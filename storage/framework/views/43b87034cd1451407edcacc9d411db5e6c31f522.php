<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">
                <div class="actions">
                    <button type="submit" class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Save &amp; Close">
                        <i class="fa fa-save"></i>
                    </button>
                    <button name="save_new" type="submit" class="btn btn-circle btn-icon-only btn-default btn-wnew tooltip-one-info" title="Save &amp; New">
                        <i class="fa fa-save"></i>
                        <span class="fa fa-plus"></span>
                    </button>
                    <a href="<?php echo e(config('app.cp_route_name')); ?>/category" class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i> التصنيفات
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
                                                <span class="">الاسم</span>
                                                 <?php echo Form::text('name',null,['class'=>'form-control  txtinput-required ']); ?>

                                                <?php if($errors->has('name')): ?>
                                                    <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                             <div class="col-md-6">
                                                 <div class="form-group input-wlbl  <?php if($errors->has('name_en')): ?> has-error <?php endif; ?>">
                                                     <span class="">Name En</span>
                                                     <?php echo Form::text('name_en',null,['class'=>'form-control ']); ?>

                                                     <?php if($errors->has('name_en')): ?>
                                                         <span class="help-block error"><?php echo e($errors->first('name_en')); ?></span>
                                                     <?php endif; ?>
                                                 </div>
                                             </div>
                                        <div class="col-md-12">
                                            <div class="form-group input-wlbl  <?php if($errors->has('about_category')): ?> has-error <?php endif; ?>">
                                                <span class="">عن التصنيف</span>
                                                
                                                 <?php echo Form::textarea('about_category',null,['class'=>'form-control  category textarea ']); ?>

                                                <?php if($errors->has('about_category')): ?>
                                                    <span class="help-block error"><?php echo e($errors->first('about_category')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                             <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  <?php if($errors->has('cost_from')): ?> has-error <?php endif; ?>">
                                                <span class="">Cost from</span>
                                                 <?php echo Form::text('cost_from',null,['class'=>'form-control  txtinput-number-required txtmin']); ?>

                                                <?php if($errors->has('cost_from')): ?>
                                                    <span class="help-block error"><?php echo e($errors->first('cost_from')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                             <div class="col-md-6 hidden">
                                            <div class="form-group input-wlbl  <?php if($errors->has('cost_to')): ?> has-error <?php endif; ?>">
                                                <span class="">Cost To</span>
                                                 <?php echo Form::text('cost_to',null,['class'=>'form-control   txtinput-number-required txtmax']); ?>

                                                <?php if($errors->has('cost_to')): ?>
                                                    <span class="help-block error"><?php echo e($errors->first('cost_to')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                           <div class="col-md-6">
                                            <div class="form-group input-wlbl  <?php if($errors->has('d_order')): ?> has-error <?php endif; ?>">
                                                <span class=""> الترتيب</span>
                                                 <?php echo Form::text('d_order',null,['class'=>'form-control  txtinput-number-required', 'type'=>'number']); ?>

                                                <?php if($errors->has('d_order')): ?>
                                                    <span class="help-block error"><?php echo e($errors->first('d_order')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6 ">
                                            <div class="form-group input-wlbl  <?php if($errors->has('lang')): ?> has-error <?php endif; ?>">
                                                <span class="">Language</span>
                                                 <?php echo Form::select('lang',$languages,2,['class'=>'form-control  txtinput']); ?>

                                                <?php if($errors->has('id')): ?>
                                                    <span class="help-block error"><?php echo e($errors->first('id')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                           <div class="col-md-6 hidden" >
                                            <div class="form-group input-wlbl  <?php if($errors->has('type')): ?> has-error <?php endif; ?>">
                                                <span class="">Type</span>
                                                 <?php echo Form::select('type',$type,null,['class'=>'form-control  txtinput']); ?>

                                                <?php if($errors->has('type')): ?>
                                                    <span class="help-block error"><?php echo e($errors->first('type')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                             <div class="col-md-6 hidden">
                                                 <div class="form-group input-wlbl  <?php if($errors->has('isroot')): ?> has-error <?php endif; ?>">
                                                     <span class="">هل هي أصل</span>

                                                     <?php echo e(Form::checkbox('isroot', 1, null, ['class' => 'field hidden'])); ?>



                                                     <?php if($errors->has('type')): ?>
                                                         <span class="help-block error"><?php echo e($errors->first('isroot')); ?></span>
                                                     <?php endif; ?>
                                                 </div>
                                             </div>



                                             <div class="col-md-6 ">
                                                 <div class="form-group input-wlbl  <?php if($errors->has('parent_id')): ?> has-error <?php endif; ?>">
                                                     <span class="">Parent ID </span>
                                                     <?php echo Form::select('parent_id',$categorys,null,['class'=>'form-control select2 txtinput']); ?>


                                                     <?php if($errors->has('parent_id')): ?>
                                                         <span class="help-block error"><?php echo e($errors->first('parent_id')); ?></span>
                                                     <?php endif; ?>
                                                 </div>
                                             </div>
                                             <div class="col-md-6 hidden">
                                                 <div class="form-group input-wlbl  <?php if($errors->has('disease_id')): ?> has-error <?php endif; ?>">
                                                     <span class="">Disease</span>
                                                     <?php echo Form::select('disease_id',$disease,null,['class'=>'form-control select2 txtinput']); ?>


                                                     <?php if($errors->has('disease_id')): ?>
                                                         <span class="help-block error"><?php echo e($errors->first('disease_id')); ?></span>
                                                     <?php endif; ?>
                                                 </div>
                                             </div>

                                             <div class="col-md-12 ">
                                                 <div class="form-group input-wlbl  <?php if($errors->has('isroot')): ?> has-error <?php endif; ?>">
                                                     <span class="">Is Parent</span>

                                                     <?php echo e(Form::checkbox('isroot', 1, null, ['class' => 'field'])); ?>


                                                     <?php if($errors->has('type')): ?>
                                                         <span class="help-block error"><?php echo e($errors->first('isroot')); ?></span>
                                                     <?php endif; ?>
                                                 </div>
                                             </div>
                                             <div class="col-md-12">
                                                 <div class="form-group input-wlbl  <?php if($errors->has('source')): ?> has-error <?php endif; ?>">
                                                     <span class="">Source</span>
                                                     <?php echo Form::text('source',null,['class'=>'form-control  ']); ?>

                                                     <?php if($errors->has('source')): ?>
                                                         <span class="help-block error"><?php echo e($errors->first('source')); ?></span>
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

    