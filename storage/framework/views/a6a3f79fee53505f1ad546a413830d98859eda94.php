<?php $__env->startSection('css'); ?>
    <style>
        .inner-page
        {
            margin: 20px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.12);
            padding: 20px;
            color: #8E8E8E;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="inner-page">
        <div class="inner-menu">
            <ul>
                <li><a href="/index">الرئيسية</a></li>
                <li>-</li>
                <li><a href="#">عن عمال</a></li>
            </ul>
        </div>
        <div class="inner-content">
            <h1>من نحن</h1>
            <p style="text-align: justify;">عُمال هو اول موقع لتوظيف العمال الفلسطينيين داخل الخط الأخضر بحيث يساعد العمال الباحثين عن الوظائف, من خلال تقديم حلول توظيف شاملة للعمال الفلسطينيين و فرص عمل لهم بدون وساطات و بضمان مستحقاتهم. كما يساعد تطبيق عُمال العامل بإسترجاع مستحقات نهاية الخدمة او التبليغ عن اصابة عمل لضمان حقوقه.</p>
            <p style="text-align: justify;">يقوم عُمال بجمع طلبات البحث عن العمل المقدمة عبر تطبيق&nbsp; و تقديمها للشركات ذات شواغر للتواصل معك مباشرة دون الحاجة لوسيط بين العامل و الشركة, وعبر خيارات الخدمات الاخرى المقدمة &nbsp;يمكنك تقديم الخدمة المناسبة لك.</p>
            <p style="text-align: justify;">&nbsp;يقدم عُمال خدمة "قدم طلب عمل" من خلال مجالات عمل متنوعة و يمكن للراغبين في التقديم التسجيل فى حساب جديد من <u>هنا</u> , ليتم اتصالك بالشركات ذات علاقة.</p>
            <p style="text-align: justify;">إذا كان لديك أي شكاوى أو اقتراحات أو استفسارات <a href="/contact">اتصل بنا</a> </p>

        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>