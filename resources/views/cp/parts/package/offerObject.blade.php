<div class="box-item portlet box blue-soft">
    <input class="sub-item" type="hidden" name="OffDet_ID[{{ $OffDet_ID }}]" value="{{ $OffDet_ID}}">

    <div class="portlet-title child-title">
        <div class="caption">
            <i class="fa fa-info-circle"></i>
            <span>{{ isset($offerDetails) && $offerDetails->OffDet_EnglishTitle?$offerDetails->OffDet_EnglishTitle:"Offer Object"}}</span>
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
            <a href="javascript:;" class="del-item" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fa fa-close"></i></a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-6">
                @include("cp.parts.helper.htmlWidthSize",["selectName"=>"OffDet_HTMLWidth[$OffDet_ID]","width"=>(isset($offerDetails)?$offerDetails->OffDet_HTMLWidth:"")])
                <div class="form-group input-wlbl" data-lang="en">
                    <span class="lblinput">Offer Title</span>
                    <input data-title="Offer Object" name="OffDet_EnglishTitle[{{ $OffDet_ID}}]" type="text" class="form-control input-childtitle @if ($errors->has('OffDet_EnglishTitle['. $OffDet_ID.']')) has-error @endif" value="{{ isset($offerDetails) && $offerDetails->OffDet_EnglishTitle?$offerDetails->OffDet_EnglishTitle:""}}"/>
                    @if ($errors->has('OffDet_EnglishTitle['. $OffDet_ID.']'))
                        <span class="help-block error">{{ $errors->first('OffDet_EnglishTitle['. $OffDet_ID.']') }}</span>
                    @endif
                </div>
                <div class="form-group input-wlbl" style="display: none;" data-lang="ar">
                    <span class="lblinput">Offer Title</span>
                    <input name="OffDet_ArabicTitle[{{ $OffDet_ID}}]" type="text" class="form-control @if ($errors->has('OffDet_ArabicTitle['. $OffDet_ID.']')) has-error @endif" value="{{ isset($offerDetails) && $offerDetails->OffDet_ArabicTitle?$offerDetails->OffDet_ArabicTitle:""}}"/>
                    @if ($errors->has('OffDet_ArabicTitle['. $OffDet_ID.']'))
                        <span class="help-block error">{{ $errors->first('OffDet_ArabicTitle['. $OffDet_ID.']') }}</span>
                    @endif
                </div>
            </div>
            <!--span-->
            <div class="col-md-6">
                <div class="formgroup-wp uploadimg-rg clearfix">
                    <!-- <div class="upload-img-rg">
                        @if(isset($offerDetails) && $offerDetails->OffDet_ImageLink)
                            <img alt="" src="uploads/packages/{{ $offerDetails->OffDet_ImageLink }}">
                        @else
                            <img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
                        @endif
                    </div>
                    <div class="btn-inputfile-rg">
                        <div class="btn green btn-winputfile btn-loading2">
                            <span>Select Image</span>
                            <input data-folder="packages" type="file" class="file-img upload-img">
                            <input class="image-value" type="hidden" name="OffDet_ImageLink[{{ $OffDet_ID}}]" value="{{ isset($offerDetails)?$offerDetails->OffDet_ImageLink:""}}">
                        </div>
                        <div class="btn default btn-delimg">
                            <i class="fa fa-close"></i>
                        </div>
                    </div> -->
                    <div class="upload-image-rg clearfix" @if(isset($offerDetails) && $offerDetails->OffDet_ImageLink) style='background-image: url({{ url("image/".$offerDetails->OffDet_ImageLink."/packages/200/150") }})' @endif>
                        <input type="file" data-folder="packages" class="file-img upload-img" />
                        <input class="image-value" type="hidden" name="OffDet_ImageLink[{{ $OffDet_ID}}]" value="{{ isset($offerDetails)?$offerDetails->OffDet_ImageLink:""}}">
                        @if(isset($offerDetails) && $offerDetails->OffDet_ImageLink)
                        <span class="rem-imgicon rem-packageimgfile"><i class="fa fa-close"></i></span>
                        @endif
                    </div><!-- upload img rg -->
                    <span class="help-block">Max size is 4 MB</span>
                </div>
            </div>
            <!--span-->
        </div>
        <!--row-->
        <div class="form-group editorarea">
            <div data-lang="en">
                <textarea name="OffDet_EnglishDetails[{{ $OffDet_ID}}]" class="tinymce @if ($errors->has('OffDet_EnglishDetails['. $OffDet_ID.']')) has-error @endif">{{ isset($offerDetails) && $offerDetails->OffDet_EnglishDetails?$offerDetails->OffDet_EnglishDetails:""}}</textarea>
                @if ($errors->has('OffDet_EnglishDetails['. $OffDet_ID.']'))
                    <span class="help-block error">{{ $errors->first('OffDet_EnglishDetails['. $OffDet_ID.']') }}</span>
                @endif
            </div>
            <div data-lang="ar">
                <textarea name="OffDet_ArabicDetails[{{ $OffDet_ID}}]" class="tinymce @if ($errors->has('OffDet_ArabicDetails['. $OffDet_ID.']')) has-error @endif">{{ isset($offerDetails) && $offerDetails->OffDet_ArabicDetails?$offerDetails->OffDet_ArabicDetails:""}}</textarea>
                @if ($errors->has('OffDet_ArabicDetails['. $OffDet_ID.']'))
                    <span class="help-block error">{{ $errors->first('OffDet_ArabicDetails['. $OffDet_ID.']') }}</span>
                @endif
            </div>
        </div>
        <!-- editorarea -->
    </div>
    <!-- portlet body -->
</div>