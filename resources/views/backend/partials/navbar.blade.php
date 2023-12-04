<header class="header">

    <div class="header-search"> 
    </div>

    <button class="close-toggle sidebar-toggle">
        <img src="{{ url('public/assets/images/icons/hammenu-2.svg') }}" alt="">
    </button>
    <div class="header-controls">
        @if (isModuleActive('MultiBanch'))
            <x-branch-dropdown />
        @endif
        <x-language-dropdown />

        <div class="header-control-item">
            <div class="item-content dropdown">
                <a class="nav-link __clock_nav mt-0" href="javascript:void(0)">
                    <span class="clock company_name_clock fs-16" id="clock" onload="currentTime()">{{ _trans('partial.00:00:00') }}</span>
                </a>
            </div>
        </div>

        <div class="header-control-item d-none d-lg-block">

            <div class="item-content d-flex align-items-center">
                <div class="mt-0 d-flex  align-items-between pe-auto cursor-pointer pointer " role="navigation" id="topbar_messages"
                    aria-expanded="false">
                    @if (!isAttendee()['checkin'] && auth()->user()->role_id != 1)
                        <a id="demo" onclick="viewModal(`{{ route('admin.ajaxDashboardCheckinModal') }}`)"
                            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{ _trans('common.Check In') }}"
                            class="ml-2 mr-2 checkin d-flex align-items-center sm-btn-with-radius checkin-color me-3">
                            <span class="checkin-btn"><i class="las la-sign-in-alt"></i></span>
                        </a>
                    @endif
                    @if (isAttendee()['checkin'] && !isAttendee()['checkout'])
                        <a onclick="viewModal(`{{ route('admin.ajaxDashboardCheckOutModal') }}`)"
                            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{ _trans('common.Check Out') }}"
                            class="  d-flex  align-items-center sm-btn-with-radius checkout-color me-3">
                            <span class="checkout-btn"><i class="las la-sign-out-alt"></i></span>
                        </a>
                        <input type="text" hidden value="{{ url('public/assets/coffee-break.png') }}"
                            id="break_icon">
                        <span class="break_back_button">
                            @if (isBreakRunning() == 'start')
                                <a onclick="breakBack(`{{ route('admin.ajaxDashboardBreakModal_Back') }}`, `{{ route('admin.ajaxDashboardBreakModal') }}`)"
                                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{ _trans('common.Break') }}"
                                    class="ml-2 mr-2 btn-danger box-shadow d-flex align-items-center break-color sm-btn-with-radius">
                                    <span class="break-btn"><i class="las la-coffee"></i></span>

                                </a>
                            @else
                                <a onclick="breakStart(`{{ route('admin.ajaxDashboardBreakModal') }}`)"
                                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{ _trans('common.Break') }}"
                                    class="ml-2 mr-2  box-shadow d-flex align-items-center break-color sm-btn-with-radius">
                                    <span class="break-btn"><i class="las la-coffee"></i></span>
                                </a>
                            @endif
                        </span>

                    @endif
                    @if (isAttendee()['checkin'] && isAttendee()['checkout'])
                        <a id="demo" onclick="viewModal(`{{ route('admin.ajaxDashboardCheckinModal') }}`)"
                            class="ml-2 mr-2 checkin d-flex align-items-center sm-btn-with-radius checkin-color me-3">
                            <span class="checkin-btn"><i class="las la-sign-in-alt"></i></span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="header-control-item d-none d-lg-block">
            <div class="item-content">
                <button class="mt-0 noti-color sm-btn-with-radius" type="button" id="topbar_notifications"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="noti-btn" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-title="{{ _trans('common.Notification') }}"> <i class="las la-bell"></i></span>

                </button>

                <div class="dropdown-menu dropdown-menu-end topbar-dropdown-menu ot-card pv-32 ph-16 topbar_notifications"
                    aria-labelledby="topbar_notifications">
                    <div class="topbar-dropdown-header">
                        <h1>{{ _trans('common.Notifications') }}</h1>
                    </div>
                    <div class="topbar-dropdown-content">
                        @forelse (auth()->user()->unreadNotifications  as $key => $notification)
                            <a class="dropdown-item topbar-dropdown-item d-flex align-items-start" href="#">
                                @php
                                    if ($key > 5) {
                                        continue;
                                    }
                                @endphp
                                <div class="d-flex flex-column">
                                    <div class="d-flex gap-3 flex-row">
                                        <div class="item-avater">
                                            <img src="{{ uploaded_asset_with_user(@$notification->data['sender_id']) }}" alt="User" />
                                            <div class="item-badge item-icon-badge">
                                                <i class="fa-solid fa-star">&starf;</i>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <h6 class="notification">
                                                {{ @$notification->data['title'] }} <p>{!! @$notification->data['body'] !!}</p>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="item-status ml-62">
                                        <span class="time"> {{ @$notification->created_at->diffForHumans() }} </span>
                                        <span class="status-dot active"></span>
                                    </div>
                                </div>
                            </a>
                            @empty
                                <p>{{ _trans('common.No Notification Found') }}</p>


                            
                        @endforelse
                        <div class="d-flex align-items-center">
                            <a class="topbar-dropdown-footer ot-btn-primary w-100 "
                                href="{{ route('notification.index') }}">{{ _trans('common.See All Notifications') }}
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="header-control-item">
            <div class="item-content">
                <div class="profile-navigate mt-0 cursor-pointer " id="profile_expand" data-bs-toggle="dropdown"
                     role="navigation">
                    <div class="profile-photo">
                        <img  src="{{ uploaded_asset(@Auth::user()->avatar_id) }}" alt="profile">
                    </div>
                    <div class="profile-info md-none">
                        <h6>{{ @Auth::user()->name }}</h6>
                        <p> {{ @Auth::user()->designation->title }}, {{ auth()->user()->company->company_name }}</p>
                    </div>
                </div>
                <div class="dropdown-menu dropdown-menu-end profile-expand-dropdown top-navbar-dropdown-menu ot-card pa-0"
                    aria-labelledby="profile_expand">
                    <div class="profile-expand-container">
                        <div class="profile-expand-list d-flex flex-column">
                            @if (hasPermission('profile_view'))
                                <a class="profile-expand-item profile-border"
                                    href="{{ route('user.authProfile', 'personal') }}">
                                    <span>{{ _trans('common.My Profile') }}</span>
                                </a>
                            @endif
                            <a class="profile-expand-item" href="{{ route('notification.index') }}"
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{ _trans('common.Notification') }}">
                                <span><i class="las la-bell"></i>{{ _trans('common.Notification') }}</span>
                            </a>
                            <a class="profile-expand-item profile-border"
                                href="{{ route('user.authProfile', ['settings']) }}">
                                <span><i class="las la-cog"></i> {{ _trans('common.Settings') }}</span>
                            </a>
                            <a class="profile-expand-item " href="{{ route('dashboard.logout') }}">
                                <span>{{ _trans('common.Logout') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
