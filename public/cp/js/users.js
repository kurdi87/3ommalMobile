var users = function () {

    var handleBtnClear = function () {
        jQuery(document).on('click', '.cleardate', function () {
            jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val('');
            jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            input_wlbl();
            oTable.columns(7).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
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
    users.init();
    var flag = true;
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/user/list",
        "order": [[ 7, "desc" ]],
        columnDefs: [
            {orderable: false, targets: -1},
            {orderable: false, targets: 0},
            {searchable: false, targets: 7},
            {searchable: false, targets: 1},
        ],
        "columns": [
            {data: 'SysUsr_ID', name: 'SysUsr_ID'},
            {data: 'SysUsr_FullName', name: 'SysUsr_FullName'},
            
            {data: 'SysUsr_UserName', name: 'SysUsr_UserName'},
            {data: 'status', name: 'System_User.SysUsr_Status'},
            {data: 'SysUsr_Email', name: 'SysUsr_Email'},
            {data: 'SysUsr_Mobile', name: 'SysUsr_Mobile'},
            {data: 'created_at', name: 'created_at'},
            {data: 'created_by', name: 'created_by'},
            {data: 'action', name: 'action'}
        ],
        "fnDrawCallback": function (oSettings) {
            mytooltipster();
            $('.popovers').popover();
            App.init();
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
        // setup responsive extension: http://datatables.net/extensions/responsive/
        "responsive": false,
        "autoWidth": false,
        "scrollX": true,
        "pagingType": "bootstrap_full_number"
        /*"drawCallback": function( settings ) {
            $('.tooltip-one-info').tooltipster('destroy');            
        }*/
    });

    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable.draw();
    });


    
    jQuery(document).on('click','.sorting_1',function() {
        mytooltipster();
        $('.popovers').popover();
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
        oTable.columns(7).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
    });

    /*$(document).on("submit",".search-form",function(){
        oTable.columns(7).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
    });*/

    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable.columns().search('').draw();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";

    $(".change-role-select2").select2({
        placeholder: placeholder,
        width: null
    });

    jQuery(document).on('click', '.btn-dropdown-wstatus', function () {
        if (jQuery(this).attr('disabled') != "disabled") {
            if (jQuery(this).parents('.btn-dropdown-wstatusrg').hasClass('open')) {
                jQuery(this).parents('.btn-dropdown-wstatusrg').removeClass('open');
            }
            else {
                jQuery(this).parents('.btn-dropdown-wstatusrg').addClass('open');
            }
        }
    });

    jQuery(document).on('click', '.btn-dropdown-wselect', function () {
        if (jQuery(this).attr('disabled') != "disabled") {
            if (jQuery(this).parents('.btn-dropdownrg').hasClass('open')) {
                jQuery(this).parents('.btn-dropdownrg').removeClass('open');
            }
            else {
                jQuery(this).parents('.btn-dropdownrg').addClass('open');
            }
        }
    });

    jQuery(document).on('click', 'body', function (e) {
        var target = $(e.target);
        if (!$(e.target).is('.dropdown-wselect, .dropdown-wselect *, .btn-dropdown-wselect, .btn-dropdown-wselect *,.select2-search__field')) {
            $('.btn-dropdownrg').removeClass('open');
        }
    });

    jQuery(document).on('click', 'body', function (e) {
        var target = $(e.target);
        if (!$(e.target).is('.btn-dropdown-wstatusrg ,.btn-dropdown-wstatus, .btn-dropdown-wstatus *')) {
            $('.btn-dropdown-wstatusrg').removeClass('open');
        }
    });

    jQuery(document).on('change', '.change-role-select2', function () {
        var thisclick = jQuery(this);
        var id = [];
        var roleid = thisclick.val();
        var name = thisclick.find("option:selected").text();
        thisclick.parents('.select2-wlbl').find('.select2-container--default').removeClass('select2-container-openmy');
        bootbox.confirm("Are you sure you want to change role for " + jQuery(".checkboxes:checked").not(".checkbox-parent").size() + " user to " + name + " role?", function (result) {
                if (result) {
                    jQuery("#mydatatable").find(".checkboxes:checked").each(function () {
                        id.push(jQuery(this).parents('tr').find('.userid').attr('data-id'));
                    });
                    if (flag) {
                        flag = false;
                        jQuery.ajax({
                            url: "cp-brand-buzz/user/changeRole",
                            type: 'GET',
                            data: {"id": id, roleid: roleid},
                            dataType: "json",
                            success: function (data) {
                                if (data.status) {
                                    flag = true;
                                    thisclick.parents('.btn-dropdownrg').removeClass('open');
                                    jQuery("#mydatatable").find(".checkboxes:checked").each(function () {
                                        jQuery(this).parents('tr').find(".roleName").text(name);
                                    });
                                    toasterMessage("success", data.message, "Updated Successfully");
                                }
                            },
                            error: function (data) {
                                toasterMessage("error", "Please Check Selected Role", "CHeck Error");
                            }
                        });
                    }
                }
            }
        );
    });

    // for change status
    jQuery(document).on('click', '.btn-ustatus', function () {
        thisclick = jQuery(this);
        var status = "";
        if (thisclick.hasClass('ustatus-inactive'))
            status = "SYSTEM_USER_STATUS_DEACTIVE";
        else
            status = "SYSTEM_USER_STATUS_ACTIVE";
        jQuery.ajax({
            url: jQuery(this).attr('href'),
            type: 'GET',
            data: {"id[]": thisclick.parents('tr').find('.userid').attr('data-id'), status: status},
            dataType: "json",
            success: function (data) {
                if (data.status) {
                    if (thisclick.hasClass('ustatus-inactive')) {
                        thisclick.removeClass('ustatus-inactive').addClass('ustatus-active');
                        thisclick.find('i').removeClass('fa-square-o').addClass('fa-check-square');
                        thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger').text('Inactive');
                        thisclick.tooltipster('content', 'Activate');
                    } else {
                        thisclick.removeClass('ustatus-active').addClass('ustatus-inactive');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success').text('Active');
                        thisclick.tooltipster('content', 'Deactivate');
                    }

                    toasterMessage("success", data.message, "Updated Successfully");
                }
            }
        });

        return false;
    });

    jQuery(document).on('click', '.umodal', function () {
        var userid = jQuery(this).parents('tr').find('.userid').attr('data-id');
        jQuery(".id").val(userid);

        var target = jQuery(this).attr('data-modal');
        var txtuser = jQuery(this).parents('tr').find('.userid').text();
        jQuery('#' + target).find('.txtadminname').text(txtuser);
        jQuery('#modal-changepassword').find('.form-control').val('');
        jQuery('#switchsend').prop('checked', true);
        jQuery('#switchsend').bootstrapSwitch('destroy');
        jQuery('#switchsend').bootstrapSwitch();
        input_wlbl();
        jQuery('#' + target).modal('show');
        return false;
    });

    jQuery(document).on('submit', '#form-changePassword', function () {
        var thisAction = jQuery(this);

        if (!errors) {
            jQuery.ajax({
                url: "crm/user/changePassword",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        jQuery('#modal-changepassword').modal('hide');
                        jQuery('#modal-changepassword').find('.form-control').val('');
                        input_wlbl();
                        toasterMessage("success", data.message, "Updated Successfully");
                    }
                },
                error: function (data) {
                    toasterMessage("error", "Check password and confirm", "CHeck Error");
                }
            });
        }

        return false;
    });

    // change all status
    jQuery('.confirm-msg').click(function () {
            var thisclick = jQuery(this);
            var status = "";
            var statusName = "";

            if (thisclick.hasClass("activate")) {
                status = "SYSTEM_USER_STATUS_ACTIVE";
                statusName = "activate";
            } else {
                status = "SYSTEM_USER_STATUS_DEACTIVE";
                statusName = "deactivate";
            }
            var id = [];
            if (jQuery('.checkboxes:checked').size() > 0) {
                bootbox.confirm("Are you sure you want to " + statusName + " " + jQuery(".checkboxes:checked").not(".checkbox-parent").size() + " users?", function (result) {
                        if (result) {

                            jQuery("#mydatatable").find(".checkboxes:checked").each(function () {
                                id.push(jQuery(this).parents('tr').find('.userid').attr('data-id'));
                            });
                            jQuery.ajax({
                                url: "crm/user/changeStatus",
                                type: 'GET',
                                data: {"id": id, status: status},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status) {
                                        if (status == "SYSTEM_USER_STATUS_ACTIVE") {
                                            jQuery("#mydatatable").find(".checkboxes:checked").each(function () {
                                                jQuery(this).parents('tr').find('.btn-ustatus').removeClass('ustatus-active').addClass('ustatus-inactive');
                                                jQuery(this).parents('tr').find('.btn-ustatus').find('i').removeClass('fa-check-square').addClass('fa-square-o');
                                                jQuery(this).parents('tr').find('.label').removeClass('label-danger').addClass('label-success').text('Active');
                                                jQuery(this).parents('tr').find('.btn-ustatus').tooltipster('content', 'Deactivate');
                                            });

                                        } else {
                                            jQuery("#mydatatable").find(".checkboxes:checked").each(function () {
                                                jQuery(this).parents('tr').find('.btn-ustatus').removeClass('ustatus-inactive').addClass('ustatus-active');
                                                jQuery(this).parents('tr').find('.btn-ustatus').find('i').removeClass('fa-square-o').addClass('fa-check-square');
                                                jQuery(this).parents('tr').find('.label').removeClass('label-success').addClass('label-danger').text('Inactive');
                                                jQuery(this).parents('tr').find('.btn-ustatus').tooltipster('content', 'Activate');
                                            });
                                        }

                                        toasterMessage("success", data.message, "Updated Successfully");
                                    }
                                }
                            });
                        }
                    }
                );
            }
        }
    );
});