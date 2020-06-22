<?php 
    use Carbon\Carbon;
    use App\Models\AdmissionModel;
 ?>






<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">

                        <span class="caption-subject bold uppercase">Dashboard</span>
                    </div>
                </div>
                <div class="portlet-body"></div>
            </div>
        </div>

    </div>








<?php $__env->stopSection(); ?>
<?php echo $__env->make('cp.layout.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>