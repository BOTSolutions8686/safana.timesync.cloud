@extends('backend.layouts.app')
@section('title', @$data['title'])

@section('content')
    {!! breadcrumb([
        'title' => @$data['title'],
        route('admin.dashboard') => _trans('common.Dashboard'),
        '#' => @$data['title'],
    ]) !!}
    <div class="table-content table-basic">
        <div class="card">

            <div class="card-body">
                <!-- toolbar table start -->
                <div
                    class="table-toolbar d-flex flex-wrap gap-2 flex-xl-row justify-content-center justify-content-xxl-between align-content-center pb-3">
                    <div class="align-self-center">
                        <div class="d-flex flex-wrap gap-2  flex-lg-row justify-content-center align-content-center">
                            <!-- show per page -->
                            <div class="align-self-center">
                                <label>
                                    <span class="mr-8">{{ _trans('common.Show') }}</span>
                                    <select class="form-select d-inline-block" id="entries"
                                        onchange="reportAttendanceDatatable()()">
                                        <option selected value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <span class="ml-8">{{ _trans('common.Entries') }}</span>
                                </label>
                            </div>



                            <div class="align-self-center d-flex flex-wrap gap-2">
                                <div class="align-self-center">
                                    @php 
                                        use Carbon\Carbon;
                                        $todayDate = Carbon::now();
                                        $todayDateName = $todayDate->format('l');
                                        $todayDateInSqlFormat = $todayDate->format('Y-m-d');
                                    @endphp
                                    <input type="date" class="btn-daterange" value="{{ $todayDateInSqlFormat }}" id="date-input" onchange="reportAttendanceDatatable()">
                                    <!--
                                        <button type="button" class="btn-daterange" id="daterange" data-bs-toggle="tooltip"
                                            data-bs-placement="right" data-bs-title="{{ _trans('common.Date Range') }}">
                                            <span class="icon"><i class="fa-solid fa-calendar-days"></i>
                                            </span>
                                            <span class="d-none d-xl-inline">{{ _trans('common.Date Range') }}</span>
                                        </button>
                                        <input type="hidden" id="daterange-input" onchange="reportAttendanceDatatable()">
                                    -->
                                </div>
                                <!-- Designation -->
                                <div class="align-self-center">
                                    <div class="dropdown dropdown-designation" data-bs-toggle="tooltip"
                                        data-bs-placement="right" data-bs-title="{{ _trans('common.Designation') }}">
                                        <button type="button" class="btn-designation" data-bs-toggle="dropdown"
                                            aria-expanded="false" data-bs-auto-close="false">
                                            <span class="icon"><i class="fa-solid fa-user-shield"></i></span>

                                            <span class="d-none d-xl-inline">{{ _trans('common.Department') }}</span>
                                        </button>

                                        <div class="dropdown-menu align-self-center ">
                                            <select name="department_id" id="department_id"
                                                class="form-control pl-2 select2 w-100" onchange="reportAttendanceDatatable()">
                                                <option value="0" disabled selected>
                                                    {{ _trans('common.Select department') }}</option>
                                                @foreach ($data['departments'] as $role)
                                                    <option value="{{ $role->id }}">{{ @$role->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="align-self-center">
                                    <div class="dropdown dropdown-designation" data-bs-toggle="tooltip"
                                        data-bs-placement="right" data-bs-title="{{ _trans('common.Employee') }}">
                                        <button type="button" class="btn-designation" data-bs-toggle="dropdown"
                                            aria-expanded="false" data-bs-auto-close="false">
                                            <span class="icon"><i class="fa-solid fa-users"></i></span>
                                            <span class="d-none d-xl-inline">{{ _trans('common.Employee') }}</span>
                                        </button>

                                        <div class="dropdown-menu align-self-center ">
                                            <select name="user_id" class="form-control select2" id="user_id"
                                                onchange="reportAttendanceDatatable()">
                                                <option value="0" selected>{{ _trans('common.Choose Employee') }}</option>
                                                @foreach ($data['users'] as $user)
                                                    <option value="{{ $user->id }}">{{ @$user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- search -->
                                <div class="align-self-center">
                                    <div class="search-box d-flex">
                                        <input class="form-control" placeholder="{{ _trans('common.Search') }}"
                                            name="search" onkeyup="reportAttendanceDatatable()" autocomplete="off" />
                                        <span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- export -->
                    @include('backend.partials.buttons')
                </div>
                <!-- toolbar table end -->
                <!--  table start -->
                <div class="table-responsive">
                    @include('backend.partials.table')
                </div>
                <!--  table end -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        //report_attendance_table start
        function reportAttendanceDatatable(...values) {
            let data = [];
            let url = $("#report_absent_attendance_table_url").val();
            data["url"] = url;
            var shortBy = $("#short_by").val();
            data["value"] = {
                date: $('#date-input').val(),
                short_by: shortBy ? shortBy : null,
                limit: $("#entries").val(),
                search: $('input[name="search"]').val(),
                department: $("#department_id").val(),
                user_id: $("#user_id").val() ?? null,
                type: $("#type").val(),
                is_report : 1,
                _token: _token,
        };
        data["column"] = [
            "id",
            "name",
            "empID",
            "date",
            "department",
            "status"
        ];
        //  console.log(data);

        data["table_id"] = "report_attendance_table";
        table(data);
        }
        $(".report_attendance_table").length > 0 ? reportAttendanceDatatable() : "";
        //report_attendance_table end

    </script>
@endsection
