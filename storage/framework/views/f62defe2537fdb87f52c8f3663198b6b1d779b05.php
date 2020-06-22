<div class="page-bar">
    <ul class="page-breadcrumb">
        <?php echo generateBreadcrumbs($breadcrumbs); ?>

    </ul>

    <?php if(isset($isDashboard)): ?>
        <div class="page-toolbar">
            <div class="pull-right btn btn-sm">
                <i class="icon-calendar"></i>&nbsp;
                <span class="thin uppercase hidden-xs"><?php echo e(date("M d,Y")); ?></span>&nbsp;
            </div>
        </div>
    <?php endif; ?>
</div>