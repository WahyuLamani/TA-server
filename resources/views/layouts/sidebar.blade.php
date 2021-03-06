
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
                    @if (Auth::user()->userable_type === "App\Models\Client\Agent" || Auth::user()->userable_type === "App\Models\Client\Distributor")
                    <li><a href="{{route('clients')}}">Home</a></li>
                    @else
                    <li><a href="{{route('home')}}">Home</a></li>
                    @endif
                    <li><a href="{{route('profile')}}">Profile</a></li>
                    
                </ul>
            </li>
            @if (Auth::user()->userable_type === "App\Models\Server\Company")
            <li class="mega-menu mega-menu-sm">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-menu menu-icon"></i><span class="nav-text">Menu</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('agents')}}">Agents</a></li>
                    <li><a href="{{route('distributors')}}">Distributors</a></li>
                    <li><a href="{{route('request.distributor')}}">Order Request</a></li>
                </ul>
            </li>
            <li class="mega-menu mega-menu-sm">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-note menu-icon"></i><span class="nav-text">Services</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/warehouse">Warehouse</a></li>
                    <li><a href="{{route('container')}}">Agent Truck</a></li>
                </ul>
            </li>
            @endif
    {{-- tambah menu disini --}}
    
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
    ***********************************-->

