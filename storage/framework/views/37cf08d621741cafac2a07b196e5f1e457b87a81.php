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

            <li class="nav-item start <?php echo e(isset($active_menu) && $active_menu=="dashboard"?"active open":""); ?>">
                <a href="<?php echo e(config('app.cp_route_name')); ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title"> Dashboard</span>

                </a>
            </li>

            <?php foreach($menuActions as $action): ?>


                <?php if(in_array($action->Action_ID,$allowedActions) || ($action->countActions && $action->countActions->Action_PredecesorActionID && hasOneChild($allowedActions,$action->actionsMenu))): ?>


                    <li class="nav-item <?php echo e(($action->Action_PredecesorActionID)?'hidden':''); ?> <?php echo e((isset($active_menu) && strpos(strtolower($action->Action_GroupName),strtolower($active_menu) )!== false)?"active open":""); ?>">
                        <a href="<?php echo e(route($action->routes[0]->ActRoute_RouteName)); ?>" class="nav-link nav-toggle">
                            <i class="<?php echo e($action->Action_Icon); ?>"> </i>
                            <span class="title"> <?php echo e($action->Action_GroupName); ?></span>
                            <?php if($action->hasSpecial && isset($menuActionsValue[$action->Action_ID]) && $menuActionsValue[$action->Action_ID]): ?>
                                <span class="badge badge-danger"><?php echo e($menuActionsValue[$action->Action_ID]); ?></span>
                            <?php endif; ?>

                            <?php if($action->countActions && $action->countActions->Action_PredecesorActionID): ?>
                                <span class="arrow"></span>
                            <?php endif; ?>
                        </a>


                        <?php if($action->countActions && $action->countActions->Action_PredecesorActionID): ?>
                            <ul class="sub-menu">
                                <?php if(in_array($action->Action_ID,$allowedActions)): ?>
                                    <li class="nav-item <?php echo e((isset($active_menuPlus) && strpos(strtolower($action->Action_Name),strtolower($active_menuPlus) )!== false)?"active":""); ?> ">
                                        <a href="<?php echo e(route($action->routes[0]->ActRoute_RouteName)); ?>" class="nav-link">
                                            <i class="<?php echo e($action->Action_Icon); ?>"></i>
                                            <span class="title"> <?php echo e($action->Action_Name); ?></span>
                                            <?php if($action->hasSpecial && isset($menuActionsValue[$action->Action_ID]) && $menuActionsValue[$action->Action_ID]): ?>
                                                <span class="badge badge-danger"><?php echo e($menuActionsValue[$action->Action_ID]); ?></span>
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php foreach($action->actionsMenu as $subAction): ?>
                                    <?php if(in_array($subAction->Action_ID,$allowedActions)): ?>
                                        <li class="nav-item <?php echo e((isset($active_menuPlus)  && strpos(strtolower($subAction->Action_Name),strtolower($active_menuPlus) )!== false)?"active ":""); ?>">
                                            <a href="<?php echo e(route($subAction->routes[0]->ActRoute_RouteName)); ?>"
                                               class="nav-link">
                                                <i class="<?php echo e($subAction->Action_Icon); ?>"></i>
                                                <span class="title"> <?php echo e($subAction->Action_Name); ?></span>
                                                <?php if($subAction->hasSpecial && isset($menuActionsValue[$subAction->Action_ID]) && $menuActionsValue[$subAction->Action_ID]): ?>
                                                    <span class="badge badge-danger"><?php echo e($menuActionsValue[$subAction->Action_ID]); ?></span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>

            <?php endforeach; ?>

            <li class="nav-item">
                <a href="<?php echo e(config('app.cp_route_name')); ?>/logout" class="nav-link nav-toggle">
                    <i class="icon-logout"></i>
                    <span class="title"> Sign Out</span>

                </a>
            </li>

        </ul>
    </div>
</div>