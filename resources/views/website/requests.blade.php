@extends('website.layout')
@section('content')


    <div class="line-yellow"></div>
    <div class="site-container">
        <div class="my-requests">
            <div class="my-request-container">
                @if(count($requests)>0)
                    @foreach($requests as $r)
                        <div class="my-request-number">
                            <i class="icon request"></i>
                            <span class="my-request-title">{{$r->subject}}</span>
                            <div class="my-request-date">
                                @php
                                    $created = new \Carbon\Carbon($r->created_at);
                                    $now = $created->addHour(3);;
                                    $difference =$created->diffForHumans(null, true);@endphp
                                {{$difference}}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="my-request-number">
                       
                        <span class="my-request-title">لا توجد طلبات حاليا</span>
                        <div class="my-request-date">

                        </div>
                    </div>

                @endif

            </div>
        </div>
    </div>

@stop


