<div class="m-header">
    <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
    <a href="#!" class="b-brand">
        <!-- ========   change your logo hear   ============ -->
        <img style="width: 95px" src="{{asset('/images/logo-mono.png')}}" alt="" class="logo">
        <img style="width: 95px" src="{{asset('/images/logo-mono.png')}}" alt="" class="logo-thumb">
    </a>
    <a href="#!" class="mob-toggler">
        <i class="feather icon-more-vertical"></i>
    </a>
</div>
<div class="collapse navbar-collapse">
    <ul class="navbar-nav ml-auto">

        <li>
            <div class="dropdown drp-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="feather icon-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-notification">
                    <div class="pro-head">
                        <img src="{{asset('images/images.jpg')}}" class="img-radius" alt="User-Profile-Image">
                        <span>{{auth()->user()->name}}</span>
                        <a class="dud-logout text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            <i class="feather icon-log-out"></i>
                         </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>

                </div>
            </div>
        </li>
    </ul>
</div>
