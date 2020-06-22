<script>
    jQuery(document).ready(function () {
        $('.textareaPro').wysihtml5();
    });
</script>

<div class="row" style="padding: 20px;">

    <div class="col-md-6">
        <div class="form-group input-wlbls  <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
            <span class="">Name - الاسم</span>
            <?php echo Form::text('category_id',isset($result->id)?$result->id:"0",['class'=>'hidden category_id']); ?>

            <?php echo Form::text('type',isset($result->type)?$result->type:"0",['class'=>'hidden ']); ?>

            <?php echo Form::text('lang',isset($result->lang)?$result->lang:"0",['class'=>'hidden']); ?>


            <?php echo Form::text('name',null,['class'=>'form-control  txtinput-required ']); ?>

            <?php if($errors->has('name')): ?>
                <span class="help-block error"><?php echo e($errors->first('name')); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group input-wlbl  <?php if($errors->has('name_en')): ?> has-error <?php endif; ?>">
            <span class="">Name En</span>
            <?php echo Form::text('name_en',null,['class'=>'form-control  txtinput-required ']); ?>

            <?php if($errors->has('name_en')): ?>
                <span class="help-block error"><?php echo e($errors->first('name_en')); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group input-wlbl  <?php if($errors->has('about_category')): ?> has-error <?php endif; ?>">
            <span class="">About Category - عن </span>

            <?php echo Form::textarea('about_category',null,['class'=>'form-control  txtinput-required textarea ']); ?>

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
            <span class="">order</span>
            <?php echo Form::text('d_order',null,['class'=>'form-control  txtinput-required txtinput-number-required']); ?>

            <?php if($errors->has('d_order')): ?>
                <span class="help-block error"><?php echo e($errors->first('d_order')); ?></span>
            <?php endif; ?>
        </div>
    </div>


    <div class="col-md-6 hidden">
        <div class="form-group input-wlbl  <?php if($errors->has('parent_id')): ?> has-error <?php endif; ?>">
            <span class="">Parent ID </span>
            <?php echo Form::text('parent_id',isset($result->id)?$result->id:"0",['class'=>'form-control   txtinput-required ']); ?>


            <?php if($errors->has('type')): ?>
                <span class="help-block error"><?php echo e($errors->first('parent_id')); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12 ">
        <div class="form-group input-wlbl  <?php if($errors->has('isroot')): ?> has-error <?php endif; ?>">
            <span class="">Is Root</span>

            <?php echo e(Form::checkbox('isroot', 1, null, ['class' => 'field'])); ?>


            <?php if($errors->has('type')): ?>
                <span class="help-block error"><?php echo e($errors->first('isroot')); ?></span>
            <?php endif; ?>
        </div>
    </div>


</div>
