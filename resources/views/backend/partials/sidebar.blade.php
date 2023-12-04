<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
                <a href="{{ route('admin.dashboard') }}" class="img-tag sidebar_logo">
                    @include('backend.auth.backend_logo')
                    <img class="half-logo" src="{{ uploaded_asset(@base_settings('company_icon')) }}" alt="Icon"
                        width="15" >
                </a>
        </div>

        <button class="half-expand-toggle sidebar-toggle">
            <img src="{{ url('public/assets/images/icons/collapse-arrow.svg') }}" alt="" >
        </button>
        <button class="close-toggle sidebar-toggle">
            <img src="{{ url('public/assets/images/icons/collapse-arrow.svg') }}" alt="" >
        </button>
    </div>
    <div class="sidebar-menu">
        <div class="sidebar-menu-section">
            <!-- parent menu list start  -->
            <ul class="sidebar-dropdown-menu parent-menu-list">
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="parent-item-content {{ set_active(route('admin.dashboard')) }}">
                        <i class="las la-home "></i>
                        <span class="on-half-expanded">{{ _trans('common.Dashboard') }}</span>
                    </a>
                </li>
                {{-- superadmin sidebar --}}
                @if (hasPermission('company_read') && config('app.APP_BRANCH') != 'nonsaas')
                    <li class="sidebar-menu-item">
                        <a href="javascript:void(0)" class="parent-item-content has-arrow">


                            <span class="on-half-expanded">
                                {{ _trans('common.Company') }}
                            </span>
                        </a>
                        <ul class="child-menu-list {{ set_active(['dashboard/companies*']) }}">
                            @if (hasPermission('company_read'))
                                <li class="sidebar-menu-item {{ menu_active_by_route(['dashboard/companies*']) }}">
                                    <a href="{{ route('company.index') }}"
                                        class="  {{ set_active(route('company.index')) }}">
                                        <span>{{ _trans('common.Company List') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (hasPermission('hr_menu'))
                    <li class="sidebar-menu-item ">
                        <a href="javascript:void(0)"
                            class="parent-item-content has-arrow {{ menu_active_by_route(['designation.index', 'designation.edit', 'designation.create', 'department.index', 'department.edit', 'department.create', 'roles.index', 'roles.edit', 'roles.create','branches.index']) }}">
                            <i class="fa-solid fa-users-viewfinder"></i>
                            <span class="on-half-expanded">
                                {{ _trans('common.HR') }}
                            </span>
                        </a>
                        <ul
                            class="child-menu-list {{ set_active(['hrm/designation*', 'hrm/department*', 'hrm/roles*']) }}">

                            @if (hasPermission('designation_read'))
                                <li
                                    class="sidebar-menu-item {{ menu_active_by_route(['designation.index', 'designation.edit', 'designation.create']) }}">
                                    <a href="{{ route('designation.index') }}"
                                        class="  {{ set_active(route('designation.index')) }}">
                                        <span>{{ _trans('common.Designations') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('department_read'))
                                <li
                                    class="sidebar-menu-item {{ menu_active_by_route(['department.index', 'department.edit', 'department.create']) }}">
                                    <a href="{{ route('department.index') }}"
                                        class="  {{ set_active(route('department.index')) }}">
                                        <span>{{ _trans('common.Departments') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (hasPermission('role_read'))
                                <li
                                    class="sidebar-menu-item {{ menu_active_by_route(['roles.index', 'roles.edit', 'roles.create']) }}">
                                    <a href="{{ route('roles.index') }}" class=" {{ set_active('dashboard/roles') }}">
                                        <span>{{ _trans('common.Roles') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('branch_read') && isModuleActive('MultiBanch'))
                                <li
                                    class="sidebar-menu-item {{ menu_active_by_route(['branches.index', 'branches.edit', 'branches.create']) }}">
                                    <a href="{{ route('branches.index') }}" class=" {{ set_active('dashboard/branches') }}">
                                        <span>{{ _trans('common.Branches') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (hasPermission('user_menu'))
                    <li class="sidebar-menu-item ">
                        <a href="{{ route('user.index') }}"
                            class="parent-item-content {{ menu_active_by_route(['user.index', 'user.edit', 'user.create']) }}">
                            <i class="las la-users"></i>
                            <span class="on-half-expanded">
                                {{ _trans('common.Employees') }}
                            </span>
                        </a>
                    </li>
                @endif
                @if (hasPermission('leave_menu'))
                    <li class="sidebar-menu-item {{ set_menu([route('leave.index'), route('assignLeave.index')]) }}">
                        <a href="javascript:void(0)"
                            class="parent-item-content has-arrow {{ menu_active_by_route(['leave.index', 'leave.create', 'leave.edit', 'assignLeave.index', 'assignLeave.create', 'assignLeave.edit', 'leaveRequest.index', 'leaveRequest.create']) }}">
                            <i class="las la-sign-out-alt"></i>
                            <span class="on-half-expanded">
                                {{ _trans('common.Leave Management') }}

                            </span>
                        </a>
                        <ul
                            class="child-menu-list {{ set_active(['hrm/leave*', 'hrm/leave/assign*', 'hrm/leave/request*']) }}">
                            @if (hasPermission('leave_type_read'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['leave.index', 'leave.create', 'leave.edit']) }}">
                                    <a href="{{ route('leave.index') }}"
                                        class=" {{ set_active(route('leave.index')) }}">
                                        <span>{{ _trans('common.Type') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('leave_assign_read'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['assignLeave.index', 'assignLeave.create', 'assignLeave.edit']) }}">
                                    <a href="{{ route('assignLeave.index') }}"
                                        class=" {{ set_active(route('assignLeave.index')) }}">
                                        <span> {{ _trans('leave.Assign Leave') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('leave_request_read'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['leaveRequest.index', 'leaveRequest.create']) }}">
                                    <a href="{{ route('leaveRequest.index') }}"
                                        class=" {{ set_active(route('leaveRequest.index')) }}">
                                        <span>{{ _trans('leave.Leave Request') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('leave_request_read'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['dailyLeave.index']) }}">
                                    <a href="{{ route('dailyLeave.index') }}"
                                        class=" {{ set_active(route('dailyLeave.index')) }}">
                                        <span>{{ _trans('leave.Daily Leave') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (hasPermission('attendance_menu'))
                    <li class="sidebar-menu-item {{ set_menu([route('weekendSetup.index')]) }}">
                        <a href="javascript:void(0)"
                            class="parent-item-content has-arrow {{ menu_active_by_route('attendance.index', 'shift.index') }}">
                            <i class="las la-user-check"></i>
                            <span class="on-half-expanded">
                                {{ _trans('attendance.Attendance') }}

                            </span>
                        </a>
                        <ul class="child-menu-list {{ set_active(['hrm/attendance*']) }}">



                            @if (hasPermission('attendance_read'))
                                <li class="nav-item {{ menu_active_by_route('attendance.index') }}">
                                    <a href="{{ route('attendance.index') }}"
                                        class=" {{ set_active(route('attendance.index')) }}">
                                        <span>{{ _trans('attendance.Attendance') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('generate_qr_code') && settings('attendance_method') == 'QR')
                                <li class="nav-item {{ menu_active_by_route('hrm.qr.index') }}">
                                    <a href="{{ route('hrm.qr.index') }}"
                                        class=" {{ set_active(route('hrm.qr.index')) }}">
                                        <span>{{ _trans('attendance.QR Code') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (hasPermission('payroll_menu'))
                    <li class="sidebar-menu-item {{ set_menu([route('hrm.payroll_items.index')]) }}">
                        <a href="javascript:void(0)"
                            class="parent-item-content has-arrow {{ menu_active_by_route(['hrm.payroll_items.index', 'hrm.payroll_setup.index', 'hrm.payroll_setup.user_setup', 'hrm.payroll_setup.user_commission_setup', 'hrm.payroll_advance_type.index', 'hrm.payroll_advance_salary.index', 'hrm.payroll_advance_salary.create', 'hrm.payroll_advance_salary.edit', 'hrm.payroll_advance_salary.show', 'hrm.payroll_salary.index', 'hrm.payroll_salary.show', 'hrm.payroll_salary.invoice']) }}">
                            <i class="las la-comment-dollar"></i>
                            <span class="on-half-expanded">
                                {{ _trans('payroll.Payroll') }}

                            </span>
                        </a>
                        <ul class="child-menu-list {{ set_active(['hrm/payroll*']) }}">

                            @if (hasPermission('payroll_item_menu'))
                                <li class="nav-item {{ menu_active_by_route(['hrm.payroll_items.index']) }}">
                                    <a href="{{ route('hrm.payroll_items.index') }}" class="">
                                        <span> {{ _trans('payroll.Commissions') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('payroll_set_menu'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['hrm.payroll_setup.index', 'hrm.payroll_setup.user_setup', 'hrm.payroll_setup.user_commission_setup']) }}">
                                    <a href="{{ route('hrm.payroll_setup.index') }}" class="">
                                        <span> {{ _trans('payroll.Setup') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (hasPermission('advance_type_list'))
                                <li class="nav-item {{ menu_active_by_route(['hrm.payroll_advance_type.index']) }}">
                                    <a href="{{ route('hrm.payroll_advance_type.index') }}" class="">
                                        <span> {{ _trans('payroll.Advance Type') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('advance_salaries_list'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['hrm.payroll_advance_salary.index', 'hrm.payroll_advance_salary.create', 'hrm.payroll_advance_salary.edit', 'hrm.payroll_advance_salary.show']) }}">
                                    <a href="{{ route('hrm.payroll_advance_salary.index') }}" class="">
                                        <span> {{ _trans('payroll.Advance') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (hasPermission('payroll_set_menu'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['hrm.payroll_salary.index', 'hrm.payroll_salary.show', 'hrm.payroll_salary.invoice']) }}">
                                    <a href="{{ route('hrm.payroll_salary.index') }}" class="">
                                        <span> {{ _trans('payroll.Salary Generate') }}</span>
                                    </a>
                                </li>
                            @endif
                            

                            {{-- @if (hasPermission('payroll_set_menu'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['hrm.monthly.salary.table', 'hrm.payroll_salary.show', 'hrm.payroll_salary.invoice']) }}">
                                    <a href="{{ route('hrm.monthly.salary.table') }}" class="">
                                        <span> {{ _trans('payroll.Salary Sheet') }}</span>
                                    </a>
                                </li>
                            @endif --}}


                        </ul>
                    </li>
                @endif
                @if (hasPermission('account_menu'))
                    <li class="sidebar-menu-item {{ set_menu([route('hrm.accounts.index', 'hrm.accounts.create')]) }}">
                        <a href="javascript:void(0)"
                            class="parent-item-content has-arrow {{ menu_active_by_route(['hrm.accounts.index', 'hrm.deposits.index', 'hrm.expenses.index', 'hrm.transactions.index', 'hrm.accounts.create', 'hrm.accounts.edit', 'hrm.deposits.create', 'hrm.deposits.edit', 'hrm.expenses.create', 'hrm.expenses.edit', 'hrm.expenses.show', 'hrm.deposit_category.deposit', 'hrm.deposit_category.expense', 'hrm.payment_method.index']) }}">
                            <i class="las la-file-invoice-dollar"></i>
                            <span class="on-half-expanded">
                                {{ _trans('payroll.Accounts') }}

                            </span>
                        </a>
                        <ul
                            class="child-menu-list {{ set_active(['hrm/accounts*', 'hrm/transactions*', 'hrm/deposit*', 'hrm/expenses*', 'hrm/account-settings*', 'hrm/payment-method*']) }}">


                            @if (hasPermission('account_menu'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['hrm.accounts.index', 'hrm.accounts.create', 'hrm.accounts.edit']) }}">
                                    <a href="{{ route('hrm.accounts.index') }}" class="">
                                        <span> {{ _trans('payroll.Account List') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (hasPermission('deposit_menu'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['hrm.deposits.index', 'hrm.deposits.create', 'hrm.deposits.edit']) }}">
                                    <a href="{{ route('hrm.deposits.index') }}" class="">
                                        <span> {{ _trans('payroll.Deposit') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (hasPermission('expense_menu'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['hrm.expenses.index', 'hrm.expenses.create', 'hrm.expenses.edit', 'hrm.expenses.show']) }}">
                                    <a href="{{ route('hrm.expenses.index') }}" class="">
                                        <span> {{ _trans('payroll.Expense') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (hasPermission('transaction_menu'))
                                <li class="nav-item {{ menu_active_by_route(['hrm.transactions.index']) }}">
                                    <a href="{{ route('hrm.transactions.index') }}" class="">
                                        <span> {{ _trans('payroll.Transaction History') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('deposit_category_menu'))
                                <li class="sidebar-menu-item {{ set_menu([route('hrm.deposit_category.expense')]) }}">
                                    <a href="javascript:void(0)"
                                        class="parent-item-content has-arrow {{ menu_active_by_route(['hrm.deposit_category.deposit', 'hrm.deposit_category.expense', 'hrm.payment_method.index']) }}">
                                        <span class="-text font-purple">
                                            {{ _trans('payroll.Accounts Settings') }}

                                        </span>
                                    </a>
                                    <ul
                                        class="child-menu-list {{ set_active(['hrm/account-settings*', 'hrm/payment-method*']) }} pl-2">


                                        @if (hasPermission('deposit_category_menu'))
                                            <li
                                                class="nav-item {{ menu_active_by_route(['hrm.deposit_category.deposit']) }}">
                                                <a href="{{ route('hrm.deposit_category.deposit') }}"
                                                    class="">
                                                    <span> {{ _trans('payroll.Deposit Category') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (hasPermission('deposit_category_menu'))
                                            <li
                                                class="nav-item {{ menu_active_by_route(['hrm.deposit_category.expense']) }}">
                                                <a href="{{ route('hrm.deposit_category.expense') }}"
                                                    class="">
                                                    <span> {{ _trans('expense.Expense Category') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (hasPermission('payment_method_menu'))
                                            <li
                                                class="nav-item {{ menu_active_by_route(['hrm.payment_method.index']) }}">
                                                <a href="{{ route('hrm.payment_method.index') }}" class="">
                                                    <span> {{ _trans('payment_method.Payment Method') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                    </ul>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif
                {{-- Start Client Module --}}
                @include('backend.client.sidebar')
                {{-- End Client Module --}}

                {{-- task management start --}}
                @include('backend.task.sidebar')
                {{-- project management end --}}

                {{-- project management start --}}
                @include('backend.project.sidebar')
                {{-- project management end --}}

                {{-- award management start --}}
                @include('backend.award.sidebar')
                {{-- award management end --}}

                {{-- Start Travel Routes --}}
                @include('backend.travel.sidebar')
                {{-- End Travel Routes --}}



                {{-- Start performance Routes --}}
                @include('backend.performance.sidebar')
                {{-- End performance Routes --}}

                {{-- Start meeting Routes --}}
                @include('backend.meeting.sidebar')
                {{-- End meeting Routes --}}
                @if (hasPermission('appointment_menu'))
                    <li class="sidebar-menu-item {{ set_menu([route('appointment.index', 'appointment.create')]) }}">
                        <a href="javascript:void(0)"
                            class="parent-item-content has-arrow  {{ menu_active_by_route(['appointment.index', 'appointment.create']) }}">
                            <i class="las la-calendar-check"></i>
                            <span class="on-half-expanded">
                                {{ _trans('appointment.Appointment') }}

                            </span>
                        </a>
                        <ul class="child-menu-list {{ set_active(['hrm/appointment*']) }}">

                            <li
                                class="nav-item {{ menu_active_by_route(['appointment.index', 'appointment.create']) }}">
                                <a href="{{ route('appointment.index') }}"
                                    class="  {{ set_active(route('appointment.index', 'appointment.create')) }}">
                                    <span>{{ _trans('common.List') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (hasPermission('visit_menu'))
                    <li class="sidebar-menu-item {{ set_menu([route('visit.index')]) }}">
                        <a href="javascript:void(0)"
                            class="parent-item-content has-arrow {{ menu_active_by_route(['visit.index']) }}">
                            <i class="las la-map-marked-alt"></i>
                            <span class="on-half-expanded">
                                {{ _trans('common.Visit') }}

                            </span>
                        </a>
                        <ul class="child-menu-list {{ set_active(['hrm/visit*']) }}">
                            @if (hasPermission('visit_read'))
                                <li class="nav-item {{ menu_active_by_route(['visit.index']) }}">
                                    <a href="{{ route('visit.index') }}" class="">
                                        <span>{{ _trans('common.Manage visit') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (hasPermission('support_menu'))
                    <li
                        class="sidebar-menu-item {{ set_menu([route('supportTicket.index', 'supportTicket.create')]) }}">
                        <a href="javascript:void(0)"
                            class="parent-item-content has-arrow {{ menu_active_by_route(['supportTicket.index', 'supportTicket.create', 'supportTicket.reply']) }}">
                            <i class="las la-ticket-alt"></i>
                            <span class="on-half-expanded">
                                {{ _trans('common.Support') }}

                            </span>
                        </a>
                        <ul class="child-menu-list {{ set_active(['hrm/support/ticket*']) }}">
                            @if (hasPermission('support_read'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['supportTicket.index', 'supportTicket.create', 'supportTicket.reply']) }}">
                                    <a href="{{ route('supportTicket.index') }}" class="">
                                        <span> {{ _trans('common.Tickets') }}</span> </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (hasPermission('announcement_menu'))
                    <li class="sidebar-menu-item  {{ set_menu(['notice.index', 'notice.create', 'notice.edit']) }} ">
                        <a href="javascript:void(0)"
                            class="parent-item-content has-arrow {{ menu_active_by_route(['notice.index', 'notice.create', 'notice.edit']) }}">
                            <i class="las la-bullhorn"></i>
                            <span class="on-half-expanded">
                                {{ _trans('common.Announcement') }}

                            </span>
                        </a>
                        <ul
                            class="child-menu-list  {{ set_active(['announcement/*', 'dashboard/announcement/*']) }}">

                            @if (hasPermission('notice_menu'))
                                <li
                                    class="nav-item  {{ menu_active_by_route(['notice.index', 'notice.create', 'notice.edit']) }} ">
                                    <a href="{{ route('notice.index') }}"
                                        class="  {{ menu_active_by_route(['notice.index', 'notice.create', 'notice.edit']) }} ">
                                        <span>{{ _trans('common.Notice') }}</span> <span
                                            class="badge badge-info d-none fs-6 p-s">5</span> </a>
                                </li>
                            @endif

                            @if (hasPermission('send_email_menu'))
                                <li class="nav-item d-none">
                                    <a href="#" class="">
                                        <span>{{ _trans('common.Send E-mail') }}</span> </a>
                                </li>
                            @endif
                            @if (hasPermission('send_notification_menu'))
                                <li class="nav-item d-none">
                                    <a href="#" class="">
                                        <span>{{ _trans('common.Send Notification') }}</span> </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (hasPermission('contact_menu'))
                    <li class="sidebar-menu-item">
                        <a href="{{ route('contact.index') }}"
                            class="parent-item-content {{ menu_active_by_route(['contact.index']) }}">
                            <i class="las la-inbox"></i>
                            <span class="on-half-expanded">
                                {{ _trans('common.Contacts') }}
                            </span>
                        </a>
                    </li>
                @endif


                @if (hasPermission('report_menu'))
                    <li class="sidebar-menu-item {{ set_menu([route('attendanceReport.index')]) }}">
                        <a href="javascript:void(0)"
                            class="parent-item-content has-arrow {{ menu_active_by_route(['live_trackingReport.index', 'attendanceReport.index', 'breakReport.index', 'payment.index', 'report_visit.index', 'report_leave']) }}">
                            <i class="las la-clipboard-list"></i>
                            <span class="on-half-expanded">
                                {{ _trans('common.Report') }}

                            </span>
                        </a>
                        <ul class="child-menu-list {{ set_active(['hrm/report/*', 'hrm/break/*', 'hrm/expense/payment']) }}">

                            @if (hasPermission('live_tracking_read'))
                                <li class="nav-item {{ menu_active_by_route(['live_trackingReport.index']) }}">
                                    <a href="{{ route('live_trackingReport.index') }}"
                                        class=" {{ set_active(route('live_trackingReport.index')) }}">
                                        <span>{{ _trans('common.Live Tracking') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if(hasPermission('location_history'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['live_trackingReportHistory.index']) }}">
                                    <a href="{{ route('live_trackingReportHistory.index') }}"
                                        class=" {{ set_active(route('live_trackingReportHistory.index')) }}">
                                        <span>{{ _trans('common.Location History') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (hasPermission('attendance_report_read'))
                                <li class="nav-item {{ menu_active_by_route(['attendanceReport.index']) }}">
                                    <a href="{{ route('attendanceReport.index') }}"
                                        class=" {{ set_active(route('attendanceReport.index')) }}">
                                        <span>{{ _trans('attendance.Attendance report') }}</span>
                                    </a>
                                </li>
                            @endif

                            <!--Present Attendance Report -->
                            @if (hasPermission('present_attendance_report'))
                                <li class="nav-item {{ menu_active_by_route(['PresentAttendanceReport.PresentAttendance']) }}">
                                    <a href="{{ route('PresentAttendanceReport.PresentAttendance') }}"
                                        class=" {{ set_active(route('PresentAttendanceReport.PresentAttendance')) }}">
                                        <span>{{ _trans('attendance.Present Attendance Report') }}</span>
                                    </a>
                                </li>
                            @endif

                            <!--Late Attendance Report -->
                            @if (hasPermission('late_attendance_report'))
                                <li class="nav-item {{ menu_active_by_route(['LateAttendanceReport.LateAttendance']) }}">
                                    <a href="{{ route('LateAttendanceReport.LateAttendance') }}"
                                        class=" {{ set_active(route('LateAttendanceReport.LateAttendance')) }}">
                                        <span>{{ _trans('attendance.Late Attendance Report') }}</span>
                                    </a>
                                </li>
                            @endif

                            <!--Absent Attendance Report -->
                            @if (hasPermission('absent_attendance_report'))
                                <li class="nav-item {{ menu_active_by_route(['AbsentAttendanceReport.AbsentAttendance']) }}">
                                    <a href="{{ route('AbsentAttendanceReport.AbsentAttendance') }}"
                                        class=" {{ set_active(route('AbsentAttendanceReport.AbsentAttendance')) }}">
                                        <span>{{ _trans('attendance.Absent Attendance Report') }}</span>
                                    </a>
                                </li>
                            @endif

                            <!--NoCheckout Attendance Report -->
                            @if (hasPermission('no_checkout_report'))
                                <li class="nav-item {{ menu_active_by_route(['NoCheckoutReport.NoCheckout']) }}">
                                    <a href="{{ route('NoCheckoutReport.NoCheckout') }}"
                                        class=" {{ set_active(route('NoCheckoutReport.NoCheckout')) }}">
                                        <span>{{ _trans('attendance.NoCheckout Attendance Report') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (hasPermission('break_report'))
                                <li class="nav-item {{ menu_active_by_route(['breakReport.index']) }}">
                                    <a href="{{ route('breakReport.index') }}"
                                        class=" {{ set_active(route('breakReport.index')) }}">
                                        <span>{{ _trans('common.Break report') }}</span>
                                    </a>
                                </li>
                            @endif


                            @if (hasPermission('payment_read'))
                                <li class="nav-item {{ menu_active_by_route(['payment.index']) }}">
                                    <a href="{{ route('payment.index') }}"
                                        class=" {{ set_active(route('payment.index')) }}">
                                        <span>{{ _trans('common.Payment Report') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('visit_read'))
                                <li class="nav-item {{ menu_active_by_route(['report_visit.index']) }}">
                                    <a href="{{ route('report_visit.index') }}" class="">
                                        <span>{{ _trans('common.Visit Reports') }}</span>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if (hasPermission('company_setup_menu'))
                    <li class="sidebar-menu-item">
                        <a href="javascript:void(0)"
                            class="parent-item-content has-arrow {{ menu_active_by_route([
                                'company.settings.configuration',
                                'weekendSetup.index',
                                'holidaySetup.index',
                                'dutySchedule.index',
                                'shift.index',
                                'ipConfig.index',
                                'ipConfig.create',
                                'company.settings.location',
                                'company.settings.locationCreate',
                                'company.settings.locationEdit',
                                'company.settings.activation',
                                'holidaySetup.create',
                                'holidaySetup.show',
                                'dutySchedule.create',
                                'dutySchedule.edit',
                            ]) }}">
                            <i class="las la-tools"></i>
                            <span class="on-half-expanded">
                                {{ _trans('common.Setup & Configuration') }}

                            </span>
                        </a>
                        <ul
                            class="child-menu-list  {{ set_active(['admin/company-setup*', 'hrm/weekend/setup*', 'hrm/holiday/setup*', 'hrm/duty/schedule*', 'hrm/shift*', 'hrm/ip-whitelist*', 'hrm/location*']) }}">

                            @if (hasPermission('company_setup_configuration'))
                                <li class="nav-item {{ menu_active_by_route(['company.settings.configuration']) }}">
                                    <a href="{{ route('company.settings.configuration') }}" class=" ">
                                        <span>{{ _trans('common.Configurations') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (hasPermission('weekend_read'))
                                <li class="nav-item {{ menu_active_by_route(['weekendSetup.index']) }}">
                                    <a href="{{ route('weekendSetup.index') }}"
                                        class=" {{ set_active([route('weekendSetup.index')]) }}">
                                        <span>{{ _trans('attendance.Weekend Setup') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('holiday_read'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['holidaySetup.index', 'holidaySetup.create', 'holidaySetup.show']) }}">
                                    <a href="{{ route('holidaySetup.index') }}"
                                        class=" {{ menu_active_by_route(['holidaySetup.index', 'holidaySetup.create', 'holidaySetup.show']) }}">
                                        <span>{{ _trans('attendance.Holiday Setup') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('shift_read'))
                                <li class="nav-item {{ menu_active_by_route('shift.index') }}">
                                    <a href="{{ route('shift.index') }}"
                                        class=" {{ set_active(route('shift.index')) }}">
                                        <span>{{ _trans('attendance.Shift Setup') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('schedule_read'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['dutySchedule.index', 'dutySchedule.create', 'dutySchedule.show']) }}">
                                    <a href="{{ route('dutySchedule.index') }}"
                                        class=" {{ menu_active_by_route(['dutySchedule.index', 'dutySchedule.create', 'dutySchedule.show']) }}">
                                        <span>{{ _trans('attendance.Duty Schedule') }}</span>
                                    </a>
                                </li>
                            @endif




                            @if (hasPermission('company_setup_ip_whitelist'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['ipConfig.index', 'ipConfig.create']) }}">
                                    <a href="{{ route('ipConfig.index') }}" class="">
                                        <span>{{ _trans('common.IP Whiltelist') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (hasPermission('company_setup_location'))
                                <li
                                    class="nav-item {{ menu_active_by_route(['company.settings.location', 'company.settings.locationCreate', 'company.settings.locationEdit']) }}">
                                    <a href="{{ route('company.settings.location') }}" class="">
                                        <span>{{ _trans('common.Locations') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (hasPermission('company_setup_activation'))
                                <li class="nav-item {{ menu_active_by_route('company.settings.activation') }}">
                                    <a href="{{ route('company.settings.activation') }}" class="">
                                        <span>{{ _trans('common.Activation') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

             

                @if (hasPermission('general_settings_read'))
                    <li class="sidebar-menu-item">
                        <a href="javascript:void(0)"
                            class="parent-item-content has-arrow {{ menu_active_by_route(['manage.settings.view', 'appScreenSetup', 'ipConfig.create', 'language.index', 'language.setup']) }}">
                            <i class="las la-cog"></i>
                            <span class="on-half-expanded">
                                {{ _trans('common.Settings') }}
                            </span>
                        </a>
                        <ul
                            class="child-menu-list  {{ set_active(['admin/settings*', 'admin/settings/list', 'admin/settings/leave*', 'admin/settings/ip-configuration*', 'company/settings', 'admin/settings/app-setting/dashboard', 'admin/settings/language-setup']) }}">
                            @if (hasPermission('general_settings_read'))
                                <li class="nav-item {{ menu_active_by_route('manage.settings.view') }}">
                                    <a href="{{ route('manage.settings.view') }}"
                                        class=" {{ set_active('admin/settings/list') }}">
                                        <span>{{ _trans('common.General Settings') }}</span>
                                    </a>
                                </li>
                            @endif

                            {{-- get config file value --}}
                            @if (Config::get('app.APP_BRANCH') == 'nonsaas')
                                @if (hasPermission('app_settings_menu'))
                                    <li class="nav-item {{ menu_active_by_route('appScreenSetup') }}">
                                        <a href="{{ route('appScreenSetup') }}"
                                            class=" {{ set_active('admin/settings/contact/*') }}">
                                            <span>{{ _trans('common.App Setting') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if (hasPermission('content_menu'))
                                <li class="nav-item {{ menu_active_by_route(['content.list']) }}">
                                            <a href="{{ route('content.list') }}"
                                        class="nav-link {{ set_active('admin/settings/app-setting/dashboard/*') }}">
                                        <span>{{ _trans('common.Contents') }}</span>
                                    </a>
                                </li>
                            @endif

                                @if (hasPermission('language_menu'))
                                    <li
                                        class="nav-item {{ menu_active_by_route(['language.index', 'language.setup']) }}">
                                        <a href="{{ route('language.index') }}"
                                            class=" {{ set_active('admin/settings/language/*') }}">
                                            <span>{{ _trans('settings.Language') }}</span>
                                        </a>
                                    </li>
                                @endif


                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
            <!-- parent menu list end  -->
        </div>
    </div>
</aside>
