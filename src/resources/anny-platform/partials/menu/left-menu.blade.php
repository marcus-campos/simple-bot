@section('left-menu')
    <div class="left side-menu side-menu-sm">
        <div class="sidebar-inner slimscrollleft" style="overflow: hidden; width: auto; height: 233px;">
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>
                    <li class="has_sub">
                        <a href="{{ route('dashboard.index') }}" class="waves-effect"><i class="fa fa-home"></i> <span> Dashboard </span> </a>
                    </li>

                    <!--<li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-graduation-cap"></i> <span> Planos de estudos </span> </a>
                    </li>-->

                   {{-- <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-crown"></i><span> Apps </span><span class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            --}}{{--<li><a href="#"> Loja</a></li>--}}{{--
                            <li><a href=""> Loja</a></li>
                        </ul>
                    </li>--}}

                    <!--<li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-comments "></i> <span> Sugestões </span>  </a>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-help"></i> <span> Suporte </span>  </a>
                    </li>-->

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection