<div class="portlet pfullscreen box blue-hoki pcontainer-item">
    <div class="portlet-title parent-title pcontainer-title">
        <div class="caption">
            <i class="fa fa-info-circle"></i>
            <span>{{ isset($objectDetails )&& $objectDetails->PackObj_EnglishTitle?$objectDetails->PackObj_EnglishTitle:"Container"}}</span>
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
            <div class="form-body box-bt-wbtn">
                <span class="fa fa-plus btn-btbox btn-add-offer"></span>
                <input type="hidden" name="PackObj_ID[{{ $PackObj_ID}}]" value="{{ $PackObj_ID}}">


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group input-wlbl" data-lang="en">
                            <span class="lblinput">Container Title</span>
                            <input name="PackObj_EnglishTitle[{{ $PackObj_ID}}]" type="text" class="form-control @if ($errors->has('PackObj_EnglishTitle['. $PackObj_ID.']')) has-error @endif input-parenttitle" data-title="Container" value="{{ isset($objectDetails)?$objectDetails->PackObj_EnglishTitle:""}}"/>
                            @if ($errors->has('PackObj_EnglishTitle['. $PackObj_ID.']'))
                                <span class="help-block error">{{ $errors->first('PackObj_EnglishTitle['. $PackObj_ID.']') }}</span>
                            @endif
                        </div>
                        <div class="form-group input-wlbl" style="display: none;" data-lang="ar">
                            <span class="lblinput">Container Title</span>
                            <input name="PackObj_ArabicTitle[{{ $PackObj_ID}}]" type="text" class="form-control @if ($errors->has('PackObj_ArabicTitle['. $PackObj_ID.']')) has-error @endif" value="{{ isset($objectDetails)?$objectDetails->PackObj_ArabicTitle:""}}"/>
                            @if ($errors->has('PackObj_ArabicTitle['. $PackObj_ID.']'))
                                <span class="help-block error">{{ $errors->first('PackObj_ArabicTitle['. $PackObj_ID.']') }}</span>
                            @endif
                        </div>
                    </div>
                    <!--span-->
                </div>
                <!--row-->
                <div class="offers-list">
                    @if(isset($OffDet_ID))
                        @include('cp.parts.package.offerObject')
                    @elseif(isset($offers))
                        @foreach($offers as $offer)
                            @include('cp.parts.package.offerObject',["OffDet_ID"=>$offer->OffDet_ID,'offerDetails'=>$offer])
                        @endforeach
                    @endif
                </div>
                <!-- offers list -->
            </div>
            <!--form body-->
        </div>
        <!-- END FORM-->
    </div>
    <!--portlet form-->
</div><!--portlet box-->