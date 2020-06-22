var comments = function () {

    var handleBtnClear = function () {
        jQuery(document).on('click', '.cleardate', function () {
            jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val('');
            jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            input_wlbl();
            oTable.columns(3).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
            return false;
        });
    };

    var handleInputDate = function () {
        jQuery(document).on('change', '.inputdateclear', function () {
            if (jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val()) {
                jQuery(this).parents('.inputdate-wicon').find('.cleardate').removeClass('display-none');
            }
            else {
                jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            }
        });
    };

    return {
        init: function () {
            handleBtnClear();
            handleInputDate();
        }
    };

}();

jQuery(document).ready(function () {

    comments.init();

    var flag = true;
    jQuery(document).on('change', '.rb-changerole', function () {
        if (jQuery(this).hasClass('rb-chrole-more') && (jQuery(this).is(':checked'))) {
            jQuery('.select2-role-rg').removeClass('display-none');
        }
        else {
            jQuery('.select2-role-rg').addClass('display-none');
        }
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";

    $(".changerole-mselect2").select2({
        placeholder: placeholder,
        width: null
    });

    var roleid;
    var roletxt;
    var thisclick;

    jQuery(document).on('click', '.chn-status', function () {
        thisclick = jQuery(this);
        jQuery.ajax({
            url: jQuery(this).attr('href'),
            type: 'GET',
            dataType: "json",
            success: function (data) {
                if (data.status) {
                    oTable.draw(false);
                    toasterMessage("success", data.message, "Updated Successfully");
                    jQuery(".flaticon-comment43").parent().find('.badge').text(data.needApproval);
                }
            }
        });

        return false;
    });

    jQuery(document).on('click', '.block-user', function () {
        thisclick = jQuery(this);
        var createbyname = thisclick.parents('tr').find('.td-createdby').text().trim();
        bootbox.confirm("Are you sure you want to block the user <b>"+createbyname+"</b>?? this will reject all his/her waiting for approval comments.", function(result) {
            if(result==true)
            {
                jQuery.ajax({
                    url: thisclick.attr('href'),
                    type: 'GET',
                    dataType: "json",
                    success: function (data) {
                        if (data.status) {
                            oTable.draw(false);
                            toasterMessage("success", data.message, "Updated Successfully");
                        }
                    }
                });
            }
        });
        return false;
    });

    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable.draw();
    });
    
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "cp-attar/comments/list",
        "order": [[2,'desc'],[3, 'desc']],
        columnDefs: [
            {orderable: false, targets: -1},
            {orderable: false, targets: 0},
            {searchable: false, targets: 3},
        ],
        "columns": [
            {data: 'Comment_ID', name: 'Comment_ID'},
            {data: 'Comment_Body', name: 'Comment_Body'},
            {data: 'status', name: 'Comment_Status'},
            {data: 'Comment_CommentDate', name: 'Comment_CommentDate'},
            {data: 'fullName', name: 'fullName'},
            {data: 'action', name: 'action'}
        ],
        "fnDrawCallback": function (oSettings) {
            mytooltipster();
            $('.popovers').popover();
            oTable.column(0).nodes().each(function (cell, i) {
                cell.innerHTML = (parseInt(oTable.page.info().start)) + i + 1;
            });
            var input=oSettings.oAjaxData;
            input.length="";
            input.start="";
            input=jQuery.param(input);
            input=input.replace("&length=", "");
            input=input.replace("&start=", "");
            $(".exportData").each(function(){
                $(this).attr("href",$(this).data("href")+input);
            });
        },
        //responsive: true,
        "autoWidth": false,
        "scrollX": true,
        "pagingType": "bootstrap_full_number"
    });

    jQuery(window).load(function(){
        oTable.columns(2).search("131").draw();
    });
    
    jQuery(window).resize(function() {
        oTable.columns().search('').draw();
    });

    $('.searchable').change(function () {
        if (flag) {
            flag = false;
            var column = jQuery(this).attr('data-column');
            oTable.columns(column).search(jQuery(this).val()).draw();
        }
        flag = true;
    });

    $('.searchableList').change(function () {
        var column = $(this).attr('data-column');
        oTable.columns(column).search($(this).val()).draw();
    });

    $('#from, #to').change(function () {
        oTable.columns(3).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
    });

    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable.columns().search('').draw();
    });
});