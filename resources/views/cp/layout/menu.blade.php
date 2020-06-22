<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler"></div>
            </li>
            <li class="sidebar-search-wrapper">
                <form class="sidebar-search">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>

                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
            </li>

            <li class="nav-item start {{ isset($active_menu) && $active_menu=="dashboard"?"active open":"" }}">
                <a href="{{ config('app.cp_route_name') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title"> لوحة التحكم</span>

                </a>
            </li>

            @foreach($menuActions as $action)


                @if(in_array($action->Action_ID,$allowedActions) || ($action->countActions && $action->countActions->Action_PredecesorActionID && hasOneChild($allowedActions,$action->actionsMenu)))


                    <li class="nav-item {{($action->Action_PredecesorActionID)?'hidden':'' }} {{ (isset($active_menu) && strpos(strtolower($action->Action_GroupName),strtolower($active_menu) )!== false)?"active open":"" }}">
                        <a href="{{ route($action->routes[0]->ActRoute_RouteName) }}" class="nav-link nav-toggle">
                            <i class="{{ $action->Action_Icon }}"> </i>
                            <span class="title"> {{ $action->d_name }}</span>
                            @if($action->hasSpecial && isset($menuActionsValue[$action->Action_ID]) && $menuActionsValue[$action->Action_ID])
                                <span class="badge badge-danger">{{ $menuActionsValue[$action->Action_ID] }}</span>
                            @endif

                            @if($action->countActions && $action->countActions->Action_PredecesorActionID)
                                <span class="arrow"></span>
                            @endif
                        </a>


                        @if($action->countActions && $action->countActions->Action_PredecesorActionID)
                            <ul class="sub-menu">
                                @if(in_array($action->Action_ID,$allowedActions))
                                    <li class="nav-item {{ (isset($active_menuPlus) && strpos(strtolower($action->Action_Name),strtolower($active_menuPlus) )!== false)?"active":"" }} ">
                                        <a href="{{ route($action->routes[0]->ActRoute_RouteName) }}" class="nav-link">
                                            <i class="{{ $action->Action_Icon }}"></i>
                                            <span class="title"> {{ $action->d_name }}</span>
                                            @if($action->hasSpecial && isset($menuActionsValue[$action->Action_ID]) && $menuActionsValue[$action->Action_ID])
                                                <span class="badge badge-danger">{{ $menuActionsValue[$action->Action_ID] }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                @foreach($action->actionsMenu as $subAction)
                                    @if(in_array($subAction->Action_ID,$allowedActions))
                                        <li class="nav-item {{ (isset($active_menuPlus)  && strpos(strtolower($subAction->Action_Name),strtolower($active_menuPlus) )!== false)?"active ":""}}">
                                            <a href="{{ route($subAction->routes[0]->ActRoute_RouteName) }}"
                                               class="nav-link">
                                                <i class="{{ $subAction->Action_Icon }}"></i>
                                                <span class="title"> {{ $subAction->d_name }}</span>
                                                @if($subAction->hasSpecial && isset($menuActionsValue[$subAction->Action_ID]) && $menuActionsValue[$subAction->Action_ID])
                                                    <span class="badge badge-danger">{{ $menuActionsValue[$subAction->Action_ID] }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif

            @endforeach

            <li class="nav-item">
                <a href="{{ config('app.cp_route_name') }}/logout" class="nav-link nav-toggle">
                    <i class="icon-logout"></i>
                    <span class="title"> تسجيل الخروج</span>

                </a>
            </li>

        </ul>
    </div>
</div>