  <!-- ========== Left Sidebar Start ========== -->
  <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <div class="user-details">
                <div class="pull-left">
                    <img src="{{asset("admin")}}/images/logo.png" alt="" class="thumb-md img-circle">
                </div>
                <div class="user-info">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{ config('app.name')}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="md md-settings"></i> Reset Profile</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="md md-administrators-power"></i> Logout</a></li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                        </ul>
                    </div>

                    <p class="text-muted m-0">{{Auth::user()->role->name}}</p>
                </div>
            </div>
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>
                    <li>
                        <a href="{{ route("admin.dashboard")}}" class="waves-effect {{\App\Helpers\Util::set_Topmenu("dashboard")}}"><i class="md md-home"></i><span> Dashboard </span></a>
                    </li>
                    <li>
                        <a href="{{ route("admin.user")}}" class="waves-effect {{\App\Helpers\Util::set_Topmenu("user")}}"><i class="fa fa-user"></i><span> Users </span></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Left Sidebar End -->
