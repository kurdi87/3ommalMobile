<html lang="ar">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta
          name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1"
  />
  <title>{{isset($page_title)?$page_title:"عمال || طريقك نحو العمل"}}</title>

  <meta name="description" content="" />
  <link
          rel="apple-touch-icon"
          sizes="180x180"
          href="./images/logo/logo-180x180.png"
  />
  <link
          rel="icon"
          type="image/png"
          sizes="32x32"
          href="./images/logo/logo-32x32.png"
  />
  <link
          rel="icon"
          type="image/png"
          sizes="16x16"
          href="./images/logo/logo-16x16.png"
  />
  <link rel="mask-icon" href="./images/logo/mask-icon.svg" color="#0e60ba" />
  <meta name="theme-color" content="#0e60ba" />
  <meta name="theme-color" content="#0e60ba" />
  <meta name="keywords" content="{{isset($keywords)?$keywords:"عمال || طريقك نحو العمل"}}">
  <meta name="description" content="{{isset($description)?$description:"عمال || طريقك نحو العمل"}}">
  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="https://3ommal.me/الصفحة_الرئيسية">
  <meta property="og:image" content="'.https://3ommal.me.'/logo.png">
  <meta property="og:site_name" content="عمال">
  <meta property="og:description" content="عمال || طريقك نحو العمل">
  <!-- /Facebook Card -->

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@3ommal">
  <meta name="twitter:title" content="عمال || طريقك نحو العمل">
  <meta name="twitter:description" content="عمال || طريقك نحو العمل">
  <meta name="twitter:image" content="'.https://3ommal.me.'/logo.png">

  <link rel="stylesheet" href="/css/style.css" type="text/css" />
  <link rel="stylesheet" href="/toastr-master/build/toastr.min.css">
  <link href="/nprogress-master/nprogress.css" rel="stylesheet"/>
  <style>
    .bjqs-slide img {
      object-fit: cover !important;
      object-position: center !important;
      display: inline !important;
      position: relative !important;
      width: 100% !important;
      z-index: -1 !important;
    }
  </style>
  @yield('css')
</head>
<body class="public">
@include('website.header')
<div class="site-container">
  <!-- #################################### Slider ######################################################-->
  <div id="banner-public">
    <ul class="bjqs">
      <li>
        <img
                src="images/slider/1.jpg"
                title=""
        />

      </li>
      <li>
        <img
                src="images/slider/2.jpg"
                title=""
        />

      </li>
      <li>
        <img
                src="images/slider/3.jpg"
                title=""
        />

      </li>
      <li>
        <img
                src="images/slider/4.jpg"
                title=""
        />
        <div class="banner-content">
          <div class="banner-title">
            <h1>يمكنك أيضاً الحصول على خدمات موقع عمال من خلال التطبيق</h1>
          </div>
          <a href="intro.html" class="btn btn-lg btn-secondary">سجل الآن</a>
        </div>

      </li>

    </ul>
  </div>

  <!-- #################################### Main Menu ######################################################-->
  <div class="home-menu">
    <div class="home-menu-container">
      <h1 class="heading">خدماتنا</h1>
      <div class="site container">
        <div class="circles">
          <a href="/{{ config('app.user_route_name')}}/refund" class="home-menu-content btn btn-primary">
            <div class="home-menu-icon"><i class="icon money"></i></div>
            <div class="home-menu-title">استرجاع مستحقات نهاية خدمة</div>
          </a>
          <a
                  href="/job-application"
                  class="home-menu-content btn btn-secondary"
          >
            <div class="home-menu-icon"><i class="icon icon-form"></i></div>
            <div class="/index">المساعدة في البحث عن وظيفة</div>
          </a>
          <a
                  href="/{{ config('app.user_route_name')}}/injury"
                  class="home-menu-content btn btn-primary"
          >
            <div class="home-menu-icon"><i class="icon work"></i></div>
            <div class="home-menu-title">اخبرنا عن اصابة عمل</div>
          </a>
        </div>
      </div>
    </div>
    <div class="home-menu-container">
      <h1 class="heading">مجالات العمل</h1>
      <div class="site container">
        <div class="square">
          <a href="/job-application" class="home-menu-content btn btn-primary">
            <div class="home-menu-icon">
              <i class="icon icon-constructions white"></i>
            </div>
            <div class="home-menu-title">أعمال البناء</div>
          </a>
          <a
                  href="/job-application"
                  class="home-menu-content btn btn-secondary"
          >
            <div class="home-menu-icon">
              <i class="icon icon-cultivation white"></i>
            </div>
            <div class="home-menu-title">الزراعة</div>
          </a>
          <a
                  href=href="/job-application"
                  class="home-menu-content btn btn-primary"
          >
            <div class="home-menu-icon">
              <i class="icon icon-maintenance white"></i>
            </div>
            <div class="home-menu-title">الصيانة</div>
          </a>

        </div>
        <div class="text-center">
          <a href="/job-application" class="btn btn-primary btn-lg m-t-20 btn-wide r-50"
          ><b>مجالات أخرى</b></a
          >
        </div>
      </div>
    </div>
    <div class="down-app m-t-50">
      <div class="down-app-content text-center text-blue">
        <h2>يمكنك أيضاً الحصول على خدمات موقع عمال من خلال التطبيق</h2>
        <div class="down-app-icons m-t-30 m-b-50">
          <a href="#"
          ><img src="./images/background/apple-store.png" width="200px"
            /></a>
          <a href="#"
          ><img src="./images/background/google-play.png" width="200px"
            /></a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="site-footer text-left bg-blue">
  <div class="site container footer-content">
    <div class="footer-col">
      <div class="footer-action">
        <a href="about.html">من نحن</a>
      </div>
      <div class="footer-action">
        <a href="contact.html">اتصل بنا</a>
      </div>
    </div>
    <div class="footer-col">
      <div class="footer-action">
        <a href="term.html">شروط الاستخدام</a>
      </div>
      <div class="footer-action">
        <a href="privacy.html">سياسة الخصوصية</a>
      </div>
    </div>
    <div class="footer-col footer-center">
      <div class="footer-action">
        <p class="copyright">جميع الحقوق محفوظة</p>
      </div>
    </div>
    <div class="footer-col" style="width: 10%;">
      <div class="footer-action">
        <a href="#"><i class="icon icon-fb white"></i></a>

        <a href="#"><i class="icon icon-instagram white"></i></a>
      </div>
    </div>

    <div class="footer-col contact">
      <div class="footer-action">
        <p>HaMelech David St 33, Haifa - Israel</p>
      </div>
      <div class="footer-action w-50">
        <a href="mailto:info@3ommal.me">info@3ommal.me</a>
      </div>
      <div class="footer-action w-50">
        <a href="tel:00972 509006983" dir="ltr">00972 509006983</a>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="./js/vendors/slider.js"></script>
<script src="./js/vendors/menu-animation.js"></script>
<script>

  let getWidt = $(window).width(),
          bannerHeight = 280;
  if (getWidt > 557) {
    bannerHeight = 450;
  }
  jQuery(document).ready(function ($) {

    setTimeout(() => {
      $("#banner-public li").css("display", "none");
    }, 0);

    setTimeout(() => {
      $("#banner-public").bjqs({
        height: bannerHeight,
        width: "100%",
        responsive: true,
      });
    }, 10);
  });


</script>
</body>
</html>
