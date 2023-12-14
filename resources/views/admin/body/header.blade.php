<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            {{-- {{asset('backend/')}} --}}
            <div class="navbar-brand-box ">
                {{-- <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="logo-dark" height="20">
                    </span>
                </a> --}}
                {{-- line-height: 20px;
                    padding-top: 6px;
                    font-size: 18px; --}}

                <a href="index.html" class="h-3 logo logo-light">
                    <span class="flex pt-4 logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm-light" height="22">
                    </span>
                    <span class="flex items-center justify-center pt-2 logo-lg">
                        @php
                            use App\Models\Region;
                            $region = Region::where('id', Illuminate\Support\Facades\Auth::user()->region_id)->get();
                        @endphp
                        <span class="inline-block mt-3 -mx-5 text-2xl font-semibold leading-6 text-gray-300">
                            {{ isset($region[0]->name) ? $region[0]->name : '' }}
                        </span>
                    </span>
                </a>
            </div>

            <button type="button" class="px-3 btn btn-sm font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="align-middle ri-menu-2-line"></i>
            </button>

            <!-- App Search-->
            {{-- <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="ri-search-line"></span>
                </div>
            </form> --}}
            {{-- <div class="navbar-brand-box flex ml-44 text-4xl justify-center"> --}}
            {{-- <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="logo-dark" height="20">
                    </span>
                </a> --}}
            {{-- line-height: 20px;
            padding-top: 6px;
            font-size: 18px; --}}

            <a href="/dashboard" class="h-3 logo logo-light">
                {{-- <span class="d-flex pt-4 logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm-light" height="22">
                    </span> --}}
                {{-- <span class="flex items-center justify-center pt-2 logo-lg"> --}}

                <span class="inline-block mt-3 ml-5 text-2xl font-semibold leading-6 text-gray-300">
                    PostHarvest Real Time Inventory Management System (PHRTIMS)
                </span>
                {{-- <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="logo-light" height="20"> --}}
                {{-- </span> --}}
            </a>
            {{-- </div> --}}

        </div>

        <div class="d-flex">
            {{-- <h2 class="text-gray-300 -ml-36 mr-9 mt-9">PHRT Inventory Management System</h2> --}}
            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="p-0 dropdown-menu dropdown-menu-lg dropdown-menu-end"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="m-0 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>




            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>
            @php
                use App\Models\Notification;
                // use App\Models\Region;
                // $region = Region::where('id',Auth::user()->region_id)->get();
                $notifications = Notification::where('status', 0)
                    ->orderBy('id', 'desc')
                    ->take(5)
                    ->get();
                // dd(count($notifications));
            @endphp
            <div class="dropdown d-inline-block">
                <button type="button" class="relative btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    @if (count($notifications) > 0)
                        <span
                            class="absolute px-1 text-xs text-center bg-red-500 rounded-lg top-4 right-2">{{ count($notifications) }}</span>
                    @endif
                </button>
                <div class="p-0 dropdown-menu dropdown-menu-lg dropdown-menu-end"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                {{-- <a href="#!" class="small"> View All</a> --}}
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        @foreach ($notifications as $notification)
                            <a href="{{ route('notification', $notification->id) }}"
                                class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="ri-shopping-cart-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-1"> {{ $notification->product->name }}
                                            {{ $notification->description }} </h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">The remained quantity is {{ $notification->amount }}
                                                {{ $notification->product->unit->name }} </p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                {{ $notification->created_at->diffForHumans() }} </p>
                                        </div>
                                    </div>
                                    @if ($notification->status == 0)
                                        <div>
                                            <p class="px-[0.4rem] text-xs bg-red-500 rounded-full">.</p>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                        {{-- <a href="" class="text-reset notification-item">
                            <div class="flex-row d-flex">
                                <img src="{{ asset('backend/assets/images/users/avatar-3.jpg') }}"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-1">
                                    <h6 class="mb-1">James Lemire</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">It will seem like simplified English.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1">Your item is shipped</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">If several languages coalesce the grammar</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src="{{ asset('backend/assets/images/users/avatar-4.jpg') }}"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-1">
                                    <h6 class="mb-1">Salena Layfield</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a> --}}
                    </div>
                    {{-- <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="text-center btn btn-sm btn-link font-size-14" href="javascript:void(0)">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                            </a>
                        </div>
                    </div> --}}
                </div>
            </div>
            @php
                $id = Auth::user()->id;
                $adminData = App\Models\User::find($id);
            @endphp
            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="flex items-center">

                        <img class="rounded-circle header-profile-user"
                            src="{{ !empty($adminData->profile_image) ? url($adminData->profile_image) : url('upload/no_image.jpg') }}"
                            alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1">{{ $adminData->name }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </div>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                            class="align-middle ri-user-line me-1"></i>
                        Profile</a>
                    <a class="dropdown-item" href="{{ route('change.password') }}"><i
                            class="align-middle ri-wallet-2-line me-1"></i> Change
                        Password</a>
                    <a class="dropdown-item d-block" href="#"><span
                            class="mt-1 badge bg-success float-end">11</span><i
                            class="align-middle ri-settings-2-line me-1"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="align-middle ri-lock-unlock-line me-1"></i>
                        Lock screen</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i
                            class="align-middle ri-shut-down-line me-1 text-danger"></i> Logout</a>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="ri-settings-2-line"></i>
                </button>
            </div>

        </div>
    </div>
</header>
