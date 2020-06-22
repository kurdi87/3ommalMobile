
var customers = function () {

    var handleChangeStatus = function() {
        jQuery(document).on('click','.btn-ustatus',function() {
            var thisclick = jQuery(this);
            bootbox.confirm("Are you sure?", function(result) {
                if(result==true)
                {
                    if(thisclick.hasClass('ustatus-active'))
                    {
                        thisclick.removeClass('ustatus-active').addClass('ustatus-inactive');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.tdstatus.label').removeClass('label-danger').addClass('label-success').text('Active');
                        thisclick.tooltipster('content', 'Inactive');
                    }
                    else
                    {
                        thisclick.removeClass('ustatus-inactive').addClass('ustatus-active');
                        thisclick.find('i').addClass('fa-check-square').removeClass('fa-square-o');
                        thisclick.parents('tr').find('.tdstatus.label').removeClass('label-success').addClass('label-danger').text('Inactive');
                        thisclick.tooltipster('content', 'Active');
                    }
                    Command: toastr["success"]("Status Updated!", "Success");
                }
            });
            return false;
        });
    };

    var handleBtnClear = function() {
        jQuery(document).on('click','.cleardate',function() {
            jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val('');
            jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            input_wlbl();
            return false;
        });
    };

    var handleInputDate = function() {
        jQuery(document).on('change','.inputdateclear',function() {
            if(jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val())
            {
                jQuery(this).parents('.inputdate-wicon').find('.cleardate').removeClass('display-none');
            }
            else
            {
                jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            }
        });
    };

    var handleModalChangePassword = function() {
        jQuery(document).on('click','.umodal',function(){
            var target = jQuery(this).attr('data-modal');
            var txtuser = jQuery(this).parents('tr').find('.tdfname').text() +' '+jQuery(this).parents('tr').find('.tdlname').text();
            jQuery('#'+target).find('.txtadminname').text(txtuser);
            jQuery('#'+target).modal('show');
            jQuery('#'+target).find('.form-control').val('');
            jQuery('#switchsend').prop('checked',true);
            jQuery('#switchsend').bootstrapSwitch('destroy');
            jQuery('#switchsend').bootstrapSwitch();
        });

        jQuery(document).on('click','.user-changepassword',function() {
            var thisclick = jQuery(this);
            bootbox.confirm("Are you sure?", function(result) {
                if(result==true)
                {
                    Command: toastr["success"]("Status Updated!", "Success");
                }
            });
            return false;
        });
    };

    return {
        init: function () {
            handleChangeStatus();
            handleBtnClear();
            handleInputDate();
            handleModalChangePassword();
        }
    };

}();

jQuery(document).ready(function() {
    customers.init();
});