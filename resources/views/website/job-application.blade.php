@extends('website.layout')
@section('content')


    <div class="container">
        <div class="page-icon">
            <span class="icon logo-questions"></span>
        </div>
        <form>

            <div id="wizard">
                <h5>هل ترغب في الحصول على فرصة عمل؟</h5>
                <section class="">
                    <div id="job_page_intro">
                        <div class="logo"></div>
                        <p class="text-blue text-center m-t-30">
                            هل ترغب في الحصول على فرصة عمل؟
                        </p>
                        <div class="text-center m-t-30 m-b-30">
                            <img src="./images/icons/question.svg"/>
                        </div>
                        <div id="job_interview"></div>
                    </div>
                </section>


                <div class="form-messages">
                    <div class="form-message">
                        يرجى الإجابة عن السؤال قبل الانتقال للسؤال الآخر
                    </div>
                </div>
            </div>
        </form>

        <div id="modal"></div>
    </div>

    <div id="templates"></div>

@stop
@section('js')

    <script src='https://ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.js'></script>
    <script src="./js/vendors/steps/jquery.steps.min.js"></script>
    <script src="./js/vendors/select-field.js"></script>
    <script src="./js/vendors/input-file.js"></script>
    <script src="./js/modal.js"></script>
    <script src="./js/templates.js"></script>
    <script src="./js/wizard.js"></script>
    @if($category=="حداد")
        <script src="./js/categories-data2.js"></script>
    @elseif($category=="فني_لحام")
        <script src="./js/categories-data3.js"></script>
    @elseif($category=="رعاية_المسنين")
        <script src="./js/categories-data4.js"></script>
    @else
        <script src="./js/categories-data.js"></script>
    @endif
    <script src="./js/job_application_min.js"></script>

@stop




