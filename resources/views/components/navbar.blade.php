<div>
    {{-- <img class="logo-stylis" src="{{asset('assets/images/logo.png')}}" alt="" srcset=""> --}}
    <div class="nav-header">
        <div class="brand-logo">
            <a href="index.html">
                <b class="logo-abbr text-white">DTS</b>
                <span class="brand-title text-white">
                    DTS Mineral Water
                </span>
            </a>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">    
        <div class="header-content clearfix">
            
            <div class="nav-control">
                <div class="hamburger">
                    <span class="toggle-icon"><i class="icon-menu"></i></span>
                </div>
            </div>
            <div class="header-left">
                <div class="py-4 ml-2">
                    
                    @if (Auth::user()->userable_type === "App\Models\Client\Agent" || Auth::user()->userable_type === "App\Models\Client\Distributor")
                    <h3 class="text-gray">Welcome, {{ucwords(Auth::user()->userable->name)}}</h3>
                    @else
                    <h3 class="text-gray">{{ucwords(Auth::user()->userable->company_name)}}</h3>
                    @endif
                </div>
            </div>
            
            <div class="header-right">
                <ul class="clearfix">
                    @if (Auth::user()->userable_type === "App\Models\Server\Company")
                    <li class="icons dropdown">
                        <a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="badge badge-pill gradient-1">{{ $agents->count() }}</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu">
                            <div class="dropdown-content-heading d-flex justify-content-between">
                                <span class="">{{ $agents->count() }} Agent Posts</span>  
                                
                            </div>
                            <div class="dropdown-content-body" id="posts-agent">
                                <ul>
                                   @foreach ($agents as $row)
                                        <li class="notification-unread">
                                            <a href="/post/agent/{{ $row->id }}">
                                                <img class="float-left mr-3 avatar-img" src="{{asset('uploads/'.$row->owner->thumbnail)}}" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">{{ $row->owner->name }}</div>
                                                    <div class="notification-timestamp text-dark">{{ $row->created_at->diffForhumans() }}</div>
                                                    <div class="notification-text">{!! $row->post !!}</div>
                                                </div>
                                            </a>
                                        </li>
                                   @endforeach
                                </ul>
                                
                            </div>
                        </div>
                    </li>
                    <li class="icons dropdown">
                        <a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="badge badge-pill gradient-2">{{ $distributors->count() }}</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                            <div class="dropdown-content-heading d-flex justify-content-between">
                                <span class="">{{ $distributors->count() }} Distributor posts</span>  
                                
                            </div>
                            <div class="dropdown-content-body" id="posts-distributor">
                                <ul>
                                    @foreach ($distributors as $row)
                                        <li class="notification-unread">
                                            <a href="post/distributor/{{ $row->id }}">
                                                <img class="float-left mr-3 avatar-img" src="{{asset('uploads/'.$row->owner->thumbnail)}}" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">{{ $row->owner->name }}</div>
                                                    <div class="notification-timestamp text-dark">{{ $row->created_at->diffForhumans() }}</div>
                                                    <div class="notification-text">{!! $row->post !!}</div>
                                                </div>
                                            </a>
                                        </li>
                                   @endforeach
                                </ul>
                                
                            </div>
                        </div>
                    </li>
                    @endif
                    @if (Auth::user()->userable_type === "App\Models\Client\Agent" || Auth::user()->userable_type === "App\Models\Client\Distributor")
                    <li class="icons dropdown d-none d-md-flex" data-toggle="dropdown">
                        <a href="" class="log-user">
                            <span>{{ucwords(Auth::user()->userable->name)}}</span>
                        </a>
                    </li>
                    <li class="icons dropdown">
                        <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                            <span class="activity active"></span>
                            <img src="{{asset('uploads/'. Auth::user()->userable->thumbnail)}}" height="40" width="40" alt="">
                        </div>
                        <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li>
                                        <a href="{{route('profile')}}"><i class="icon-user"></i> <span>Profile</span></a>
                                    </li>
                                    <hr class="my-2">
                                    <li><form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <i class="icon-key"></i><button class="tombol-keluar ml-2" type="submit">Logout</button>
                                    </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    @else
                    <li class="icons dropdown d-none d-md-flex" data-toggle="dropdown">
                        <a href="" class="log-user">
                            <span>{{ucwords(Auth::user()->userable->ceo_name)}}</span>
                        </a>
                    </li>
                    <li class="icons dropdown">
                        <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                            <span class="activity active"></span>
                            <img src="{{asset('uploads/'. Auth::user()->userable->thumbnail)}}" height="40" width="40" alt="">
                        </div>
                        <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li>
                                        <a href="{{route('profile')}}"><i class="icon-user"></i> <span>Profile</span></a>
                                    </li>
                                    <hr class="my-2">
                                    <li><form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <i class="icon-key"></i><button class="tombol-keluar ml-2" type="submit">Logout</button>
                                    </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>