

jQuery(document).ready(function () {
   // users.init();
   var financeParty_id= jQuery(this).find('.financeParty_id').attr('value');
    var flag = true;
    oTable3 = $('#mydatatable3').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/financeParty/listAtt/"+financeParty_id,
        "order": [[ 1, "desc" ]],
        columnDefs: [
           //{orderable: false, targets: -1},
       //{orderable: false, targets: 0},
            //{searchable: false, targets: 7},
            //{searchable: false, targets: 1},
        ],
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'type', name: 'type'},
            {data: 'title', name: 'title'},
            {data: 'information', name: 'information'},
            {data: 'm_action', name: 'm_action'}
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
        //responsive: true,
        "autoWidth": false,
        "scrollX": true,
        "pagingType": "bootstrap_full_number"
        /*"drawCallback": function( settings ) {
            $('.tooltip-one-info').tooltipster('destroy');            
        }*/
    });

    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable3 .draw();
    });

    jQuery(window).resize(function() {
        oTable3 .columns().search('').draw();
    });
    
    jQuery(document).on('click','.sorting_1',function() {
        mytooltipster();
        $('.popovers').popover();
    });
    
    $('.searchable').change(function () {
        if (flag) {
            flag = false;
            var column = jQuery(this).attr('data-column');
            oTable3 .columns(column).search(jQuery(this).val()).draw();
        }
        flag = true;
    });

    $('.searchableList').change(function () {
        var column = $(this).attr('data-column');
        oTable3 .columns(column).search($(this).val()).draw();
    });

   


    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable3 .columns().search('').draw();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";

    
    jQuery(document).on('click', '.attmodal', function () {
        var attid = jQuery(this).parents('tr').find('.attid').attr('data-id');
        jQuery(".id").val(attid);

        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        return false;
    });

    jQuery(document).on('submit', '#addAtt', function () {
        var thisAction = jQuery(this);

        if (!errors) {
            jQuery.ajax({
                url: "crm/financeParty/addAtt",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                         

                     jQuery('#modal-attadd').find('.form-control').val('');
                        jQuery('#modal-attadd').modal('hide');
                        jQuery('#modal-attadd').find('.upload-financeParty-att').css('background-image', 'url( "1.jpg")');
                        
                        input_wlbl();
                        toasterMessage("success", data.message, "Updated Successfully");
                          oTable3 .draw();
                         
                    }
                },
                error: function (data) {
                    toasterMessage("error", "Error", "Check Error");
                }
            });
        }

        return false;
    });

     jQuery(document).on('click', '.attEditmodal', function () {
        var statid = jQuery(this).attr('data-id');
        jQuery(".id").val(statid);

        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
          jQuery('.modal-body').load('crm/financeParty/editAtt/'+statid);
        return false;
    });

    jQuery(document).on('submit', '#editAtt', function () {
        var thisAction = jQuery(this);
         jQuery('#modal-attEdit').find('.uploading').removeClass('hidden');
         

        if (!errors) {
            jQuery.ajax({
                url: "crm/financeParty/storeAtt",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                       
                           oTable3.draw();


                        jQuery('#modal-attEdit').modal('hide');
                         jQuery('#modal-attEdit').find('.upload-financeParty-att').css('background-image', 'url(img/financeParty/financePartys/1.jpg)');

                        input_wlbl();
                        toasterMessage("success", data.message, "Updated Successfully");

                    }
                },
                error: function (data) {
                    toasterMessage("error", "Error", "Check Error");
                }
            });
        }

        return false;
    });




jQuery(document).on('change', '.upload-financeParty-att', function () {

        if (flag == true) {


                      jQuery('.modal-body-attach').find('.uploading').removeClass('hidden');
            flag = false;
            var my_file = this.files[0];
            var my_button = jQuery(this);
            var id=jQuery(this).attr('id');
            var size = parseInt(this.files[0].size);
            size = size / 1024;
            var file = jQuery(this).val();
            var extension = file.substr((file.lastIndexOf('.') + 1)).toLowerCase();
            var type = false;
            if (extension == 'jpg' || extension == 'jpeg' || extension == 'png'|| extension == 'pdf'|| extension == 'doc')
                type = true;

            if (size <= 4096 && type == true) {
                var fd = new FormData();
                fd.append("choose-file", my_file);
                jQuery.ajax({
                    url: 'crm/financeParty/uploadAtt/'+id,
                    type: 'POST',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function () {
                    //    my_button.parent().append('<div class="loading-submit"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
                    },
                    success: function (data) {
                        flag = true;
                    //    my_button.parent().find('.loading-submit').remove();
                        if (data.status == true) {
                            var src = "uploads/financeParty/" + data.file_name;

                            my_button.parents('.upload-financeParty-att').find('.icon').attr('value',data.file_name);
                                    jQuery('.modal-body-attach').find('.uploading').addClass('hidden');
                           // my_button.parents('.upload-financeParty-att').find('.icon').attr('value',data.file_name);
                        }
                        else {
                            flag = true;
                            var message = data.message;
                            toasterMessage("error", message, "Upload Error");
                                    jQuery('.modal-body-attach').find('.uploading').addClass('hidden');
                        }
                    }
                });

            } else {
                flag = true;
                my_button.parent().find('.loading-submit').remove();
                jQuery(this).val("");
                var message = '';
                if (size > 4096)
                    message = 'size is too big';
                if (type == false)
                    message = 'format not accepted';
                toasterMessage("error", message, "Upload Error");
            }
        }

    });
  

    

   

    // for change status
    jQuery(document).on('click', '.btn-att-status', function () {
        thisclick = jQuery(this);
        var status = "";
        if (thisclick.hasClass('att-inactive'))
            status = "0";
        else
            status = "1";
         if (confirm("This will delete item...Are you sure?"))
        {
        jQuery.ajax({
            url: jQuery(this).attr('href'),
            type: 'GET',
            data: {"id[]": thisclick.parents('tr').find('.id').attr('data-id'), status: status},
            dataType: "json",
            success: function (data) {
                
                    if (thisclick.hasClass('att-active')) {
                        
                        thisclick.removeClass('att-active').addClass('att-inactive');

                        thisclick.find('i').removeClass('fa-square-o').addClass('fa-check-square');
                        thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger');
                        thisclick.tooltipster('content', 'Activate');
                      

                    } else {
                          
                        thisclick.removeClass('att-inactive').addClass('att-active');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                        thisclick.tooltipster('content', 'Deactivate');
                    }
                      oTable3 .draw();

                    toasterMessage("success", data.message, "Updated Successfully");
                
            }
        });
}
        return false;
    });

   
});

