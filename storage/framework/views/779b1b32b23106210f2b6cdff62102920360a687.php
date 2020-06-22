<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">
                <div class="actions">
                    <button type="submit" class="btn btn-circle btn-icon-only btn-default tooltip-one-info"
                            title="Save &amp; Close">
                        <i class="fa fa-save"></i>
                    </button>
                    <button name="save_new" type="submit"
                            class="btn btn-circle btn-icon-only btn-default btn-wnew tooltip-one-info"
                            title="Save &amp; New">
                        <i class="fa fa-save"></i>
                        <span class="fa fa-plus"></span>
                    </button>
                    <a href="<?php echo e(config('app.cp_route_name')); ?>/injury"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-money"></i>طلب مستحقات نهاية الخدمة
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class="">الأسم</span>
                                                    <a href="<?php echo e(config('app.cp_route_name')); ?>/user/edit/<?php echo e($result->user_id); ?>"
                                                       target="_blank"><?php echo e(\App\Models\SystemUserModel::find($result->user_id)->SysUsr_FullName); ?></a>
                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('email')): ?> has-error <?php endif; ?>">
                                                    <span class="">البريد الالكتروني</span>
                                                    <?php echo Form::text('email',\App\Models\SystemUserModel::find($result->user_id)->SysUsr_Email,['class'=>'form-control    ','readonly ']); ?>

                                                    <?php if($errors->has('email')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('email')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('telephone')): ?> has-error <?php endif; ?>">
                                                    <span class="">الجوال</span>
                                                    <?php echo Form::text('telephone',\App\Models\SystemUserModel::find($result->user_id)->SysUsr_Mobile,['class'=>'form-control  txtinput  ','readonly ']); ?>

                                                    <?php if($errors->has('telephone')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('telephone')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  <?php if($errors->has('message')): ?> has-error <?php endif; ?>">
                                                    <span class="">الملاحظات</span>
                                                    <?php echo Form::textarea('message',$result->notes,['class'=>'form-control    ','readonly ']); ?>

                                                    <?php if($errors->has('message')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('message')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('message')): ?> has-error <?php endif; ?>">
                                                    <span class="">هل كنت تعمل عند نفس المشغل المذكور بالتصريح؟</span>

                                                    <?php if($result->work_with==1): ?>
                                                        <button type="button" class="btn btn-success">نعم</button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>
                                                    <?php if($errors->has('message')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('message')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('message')): ?> has-error <?php endif; ?>">
                                                    <span class="">هل حصلت على تلوش بنفس الشهر الذي حدثت به الإصابة</span>

                                                    <?php if($result->work_paper==1): ?>
                                                        <button type="button" class="btn btn-success">نعم</button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>
                                                    <?php if($errors->has('message')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('message')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('injury_date')): ?> has-error <?php endif; ?>">
                                                    <span class="">تاريخ الاصابة</span>
                                                    <?php echo Form::text('injury_date',$result?date('Y-m-d',strtotime($result->injury_date)):'',['class'=>'form-control  txtinput  ','readonly ']); ?>

                                                    <?php if($errors->has('injury_date')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('injury_date')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 hidden">
                                                <div class="form-group input-wlbl <?php if($errors->has('injury_amount')): ?> has-error <?php endif; ?>">
                                                    <span class=""> مبلغ قسيمة الراتب (تلوش) خلال فترة العمل </span>

                                                    <div class="input-group">
                                                        <?php echo Form::text('injury_amount',$result->injury_amount,['class'=>'form-control  txtinput-number','readonly']); ?>


                                                        <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                   NIS
                                                                </button>
                                                            </span>
                                                    </div>


                                                    <?php if($errors->has('injury_amount')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('injury_amount')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="clearfix">
                                                <hr>
                                            </div>


                                            <div class="clearfix">
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('adminAction')): ?> has-error <?php endif; ?>">
                                                    <span class="">Admin Action</span>
                                                    <?php echo Form::select('adminAction',$adminAction,$result->status,['class'=>'form-control  txtinput']); ?>

                                                    <?php if($errors->has('adminAction')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('adminAction')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group input-wlbl  <?php if($errors->has('admin_notes')): ?> has-error <?php endif; ?>">
                                                    <span class="">ملاحظات الأدمن</span>
                                                    <?php echo Form::textarea('admin_notes',null,['class'=>'form-control textarea txtinput ']); ?>

                                                    <?php if($errors->has('admin_notes')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('admin_notes')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>


                                        </div>


                                        <!--span-->
                                    </div>

                                    <!--span-->
                                </div>
                                <!--row-->
                            </div>
                            <!--form body-->
                        </div>
                        <!-- END FORM-->
                    </div>
                    <!--portlet form-->
                </div>
                <!--portlet box-->

            </div>
            <!--tab pane-->
        </div>
        <!--tab content-->
    </div>
    <!--tabbable line-->
</div>
<!-- col md 12 -->
</div>

    