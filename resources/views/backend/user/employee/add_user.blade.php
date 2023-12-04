@extends('backend.layouts.app')
@section('title', @$data['title'])
@section('content')
    {!! breadcrumb([
        'title' => @$data['title'],
        route('admin.dashboard') => _trans('common.Dashboard'),
        '#' => @$data['title'],
    ]) !!}

    <div class="card ot-card">
        <div class="card-body">
            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">{{ _trans('common.Name') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control ot-form-control ot-input"
                                    placeholder="{{ _trans('common.Name') }}" value="{{ old('name') }}" >
                                @if ($errors->has('name'))
                                    <span class="error text-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">{{ _trans('common.Email') }} <span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email" placeholder="{{ _trans('common.Email') }}"
                                    autocomplete="off" class="form-control ot-form-control ot-input"
                                    value="{{ old('email') }}" >
                                @if ($errors->has('email'))
                                    <span class="error text-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                    
                                @endif
                                
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">{{ _trans('common.Phone') }} <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="phone" placeholder="{{ _trans('common.Phone') }}"
                                    autocomplete="off" class="form-control ot-form-control ot-input"
                                    value="{{ old('phone') }}" >
                                @if ($errors->has('phone'))
                                    <div class="error text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label"> {{ _trans('common.Country') }} <span
                                        class="text-danger">*</span>
                                </label>

                                <select name="country"  class="form-control ot-form-control ot-input select2 w-100" id="_country_id" >  
                            </select>
                                @if ($errors->has('country'))
                                    <div class="error text-danger">{{ $errors->first('country') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="joining_date" class="form-label">{{ _trans('common.Joining Date') }} <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="joining_date" autocomplete="off"
                                    class="form-control ot-form-control ot-input" value="{{ old('joining_date') }}"
                                    >
                                @if ($errors->has('joining_date'))
                                    <div class="error text-danger">{{ $errors->first('joining_date') }}</div>
                                @endif
                            </div>
                        </div>

                       

                        

                       

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="gender">{{ _trans('common.Date Of Birth') }}</label>
                                <input type="date" name="birth_date" autocomplete="off"
                                    class="form-control ot-form-control ot-input" value="{{ old('birth_date') }}">
                                @if ($errors->has('birth_date'))
                                    <div class="error text-danger">{{ $errors->first('birth_date') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="blood_group">{{ _trans('common.Blood Group') }}</label>
                                <select name="blood_group" class="form-select select2">
                                    <option disabled selected>{{ _trans('common.Choose One') }}
                                    </option>
                                    <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>{{ _trans('common.A+') }}
                                    </option>
                                    <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>{{ _trans('common.A-') }}
                                    </option>
                                    <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>{{ _trans('common.B+') }}
                                    </option>
                                    <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>{{ _trans('common.B-') }}
                                    </option>
                                    <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>{{ _trans('common.O+') }}
                                    </option>
                                    <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>{{ _trans('common.O-') }}
                                    </option>
                                    <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>
                                        {{ _trans('common.AB+') }}
                                    </option>
                                    <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>
                                        {{ _trans('common.AB-') }}
                                    </option>
                                </select>
                                @if ($errors->has('blood_group'))
                                    <div class="error text-danger">{{ $errors->first('blood_group') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="name"
                                    class="form-label">{{ _trans('common.Gross Salary') }} <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="basic_salary" placeholder="{{ _trans('common.Salary') }}"
                                    autocomplete="off" class="form-control ot-form-control ot-input"
                                    value="{{ old('basic_salary') }}" >
                                @if ($errors->has('basic_salary'))
                                    <div class="error text-danger">{{ $errors->first('basic_salary') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="password"
                                    class="form-label">{{ _trans('common.Password') }} <span
                                        class="text-danger">*</span> <span data-toggle="tooltip" data-placement="top" title="Leave the field blank to use the default password '12345678'"><i class="fa-solid fa-circle-info"></i></span></label>
                                <input type="text" name="password" placeholder="{{ _trans('common.Password') }}"
                                    autocomplete="off" class="form-control ot-form-control ot-input"
                                    value="{{ old('password') }}" id="password">
                                @if ($errors->has('password'))
                                    <div class="error text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">{{ _trans('common.empID') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="empID" class="form-control ot-form-control ot-input"
                                    placeholder="{{ _trans('common.empID') }}" value="{{ old('empID') }}" >
                                @if ($errors->has('empID'))
                                    <span class="error text-danger">
                                        {{ $errors->first('empID') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">{{ _trans('common.Manager') }}</label>
                                <select name="manager_id" class="form-select change-role select2" >
                                    @foreach ($data['managers'] as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('manager'))
                                    <span class="error text-danger">
                                        {{ $errors->first('manager') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="col-md-12" @if(Auth::user()->is_admin) style="visibility:visible;" @else style="visibility: hidden;" @endif>
                            <div class="form-group mb-3">
                                <label class="form-label" for="name" class="form-label">{{ _trans('common.Role') }}
                                    <span class="text-danger">*</span></label> 
                                <select name="role_id" class="form-select change-role select2">
                                    <option value="" disabled >
                                        {{ _trans('common.Choose One') }}</option>
                                    @foreach ($data['roles'] as $role)
                                        <option @if($role->slug == 'staff') selected @endif value="{{ $role->id }}">{{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role_id'))
                                    <span class="error text-danger">
                                        {{ $errors->first('role_id') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="designation_id" class="form-label">{{ _trans('common.Designation') }} <span
                                        class="text-danger">*</span></label>
                                <select name="designation_id" class="form-select select2" >
                                    <option value="" disabled >{{ _trans('common.Choose One') }}
                                    </option>
                                    @foreach ($data['designations'] as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->title }}</option>
                                    @endforeach
                                </select>
                                 @if ($errors->has('designation_id'))
                                    <span class="error text-danger">
                                        {{ $errors->first('designation_id') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">{{ _trans('common.Department') }} <span
                                        class="text-danger">*</span></label>
                                <select name="department_id" class="form-select select2" >
                                    <option value="" disabled>{{ _trans('common.Choose One') }}
                                    </option>
                                    @foreach ($data['departments'] as $department)
                                        <option value="{{ $department->id }}">{{ $department->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="shift_id" class="form-label">{{ _trans('common.Shift') }} <span
                                        class="text-danger">*</span></label>
                                <select name="shift_id" class="form-select select2" >
                                    <option value="" disabled>{{ _trans('common.Choose One') }}
                                    </option>
                                    @foreach ($data['shifts'] as $shift)
                                        <option value="{{ $shift->id }}">{{ $shift->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">{{ _trans('common.Gender') }} <span
                                        class="text-danger">*</span></label>
                                <select name="gender" 
                                    class="form-select demo-select2-placeholder {{ $errors->has('gender') ? 'is-invalid' : '' }} select2">
                                    <option disabled selected>{{ _trans('common.Choose One') }}</option>
                                    <option value="0" {{ old('gender') == 0 ? 'selected' : '' }}>
                                        {{ _trans('common.Male') }}</option>
                                    <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>
                                        {{ _trans('common.Female') }}</option>
                                    <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>
                                        {{ _trans('common.Unisex') }}</option>
                                </select>
                                @if ($errors->has('gender'))
                                    <span class="error text-danger">
                                        {{ $errors->first('gender') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">{{ _trans('common.Address') }}</label>
                                <input type="text" name="address" placeholder={{ _trans('common.Address') }}
                                    autocomplete="off" class="form-control ot-form-control ot-input"
                                    value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <div class="error text-danger">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="gender">{{ _trans('common.Religion') }}</label>

                                <select name="religion" id="religion" class="form-select select2">
                                    <option disabled selected>{{ _trans('common.Choose One') }}
                                    </option>
                                    <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>
                                        {{ _trans('common.Islam') }}
                                    </option>
                                    <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>
                                        {{ _trans('common.Hindu') }}
                                    </option>
                                    <option value="Christan" {{ old('religion') == 'Christan' ? 'selected' : '' }}>
                                        {{ _trans('common.Christan') }}
                                    </option>
                                </select>
                                @if ($errors->has('religion'))
                                    <div class="error text-danger">{{ $errors->first('religion') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label"
                                    for="marital_status">{{ _trans('common.Marital Status') }}</label>
                                <select name="marital_status" id="marital_status" class="form-select select2">
                                    <option disabled selected>{{ _trans('common.Choose One') }}
                                    </option>
                                    <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>
                                        {{ _trans('common.Married') }}</option>
                                    <option value="Unmarried"
                                        {{ old('marital_status') == 'Unmarried' ? 'selected' : '' }}>
                                        {{ _trans('common.Unmarried') }}</option>
                                </select>
                                @if ($errors->has('marital_status'))
                                    <div class="error text-danger">{{ $errors->first('marital_status') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-end">
                            <div class="form-group mt-3 mb-3">
                                @if (hasPermission('user_create'))
                                    <button type="submit"
                                        class="btn btn-gradian mr-3">{{ _trans('common.Submit') }}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    </div>

@endsection
@section('script')
    <script src="{{ url('public/backend/js/pages/__profile.js') }}"></script>
@endsection
