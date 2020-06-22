<div class="site-header">
    <div class="container">
        <div class="options">
            <a class="option" href="/index">
                الرئيسية
            </a>

            <a class="option" href="/about">
                عن عمال
            </a>
            <a class="option" href="/contact">
                اتصل بنا
            </a>
            <?php if(isset(auth()->user()->SysUsr_ID)): ?>
                <a class="option" href="/<?php echo e(config('app.user_route_name')); ?>/profile">
                    الصفحة الشخصية
                </a>
                <a class="option" href="/<?php echo e(config('app.user_route_name')); ?>/requests">
                    طلباتي
                </a>
                <a class="btn btn-banner" href="/<?php echo e(config('app.user_route_name')); ?>/logout">
                    تسجيل الخروج
                </a>
                <?php else: ?>
                <a class="btn btn-banner" href="/register">
                    حساب جديد
                </a>
            <?php endif; ?>
        </div>
        <div class="containermenu">
            <button id="burger" class="open-main-nav">
                <span class="burger"></span>
            </button>
        </div>
        <a href="/index" class="logo-container">
            <div class="logo"></div>
            <span class="site-name">عـمـال</span>
        </a>
    </div>
</div>
<div id="mobile-menu" class="mobile-menu">
    <div class="menu-item">
        <a href="/index">
            <i class="icon "></i>
            الرئيسية
        </a>
    </div>
    <div class="menu-item">
        <a href="/<?php echo e(config('app.user_route_name')); ?>/profile">
            <i class="icon icon-user"></i>
            الملف الشخصي
        </a>
        <a href="/<?php echo e(config('app.user_route_name')); ?>/requests">
            <i class="icon icon-user"></i>
            طلباتي
        </a>
    </div>
    <div class="menu-item">
        <a href="/term">
            <i class="icon icon-info"></i>
            شروط الاستخدام
        </a>
        <a href="/privacy">
            <i class="icon icon-privacy"></i>
            سياسة الخصوصية
        </a>
    </div>
    <div class="menu-item">
        <a href="/about">
            <i class="icon icon-about"></i>
            عن عمال
        </a>
        <a href="/contact">
            <i class="icon icon-contactus"></i>
            اتصل بنا
        </a>
    </div>
    <div class="text-center">
        <?php if(isset(auth()->user()->SysUsr_ID)): ?>

            <a class="btn btn-primary btn-lg m-t-20" href="/<?php echo e(config('app.user_route_name')); ?>/logout">
                تسجيل الخروج
            </a>
        <?php else: ?>
            <a class="btn btn-primary btn-lg m-t-20" href="/register">
                حساب جديد
            </a>
        <?php endif; ?>

    </div>

</div>
