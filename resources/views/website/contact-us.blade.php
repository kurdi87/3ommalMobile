@extends('website.layout')
@section('css')
    <style>
        .inner-page
        {
            margin: 20px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.12);
            padding: 20px;
            color: #8E8E8E;
        }

    </style>
@stop
@section('content')

    <div class="inner-page">
        <div class="inner-menu">
            <ul>
                <li><a href="/index">الرئيسية</a></li>
                <li>-</li>
                <li><a href="#">اتصل بنا</a></li>
            </ul>
        </div>
        <div class="inner-content">
            <h1>اتصل بنا</h1>
            <p><strong>للإقتراحات والإستفسارات فيما يخص عُمال</strong></p>
            <p>عنوان البريد الإلكتروني <a href="mailto:info@3ommal.me">info@3ommal.me</a></p>
            <p>&nbsp;</p>
            <p><strong>للأسئلة ذات الصلة بخدمات عُمال</strong></p>
            <p><a href="">حمل تطبيق عُمال</a> لبدئ محادثة مباشرة مع طاقمنا للمساعدة الفورية.</p>
        </div>
    </div>


@stop
