<div class="portlet pfullscreen box green-dark pcontainer-item">
    <div class="portlet-title parent-title pcontainer-title">
        <div class="caption">
            <i class="fa fa-info-circle"></i>
            <span>{{ isset($objectDetails) && $objectDetails->PackObj_EnglishTitle?$objectDetails->PackObj_EnglishTitle:"Flight Booking Object"}}</span>
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse collapsep"></a>
            <a href="" class="fullscreen fmax"> </a>
            <a href="javascript:;" class="del-pcontainer" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fa fa-close"></i></a>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <div class="horizontal-form">
            <div class="form-body box-bt-wbtn {{ (isset($flightDetails) && $flightDetails->PkgFlt_TripType==2)?"boxbtn-open":"" }}">
                <span class="fa fa-plus btn-btbox btn-add-flight"></span>

                <input type="hidden" name="PackObj_ID[{{ $PackObj_ID}}]" value="{{ $PackObj_ID}}">
                <input type="hidden" name="PkgFlt_ID[{{ $PkgFlt_ID}}]" value="{{ $PkgFlt_ID}}">

                <div class="row">
                    <div class="col-md-6">
                        @include("cp.parts.helper.htmlWidthSize",["selectName"=>"PackObj_HTMLWidth[$PackObj_ID]","width"=>(isset($objectDetails)?$objectDetails->PackObj_HTMLWidth:"")])
                    </div>
                </div>
                <!--row-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group input-wlbl" data-lang="en">
                            <span class="lblinput">Flight Booking Title</span>
                            <input name="PackObj_EnglishTitle[{{ $PackObj_ID}}]" type="text" class="form-control @if ($errors->has('PackObj_EnglishTitle['. $PackObj_ID.']')) has-error @endif input-parenttitle" data-title="Flight Booking Object" value="{{ isset($objectDetails)?$objectDetails->PackObj_EnglishTitle:""}}"/>
                            @if ($errors->has('PackObj_EnglishTitle['. $PackObj_ID.']'))
                                <span class="help-block error">{{ $errors->first('PackObj_EnglishTitle['. $PackObj_ID.']') }}</span>
                            @endif
                        </div>
                        <div class="form-group input-wlbl" style="display: none;" data-lang="ar">
                            <span class="lblinput">Flight Booking Title</span>
                            <input name="PackObj_ArabicTitle[{{ $PackObj_ID}}]" type="text" class="form-control @if ($errors->has('PackObj_ArabicTitle['. $PackObj_ID.']')) has-error @endif" value="{{ isset($objectDetails)?$objectDetails->PackObj_ArabicTitle:""}}"/>
                            @if ($errors->has('PackObj_ArabicTitle['. $PackObj_ID.']'))
                                <span class="help-block error">{{ $errors->first('PackObj_ArabicTitle['. $PackObj_ID.']') }}</span>
                            @endif
                        </div>
                    </div>
                    <!--span-->
                    <div class="col-md-6">
                        <div class="form-group select-wlbl">
                            <span class="lblselect lblselecttop">Type</span>
                            <select name="PkgFlt_TripType[{{ $PkgFlt_ID}}]" class="bs-select form-control flight-type">
                                @foreach($tripType as $trip)
                                    <option @if(isset($flightDetails) && $flightDetails->PkgFlt_TripType==$trip->SysLkp_ID) selected="selected" @endif data-tripType="{{ $trip->SysLkp_HTMLID }}" value="{{ $trip->SysLkp_ID }}">{{ $trip->language[0]->LkpLang_Text }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--span-->
                </div>
                <!--row-->
                <div class="flights-list">
                    @if(isset($PkgTrip_ID))
                        @include('cp.parts.package.flightTrip')
                    @elseif(isset($trips))
                        @foreach($trips as $trip)
                            @include('cp.parts.package.flightTrip',["PkgTrip_ID"=>$trip->PkgTrip_ID,'tripDetails'=>$trip])
                        @endforeach
                    @endif
                </div>
                <!--flights list-->
            </div>
            <!--form body-->
        </div>
        <!-- END FORM-->
    </div>
    <!--portlet form-->
</div><!--portlet box-->