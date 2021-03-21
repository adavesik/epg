<div class="navbar-wrapper  ">
    <div class="navbar-content scroll-div " >

        <div class="">
            <div class="main-menu-header">
                <img class="img-radius" src="{{asset('images/images.jpg')}}" alt="User-Profile-Image">
                <div class="user-details">
                    <div id="more-details">{{auth()->user()->name}} <i class="fa fa-caret-down"></i></div>
                </div>
            </div>
            <div class="collapse" id="nav-user-link">
                <ul class="list-inline">

                    <li class="list-inline-item"><a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="feather icon-power"></i></a></li>
                </ul>
            </div>
        </div>

        <ul class="nav pcoded-inner-navbar ">
            <li class="nav-item pcoded-menu-caption">
                <label>Navigation</label>
            </li>
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a href="{{route('dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
            </li>
            <li class="nav-item pcoded-hasmenu {{ request()->is('channels/*') ? 'active' : '' }}">
                <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-check-square"></i></span><span class="pcoded-mtext">Channels</span></a>
                <ul class="pcoded-submenu">
                    <li><a href="{{route('channels')}}">Active Channels </a></li>
                    <li><a href="{{route('channels.disabled')}}">Disabled</a></li>
                </ul>
            </li>
            <li class="nav-item pcoded-hasmenu {{ request()->is('epg/*') ? 'active' : '' }}">
                <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-check-square"></i></span><span class="pcoded-mtext">EPG</span></a>
                <ul class="pcoded-submenu">
                    <li><a href="{{route('epg')}}">Generate Full EPG </a></li>
                    <li><a href="{{route('epg.url')}}">EPG from URL</a></li>
                </ul>
            </li>
            <li class="nav-item {{ request()->is('categories/*') ? 'active' : '' }}">
                <a href="{{route('categories')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-check-square"></i></span><span class="pcoded-mtext">Categories</span></a>
            </li>
        </ul>
    </div>
</div>
