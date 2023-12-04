<?php

namespace App\Http\Controllers\Api\Auth;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProfileRepository;
use Laravel\Sanctum\PersonalAccessToken;
use App\Helpers\CoreApp\Traits\ApiReturnFormatTrait;

class AuthController extends Controller
{
    public $token = true;
    protected $profile;

    use ApiReturnFormatTrait;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profile = $profileRepository;
    }

    public function credentials($request)
    {
        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            
            return ['email' => $request->get('email'), 'password' => $request->get('password'), 'is_email' => 1];
        }
        elseif(is_string($request->get('email'))) {
            
            return ['email' => $request->get('email'), 'password' => $request->get('password'), 'is_email' => 0];
        } 
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'email' => 'required',
                'password' => 'required',
            ]);

        if ($validator->fails()) {
            return $this->responseWithError(__('Required field missing'), $validator->errors(), 422);

        }

        $credentials = $this->credentials($request);
        
        if ($credentials['is_email']) {
            $input = ['email' => $credentials['email'], 'password' => $credentials['password'], 'status_id' => 1];
        } else {
            $input = ['empID' => $credentials['email'], 'password' => $credentials['password'], 'status_id' => 1];
        }

        if (!Auth::attempt($input)) {
            return $this->responseWithError(__('Invalid Credentials'), [], 400);
        } 
        /*
        if(!Auth::attempt($request->only(['email', 'password']))){
            return $this->responseWithError(__('Invalid Email or Password'), [], 400);
        }*/


        $user = User::where('email', $request->email)
                ->orWhere('empID', $request->email)
                ->first();

        $checkUser['id'] = $user->id;
        $checkUser['company_id'] = $user->company_id;
        $checkUser['department_id'] = $user->department_id;
        $checkUser['department_name'] = $user->department->title;
        $checkUser['is_admin'] = auth()->user()->is_admin ? true : false;
        $checkUser['is_hr'] = auth()->user()->is_hr ? true : false;
        $checkUser['is_face_registered'] = auth()->user()->face_data ? true : false;
        $checkUser['name'] = $user->name;
        $checkUser['email'] = $user->email;
        $checkUser['phone'] = $user->phone;
        $checkUser['avatar'] = uploaded_asset($user->avatar_id);

        if ($user->role->app_login == 1) {
            $checkUser['token'] = $user->createToken("API TOKEN")->plainTextToken;
        } else {
            return $this->responseWithError(__('You are not allowed to login to the APP'), [], 400);
        }

        $user->save();

        // exceptional for login
        return $this->responseWithSuccess(__('Successfully Login'), $checkUser, 200);

    }

    public function logout()
    {
        try {
            auth()->user()->currentAccessToken()->delete();
            return $this->responseWithSuccess(__('Logged Out'),[], 200);

        } catch (\Throwable $th) {
            return $this->responseWithError(__('Something Went Wrong! Please Try Again'), [], 400);
        }
    }

    public function logoutAllDevices()
    {
        try {
            auth()->user()->tokens()->delete();
            return $this->responseWithSuccess(__('Successfully Logged Out from All Devices'),[], 200);

        } catch (\Throwable $th) {
            return $this->responseWithError(__('Something Went Wrong! Please Try Again'), [], 400);
        }
    }

    public function getUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
        ]);

        $token = PersonalAccessToken::findToken($request->token);
        $user = $token->tokenable;


        return response()->json(['user' => $user]);
    }

    public function sendResetLinkEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->profile->sendEmail($request);
        } catch (\Exception $exception) {
            return $this->responseWithError($exception->getMessage(), [], 500);
        }

    }

    public function changePassword(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->profile->updatePassword($request);
        } catch (\Exception $exception) {
            return $this->responseWithError($exception->getMessage(), [], 500);
        }
    }
}
