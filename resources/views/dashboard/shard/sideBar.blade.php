<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="index.html"><img src="{{ asset('assets/img/logo-v.png') }}"
                class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="index.html"><img src="../../assets/img/brand/logo-white.png"
                class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="index.html"><img
                src="../../assets/img/brand/favicon.png" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="index.html"><img
                src="../../assets/img/brand/favicon-white.png" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{ asset('assets/img/def.png') }}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ auth()->user()->name }}</h4>
                    <span class="mb-0 text-muted"> {{ auth()->user()->roles->first()->name ?? '' }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">{{ __('Main') }}</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" opacity=".3" />
                        <path
                            d="M3 21h8v-6H3v6zm2-4h4v2H5v-2zm-2-4h8v-6H3v6zm2-4h4v2H5v-2zm8 8h8v-6h-8v6zm2-4h4v2h-4v-2zm-2-4h8V3h-8v6zm2-4h4v2h-4V5z" />
                    </svg><span class="side-menu__label">{{ __('Main') }}</span><span
                        class="badge badge-success side-badge">1</span></a>
            </li>
            @hasrole('super-admin')
                <li class="side-item side-item-category">{{ __('Authorization') }}</li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('user.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" opacity=".3" />
                            <path
                                d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm-6 4c.22-.72 3.31-2 6-2 2.7 0 5.8 1.29 6 2H6zm6-6c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" />
                        </svg>
                        <span class="side-menu__label">{{ __('Users') }}</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('role.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 4c-4.42 0-8 3.58-8 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zm4.5 11h-9v-2h9v2zm0-4h-9V9h9v2z"
                                opacity=".3" />
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm4.5-11h-9v2h9V9zm0 4h-9v2h9v-2z" />
                        </svg><span class="side-menu__label">{{ __('Roles') }}</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('permission.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 4c-1.7 0-3 1.3-3 3v2h6V7c0-1.7-1.3-3-3-3zm5 6H7v8h10V10z" opacity=".3" />
                            <path
                                d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                        </svg><span class="side-menu__label">{{ __('Permissions') }}</span></a>
                </li>
            @endhasrole
            <li class="side-item side-item-category">{{ __('Management') }}</li>
            @hasrole('super-admin')
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('salaries.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"
                                opacity=".3" />
                            <path
                                d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z" />
                        </svg>
                        <span class="side-menu__label">{{ __('Salaries') }}</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('staticSalaries.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 4h16v6H4zm0 9h16v2H4zm0 5h16v2H4z" opacity=".3" />
                            <path
                                d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 2v6H4V4h16zM4 20v-2h16v2H4zm0-5v-2h16v2H4z" />
                        </svg>
                        <span class="side-menu__label">{{ __('Static Salaries') }}</span></a>
                </li>
            @endhasrole
            <li class="slide">
                <a class="side-menu__item" href="{{ route('bill.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M21 18v1c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2 2V5c0-1.1.89-2 2-2h14c1.1 0 2 .9 2 2v1h-9c-1.11 0-2 .9-2 2v8c0 1.1.89 2 2 2h9zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"
                            opacity=".3" />
                        <path
                            d="M21 18v1c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2 2V5c0-1.1.89-2 2-2h14c1.1 0 2 .9 2 2v1h-9c-1.11 0-2 .9-2 2v8c0 1.1.89 2 2 2h9zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" />
                    </svg><span class="side-menu__label">{{ __('Bills') }}</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                <a class="side-menu__item" href="{{ route('appointment.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V9h14v10zM5 7V5h14v2H5zm2 4h10v2H7zm0 4h7v2H7z" opacity=".3" />
                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V9h14v10zM5 7V5h14v2H5zm2 4h10v2H7zm0 4h7v2H7z" />
                    </svg>
                    <span class="side-menu__label">{{ __('Appointments') }}</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    @hasrole('patient')
                        <li><a class="slide-item" href="{{ route('appointment.index') }}">{{ __('All Appointments') }}</a></li>
                        <li><a class="slide-item" href="{{ route('appointments.my') }}">{{ __('My Appointments') }}</a></li>
                    @endhasrole
                    
                    @hasrole('doctor')
                        <li><a class="slide-item" href="{{ route('appointments.doctor') }}">{{ __('My Appointments') }}</a></li>
                        <li><a class="slide-item" href="{{ route('appointment.pending') }}">
                            <span class="badge bg-warning rounded-pill float-end">
                                {{ \App\Models\Appointment::where('doctor_id', auth()->id())->where('status', 'pending')->count() }}
                            </span>
                            {{ __('Pending Requests') }}
                        </a></li>
                    @endhasrole
                </ul>
            </li>

            @hasrole('doctor')
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
                        <path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                    </svg>
                    <span class="side-menu__label">{{ __('Working Hours') }}</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('doctor-schedules.index') }}">{{ __('View Schedule') }}</a></li>
                    <li><a class="slide-item" href="{{ route('doctor-schedules.create') }}">{{ __('Set Schedule') }}</a></li>
                </ul>
            </li>
            @endhasrole
            <li class="slide">
                <a class="side-menu__item" href="{{ route('prescription.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 19h16v-7H4v7zM9 10h6v2H9z" opacity=".3" />
                        <path
                            d="M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-8-2h4v2h-4V4zm8 14H4v-7h16v7zm0-9H4V8h16v1zM9 10h6v2H9z" />
                    </svg><span class="side-menu__label">{{ __('Prescriptions') }}</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route('medical-record.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-8-2h4v2h-4V4zm8 14H4V8h16v12z"
                            opacity=".3" />
                        <path
                            d="M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-8-2h4v2h-4V4zm8 14H4V8h16v12zM6 10h12v2H6zm0 4h12v2H6z" />
                    </svg><span class="side-menu__label">{{ __('Medical Records') }}</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route('lab-test.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3" />
                        <path
                            d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zM7 10h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />
                    </svg><span class="side-menu__label">{{ __('Lab Tests') }}</span></a>
            </li>
        </ul>
    </div>
</aside>



