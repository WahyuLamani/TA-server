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
                        <h3 class="text-gray">{{ucwords(Auth::user()->company_name)}}</h3>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        @auth
                        <li class="icons dropdown d-none d-md-flex" data-toggle="dropdown">
                            <a href="" class="log-user">
                                <span>{{ucwords(Auth::user()->name)}}</span>
                            </a>
                        </li>
                        @endauth
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{asset("storage/" . Auth::user()->thumnail)}}" height="40" width="40" alt="">
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