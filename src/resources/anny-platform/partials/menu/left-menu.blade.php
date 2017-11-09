@section('left-menu')
    <div class="left side-menu side-menu-sm">
        <div class="sidebar-inner slimscrollleft" style="overflow: hidden; width: auto; height: 233px;">
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>
                    <li class="has_sub">
                        <a href="{{ route('dashboard.index') }}" class="waves-effect"><i class="fa fa-home"></i> <span> Dashboard </span> </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection