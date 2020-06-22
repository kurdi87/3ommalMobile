@extends('cp.layout.layout')

@section('css')
    <link href="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="cp/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
@stop

@section('js')
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
    <script src="cp/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="cp/js/dashboard.js" type="text/javascript"></script>
    <script type="text/javascript">
    	jQuery(document).ready(function(){
    		@if(in_array(45,$allowedActions))
    			// inquiries
	            var chart = AmCharts.makeChart("dashboard_amchart_1", {
	                "type": "serial",
	                "addClassNames": true,
	                "theme": "light",
	                "path": "../assets/global/plugins/amcharts/ammap/images/",
	                "autoMargins": false,
	                "marginLeft": 30,
	                "marginRight": 8,
	                "marginTop": 10,
	                "marginBottom": 26,
	                "balloon": {
	                    "adjustBorderColor": false,
	                    "horizontalPadding": 10,
	                    "verticalPadding": 8,
	                    "color": "#ffffff"
	                },

	                "dataProvider": [
	                @for($i=1;$i<=12;++$i)
	                {
	                    "month": {{ $i }},
	                    "all": {{ $allInquiriesMonth[$i] or 0 }},
	                    "done": {{ $doneInquiriesMonth[$i] or 0 }},
	                    "wait": {{ $waitInquiriesMonth[$i] or 0 }}
	                },
	                @endfor
	                ],
	                "valueAxes": [{
	                    "axisAlpha": 0,
	                    "position": "left",
	                }],
	                "startDuration": 1,
	                "graphs": [{
	                    "alphaField": "alpha",
	                    "balloonText": "<span style='font-size:12px;'>[[title]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
	                    "fillAlphas": 1,
	                    "title": "All Inquires",
	                    "type": "column",
	                    "valueField": "all",
	                    "dashLengthField": "dashLengthColumn"
	                }, {
	                	"alphaField": "alpha",
	                    "balloonText": "<span style='font-size:12px;'>[[title]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
	                    "fillAlphas": 1,
	                    "title": "Responsed Inquires",
	                    "type": "column",
	                    "valueField": "done",
	                    "dashLengthField": "dashLengthColumn"
	                }, {
	                	"alphaField": "alpha",
	                    "balloonText": "<span style='font-size:12px;'>[[title]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
	                    "fillAlphas": 1,
	                    "title": "Waiting Inquires",
	                    "type": "column",
	                    "valueField": "wait",
	                    "dashLengthField": "dashLengthColumn"
	                }],
	                "categoryField": "month",
	                "categoryAxis": {
	                    "gridPosition": "start",
	                    "axisAlpha": 0,
	                    "tickLength": 0,
	                    "autoGridCount": false,
	                    "gridCount": 12,
	                    "showFirstLabel": true,
	                    "showLastLabel": true,
	                }
	            });
			@endif

			@if(in_array(32,$allowedActions))
				// booked packages
	            var chart = AmCharts.makeChart("dashboard_amchart_3", {
	                "type": "serial",
	                "addClassNames": true,
	                "theme": "light",
	                "path": "../assets/global/plugins/amcharts/ammap/images/",
	                "autoMargins": false,
	                "marginLeft": 30,
	                "marginRight": 8,
	                "marginTop": 10,
	                "marginBottom": 26,
	                "balloon": {
	                    "adjustBorderColor": false,
	                    "horizontalPadding": 10,
	                    "verticalPadding": 8,
	                    "color": "#ffffff"
	                },

	                "dataProvider": [
	                @for($i=1;$i<=12;++$i)
	                {
	                    "month": {{ $i }},
	                    "all": {{ $bookedPackages[$i] or 0 }}
	                },
	                @endfor
	                ],
	                "valueAxes": [{
	                    "axisAlpha": 0,
	                    "position": "left",
	                }],
	                "startDuration": 1,
	                "graphs": [{
	                    "alphaField": "alpha",
	                    "balloonText": "<span style='font-size:12px;'>[[title]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
	                    "fillAlphas": 1,
	                    "title": "Booked Packages",
	                    "type": "line",
	                    "valueField": "all",
	                    "dashLengthField": "dashLengthColumn",
	                }],
	                "categoryField": "month",
	                "categoryAxis": {
	                    "gridPosition": "start",
	                    "axisAlpha": 0,
	                    "tickLength": 0,
	                    "autoGridCount": false,
	                    "gridCount": 12,
	                    "showFirstLabel": true,
	                    "showLastLabel": true,
	                },
	            });
			@endif

			@if(in_array(39,$allowedActions))
				// comments and likes
	            var chart = AmCharts.makeChart("dashboard_amchart_2", {
	                "type": "serial",
	                "addClassNames": true,
	                "theme": "light",
	                "path": "../assets/global/plugins/amcharts/ammap/images/",
	                "autoMargins": false,
	                "marginLeft": 30,
	                "marginRight": 8,
	                "marginTop": 10,
	                "marginBottom": 26,
	                "balloon": {
	                    "adjustBorderColor": false,
	                    "horizontalPadding": 10,
	                    "verticalPadding": 8,
	                    "color": "#ffffff"
	                },

	                "dataProvider": [
	                @for($i=1;$i<=12;++$i)
	                {
	                    "month": {{ $i }},
	                    "allLikes": {{ $allLikes[$i] or 0 }},
	                    "allComments": {{ $allCommentsByMonth[$i] or 0}}
	                },
	                @endfor
	                ],
	                "valueAxes": [{
	                    "axisAlpha": 0,
	                    "position": "left"
	                }],
	                "startDuration": 1,
	                "graphs": [{
	                    "alphaField": "alpha",
	                    "balloonText": "<span style='font-size:12px;'>[[title]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
	                    "fillAlphas": 1,
	                    "title": "All Comments",
	                    "type": "column",
	                    "valueField": "allComments",
	                    "dashLengthField": "dashLengthColumn"
	                }
	                , {
	                    "id": "g2",
	                    "valueField": "allLikes",
	                    "classNameField": "bulletClass",
	                    "title": "likes",
	                    "type": "line",
	                    "valueAxis": "a2",
	                    "lineColor": "#786c56",
	                    "lineThickness": 1,
	                    //"legendValueText": "[[description]]/[[value]]",
	                    //"descriptionField": "townName",
	                    "bullet": "round",
	                    //"bulletSizeField": "townSize",
	                    "bulletBorderColor": "#02617a",
	                    "bulletBorderAlpha": 1,
	                    "bulletBorderThickness": 2,
	                    "bulletColor": "#89c4f4",
	                    //"labelText": "likes No.",
	                    "labelPosition": "right",
	                    "balloonText": "likes No. [[value]]",
	                    "showBalloon": true,
	                    "animationPlayed": true,
	                }],
	                "categoryField": "month",
	                "categoryAxis": {
	                    "gridPosition": "start",
	                    "axisAlpha": 0,
	                    "tickLength": 0,
	                    "autoGridCount": false,
	                    "gridCount": 12,
	                    "showFirstLabel": true,
	                    "showLastLabel": true,
	                }
	            });
			@endif
    	});
    </script>
@stop

@section('content')
	<div class="row">
		@if(in_array(45,$allowedActions))
	        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	            <div class="dashboard-stat2 dashboard-smbox">
	                <div class="display">
	                    <div class="number">
	                        <h3 class="font-green-sharp">
	                            <span data-counter="counterup" data-value="{{ $waitingInquiries }}">0</span>
	                        </h3>
	                        <small>INQUIRIES WAITING</small>
	                    </div>
	                    <div class="icon">
	                        <i class="flaticon-faq8"></i>
	                    </div>
	                </div>
	                <div class="progress-info">
	                    <div class="progress">
	                        <span style="width: {{ round($waitingInquiries/$allInquiries*100) }}%;" class="progress-bar progress-bar-success green-sharp">
	                            <span class="sr-only">{{ round($waitingInquiries/$allInquiries*100) }}% progress</span>
	                        </span>
	                    </div>
	                    <div class="status">
	                        <div class="status-title"> waiting </div>
	                        <div class="status-number"> {{ round($waitingInquiries/$allInquiries*100) }}% </div>
	                    </div>
	                </div>
	            </div>
	        </div>
        @endif
        @if(in_array(39,$allowedActions))
	        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	            <div class="dashboard-stat2 dashboard-smbox">
	                <div class="display">
	                    <div class="number">
	                        <h3 class="font-red-haze">
	                            <span data-counter="counterup" data-value="{{ $commentsNeedApprovalCount }}">0</span>
	                        </h3>
	                        <small>COMMENTS NEED APPROVAL</small>
	                    </div>
	                    <div class="icon">
	                        <i class="flaticon-comment43"></i>
	                    </div>
	                </div>
	                <div class="progress-info">
	                    <div class="progress">
	                        <span style="width: {{ round($commentsNeedApprovalCount/$allComments*100) }}%;" class="progress-bar progress-bar-success red-haze">
	                            <span class="sr-only">{{ round($commentsNeedApprovalCount/$allComments*100) }}% change</span>
	                        </span>
	                    </div>
	                    <div class="status">
	                        <div class="status-title"> need approval </div>
	                        <div class="status-number"> {{ round($commentsNeedApprovalCount/$allComments*100) }}% </div>
	                    </div>
	                </div>
	            </div>
	        </div>
        @endif
      

        @if(in_array(50,$allowedActions))
        	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{ $customers }}">0</span>
                        </div>
                        <div class="desc"> CUSTOMERS </div>
                    </div>
                    <a class="more" href="{{ config('app.cp_route_name') }}/customers"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
    	@if(in_array(45,$allowedActions))
	        <div class="col-md-6 col-sm-6">
	            <div class="portlet light pfullscreen">
	                <div class="portlet-title">
	                    <div class="caption font-green">
	                        <span class="caption-subject bold uppercase">Inquiries</span>
	                        <span class="caption-helper">per month</span>
	                    </div>

	                    <div class="actions">
	                        <a href="javascript:;" class="btn btn-circle btn-icon-only btn-default fullscreen fmax tooltip-one-info" title="Fullscreen"></a>
	                    </div>
	                </div>
	                <div class="portlet-body">
	                    <div id="dashboard_amchart_1" class="CSSAnimationChart"></div>
	                    <ul class="charts-color">
	                        <li class="clearfix">
	                            <span class="color-bg" style="background-color:#67b7dc ;"></span>
	                            <span class="color-txt">All Inquires</span>
	                        </li>
	                        <li class="clearfix">
	                            <span class="color-bg" style="background-color:#fdd400 ;"></span>
	                            <span class="color-txt">Responsed Inquires</span>
	                        </li>
	                        <li class="clearfix">
	                            <span class="color-bg" style="background-color:#84b761 ;"></span>
	                        	<span class="color-txt">Waiting Inquires</span>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    @endif
	    @if(in_array(32,$allowedActions))
	        <div class="col-md-6 col-sm-6">
	            <div class="portlet light pfullscreen">
	                <div class="portlet-title">
	                    <div class="caption font-red">
	                        <span class="caption-subject bold uppercase">Booked Packages</span>
	                        <span class="caption-helper">per month</span>
	                    </div>
	                    <div class="actions">
	                        <a href="javascript:;" class="btn btn-circle btn-icon-only btn-default fullscreen fmax tooltip-one-info" title="Fullscreen"></a>
	                    </div>
	                </div>
	                <div class="portlet-body">
	                    <div id="dashboard_amchart_3" class="CSSAnimationChart"></div>
	                </div>
	            </div>
	        </div>
	    @endif
    </div>

    <div class="row">
    	@if(in_array(39,$allowedActions))
	        <div class="col-md-6 col-sm-6">
	            <div class="portlet light pfullscreen">
	                <div class="portlet-title">
	                    <div class="caption font-green">
	                        <span class="caption-subject bold uppercase">Website Activites</span>
	                        <span class="caption-helper">comments and likes</span>
	                    </div>
	                    <div class="actions">
	                        <a href="javascript:;" class="btn btn-circle btn-icon-only btn-default fullscreen fmax tooltip-one-info" title="Fullscreen"></a>
	                    </div>
	                </div>
	                <div class="portlet-body">
	                    <div id="dashboard_amchart_2" class="CSSAnimationChart"></div>
	                    <ul class="charts-color">
                            <li class="clearfix">
                                <span class="color-bg circle" style="background-color:#67b7dc;"></span>
                                <span class="color-txt">Likes</span>
                            </li>
                            <li class="clearfix">
                                <span class="color-bg" style="background-color:#67b7dc;"></span>
                                <span class="color-txt">Comments</span>
                            </li>
                        </ul>
	                </div>
	            </div>
	        </div>
	    @endif

        <div class="col-md-6 col-sm-6">
            <div class="portlet light pfullscreen">
                <div class="portlet-title">
                    <div class="caption font-green">
                        <span class="caption-subject bold uppercase">{{$title}}</span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-circle btn-icon-only btn-default fullscreen fmax tooltip-one-info" title="Fullscreen"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="dashboard_amchart_4" class="CSSAnimationChart"></div>
                </div>
            </div>
        </div>
	    
    </div>

    <div class="row">
    	@if(in_array(37,$allowedActions))
	        <div class="col-md-6 col-sm-6">
	            <div class="portlet light portlet-needapproval">
	                <div class="portlet-title">
	                    <div class="caption caption-md">
	                        <i class="icon-bar-chart font-red"></i>
	                        <span class="caption-subject font-red bold uppercase">Blogs Need Approval</span>
	                    </div>
	                    <div class="actions">
	                        <div class="btn-group btn-group-devided" data-toggle="buttons">
	                            <label class="btn btn-transparent green btn-outline btn-circle btn-sm active today-tab">
	                                <input type="radio" name="options" class="toggle" id="option1">Today</label>
	                            <label class="btn btn-transparent green btn-outline btn-circle btn-sm week-tab">
	                                <input type="radio" name="options" class="toggle" id="option2">Week</label>
	                            <label class="btn btn-transparent green btn-outline btn-circle btn-sm month-tab">
	                                <input type="radio" name="options" class="toggle" id="option2">Month</label>
	                        </div>
	                    </div>
	                </div>
	                <div class="portlet-body">
	                    <div class="row number-stats margin-bottom-30">
	                        <div class="col-md-6 col-sm-6 col-xs-6">
	                            <div class="stat-left">
	                                <div class="stat-chart">
	                                    <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
	                                    <div id="sparkline_bar"></div>
	                                </div>
	                                <div class="stat-number">
	                                    <div class="title"> Total </div>
	                                    <div class="number"> {{ $allBlogCount }} </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-6 col-sm-6 col-xs-6">
	                            <div class="stat-right">
	                                <div class="stat-chart">
	                                    <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
	                                    <div id="sparkline_bar2"></div>
	                                </div>
	                                <div class="stat-number">
	                                    <div class="title"> New </div>
	                                    <div class="number"> {{ $blogNeedApprovalCount }} </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>

	                    <div class="scroller" style="height: 338px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
	                        <div class="general-item-list">
	                            @foreach($blogNeedApproval as $blog)
		                            <div class="item blog-item @if($blog->approval[0]->BlogApp_ApproveDate>date("Y-m-d")) today @endif @if($blog->approval[0]->BlogApp_ApproveDate>date("Y-m-d",time()-604800)) week @endif month">
		                                <div class="item-head">
		                                    <div class="item-details">
		                                    	@if($blog->approval[0]->customer->Cust_ThumpImage)
		                                        	<img class="item-pic rounded" src="{{ url("image/".$blog->approval[0]->customer->Cust_ThumpImage."/customers/41/41") }}">
		                                        @else
		                                        	<img class="item-pic rounded" src="cp/images/avatar-img3.png">
		                                        @endif
		                                        <a @if(in_array(37, $allowedActions)) href="{{ config('app.cp_route_name') }}/blog/preview/{{ $blog->Article_ID }}" @endif class="item-name primary-link">{{ $blog->approval[0]->customer->Cust_FirstName." ".$blog->approval[0]->customer->Cust_LastName }}</a>
		                                        <span class="item-label">{{ $blog->approval[0]->BlogApp_ApproveDate }}</span>
		                                    </div>
		                                </div>
		                                <div class="item-body">{{ $blog->language[0]->ArtLang_ArticleTitle }}</div>
		                                <div class="item-body">{{ $blog->language[0]->ArtLang_ArticleDescription }}</div>
		                            </div>
	                            @endforeach
	                            <p class="char-noresult blog-noresult">There are no blogs available!</p>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
        @endif
        @if(in_array(39,$allowedActions))
	        <div class="col-md-6 col-sm-6">
	            <div class="portlet light portlet-needapproval comments-needapproval">
	                <div class="portlet-title">
	                    <div class="caption caption-md">
	                        <i class="icon-bar-chart font-green"></i>
	                        <span class="caption-subject font-green bold uppercase">Comments Need Approval</span>
	                        <span class="caption-helper">{{ $commentsNeedApprovalCount }} pending</span>
	                    </div>
	                    <div class="inputs">
	                        <div class="portlet-input input-inline input-small ">
	                            <div class="input-icon right">
	                                <i class="icon-magnifier"></i>
	                                <input type="text" class="form-control form-control-solid input-circle inputtxt-comments" placeholder="search..."> 
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="portlet-body">
	                    <div class="scroller" style="height: 338px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
		                    <div class="general-item-list">
		                        @if($commentsNeedApproval->count())
		                        	@foreach($commentsNeedApproval as $comment)
			                            <div class="item">
			                                <div class="item-head">
			                                    <div class="item-details">
			                                        @if($comment->customer->Cust_ThumpImage)
			                                        	<img class="item-pic rounded" src="{{ url("image/".$comment->customer->Cust_ThumpImage."/customers/41/41") }}">
			                                        @else
			                                        	<img class="item-pic rounded" src="cp/images/avatar-img3.png">
			                                        @endif
			                                        <a class="item-name primary-link">{{ $comment->customer->Cust_FirstName." ".$comment->customer->Cust_LastName }}</a>
			                                        <span class="item-label">{{ $comment->Comment_CommentDate }}</span>
			                                    </div>
			                                    <span class="item-status">
			                                    	@if(in_array(40,$allowedActions))
			                                        <a class="chn-status btn btn-circle btn-icon-only btn-default tooltip-one-info txtred tooltipstered" href="{{ config('app.cp_route_name') }}/comments/changeStatus/{{ $comment->Comment_ID }}/reject" title="Reject"><i class="flaticon-cancel5"></i></a>
			                                        <a class="chn-status btn btn-circle btn-icon-only btn-default tooltip-one-info txtgreen tooltipstered" href="{{ config('app.cp_route_name') }}/comments/changeStatus/{{ $comment->Comment_ID }}/publish" title="Accept"><i class="flaticon-message35"></i></a>
			                                        @endif
			                                    </span>
			                                </div>
			                                <div class="item-body"> {{ $comment->Comment_Body }} </div>
			                            </div>
		                            @endforeach
		                        @else
		                            <p class="char-noresult comment-noresult">There are no waiting comments available!</p>
		                        @endif
		                    </div>
	                    </div>
	                </div>
	            </div>
	        </div>
        @endif
    </div>
@stop