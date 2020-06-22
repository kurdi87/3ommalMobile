
jQuery(document).ready(function() {    

    
    jQuery(document).on('click','.iadvanced',function(){
        if(jQuery(this).hasClass('active') == false)
        {
            jQuery('.advsearch-elm').collapse('show');
            jQuery(this).addClass('active');
            jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
        }
        else
        {
            jQuery('.advsearch-elm').collapse('hide');
            jQuery(this).removeClass('active');
            jQuery('[data-toggle="tooltip"],.tooltip').tooltip('hide');
        }
   });

   jQuery(document).on('click','.btn-reset',function(){
        jQuery(this).parents('form').find('.form-control').val('');
        jQuery('.lblinput').removeClass('lblinputtop');
        jQuery('select.bs-select').val(0);
        jQuery('.bs-select').selectpicker('refresh');
        jQuery('.select-wlbl,.selectbs-wlbl').find('.lblselect').removeClass('lblselecttop');
        //jQuery('.chosen-select').select2("val", "");
   });

   jQuery('[data-toggle="tooltip"]').tooltip();

   jQuery(document).on('click','.lblinput',function(){
        jQuery(this).addClass('lblinputtop');
         jQuery(this).parents('.input-wlbl').find('.form-control').eq(0).focus();
    });

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
    
    jQuery(document).on('change','.input-wlbl',function(){
        if(jQuery(this).find('.form-control').val())
        {
            jQuery(this).find('.lblinput').addClass('lblinputtop');
        }
        else
        {
            jQuery(this).find('.lblinput').removeClass('lblinputtop');
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
            if(jQuery(this).find('option:selected').index()>0)
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
        if(jQuery(this).parents('.selectbs-wlbl').find('.bootstrap-select.bs-select').hasClass('open')==false)
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
        jQuery(this).parents('.select2-wlbl').find('select.select2,select.myselect2').select2("open");
    });

    jQuery('.select2-wlbl .lblselect').hover(function(){
        jQuery(this).parents('.select2-wlbl').find('.select2-container--default').addClass('select2-container--openmy');
    },function(){
        jQuery(this).parents('.select2-wlbl').find('.select2-container--default').removeClass('select2-container--openmy');
    });

    jQuery(document).on('change','.select2-wlbl select.select2,.select2-wlbl select.myselect2',function(){
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
            jQuery('.icheck-input').addClass('icheckinput-open');
        }
        else
        {
            jQuery('.icheck-input').removeClass('icheckinput-open');
        }
    });

    jQuery(document).on('change','.flight-type',function(){
        if(jQuery(this).val()=="1")
        {
            jQuery(this).parents('.box-bt-wbtn').removeClass('boxbtn-open');
        }
        else
        {
            jQuery(this).parents('.box-bt-wbtn').addClass('boxbtn-open');
        }
    });

    var mythisclick;
    jQuery(document).on('click','.del-pcontainer',function(){
        /*jQuery(this).parents('.pcontainer-item').remove();*/
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
                        + '</div>'
        });
        
        /*$('#bs_confirmation_demo_1').on('confirmed.bs.confirmation', function () {
            alert('You confirmed action #1');
        });
        $('#bs_confirmation_demo_2').on('canceled.bs.confirmation', function () {
            alert('You canceled action #2');
        });
        */
        return false;
    });

    jQuery('.del-pcontainer').on('confirmed.bs.confirmation', function () {
        mythisclick.confirmation('hide');
        mythisclick.parents('.pcontainer-item').remove();
    });

    jQuery(document).on('click','.del-item',function(){
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
    });

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

    jQuery(document).on("keypress keyup blur",'.txtinput-filter-decimal',function (event) {
        //this.value = this.value.replace(/[^0-9\.]/g,'');
        jQuery(this).val(jQuery(this).val().replace(/[^0-9\.]/g,''));
        if((event.which == 8) || (event.keyCode >= 35 && event.keyCode <= 39) || (event.keyCode == 65 && event.ctrlKey == true)){
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
        return false;
    });

    jQuery(document).on('click','.remove-img',function(){
        jQuery(this).parents('.col-md-4').remove();
    });
    
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

    jQuery(document).on('click','.btn-ustatus',function(){
        if(jQuery(this).hasClass('ustatus-active'))
        {
            jQuery(this).removeClass('ustatus-active').addClass('ustatus-inactive');
            jQuery(this).find('i').removeClass('fa-check-square').addClass('fa-square-o');
            jQuery(this).parents('tr').find('td.tdstatus>.label').removeClass('label-danger').addClass('label-success').text('Active');
            jQuery(this).tooltipster('content', 'Inactive');
            //jQuery(this).attr("title", "Inactive").tooltip('fixTitle').tooltip('show');
        }
        else
        {
            jQuery(this).removeClass('ustatus-inactive').addClass('ustatus-active');
            jQuery(this).find('i').addClass('fa-check-square').removeClass('fa-square-o');
            jQuery(this).parents('tr').find('td.tdstatus>.label').removeClass('label-success').addClass('label-danger').text('Inactive');
            jQuery(this).tooltipster('content', 'Active');
            //jQuery(this).attr("title", "Active").tooltip('fixTitle').tooltip('show');
        }
        return false;
    });

    jQuery(document).on('click','.btn-publishdraft',function(){
        if(jQuery(this).hasClass('btn-pdraft'))
        {
            jQuery(this).removeClass('btn-pdraft').addClass('btn-dpublish');
            jQuery(this).find('i').removeClass('fa-edit').addClass('fa-globe');
            jQuery(this).parents('tr').find('td.td-pubishdraft>span').removeClass('label-success').addClass('label-warning').text('Draft');
            jQuery(this).tooltipster('content', 'Publish');
        }
        else
        {
            jQuery(this).removeClass('btn-dpublish').addClass('btn-pdraft');
            jQuery(this).find('i').removeClass('fa-globe').addClass('fa-edit');
            jQuery(this).parents('tr').find('td.td-pubishdraft>span').removeClass('label-warning').addClass('label-success').text('Published');
            jQuery(this).tooltipster('content', 'Draft');
        }
        return false;
    });

    jQuery(document).on('click','.umodal',function(){
        var target = jQuery(this).attr('data-modal');
        var txtuser = jQuery(this).parents('tr').find('td.tdname>a').text();
        jQuery('#'+target).find('.txtadminname').text(txtuser);
        jQuery('#'+target).modal('show');
    });

    jQuery('.confirm-msg').click(function(){
        bootbox.confirm("Are you sure?", function(result) {
           alert("Confirm result: "+result);
        }); 
    });

    jQuery(document).on('change','.mycheckbox',function() {
        if(jQuery(this).prop('checked')==true)
        {
            jQuery(this).val("1");
        }
        else
        {
            jQuery(this).val("0");
        }
    });

    jQuery(document).on('change','.ccheckbox',function() {
        var liSize = jQuery(this).parents('ul').find('li').size();
        var checkedSize = jQuery(this).parents('ul').find('.ccheckbox:checked').size();
        jQuery(this).parents('.permissions-checks').find('.pcheckbox').val(1).prop('checked',true);
        if(checkedSize == liSize)
        {
            jQuery(this).parents('.permissions-checks').find('.pcheckbox').removeClass('undetermined');
        }
        else if(checkedSize == 0)
        {
            jQuery(this).parents('.permissions-checks').find('.pcheckbox').removeAttr('checked').val("0");
        }
        else
        {
            jQuery(this).parents('.permissions-checks').find('.pcheckbox').addClass('undetermined');
        }
    });

    jQuery(document).on('change','.pcheckbox',function() {
        jQuery(this).removeClass('undetermined');
        if(jQuery(this).prop('checked')==true)
        {
            jQuery(this).parents('.permissions-checks').find('.ccheckbox').prop('checked',true).val("1");;
        }
        else
        {
            jQuery(this).parents('.permissions-checks').find('.ccheckbox').removeAttr('checked').val("0");
        }
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
    mytooltipster();

    var formhtml = '<div class="form-popover">'
            +'<form action="#">'
            +'<div class="form-group input-wlbl">'
                +'<span class="lblinput">Password</span>'
                +'<input type="password" class="form-control" placeholder="" />'
            +'</div>'
            +'<div class="form-group input-wlbl">'
                +'<span class="lblinput">Confirm Password</span>'
                +'<input type="password" class="form-control" placeholder="" />'
            +'</div>'
            +'<button type="Submit" class="btn green">Save changes</button>'
        +'</form>'
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

    /*$('[data-toggle="popover"]').popover();*/

    $('body').on('click', function (e) {
        $('.mypopover').each(function () {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.mypopover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });

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

});