<?php $__env->startSection('content'); ?>


    <div class="line-yellow"></div>
    <div class="site-container">
        <div class="my-requests">
            <div class="my-request-container">
                <?php if(count($requests)>0): ?>
                    <?php foreach($requests as $r): ?>
                        <div class="my-request-number">
                            <i class="icon request"></i>
                            <span class="my-request-title"><?php echo e($r->subject); ?></span>
                            <div class="my-request-date">
                                <?php 
                                    $created = new \Carbon\Carbon($r->created_at);
                                    $now = $created->addHour(3);;
                                    $difference =$created->diffForHumans(null, true); ?>
                                <?php echo e($difference); ?>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="my-request-number">
                       
                        <span class="my-request-title">لا توجد طلبات حاليا</span>
                        <div class="my-request-date">

                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('website.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>