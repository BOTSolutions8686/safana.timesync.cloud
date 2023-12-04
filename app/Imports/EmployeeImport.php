<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\coreApp\Relationship\RelationshipTrait;
use App\Models\Hrm\Country\Country;
use App\Models\Hrm\Department\Department;
use App\Models\Hrm\Designation\Designation;
use App\Models\Hrm\Shift\Shift;
use App\Models\Role\Role;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EmployeeImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation
{
    private $user;
    private $role;
    private $designation;
    private $department;
    private $shift;
    private $country;
    private $branch;
    use RelationshipTrait;
    
    

    public function __construct()
    {
        $this->user = User::select('id', 'name')->get()
            ->keyBy(function ($user) {
                return strtolower($user->name);
            })
            ->toArray();
        
        $this->role = Role::select('id', 'name')->get()
            ->keyBy(function ($role) {
                return strtolower($role->name);
            })
            ->toArray();

        $this->designation = Designation::select('id', 'title')->get()
            ->keyBy(function ($designation) {
                return strtolower($designation->title);
            })
            ->toArray();

        $this->department = Department::select('id', 'title')->get()
            ->keyBy(function ($department) {
                return strtolower($department->title);
            })
            ->toArray();
        
        $this->shift = Shift::select('id', 'name')->get()
            ->keyBy(function ($shift) {
                return strtolower($shift->name);
            })
            ->toArray();

        $this->country = Country::select('id', 'name')->get()
            ->keyBy(function ($country) {
                return strtolower($country->name);
            })
            ->toArray();
        
        $this->branch = Branch::select('id', 'name')->get()
            ->keyBy(function ($branch) {
                return strtolower($branch->name);
            })
            ->toArray();
        
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            $join = Date::excelToDateTimeObject($row['joining_date']);
            $joining_date = Carbon::instance($join)->format('m/d/Y');
            if(!empty($row['dob'])){
                $dob = Date::excelToDateTimeObject($row['dob']);
                $date_birth = Carbon::instance($dob)->format('m/d/Y');
            }else{
                $date_birth = NULL;
            }

            $role = $this->role(strtolower($row['role']));
            $role_permissions = Role::find($role);
            $permissions = $role_permissions->permissions;
            
            
            $user = User::create([
                'company_id' => $this->companyInformation()->id,
                'branch_id' => $this->branch(strtolower($row['branch'])),
                'name' => $row['name'],
                'empID' => $row['employee_id'],
                'email' => $row['email'],
                'permissions' => $permissions,
                'password' => Hash::make($row['password']),
                'manager_id' => $this->user(strtolower($row['manager'])),
                'role_id' => $role,
                'phone' => $row['phone'],
                'country_id' => $this->country(strtolower($row['country'])),
                'designation_id' => $this->designation(strtolower($row['designation'])),
                'joining_date' => $joining_date,
                'department_id' => $this->department(strtolower($row['department'])),
                'birth_date' => $date_birth,
                'shift_id' => $this->shift(strtolower($row['shift'])),
                'blood_group' => $row['blood_group'],
                'gender' => $row['gender'],
                'basic_salary' => $row['gross_salary'],
                'address' => $row['address'],
                'religion' => $row['religion'],
                'marital_status' => $row['marital_status'],
                
            ]);

            $user->userRole()->create([
                'user_id' => $user->id,
                'role_id' => $role
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'employee_id' => 'required|unique:users,empID',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'manager' => 'required|exists:users,name',
            'role' => 'required|exists:roles,name',
            'branch' => 'required|exists:branches,name',
            'phone' => 'required',
            'country' => 'required|exists:countries,name',
            'designation' => 'required|exists:designations,title',
            'joining_date' => 'required',
            'department' => 'required|exists:departments,title',
            'shift' => 'required|exists:shifts,name',
            'gender' => 'required',
            'gross_salary' => 'required',
        ];
    }

    /**
     * @return array
    */
    public function customValidationMessages(): array
    {
        return [
            'name.required' => 'Name is required',
            'employee_id.required' => 'Employee Id is required',
            'employee_id.unique' => 'Employee ID is taken',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already registered',
            'password.required' => 'Password is required',
            'manager.required' => 'Manager is required',
            'manager.exists' => 'Manger Name must Exists in the System',
            'role.required' => 'Role is required',
            'role.exists' => 'Role Name must Exists in the system',
            'phone.required' => 'Phone is required',
            'country.required' => 'Country is required',
            'country.exists' => 'Country name must be in the system',
            'designation.required' => 'Designation is required',
            'designation.exists' => 'Designation Name must Exists in the System',
            'joining_date.required' => 'Joining Date is required',
            'department.required' => 'Department is required',
            'department.exists' => 'Department Name must Exists in the System',
            'dob.required' => 'Date of Birth is required',
            'shift.required' => 'Shift is required',
            'shift.exists' => 'Shift Name must Exists in the System',
            'branch.required' => 'Branch is required',
            'branch.exists' => 'Branch Name must Exists in the System',
            'gender.required' => 'Gender is required',
            'gross_salary.required' => 'Gross salary is required',
        ];
    }
   

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function headingRow(): int
    {
        return 1;
    }

    /**
     * @param $user
     * @return mixed|null
     */
    private function user($user)
    {
        if (array_key_exists($user, $this->user)) {
            $user = $this->user[$user];
            if (!$user) {
                return null;
            }
            return $user['id'];
        }
        return null;
    }

    /**
     * @param $role
     * @return mixed|null
     */
    private function role($role)
    {
        if (array_key_exists($role, $this->role)) {
            $role = $this->role[$role];
            if (!$role) {
                return null;
            }
            return $role['id'];
        }
        return null;
    }

    /**
     * @param $designation
     * @return mixed|null
     */
    private function designation($designation)
    {
        if (array_key_exists($designation, $this->designation)) {
            $designation = $this->designation[$designation];
            if (!$designation) {
                return null;
            }
            return $designation['id'];
        }
        return null;
    }

    /**
     * @param $department
     * @return mixed|null
     */
    private function department($department)
    {
        if (array_key_exists($department, $this->department)) {
            $department = $this->department[$department];
            if (!$department) {
                return null;
            }
            return $department['id'];
        }
        return null;
    }

    /**
     * @param $department
     * @return mixed|null
     */
    private function shift($shift)
    {
        if (array_key_exists($shift, $this->shift)) {
            $shift = $this->shift[$shift];
            if (!$shift) {
                return null;
            }
            return $shift['id'];
        }
        return null;
    }
    /**
     * @param $country
     * @return mixed|null
     */
    private function country($country)
    {
        if (array_key_exists($country, $this->country)) {
            $country = $this->country[$country];
            if (!$country) {
                return null;
            }
            return $country['id'];
        }
        return null;
    }

    /**
     * @param $branch
     * @return mixed|null
     */
    private function branch($branch)
    {
        if (array_key_exists($branch, $this->branch)) {
            $branch = $this->branch[$branch];
            if (!$branch) {
                return null;
            }
            return $branch['id'];
        }
        return null;
    }

}
