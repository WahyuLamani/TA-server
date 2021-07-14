<!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header chnges-color">
          
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
                        <h3 class="text-gray">{{ucwords(Auth::user()->userable->company_name)}}</h3>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="badge badge-pill gradient-1">{{ session('agent')->count() }}</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">{{ session('agent')->count() }} Agent Posts</span>  
                                    
                                </div>
                                <div class="dropdown-content-body" id="posts-agent">
                                    <ul>
                                       @foreach (session('agent') as $row)
                                            <li class="notification-unread">
                                                <a href="/post/agent/{{ $row->id }}">
                                                    <img class="float-left mr-3 avatar-img" src="/storage/{{$row->owner->thumbnail}}" alt="">
                                                    <div class="notification-content">
                                                        <div class="notification-heading">{{ $row->owner->name }}</div>
                                                        <div class="notification-timestamp text-dark">{{ $row->created_at->diffForhumans() }}</div>
                                                        <div class="notification-text">{{ $row->post }}</div>
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
                                <span class="badge badge-pill gradient-2">{{ session('distributors')->count() }}</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">{{ session('distributors')->count() }} Distributor posts</span>  
                                    
                                </div>
                                <div class="dropdown-content-body" id="posts-distributor">
                                    <ul>
                                        @foreach (session('distributors') as $row)
                                            <li class="notification-unread">
                                                <a href="post/distributor/{{ $row->id }}">
                                                    <img class="float-left mr-3 avatar-img" src="/storage/{{$row->owner->thumbnail}}" alt="">
                                                    <div class="notification-content">
                                                        <div class="notification-heading">{{ $row->owner->name }}</div>
                                                        <div class="notification-timestamp text-dark">{{ $row->created_at->diffForhumans() }}</div>
                                                        <div class="notification-text">{{ $row->post }}</div>
                                                    </div>
                                                </a>
                                            </li>
                                       @endforeach
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>

                        <li class="icons dropdown d-none d-md-flex" data-toggle="dropdown">
                            <a href="" class="log-user">
                                <span>{{ucwords(Auth::user()->userable->ceo_name)}}</span>
                            </a>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{asset("storage/" . Auth::user()->userable->thumbnail)}}" height="40" width="40" alt="">
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

                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->