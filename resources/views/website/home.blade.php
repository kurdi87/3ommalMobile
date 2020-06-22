<html lang="ar">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />
    <title>3ommal Website</title>
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
    <link rel="stylesheet" href="./css/style.css" type="text/css" />
  </head>
  <body>
    <div class="main">
      <div class="header">
        <div class="container">
          <div class="header-content-right">
            <a href="my-requests.html"><i class="icon settings"></i></a>
          </div>
          <div class="header-content-center"></div>
          <div class="header-content-left">
            <a href="user-profile.html"><i class="icon profile"></i></a>
          </div>
        </div>
      </div>
      <div class="line-yellow"></div>
      <div class="container">
        <!-- #################################### Slider ######################################################-->
        <div id="banner-fade">
          <ul class="bjqs">
            <li>
              <img
                src="https://www.jqueryscript.net/demo/Simple-Clean-jQuery-Image-Slider-Plugin-Basic-Slider/img/banner01.jpg"
                title=""
              />
            </li>
            <li>
              <img
                src="https://www.jqueryscript.net/demo/Simple-Clean-jQuery-Image-Slider-Plugin-Basic-Slider/img/banner02.jpg"
                title=""
              />
            </li>
            <li>
              <img
                src="https://www.jqueryscript.net/demo/Simple-Clean-jQuery-Image-Slider-Plugin-Basic-Slider/img/banner03.jpg"
                title=""
              />
            </li>
          </ul>
        </div>

        <!-- #################################### Main Menu ######################################################-->
        <div class="home-menu">
          <div class="home-menu-container">
            <a
              href="refund.html"
              class="home-menu-content menu-item-1 btn btn-primary"
            >
              <div class="home-menu-icon"><i class="icon money"></i></div>
              <div class="home-menu-title">استرجاع مستحقات نهاية خدمة</div>
            </a>
            <a
              href="chat.html"
              class="home-menu-content menu-item-2 sm btn btn-gray-dark"
            >
              <div class="home-menu-icon">
                <i class="icon conversation"></i>
              </div>
              <div class="home-menu-title">محادثة</div>
            </a>
            <a
              href="job-application.html"
              class="home-menu-content menu-item-3 btn btn-secondary"
            >
              <div class="home-menu-icon"><i class="icon icon-form"></i></div>
              <div class="home-menu-title">
                قدم <br />
                طلب عمل
              </div>
            </a>
            <a
              href="work-injury.html"
              class="home-menu-content md menu-item-4 btn btn-primary"
            >
              <div class="home-menu-icon"><i class="icon work"></i></div>
              <div class="home-menu-title">اخبرنا عن اصابة عمل</div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="./js/vendors/slider.js"></script>
    <script>
      let getWidt = $(window).width(),
        bannerHeight = 180;
      if (getWidt > 557) {
        bannerHeight = 320;
      }
      jQuery(document).ready(function ($) {
        $("#banner-fade").bjqs({
          height: bannerHeight,
          width: "100%",
          responsive: true,
        });
      });
    </script>
  </body>
</html>
