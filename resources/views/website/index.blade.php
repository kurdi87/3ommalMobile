@extends('website.layout')
@section('css')
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
@stop
@section('content')


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
                </li>

            </ul>
        </div>

        <!-- #################################### Main Menu ######################################################-->
        <div class="home-menu">
            <div class="home-menu-container">
                <a
                        href="{{ config('app.user_route_name')}}/refund"
                        class="home-menu-content menu-item-1 btn btn-primary"
                >
                    <div class="home-menu-icon"><i class="icon money"></i></div>
                    <div class="home-menu-title">استرجاع مستحقات نهاية خدمة</div>
                </a>
                <a
                        href="https://api.whatsapp.com/send?phone=972509006983&text=&source=&data=&app_absent="
                        class="home-menu-content menu-item-2 sm btn btn-gray-dark"
                >
                    <div class="home-menu-icon">
                        <i class="icon conversation"></i>
                    </div>
                    <div class="home-menu-title">محادثة</div>
                </a>
                <a
                        href="job-application"
                        class="home-menu-content menu-item-3 btn btn-secondary"
                >
                    <div class="home-menu-icon"><i class="icon icon-form"></i></div>
                    <div class="home-menu-title">
                        قدم <br/>
                        طلب عمل
                    </div>
                </a>
                <a
                        href="{{ config('app.user_route_name')}}/injury"
                        class="home-menu-content md menu-item-4 btn btn-primary"
                >
                    <div class="home-menu-icon"><i class="icon work"></i></div>
                    <div class="home-menu-title">اخبرنا عن اصابة عمل</div>
                </a>
                @if(!isset(auth()->user()->SysUsr_ID))
                    <div class="down-app">
                        <div class="down-app-content text-center text-blue m-t-50">
                            <div><i class="icon icon-down-app "></i></div>
                            <h2 class="m-t-b-20"><b>تسجيل</b></h2>
                            <p>اطلع على الوظائف المتاحة داخل الخط الأخضر من خلال التطبيق</p>
                            <br/>
                            <a href="register" class="btn btn-primary m-t-20 btn-wide r-50">سجل الآن</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        let getWidt = $(window).width(),
            bannerHeight = 180;
        if (getWidt > 557) {
            bannerHeight = 350;
        }
        jQuery(document).ready(function ($) {
            setTimeout(() => {
                $("#banner-public  li").css("display", "none");
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
@stop