@extends('backend.layouts.app')
@section('title', @$data['title'])

@section('content')
    {!! breadcrumb([
        'title' => @$data['title'],
        route('admin.dashboard') => _trans('common.Dashboard'),
        '#' => @$data['title'],
    ]) !!}

    <div class="card mb-5">
        
        <div class="card-body">
            <form action="{{ route('user.post-import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="file">File* (.csv, .xlsx, .xls)</label>
                        <input type="file" class="form-control" name="file" accept=".csv, .xlsx, .xls">
                    
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-direction-row align-items-center">
                            <button type="submit" class="btn btn-export ot-btn-primary mt-3 mr-16">
                                <span><i class="fa-solid fa-file-import"></i> </span>
                                Upload
                            </button>
                            <a href="{{ asset('/public/backend/tempelates/import_employees.xlsx') }}" download="import_employees.xlsx" type="button" class="btn btn-export ot-btn-success mt-3">
                                <span><i class="fa-solid fa-download"></i> </span>
                                Download Tempelate
                            </a>
                        </div>
                    </div>
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger mt-5">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-body">
            <table class="table table-bordered table-slim">
                <tr>
                    <td><strong>Name</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>Branch</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>Employee Id</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>Password</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>Manager</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>Role</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>Phone</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>Designation</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>Joining Date</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>Department</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>DOB (Format: MM/DD/YYYY)</strong></td>
                    <td class="text-success">Optional</td>
                </tr>
                <tr>
                    <td><strong>Shift</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>Blood Group</strong></td>
                    <td class="text-success">Optional</td>
                </tr>
                <tr>
                    <td><strong>Gender</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>Gross Salary</strong></td>
                    <td class="text-danger">Required</td>
                </tr>
                <tr>
                    <td><strong>Address</strong></td>
                    <td class="text-success">Optional</td>
                </tr>
                <tr>
                    <td><strong>Religion</strong></td>
                    <td class="text-success">Optional</td>
                </tr>
                <tr>
                    <td><strong>Marital Status</strong></td>
                    <td class="text-success">Optional</td>
                </tr>
            </table>
        </div>
    </div>
    
  
@endsection
@section('script')
   
@endsection
