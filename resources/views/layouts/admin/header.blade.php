<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="/" class="logo logo-dark">
                        <span class="logo-sm"><img src="{{asset(settings("logo"))}}" alt="" height="20"></span>
                        <span class="logo-lg"><img src="{{asset(settings("logo"))}}" alt="" height="17"></span>
                    </a>
                    <a href="/" class="logo logo-light">
                        <span class="logo-sm"><img src="{{asset(settings("logo"))}}" alt="" height="20"></span>
                        <span class="logo-lg"><img src="{{asset(settings("logo"))}}" alt="" height="17"></span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                        <span class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                </button>

               
            </div>

            <div class="d-flex align-items-center">

            
           
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                    onclick="toggleFullscreen()">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>


                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    {{-- <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        <span
                            class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{'3'}}<span
                                class="visually-hidden">unread messages</span></span>
                    </button> --}}
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <a class="badge badge-soft-light fs-13" href="javascript:;"> Clear all</a>
                                    </div>
                                </div>
                            </div>

                            <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                    id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab"
                                           aria-selected="true">
                                            Unread (3)
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="tab-content" id="notificationItemsTabContent">
                            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    {{-- @forelse($notifications as $notification) --}}
                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                                </div>
                                                <div class="flex-1">
                                                    <a href="" class="stretched-link">
                                                        <h6 class="mt-0 mb-2 lh-base">
                                                            {{-- {{$notification['title']}} --}}
                                                        </h6>
                                                    </a>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 
                                                            {{-- {{$notification['created_at_ago']}} --}}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- @empty
                                    @endforelse --}}
                                    <div class="my-3 text-center">
                                        <a href="" class="btn btn-soft-success waves-effect waves-light">View
                                            All Notifications <i class="ri-arrow-right-line align-middle"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{asset(user()->photo)}}"
                                 alt="">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{user()->fullname}}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">
                                    {{-- {{user()->role_name}} --}}
                                </span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="{{route('admin.profile')}}">
                            <i class="fa fa-user text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">Profile</span>
                        </a>
                      

                   
                        @livewire('profile.logout')
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
