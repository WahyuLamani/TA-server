
<!--**********************************
    Sidebar start
***********************************-->
<div class="nk-sidebar">           
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('agents')}}">Your Agents</a></li>
                    
                </ul>
            </li>
            <li class="mega-menu mega-menu-sm">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Menu</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('distributed')}}">Distributions</a></li>
                    <li><a href="{{route('distributors')}}">Distributors</a></li>
                    <li><a href="{{route('request.distributor')}}">Request Product</a></li>
                </ul>
            </li>
    {{-- tambah menu disini --}}
    
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
    ***********************************-->

