
jQuery(document).ready(function() {    


    /*App.blockUI({
        boxed: true
    });

    window.setTimeout(function() {
        App.unblockUI();
    }, 2000);*/
    
    jQuery('#tabs-settings a').on('shown.bs.tab', function (e) {
        var thisclick = jQuery(this);
        var txttitle = thisclick.text().trim();
        jQuery('.settings-ptitle').text(txttitle);
    });

    jQuery(document).on('click','.btn-changeyear',function(){
        jQuery(this).parents('.btn-group').toggleClass('open');
    });

    jQuery(document).on('click','.mydropdown-yearmenu>li>a',function() {
        var year = jQuery(this).attr('data-year');
        var current_url = window.location.href;
        window.location.replace(current_url);
    });
    
    jQuery('.sidebar-search .form-control').keyup(function()
    {
        searchTable(jQuery(this).val());
    });

    jQuery(document).on('keydown', function (e) {
        if ((e.keyCode == "13") && (jQuery('.sidebar-search .form-control').is(':focus'))) {
            return false;
        }
    });

    function searchTable(inputVal)
    {
        var table = jQuery('.page-sidebar-menu');
        table.find('li').each(function(index, row)
        {
            var allCells = jQuery(row).find('.nav-link>span');
            if(allCells.length > 0)
            {
                var found = false;
                allCells.each(function(index, td)
                {
                    var regExp = new RegExp(inputVal, 'i');
                    if(regExp.test($(td).text()))
                    {
                        found = true;
                        return false;
                    }
                });
                if(found == true)$(row).show();else $(row).hide();
            }
        });
    }

    jQuery('.inputtxt-comments').keyup(function()
    {
        searchComments(jQuery(this).val());
    });

    jQuery(document).on('keydown', function (e) {
        if ((e.keyCode == "13") && (jQuery('.inputtxt-comments').is(':focus'))) {
            return false;
        }
    });
    $('select:not(.normal)').each(function () {
        $(this).select2({
            dropdownParent: $(this).parent()
        });
    });
    function searchComments(inputVal)
    {
        var table = jQuery('.comments-needapproval .general-item-list');
        table.find('.item').each(function(index, row)
        {
            var allCells = jQuery(row).find('.item-name,.item-body');
            if(allCells.length > 0)
            {
                var found = false;
                allCells.each(function(index, td)
                {
                    var regExp = new RegExp(inputVal, 'i');
                    if(regExp.test($(td).text()))
                    {
                        found = true;
                        return false;
                    }
                });
                if(found == true)$(row).show();else $(row).hide();
            }
        });
    }

    jQuery(document).on('click','.iadvanced',function(){
        var  thisclick = jQuery(this);
        if(jQuery(this).hasClass('active') == false)
        {   
            /*if ($(this).parents('.tools').find('.mycollapse').hasClass("collapse")) {
                $(this).parents('.tools').find('.mycollapse').removeClass("collapse").addClass("expand");
                //jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
                el.slideUp(200);
            }*/

            var el = thisclick.parents(".portlet").children(".collapse-body");
            if(thisclick.parents('.tools').find('.mycollapse').hasClass("expand"))
            {
                thisclick.parents('.tools').find('.mycollapse').removeClass("expand").addClass("collapse");
                el.slideDown(200);
                setTimeout(function() {
                    jQuery('.advsearch-elm').collapse('show');
                    thisclick.addClass('active');
                    jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
                },201);
            }
            else
            {
                jQuery('.advsearch-elm').collapse('show');
                jQuery(this).addClass('active');
                jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
            }
        }
        else
        {
            jQuery('.advsearch-elm').collapse('hide');
            jQuery(this).removeClass('active');
            jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');

            /*var el = thisclick.parents(".portlet").children(".collapse-body");
            if(thisclick.parents('.tools').find('.mycollapse').hasClass("expand"))
            {
                thisclick.parents('.tools').find('.mycollapse').removeClass("expand").addClass("collapse");
                el.slideDown(200);
                setTimeout(function() {
                    jQuery('.advsearch-elm').collapse('show');
                    thisclick.addClass('active');
                    jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
                },201);
            }*/
        }
   });

   jQuery(document).on('click','.btn-reset',function(){
        jQuery(this).parents('form').find('.form-control').val('');
        jQuery('.lblinput').removeClass('lblinputtop');
        jQuery('select.bs-select').val(0);
        jQuery('.bs-select').selectpicker('refresh');
        if(jQuery('select.select2').length)
        {
            jQuery('select.select2').select2("val", "");
        }
        jQuery('.select-wlbl,.selectbs-wlbl,.select2-wlbl').find('.lblselect').removeClass('lblselecttop');
        jQuery('.cleardate').addClass('display-none');
        //jQuery('.chosen-select').select2("val", "");
   });

   $('body').on('click', '.portlet > .portlet-title .fullscreen.fmax', function(e) {
        e.preventDefault();
        var portlet = $(this).closest(".pfullscreen");
        var height = App.getViewPort().height -
            portlet.children('.portlet-title').outerHeight() -
            parseInt(portlet.children('.portlet-body').css('padding-top')) -
            parseInt(portlet.children('.portlet-body').css('padding-bottom'));

            $(this).addClass('on');
            jQuery(this).removeClass('fmax').addClass('fmin');
            portlet.addClass('portlet-fullscreen');
            $('body').addClass('page-portlet-fullscreen');
            portlet.children('.portlet-body').css('height', height);
    });

    $('body').on('click', '.portlet > .portlet-title .fullscreen.fmin', function(e) {
        e.preventDefault();
        var portlet = $(this).closest(".pfullscreen");
        $(this).removeClass('on');
        jQuery(this).removeClass('fmin').addClass('fmax');
        portlet.removeClass('portlet-fullscreen');
        $('body').removeClass('page-portlet-fullscreen');
        portlet.children('.portlet-body').css('height', 'auto');
    });

   jQuery('[data-toggle="tooltip"]').tooltip();

    jQuery(document).on('click','.lblinput',function(){
        //jQuery(this).addClass('lblinputtop');
        jQuery(this).parents('.input-wlbl').find('.form-control').eq(0).focus();
    });

    /*jQuery(document).on('focus','.input-wlbl',function(){
        jQuery(this).find('.lblinput').addClass('lblinputtop');
    });*/

    jQuery(document).on('focusin','.input-wlbl',function(){
        jQuery(this).find('.lblinput').addClass('lblinputtop');
    });

    jQuery(document).on('focusout','.input-wlbl',function(){
        if(jQuery(this).find('.form-control').val())
        {
            jQuery(this).find('.lblinput').addClass('lblinputtop');
        }
        else
        {
            jQuery(this).find('.lblinput').removeClass('lblinputtop');
        }
    });
    
    jQuery(document).on('change','.input-wlbl .form-control',function(){
        if(jQuery(this).val())
        {
            jQuery(this).parents('.input-wlbl').find('.lblinput').addClass('lblinputtop');
        }
        else
        {
            if(!jQuery(this).is(':focus'))
            {
                jQuery(this).parents('.input-wlbl').find('.lblinput').removeClass('lblinputtop');
            }
        }
    });

    function input_wlbl() {
        jQuery('.input-wlbl').each(function(){
        if(jQuery(this).find('.form-control').val())
            {
                jQuery(this).find('.lblinput').addClass('lblinputtop');
            }
            else
            {
                jQuery(this).find('.lblinput').removeClass('lblinputtop');
            }
        });
    }
    window.input_wlbl = input_wlbl;
    input_wlbl();
    
    function select_wlbl() {
        jQuery('.select2-wlbl select,.selectbs-wlbl select').each(function() {
            //if(jQuery(this).find('option:selected').index()>0)
            if(jQuery(this).val())
            {
                jQuery(this).parents('.select2-wlbl').find('.lblselect').addClass('lblselecttop');
                jQuery(this).parents('.selectbs-wlbl').find('.lblselect').addClass('lblselecttop');
            }
        });
    };
    window.select_wlbl = select_wlbl;
    select_wlbl();

    jQuery(document).on('click','.select-wlbl .lblselect',function(e){
        var e = document.createEvent('MouseEvents');
        e.initMouseEvent('mousedown');
        jQuery(this).parent().find('select')[0].dispatchEvent(e);
    });

    jQuery(document).on('change','.select-wlbl select',function(){
        jQuery(this).parents('.select-wlbl').find('.lblselect').addClass('lblselecttop');
    });

    jQuery(document).on('change','.selectbs-wlbl select',function(){
        jQuery(this).parents('.selectbs-wlbl').find('.lblselect').addClass('lblselecttop');
    });

    jQuery(document).on('click','.selectbs-wlbl .lblselect',function(){
        if((jQuery(this).parents('.selectbs-wlbl').find('.bootstrap-select.bs-select').hasClass('open')==false) && (jQuery(this).parents('.selectbs-wlbl').find('select.bs-select').attr('disabled')!="disabled"))
        {
            jQuery(this).parents('.selectbs-wlbl').find('.bootstrap-select.bs-select').addClass('open');
        }
        else
        {
            jQuery(this).parents('.selectbs-wlbl').find('.bootstrap-select.bs-select').removeClass('open');
        }
        return false;
    });

    //$('.selectpicker').selectpicker('show');
    //select2
    jQuery(document).on('click','.select2-wlbl .lblselect',function(){
        jQuery(this).parents('.select2-wlbl').find('select.select2,select.myselect2,select.select2wlabel,select.selectcustom').select2("open");
    });

    jQuery('.select2-wlbl .lblselect').hover(function(){
        jQuery(this).parents('.select2-wlbl').find('.select2-container--default').addClass('select2-container--openmy');
    },function(){
        jQuery(this).parents('.select2-wlbl').find('.select2-container--default').removeClass('select2-container--openmy');
    });

    jQuery(document).on('change','.select2-wlbl select.select2,.select2-wlbl select.myselect2,select.select2wlabel,.select2-wlbl select.selectcustom',function(){
        jQuery(this).parents('.select2-wlbl').find('.lblselect').addClass('lblselecttop');
    });
    
    /*jQuery("#sortable_portlets").sortable({
        connectWith: ".portlet",
        items: ".portlet", 
        opacity: 0.8,
        handle : '.portlet-title',
        coneHelperSize: true,
        placeholder: 'portlet-sortable-placeholder',
        forcePlaceholderSize: true,
        tolerance: "pointer",
        helper: "clone",
        tolerance: "pointer",
        forcePlaceholderSize: !0,
        helper: "clone",
        cancel: ".portlet-sortable-empty, .portlet-fullscreen", // cancel dragging if portlet is in fullscreen mode
        revert: 250, // animation in milliseconds
        update: function(b, c) {
            if (c.item.prev().hasClass("portlet-sortable-empty")) {
                c.item.prev().before(c.item);
            }                    
        },
        start: function(){
            //tinyMCE.remove();
            jQuery('.editorarea textarea.tinymce').each(function(){
                tinyMCE.execCommand('mceRemoveEditor', false, jQuery(this).attr('id'));
            });
            // if (typeof tinyMCE != 'undefined') {
            //     tinyMCE.execCommand('mceRemoveEditor', false, 'tinymce1'); 
            // }
        },
        stop: function(){
            App.init();
            //Tinymce.init();
            jQuery('.editorarea textarea.tinymce').each(function(){
                //tinyMCE.execCommand('mceRemoveEditor', false, jQuery(this).attr('id'));
                tinyMCE.execCommand('mceAddEditor', false, jQuery(this).attr('id'));
            });
            // if (typeof tinyMCE != 'undefined') {
            //     tinyMCE.execCommand('mceAddEditor', false, 'tinymce1'); 
            // }
        }
    });*/
    
    jQuery(document).on('change','.check',function(){
        if(jQuery(this).prop('checked')==true)
        {
            jQuery(this).parents('.highlight-rg').find('.icheck-input').addClass('icheckinput-open');
            jQuery(this).parents('.highlight-rg').find('.form-control').addClass('forminputsingle-required');
        }
        else
        {
            jQuery(this).parents('.highlight-rg').find('.icheck-input').removeClass('icheckinput-open');
            jQuery(this).parents('.highlight-rg').find('.form-control').removeClass('forminputsingle-required has-error');
        }
    });

    /*var mythisclick;
    jQuery(document).on('click','.del-pcontainer',function(){
        //jQuery(this).parents('.pcontainer-item').remove();
        mythisclick = jQuery(this);
        //jQuery(this).parents('.pcontainer-item').attr('id','delete'+delid);
        
        jQuery(this).confirmation({
            placement: 'left',
            container: 'body',
            title: "Are You sure?",
            btnOkClass: 'btn btn-sm btn-danger',
            btnOkLabel: 'Ok',
            btnOkIcon: 'glyphicon glyphicon-ok',
            btnCancelClass: 'btn btn-sm btn-default',
            btnCancelLabel: 'Cancel',
            btnCancelIcon: 'glyphicon glyphicon-remove',
            href: '#',
            target: '_self',
            singleton: true,
            popout: true,
            template: '<div class="popover"><div class="arrow"></div>'
                        + '<h3 class="popover-title"></h3>'
                        + '<div class="popover-content">'
                        + '<a data-apply="confirmation">Yes</a>'
                        + '<a data-dismiss="confirmation">No</a>'
                        + '</div>'
                        + '</div>',
            onConfirm: function() {
                mythisclick.confirmation('hide');
                mythisclick.parents('.pcontainer-item').remove();
            }
        });
        
        return false;
    });*/

    /*jQuery('.del-pcontainer').on('confirmed.bs.confirmation', function () {
        mythisclick.confirmation('hide');
        mythisclick.parents('.pcontainer-item').remove();
    });*/

    /*jQuery(document).on('click','.del-item',function(){
        if(jQuery(this).parents('.offers-list').find('.portlet').size()==2)
        {
            jQuery(this).parents('.offers-list').find('.portlet').removeClass('offer-item');
            jQuery(this).parents('.offers-list').addClass('cancel-move');
        }
        if(jQuery(this).parents('.flights-list').find('.portlet').size()==2)
        {
            jQuery(this).parents('.flights-list').find('.portlet').removeClass('flight-item');
            jQuery(this).parents('.flights-list').addClass('cancel-move');
        }
        jQuery(this).parents('.box-item').remove();
        return false;
    });*/

    jQuery(document).on('click','.btn-add-tags',function(){
        var mytags = jQuery(this).attr('data-mytags');
        var myinput = jQuery(this).parent().find('input[type=text]');
        var input_val = myinput.val().trim();
        if(input_val.length>0)
        {
            var tagadd = '<div class="tagadd">'
                +input_val
                +'<span class="i-tagadd del-tagadded">'
                    +'<i class="fa fa-close"></i>'
                +'</span>'
                +'<input type="hidden" value="'+input_val+'" />'
            +'</div>';
            jQuery(".mytags#"+mytags).append(tagadd);
            myinput.val('');
        }
    });

    jQuery(document).on('keydown', function (e) {
        if ((e.keyCode == "13") && (jQuery('.input-tags').is(':focus'))) {
            jQuery('.input-tags:focus').parent().find('.btn-add-tags').click();
            return false;
        }
    });

    jQuery(document).on('click','.del-tagadded',function(){
        jQuery(this).parent().remove();
    });

    $('body').on('click', '.portlet > .portlet-title.myptitle', function(e) {
        e.preventDefault();
        var el = $(this).parents(".portlet").children(".collapse-body");
        if ($(this).find('.mycollapse').hasClass("collapse")) {
            $(this).find('.mycollapse').removeClass("collapse").addClass("expand");
            jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
            el.slideUp(200);
        } else {
            $(this).find('.mycollapse').removeClass("expand").addClass("collapse");
            jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
            el.slideDown(200);
        }
    });

    $('body').on('click', '.portlet > .portlet-title > .tools > .mycollapse.collapse, .portlet .portlet-title > .tools > .mycollapse.expand', function(e) {
        if(jQuery(this).parents('.portlet-title').hasClass('myptitle'))
        {
            return true;
        }
        else
        {
            e.preventDefault();
            var el = $(this).parents(".portlet").children(".collapse-body");
            if ($(this).hasClass("collapse")) {
                $(this).removeClass("collapse").addClass("expand");
                jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
                el.slideUp(200);
                jQuery('.iadvanced').removeClass('active');
            } else {
                $(this).removeClass("expand").addClass("collapse");
                jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
                el.slideDown(200);
            }
        }
    });
    
    $('body').on('click', '.portlet > .portlet-title > .tools > .collapseg.collapse, .portlet .portlet-title > .tools > .collapseg.expand', function(e) {
        e.preventDefault();
        var el = $(this).parents(".portlet").children(".portlet-body");
        if ($(this).hasClass("collapse")) {
            $(this).removeClass("collapse").addClass("expand");
            jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
            el.slideUp(200);
        } else {
            $(this).removeClass("expand").addClass("collapse");
            jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
            el.slideDown(200);
        }
    });

    $('body').on('click', '.portlet > .portlet-title > .tools > .collapsep.collapse, .portlet .portlet-title > .tools > .collapsep.expand', function(e) {
        e.preventDefault();
        var el = $(this).parents(".pcontainer-item").children(".portlet-body");
        if ($(this).hasClass("collapse")) {
            $(this).removeClass("collapse").addClass("expand");
            jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
            el.slideUp(200);
        } else {
            $(this).removeClass("expand").addClass("collapse");
            jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
            el.slideDown(200);
        }
    });

    jQuery(document).on('click','.btn-collaspe-all',function() {
        var el_one = $('.collapseg').parents(".portlet").children(".portlet-body");
        var el_two = $('.collapsep').parents(".pcontainer-item").children(".portlet-body");
        if(jQuery(this).hasClass('collaspe_all'))
        {
            jQuery(this).removeClass('collaspe_all').addClass('expand_all');
            jQuery(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
            jQuery(this).tooltipster('content', 'Expand All');
            jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
            $('.collapseg').removeClass("collapse").addClass("expand");
            el_one.slideUp(200);

            $('.collapsep').removeClass("collapse").addClass("expand");
            el_two.slideUp(200);
        }
        else
        {   
            jQuery(this).removeClass('expand_all').addClass('collaspe_all');
            jQuery(this).find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
            jQuery(this).tooltipster('content', 'Collaspe All');
            jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
            $('.collapseg').removeClass("expand").addClass("collapse");
            el_one.slideDown(200);

            $('.collapsep').removeClass("expand").addClass("collapse");
            el_two.slideDown(200);
        }
        return false;
    });

    $('body').on('click', '.box-item > .portlet-title > .tools > .collapse, .box-item .portlet-title > .tools > .expand', function(e) {
        e.preventDefault();
        var el = $(this).parents(".box-item").children(".portlet-body");
        if ($(this).hasClass("collapse")) {
            $(this).removeClass("collapse").addClass("expand");
            jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
            el.slideUp(200);
        } else {
            $(this).removeClass("expand").addClass("collapse");
            jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
            el.slideDown(200);
        }
    });

    jQuery(document).on('keyup','.input-parenttitle',function(){
        if(jQuery(this).val().trim())
        {
            jQuery(this).parents('.pcontainer-item').find('.pcontainer-title>.caption>span').text(jQuery(this).val());
        }
        else
        {
            jQuery(this).parents('.pcontainer-item').find('.pcontainer-title>.caption>span').text(jQuery(this).attr('data-title'));
        }
    });

    jQuery(document).on('keyup','.input-childtitle',function(){
        if(jQuery(this).val().trim())
        {
            jQuery(this).parents('.box-item').find('.child-title>.caption>span').text(jQuery(this).val());
        }
        else
        {
            jQuery(this).parents('.box-item').find('.child-title>.caption>span').text(jQuery(this).attr('data-title'));
        }
    });

    jQuery(document).on('keydown', '.txtinput-filter-number', function (event) {
         // Allow: backspace, delete, tab, escape, enter and , 190.
         if ($.inArray(event.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A
             (event.keyCode == 65 && event.ctrlKey == true) ||
             // Allow: home, end, left, right
             (event.keyCode >= 35 && event.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
         }
         else {
             // Ensure that it is a number and stop the keypress
             if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                 event.preventDefault();
             }
         }
    });

    jQuery(document).on("keypress keyup blur",'.txtinput-filter-latlng',function (event) {
        //this.value = this.value.replace(/[^0-9\.]/g,'');
        jQuery(this).val(jQuery(this).val().replace(/-[^0-9\.]/g,''));
        if((event.which == 8) || (event.which == 45) || (event.keyCode >= 35 && event.keyCode <= 39) || (event.keyCode == 65 && event.ctrlKey == true)){
            return true;
        }
        else if ((event.which != 46 || jQuery(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    jQuery(document).on("keypress keyup blur",'.txtinput-filter-latlng',function (event) {
        //this.value = this.value.replace(/[^0-9\.]/g,'');
        jQuery(this).val(jQuery(this).val().replace(/-[^0-9\.]/g,''));
        if((event.which == 8) || (event.which == 45) || (event.keyCode >= 35 && event.keyCode <= 39) || (event.keyCode == 65 && event.ctrlKey == true)){
            return true;
        }
        else if ((event.which != 46 || jQuery(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    jQuery(document).on('keydown', '.txtnotnumber', function (event) {
        if (event.altKey == false && event.ctrlKey == false)
        {
            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) && event.shiftKey== false)
            {
                return false;
            }
            else
            {
                if((event.keyCode >= 65 && event.keyCode <= 90) ||
                (event.keyCode >= 97 && event.keyCode <= 122))
                {}
            }
        }
    });

    /*jQuery(this).find('.input-email').each(function() {
        if (jQuery(this).val().trim().length > 0 && emailreg.test(jQuery(this).val().trim()) == false) {

            jQuery(this).addClass('error-required');
            jQuery(this).parent().addClass('error-parent');
            if (!jQuery(this).parent().find('.error-msg-validation').is(':visible')) {
                jQuery(this).parent().append('<span class="error-msg-validation">Please enter valid email</span>');
            }
            if (errors == false || (jQuery(this).offset().top < top)) {
                top = jQuery(this).offset().top;
            }
            errors = true;
        }
        else if(!jQuery(this).hasClass('required-field')){
            jQuery(this).removeClass('error-required');
            jQuery(this).parent().removeClass('error-parent');
            jQuery(this).parent().find('.error-msg-validation').remove();
        }
        else {
            jQuery(this).parent().find('.error-msg-validation').remove();
        }
    });*/

    jQuery('.ctooltip').tooltip();

    /*jQuery(document).on('click','.show-sidebar',function(){
        var thisclick = jQuery(this);
        if(jQuery(this).hasClass('active') == false)
        {
            jQuery('.tooltip-one-info').tooltipster('hide');
            jQuery('.sidebar-region').removeClass('display-none');
            jQuery('.sidebar-region').transit({
                y: 0
            }, 1000, function(){
                thisclick.addClass('active');
            });
        }
        else
        {
            jQuery('.sidebar-region').transit({
                y: '-100%'
            }, 1000, function(){
                jQuery('.sidebar-region').addClass('display-none');
                thisclick.removeClass('active');
            });
        }
        return false;
    });*/
    
    jQuery(document).on('click','.close-sidebar',function(){
        var thisclick = jQuery(this);
        if(thisclick.attr('disabled')!='disabled')
        {
            if(jQuery('.sidebar-region').hasClass('sideclose'))
            {
                thisclick.addClass('active');
                jQuery('.sidebar-region').transit({
                    x: '0'
                }, 600, function(){
                    jQuery(this).removeClass('sideclose').addClass('sideopen');
                });
            }
            else
            {
                jQuery('.sidebar-region').transit({
                    x: '100%'
                }, 600, function(){
                    jQuery(this).removeClass('sideopen').addClass('sideclose');
                    thisclick.removeClass('active');
                });
            }
        }
        return false;
    });

    function close_sidebar()
    {
        jQuery('.sidebar-region').transit({
            x: '100%'
        }, 600, function(){
            jQuery(this).removeClass('sideopen').addClass('sideclose');
            jQuery('.close-sidebar').removeClass('active');
        });
    }
    window.close_sidebar = close_sidebar;
    
    jQuery(document).on('keydown', function (e) {
        if ((e.keyCode == "13") && (jQuery('.youtube-links').is(':focus')) && (jQuery('.youtube-links:focus').parents('.input-wbtn').find('.youtube-links').val().trim())) {
            jQuery('.youtube-links:focus').parents('.input-wbtn').find('.btn-addlink').click();
            return false;
        }
    });

    jQuery('.youtube-links').on('itemAdded', function(event) {
      // event.item: contains the item
      var tag = event.item;
    });

    jQuery('.youtube-links').on('itemRemoved', function(event) {
      // event.item: contains the item
        var tag = event.item;
    });

    /*jQuery(document).on('keydown','.myselect2 .select2-search__field',function() {
        //alert(jQuery(this).val());
    });*/

    /*jQuery(document).on('keydown', function (e) {
        var this_select2 = jQuery('.myselect2 .select2-search__field');
        if ((e.keyCode == "13") && (this_select2.is(':focus'))) {
            var input_val = this_select2.val().trim();
            jQuery('.selectrole-rg select.myselect2').append('<option selected="" value="'+input_val+'">'+input_val+'</option>').select2();
            jQuery('.selectrole-rg.select2-wlbl').find('.lblselect').addClass('lblselecttop');
            return false;
        }
    });*/

    var classes_one_info = {
        mapLocationInfoClass: 'map-location-one-info',
        tooltipClass: 'tooltip-one-info'
    };
    
    function mytooltipster()
    {
        jQuery('.tooltip-one-info').tooltipster({
            animation: 'grow',
            maxWidth: 300,
            speed: 250,
            theme: '.' + classes_one_info.mapLocationInfoClass
        });
    }
    window.mytooltipster = mytooltipster;
    mytooltipster();

    var classes_one_info_green = {
        mapLocationInfoClass: 'map-location-one-info-green',
        tooltipClass: 'tooltip-one-info-green'
    };
    
    function mytooltipster_green()
    {
        jQuery('.tooltip-one-info-green').tooltipster({
            animation: 'grow',
            maxWidth: 300,
            speed: 250,
            theme: '.' + classes_one_info_green.mapLocationInfoClass
        });
    }
    window.mytooltipster_green = mytooltipster_green;
    mytooltipster_green();

    var formhtml = '<div class="form-popover">'
        +'<div class="form-group input-wlbl">'
            +'<span class="lblinput">Password</span>'            
            +'<input type="password" class="form-control input-password" data-placeholder="Password" />'
        +'</div>'
        +'<div class="form-group input-wlbl">'
            +'<span class="lblinput">Confirm Password</span>'
            +'<input type="password" class="form-control input-confirmpassword" data-related="input-password" data-placeholder="Confirm Password" />'
        +'</div>'
        +'<button type="button" class="btn green btn-savepass">Ok</button>'
    +'</div>';

    jQuery('.mypopover').popover({
        html : true, 
        content: function() {
          return formhtml;
        },
        title: function() {
          return 'Change Password';
        },
        placement: "top"
    });

    jQuery(document).on('click','body',function(e){
        var target = $(e.target);
        if (!$(e.target).is('.mypopover, .mypopover *,.popover, .popover *,.editable'))
        {
            $('.popover,.mypopover').popover('hide');
        }
    });

    jQuery(document).on('focus','.input-password', function() {
        var html = '<span class="msg-password">Please Enter at least 6 fields</span>';
        jQuery('.msg-password').remove();
        jQuery(this).after(html);
    });

    jQuery(document).on('keyup','.input-password', function() {
        if(jQuery(this).val())
        {
            jQuery('.msg-password').hide();
        }
        else
        {
            jQuery('.msg-password').show();
        }
    });

    jQuery(document).on('focus','.input-password', function() {
        if(jQuery(this).val())
        {
            jQuery('.msg-password').hide();
        }
        else
        {
            jQuery('.msg-password').show();
        }
    });

    jQuery(document).on('click','.btn-savepass',function() {
        var password = jQuery('.input-password').val().trim();
        var confirmpassword = jQuery('.input-confirmpassword').val().trim();
        var errors_pass = false;
        if(!jQuery('.input-password').val() || !jQuery('.input-confirmpassword').val()) {
            jQuery('.input-password').addClass('has-error');
            jQuery('.input-confirmpassword').addClass('has-error');
            errors_pass = true;
        }
        else if(jQuery('.input-password').val() || jQuery('.input-confirmpassword').val()) {
            if (jQuery('.input-password').val().trim().length >= 6)
            {
                jQuery('.input-password').removeClass('has-error');
            }
            if (jQuery('.input-confirmpassword').val().trim().length >= 6)
            {
                jQuery('.input-confirmpassword').removeClass('has-error');
            }
            
        }
        else if(jQuery('.input-password').val() && jQuery('.input-confirmpassword').val()) {
            errors_pass = false;
        }
        jQuery('.input-confirmpassword').each(function() {
            var input_related = jQuery(this).attr('data-related');
            var input_related_val = jQuery(this).parents('.form-popover').find('.'+input_related).val();
            var this_input_val = jQuery(this).val();
            var this_input_placeholder = jQuery(this).parents('.form-popover').find('.'+input_related).attr('data-placeholder');
            var input_related_placeholder = jQuery(this).attr('data-placeholder');
            if (input_related_val != this_input_val) {
                jQuery(this).parent().find('.error-msg-validation').remove();
                jQuery('.input-confirmpassword').addClass('has-error');
                jQuery(this).parent().append('<span class="error-msg-validation">'+input_related_placeholder+' and '+this_input_placeholder+' not equal</span>');
                errors_pass = true;
            }
            else {
                if (jQuery(this).val().trim().length > 0) 
                {
                    jQuery('.input-confirmpassword').removeClass('has-error');
                    jQuery(this).parent().find('.error-msg-validation').remove();
                    errors_pass = false;
                }
            }
        });
        if(errors_pass == false)
        {
            jQuery('.new-password').attr('val',password);
            jQuery('.new-confirmpassword').attr('val',confirmpassword);
            $('.popover').popover('hide');
        }
        return false;
    });

    jQuery(document).on('keyup','.input-password,.input-confirmpassword',function(){
        if ((jQuery(this).val().trim().length >= 6)) {
            jQuery(this).removeClass('has-error');
        }
        else {
            jQuery(this).addClass('has-error');
        }
    });

    jQuery(document).on('keyup','.input-confirmpassword',function(){
        var input_related = jQuery(this).attr('data-related');
        var input_related_val = jQuery(this).parents('.form-popover').find('.'+input_related).val().trim();
        var this_input_val = jQuery(this).val().trim();
        if ((jQuery(this).val().trim().length >= 6) && (input_related_val == this_input_val)) {
            jQuery('.input-confirmpassword').removeClass('has-error');
            jQuery(this).parent().find('.error-msg-validation').remove();
        }
    });

    /*$('[data-toggle="popover"]').popover();*/

    /*$('body').on('click', function (e) {
        $('.mypopover').each(function () {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.mypopover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });*/

    // $('body').on('click', function (e) {
    //     //only buttons
    //     if ($(e.target).data('toggle') !== 'popover'
    //         && $(e.target).parents('.popover.in').length === 0) { 
    //         $('.mypopover').popover('hide');
    //     }
    //     //buttons and icons within buttons
        
    //     /*if ($(e.target).data('toggle') !== 'popover'
    //         && $(e.target).parents('[data-toggle="popover"]').length === 0
    //         && $(e.target).parents('.popover.in').length === 0) { 
    //         $('[data-toggle="popover"]').popover('hide');
    //     }*/
        
    // });

    /*jQuery('.select2-ajax').select2({
      ajax: {
        url: "https://api.github.com/search/repositories",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page
          };
        },
        processResults: function (data, params) {
          // parse the results into the format expected by Select2
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data, except to indicate that infinite
          // scrolling can be used
          params.page = params.page || 1;
     
          return {
            results: data.items,
            pagination: {
              more: (params.page * 30) < data.total_count
            }
          };
        },
        cache: true
      },
      escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
      minimumInputLength: 1,
      templateResult: formatRepo, // omitted for brevity, see the source of this page
      templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    });*/
    
    /*$(".js-data-example-ajax").select2({
        minimumInputLength: 2,
        tags: [],
        ajax: {
            url: "https://maps.googleapis.com/maps/api/js?libraries=places&sensor=false&callback=initPlacecomplete",
            dataType: "script",
            cache: true,
            //quietMillis: 50,
            data: function (term) {
                return {
                    term: term
                };
            },
            results: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.completeName,
                            slug: item.slug,
                            id: item.id
                        }
                    })
                };
            }
        }
    });*/
    
    
    jQuery('#mytoast').click(function(){
        Command: toastr["success"]("Thank You!", "Message");
        return false;
    });
    
    function package_validation()
    {
        var number = 0;
        var numberEn = 0;
        var numberAr = 0;
        jQuery('.form-group').each(function() {
            if(jQuery(this).hasClass('has-error') == true)
            {
                number += jQuery(this).find('.form-control').length;
            }
        });
        jQuery('input.form-control,textarea.form-control').each(function() {
            if(jQuery(this).hasClass('has-error') == true)
            {
                numberEn += jQuery(this).parent('[data-lang=en]').length;
                numberAr += jQuery(this).parent('[data-lang=ar]').length;
                /*if(jQuery(this).parent('[data-lang=en]').is(':visible'))
                {
                    numberEn += jQuery(this).parent('[data-lang=en]').length;
                }
                if(jQuery(this).parent('[data-lang=ar]').is(':visible'))
                {
                    numberAr += jQuery(this).parent('[data-lang=ar]').length;
                }*/
            }
        });
        /*jQuery('.form-group input.form-control').each(function() {
            if(jQuery(this).hasClass('has-error') == true)
            {
                if(jQuery(this).parent('[data-lang=en]').is(':visible'))
                {
                    numberEn += jQuery(this).parent('[data-lang=en]').length;
                }
                if(jQuery(this).parent('[data-lang=ar]').is(':visible'))
                {
                    numberAr += jQuery(this).parent('[data-lang=ar]').length;
                }
            }
        });*/
        if(numberEn>0 && numberAr>0)
        {
            jQuery('.nav-lang>li').eq(0).addClass('tab-error');
            jQuery('.nav-lang>li').eq(1).addClass('tab-error');
        }
        else
        {
            if(number > 0 || numberEn>0)
            {
                jQuery('.nav-lang>li').eq(0).addClass('tab-error');
            }
            if(numberAr>0)
            {
                jQuery('.nav-lang>li').eq(1).addClass('tab-error');
            }
        }
    }
    window.package_validation = package_validation;
    package_validation();
    
    function stickyMenu() {
        jQuery(document).scrollTop() > 160, jQuery(window).on("scroll", function () {
            var e = jQuery(document).scrollTop();
            e > 160? (
            jQuery(".topline").hasClass("topline-fixed") || jQuery(".topline").addClass("topline-fixed"), jQuery(".topline .actions>.btn").removeClass('tooltip-one-info').addClass("tooltip-one-info-green") , 
            e > 160) : (jQuery(".topline").removeClass("topline-fixed"), jQuery(".topline .actions>.btn").removeClass("tooltip-one-info-green").addClass('tooltip-one-info'));
        });
    }
    stickyMenu();

    jQuery(document).on('click','.btn-delimg',function() {
        var imgsrc = "";
        jQuery(this).parents('.uploadimg-rg').find('.upload-img-rg>img').attr('src','http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image');
        jQuery(this).parents('.uploadimg-rg').find('.image-value').val('');
        return false;
    });

    jQuery(document).on('click','.myplaces-list-rg',function() {
        jQuery(this).find('.input-place>.form-control').focus();
    });

    jQuery(document).on('change','.checkbox-parent',function() {
        if(jQuery(this).prop('checked')==true)
        {
            jQuery('.table tbody>tr>td').each(function() {
                jQuery(this).find('.checkboxes').prop('checked',true).parent().addClass('checked');
            });
            jQuery('.btn-relatedtbl').removeAttr('disabled');
        }
        else
        {
            jQuery('.table tbody>tr>td').each(function() {
                jQuery(this).find('.checkboxes').removeAttr('checked').parent().removeClass('checked');
            });
            jQuery('.btn-relatedtbl').attr('disabled','disabled');
        }
    });

    jQuery(document).on('change','.table tbody>tr>td .checkboxes',function() {
        var checkboxesno = jQuery(this).parents('tbody').find('.checkboxes').size();
        var checkboxescheckedno = jQuery(this).parents('tbody').find('.checkboxes:checked').size();
        if(checkboxesno == checkboxescheckedno)
        {
            jQuery(this).parents('table').find('.checkbox-parent').prop('checked',true).parent().addClass('checked');
            jQuery('.btn-relatedtbl').removeAttr('disabled');
        }
        else if(checkboxescheckedno == 0)
        {
            jQuery(this).parents('table').find('.checkbox-parent').removeAttr('checked').parent().removeClass('checked');
            jQuery('.btn-relatedtbl').attr('disabled','disabled');
        }
        else
        {
            jQuery(this).parents('table').find('.checkbox-parent').removeAttr('checked').parent().removeClass('checked');
            jQuery('.btn-relatedtbl').removeAttr('disabled');
        }
    });

    jQuery("#uploadfile-user").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                $(".upload-avatar-img").css("background-image", "url("+this.result+")");
            }
        }
        else
        {
            jQuery(this).val("");
            alert("Please select just images");
        }
    });

    jQuery(window).load(function() {
        jQuery('.bootstrap-tagsinput input[type=text]').removeAttr('style');
    });

    jQuery(document).on('click','.mytabs-rg>a',function() {
        jQuery(this).parent().find('a').removeClass('active');
        jQuery(this).addClass('active');
        return false;
    });

    var myflag = true;
    jQuery(document).on('blur','.form-control[data-validation]',function() {
        var this_input = jQuery(this);
        var input_url = this_input.attr('data-validation');
        var input_name = this_input.attr('name');
        var input_val = this_input.val();
        if ((myflag == true) && (this_input.val())) {
            myflag = false;
            jQuery.ajax({
                type: 'POST',
                data: {[input_name]:input_val},
                url: input_url,
                dataType: "json",
                success: function (data) {
                    this_input.parent().find('.error-msg-validation').remove();
                    myflag = true;
                    if(data.status == true)
                    {
                        this_input.removeClass('myerror has-error');
                    }
                    else
                    {
                        this_input.addClass('myerror has-error');
                        this_input.parent().append('<span class="error-msg-validation">'+data.message[input_name][0]+'</span>');

                    }
                }
            });
        }
    });
    
    jQuery(document).on('submit','.form-datavalidation',function() {
        if(jQuery('.myerror').length>0)
        {
            return false;
        }
    });

    jQuery(document).on('keydown', function (e) {
        if ((e.keyCode == "13") && (jQuery('#google-autocomplete').is(':focus'))) {
            return false;
        }
    });
    
});