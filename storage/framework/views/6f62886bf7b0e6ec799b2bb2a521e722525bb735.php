<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-key"></i>Permissions
        </div>
        <div class="tools">
            <a href="javascript:;" class="uncheck-all">Cancel All</a>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <div class="horizontal-form">
            <div class="form-body">
                <div class="row permissions-row <?php echo e(isset($isRole)?"permissions-role":""); ?>">
                    <?php foreach($actions as $action): ?>
                        <div class="col-md-4">
                            <div class="portlet box box-permissions green">
                                <div class="portlet-title">
                                    <div class="caption caption-wcheckbox">
                                        <!-- <i class="fa fa-user"></i><?php echo e($action->Action_GroupName); ?> -->
                                        <label class="checkbox-inline parent-check">
                                            <input type="checkbox" class="mycheckbox pcheckbox" value="0" />
                                            <!-- <span class="checkbox-style"><i class="fa fa-check"></i></span> -->
                                            <i class="fa fa-user"></i><span class="label-checkbox"><?php echo e($action->Action_GroupName); ?></span>
                                        </label>
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse mycollapse"></a>
                                    </div>
                                </div>
                                <div class="portlet-body collapse-body form">
                                    <!-- BEGIN FORM-->
                                    <div class="horizontal-form">
                                        <div class="form-body">
                                            <!-- <div class="tree-demo mytree"></div> -->
                                            <div class="permissions-checks">
                                                <ul>
                                                    <li>
                                                        <label class="checkbox-inline parent-check <?php echo e((isset($roleActionsDefault) && in_array($action->Action_ID,$roleActions) && in_array($action->Action_ID,$roleActionsDefault))?"blue":""); ?>

                                                        <?php echo e((isset($roleActionsDefault) && in_array($action->Action_ID,$roleActions) && !in_array($action->Action_ID,$roleActionsDefault))?"green":""); ?>

                                                        <?php echo e((isset($roleActionsDefault) && !in_array($action->Action_ID,$roleActions) && in_array($action->Action_ID,$roleActionsDefault))?"red":""); ?>

                                                        <?php echo e((isset($roleActionsDefault) && !in_array($action->Action_ID,$roleActions) && !in_array($action->Action_ID,$roleActionsDefault))?"black":""); ?>">
                                                            <?php echo Form::checkbox('action[]',$action->Action_ID,(!$errors->has() && in_array($action->Action_ID,$roleActions))?true:null, array('class'=>'mycheckbox ccheckbox',"data-parent"=>"parent".$action->Action_ID)); ?>

                                                            <!-- <span class="checkbox-style"><i class="fa fa-check"></i></span> -->
                                                            <span class="label-checkbox"><?php echo e($action->Action_Name); ?></span>
                                                        </label>
                                                    </li>
                                                    <?php foreach($action->actions as $subAction): ?>
                                                        <li>
                                                            <label class="checkbox-inline parent-check <?php echo e((isset($roleActionsDefault) && in_array($subAction->Action_ID,$roleActions) && in_array($subAction->Action_ID,$roleActionsDefault))?"blue":""); ?>

                                                            <?php echo e((isset($roleActionsDefault) && in_array($subAction->Action_ID,$roleActions) && !in_array($subAction->Action_ID,$roleActionsDefault))?"green":""); ?>

                                                            <?php echo e((isset($roleActionsDefault) && !in_array($subAction->Action_ID,$roleActions) && in_array($subAction->Action_ID,$roleActionsDefault))?"red":""); ?>

                                                            <?php echo e((isset($roleActionsDefault) && !in_array($subAction->Action_ID,$roleActions) && !in_array($subAction->Action_ID,$roleActionsDefault) )?"black":""); ?>">
                                                                <?php echo Form::checkbox('action[]',$subAction->Action_ID,(!$errors->has() && in_array($subAction->Action_ID,$roleActions))?true:null, array('class'=>'mycheckbox ccheckbox',"data-child"=>"parent".$action->Action_ID)); ?>

                                                                <!-- <span class="checkbox-style"><!-- <i class="fa fa-check"></i></span> -->
                                                                <span class="label-checkbox"><?php echo e($subAction->Action_Name); ?></span>
                                                            </label>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                            <!-- permissions checks -->
                                        </div>
                                        <!--form body-->
                                    </div>
                                    <!-- END FORM-->
                                </div>
                                <!--portlet form-->
                            </div>
                            <!--portlet box-->
                        </div>
                        <!-- col md 4 -->
                    <?php endforeach; ?>
                </div>
            </div>
            <!--form body-->
        </div>
        <!-- END FORM-->
    </div>
    <!--portlet form-->
</div>