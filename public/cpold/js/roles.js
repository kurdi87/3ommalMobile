var roles = function () {

    var handleBtnClear = function () {
        jQuery(document).on('click', '.cleardate', function () {
            jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val('');
            jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            input_wlbl();
            oTable.columns(4).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
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
    roles.init();
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
    var placeholder = "اختر حالة";

    $(".changerole-mselect2").select2({
        placeholder: placeholder,
        width: null
    });

    var roleid;
    var roletxt;
    var thisclick;
    jQuery(document).on('click', '.btn-ustatus', function () {
        thisclick = jQuery(this);
        roleid = thisclick.parents('tr').find('.roletxt').attr('data-id');
        if (thisclick.hasClass('ustatus-inactive')) {
            jQuery.ajax({
                url: "cp_brand_buzz/role/usersCount/" + roleid,
                type: 'GET',
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        if (data.usersCount > 0) {
                            var no_users = jQuery(this).parents('tr').find('.nousers').text().trim();
                            jQuery('#modal-changerole').on('show.bs.modal', function (e) {
                                jQuery(this).find('.bmodal-changerole .nouser').text(no_users);
                            });
                            jQuery('#modal-changerole').modal('show');

                            roletxt = thisclick.parents('tr').find('.roletxt').text().trim();
                            jQuery('.rb-changerole').removeAttr('checked');
                            jQuery('.radio>span').removeClass('checked');
                            jQuery('.select2-role-rg').addClass('display-none');
                            jQuery('select.changerole-mselect2').find('option').removeAttr('disabled');
                            jQuery('select.changerole-mselect2').find('option[value=' + roleid + ']').attr('disabled', 'disabled');
                            jQuery('select.changerole-mselect2').select2({
                                placeholder: placeholder,
                                width: null
                            });
                        } else {
                            jQuery.ajax({
                                url: thisclick.attr('href'),
                                type: 'GET',
                                dataType: "json",
                                success: function (data) {
                                    if (data.status) {
                                        thisclick.removeClass('ustatus-inactive').addClass('ustatus-active');
                                        thisclick.find('i').addClass('fa-check-square').removeClass('fa-square-o');
                                        thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger').text('Inactive');
                                        thisclick.tooltipster('content', 'Active');

                                        toasterMessage("success", data.message, "تم التحديث بنجاح");
                                    }
                                }
                            });
                        }

                    } else {
                        toasterMessage("error", data.message, "Error");
                    }
                }
            });
        }
        else {
            jQuery.ajax({
                url: jQuery(this).attr('href'),
                type: 'GET',
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        thisclick.removeClass('ustatus-active').addClass('ustatus-inactive');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success').text('Active');
                        thisclick.tooltipster('content', 'Deactivate');

                        toasterMessage("success", data.message, "تم التحديث بنجاح");
                    }
                }
            });

        }
        return false;
    });

    jQuery(document).on('click', '.btn-changerole', function () {
        var thisAction = jQuery(this);
        var deactivateUsers = jQuery("#deactivateUsers").prop('checked');
        var isMove = jQuery("#moveUsers").prop('checked');
        var newRole = jQuery("#roles").val();
        if (deactivateUsers || (isMove && newRole)) {
            if (flag) {
                flag = false;
                jQuery.ajax({
                    url: thisclick.attr('href'),
                    type: 'GET',
                    data: {"isDeactivate": deactivateUsers, "isMove": isMove, "newRole": newRole},
                    dataType: "json",
                    success: function (data) {
                        flag = true;
                        if (data.status) {
                            thisclick.removeClass('ustatus-inactive').addClass('ustatus-active');
                            thisclick.find('i').addClass('fa-check-square').removeClass('fa-square-o');
                            thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger').text('Inactive');
                            thisclick.tooltipster('content', 'Active');
                            jQuery('#modal-changerole').modal('hide');
                            if (data.type == "move") {
                                thisclick.parents('tr').find('.nousers').text("0");
                            }
                            toasterMessage("success", data.message, "تم التحديث بنجاح");

                            roleid = "";
                            roletxt = "";
                            thisclick = "";
                        }
                    }
                });
            }
        }
    });

    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable.draw();
    });

    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "cp_brand_buzz/role/list",
        "order": [[4, 'desc']],
        columnDefs: [
            {orderable: false, targets: -1},
            {orderable: false, targets: 0},
            {searchable: false, targets: 4},
        ],
        "columns": [
            {data: 'Role_ID', name: 'Role_ID'},
            {data: 'Role_Name', name: 'Role_Name'},
            {data: 'status', name: 'Role_Status'},
            {data: 'userCounter', name: 'userCounter'},
            {data: 'created_at', name: 'created_at'},
            {data: 'SysUsr_FullName', name: 'SysUsr_FullName'},
            {data: 'action', name: 'action'}
        ],
        "fnDrawCallback": function (oSettings) {
            mytooltipster();
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
        oTable.columns(4).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
    });

    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable.columns().search('').draw();
    });

});