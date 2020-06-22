<div id="{{$identifier}}" class="col-md-4 gallery-item" data-imgname="{{$identifier}}">
    <div class="portlet box green">
        <div class="portlet-title gallery-title">
            <div class="caption">
                <i class="fa fa-info-circle"></i>Gallery Item
            </div>
            <div class="tools">
                <div class="highlights-video tooltip-one-info" title="Highlight">
                    <input type="checkbox" class="checkboxnostyle radiocheckbox" data-objectname="GallMed_IsHighlighted" value="1" name="highlighted[{{ $identifier }}]" />
                    <i class="flaticon-gear43"></i>
                </div>
                <a href="javascript:;" class="remove-video" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fa fa-close"></i></a>
            </div>
        </div>
        <div class="portlet-body form">
            <div class="horizontal-form">
                <div class="form-body">
                    <div class="gallery-rg">
                        <div class="gallery-img">
                            <img src="http://img.youtube.com/vi/{{$identifier}}/hqdefault.jpg" alt="Gallery Image" />
                            <input type="hidden" name="fileName[]" data-objectname="hdnfile" value="{{ $identifier }}"/>
                            <i class="fa fa-play-circle"></i>
                        </div>
                        <div class="form-group input-wlbl">
                            <span class="lblinput">Title</span>
                            <input type="text" id="gallery_item_title_{{$identifier}}" class="form-control" placeholder="" value="" />
                            <input type="hidden" name="title_en[]" data-objectname="title" value="" lang="en" />
                            <input type="hidden" name="title_ar[]" data-objectname="title" value="" lang="ar" />
                        </div>
                        <div class="form-group input-wlbl">
                            <span class="lblinput">Description</span>
                            <textarea type="text" id="gallery_item_description_{{$identifier}}" class="form-control" placeholder="" value=""></textarea>
                            <input type="hidden" name="description_en[]" data-objectname="description" value="" lang="en" />
                            <input type="hidden" name="description_ar[]" data-objectname="description" value="" lang="ar" />
                        </div>
                        
                        @if($info)
                        <input type="hidden" class="GallMed_ID" name="GallMed_ID[]" data-objectname="GallMed_ID" value="{{Crypt::encrypt($info->GallMed_ID)}}" />
                        @else
                        <input type="hidden" class="GallMed_ID" name="GallMed_ID[]" data-objectname="GallMed_ID" value="" />
                        @endif
                        
                        <input type="hidden" name="type[]" data-objectname="type" value="video" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    mytooltipster();
</script>
