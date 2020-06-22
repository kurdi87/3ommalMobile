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
                    <a href="<?php echo e(config('app.cp_route_name')); ?>/job"
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
                                                <div class="form-group input-wlbl  <?php if($errors->has('sid')): ?> has-error <?php endif; ?>">
                                                    <span class="">رقم الهوية</span>
                                                    <?php echo Form::text('sid',\App\Models\SystemUserModel::find($result->user_id)->sid,['class'=>'form-control    ','readonly ']); ?>

                                                    <?php if($errors->has('sid')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('sid')); ?></span>
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



                                            <div class="clearfix">
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class="">مقابلة</span>
                                                    <?php if($result->job_interview==1): ?>
                                                        <button type="button" class="btn btn-success">نعم</button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا </button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class="">مجال العمل</span>
                                                    <?php if($result->work_fields): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->work_fields); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class="">نوع الهوية</span>
                                                    <?php if($result->id_type): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->id_type); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class="">نوع الهوية</span>
                                                    <?php if($result->id_type): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->id_type); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class="">بطاقة ممغنطة</span>
                                                    <?php if($result->magnetic_card): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->magnetic_card); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class=""> تاريخ العمل في الخط الأخضر</span>
                                                    <?php if($result->year_work): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->year_work); ?>-<?php echo e($result->month_work); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class="">الراتب الشهري</span>
                                                    <?php if($result->amount_of_the_monthly_salary): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->amount_of_the_monthly_salary); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class="">عمل في الخط الأخضر</span>
                                                    <?php if($result->worked_inside_green_line): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->worked_inside_green_line); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class="">هل تمتلك قسيمة راتب</span>
                                                    <?php if($result->getting_a_salary_slip): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->getting_a_salary_slip); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class="">إصابة عمل</span>
                                                    <?php if($result->previous_work_accident): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->previous_work_accident); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class="">مستحقات الخدمة</span>
                                                    <?php if($result->end_of_service_benefits): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->end_of_service_benefits); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class="">مقدار المستحقات</span>
                                                    <?php if($result->monthly_salary_amount_you_were_getting): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->monthly_salary_amount_you_were_getting); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class=""> كورس سلامة</span>
                                                    <?php if($result->taken_a_public_safety_course): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->taken_a_public_safety_course); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class=""> اللغة العبرية</span>
                                                    <?php if($result->speak_hebrew): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->speak_hebrew); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class=""> سنوات الخدمة</span>
                                                    <?php if($result->years_of_experience): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->years_of_experience); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group input-wlbl  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                                                    <span class=""> المستوى الأكاديمي </span>
                                                    <?php if($result->level_of_your_academic): ?>
                                                        <button type="button" class="btn btn-success"><?php echo e($result->level_of_your_academic); ?></button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">لا يوجد</button>
                                                    <?php endif; ?>

                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
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

    