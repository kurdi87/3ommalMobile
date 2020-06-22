<div class="portlet pfullscreen box green infoinfo pcontainer-item">
    <div class="portlet-title parent-title pcontainer-title">
        <div class="caption">
            <i class="fa fa-info-circle"></i>
            <span>{{ isset($objectDetails) && $objectDetails->PackObj_EnglishTitle?$objectDetails->PackObj_EnglishTitle:"Informative Object"}}</span>
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse collapsep"></a>
            <a href="javascript:;" class="del-pcontainer" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fa fa-close"></i></a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="horizontal-form">
            <div class="form-body">
                <input type="hidden" name="PackObj_ID[{{ $PackObj_ID}}]" value="{{ $PackObj_ID}}">

                <div class="row">
                    <div class="col-md-6">
                        @include("cp.parts.helper.htmlWidthSize",["selectName"=>"PackObj_HTMLWidth[$PackObj_ID]","width"=>(isset($objectDetails)?$objectDetails->PackObj_HTMLWidth:"")])

                        <div class="form-group input-wlbl" data-lang="en">
                            <span class="lblinput">Informative Title</span>
                            <input name="PackObj_EnglishTitle[{{ $PackObj_ID}}]" type="text" class="form-control @if ($errors->has('PackObj_EnglishTitle['. $PackObj_ID.']')) has-error @endif input-parenttitle" data-title="Informative Object"
                                   value="{{ isset($objectDetails)?$objectDetails->PackObj_EnglishTitle:""}}"/>
                            @if ($errors->has('PackObj_EnglishTitle['. $PackObj_ID.']'))
                                <span class="help-block error">{{ $errors->first('PackObj_EnglishTitle['. $PackObj_ID.']') }}</span>
                            @endif
                        </div>
                        <div class="form-group input-wlbl" style="display: none;" data-lang="ar">
                            <span class="lblinput">Informative Title</span>
                            <input name="PackObj_ArabicTitle[{{ $PackObj_ID}}]" type="text" class="form-control @if ($errors->has('PackObj_ArabicTitle['. $PackObj_ID.']')) has-error @endif"
                                   value="{{ isset($objectDetails)?$objectDetails->PackObj_ArabicTitle:""}}"/>
                            @if ($errors->has('PackObj_ArabicTitle['. $PackObj_ID.']'))
                                <span class="help-block error">{{ $errors->first('PackObj_ArabicTitle['. $PackObj_ID.']') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="upload-image-rg clearfix" @if(isset($objectDetails) && $objectDetails->PackObj_ImageLink) style='background-image: url({{ url("image/".$objectDetails->PackObj_ImageLink."/packages/200/150") }})' @endif>
                            <input type="file" data-folder="packages" class="file-img upload-img"/>
                            <input class="image-value" type="hidden" name="PackObj_ImageLink[{{ $PackObj_ID}}]" value="{{ isset($objectDetails)?$objectDetails->PackObj_ImageLink:""}}">
                            @if(isset($objectDetails) && $objectDetails->PackObj_ImageLink)
                            <span class="rem-imgicon rem-packageimgfile"><i class="fa fa-close"></i></span>
                            @endif
                        </div>
                        <span class="help-block">Max size is 4 MB</span>
                    </div>
                </div>

                <div class="form-group editorarea">
                    <div data-lang="en">
                        <textarea name="PackObj_EnglishValue[{{ $PackObj_ID}}]" class="tinymce @if ($errors->has('PackObj_EnglishValue['. $PackObj_ID.']')) has-error @endif">{{ isset($objectDetails)?$objectDetails->PackObj_EnglishValue:""}}</textarea>
                        @if ($errors->has('PackObj_EnglishValue['. $PackObj_ID.']'))
                            <span class="help-block error">{{ $errors->first('PackObj_EnglishValue['. $PackObj_ID.']') }}</span>
                        @endif
                    </div>
                    <div data-lang="ar">
                        <textarea name="PackObj_ArabicValue[{{ $PackObj_ID}}]"
                                  class="tinymce @if ($errors->has('PackObj_ArabicValue['. $PackObj_ID.']')) has-error @endif">{{ isset($objectDetails)?$objectDetails->PackObj_ArabicValue:""}}</textarea>
                        @if ($errors->has('PackObj_ArabicValue['. $PackObj_ID.']'))
                            <span class="help-block error">{{ $errors->first('PackObj_ArabicValue['. $PackObj_ID.']') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>