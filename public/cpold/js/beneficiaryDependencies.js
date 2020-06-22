

jQuery(document).ready(function () {
   // users.init();
   var beneficiary_id= jQuery(this).find('.beneficiary_id').attr('value');
    var flag = true;
    oTable4 = $('#mydatatable4').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "hitechjobs/beneficiary/listDependencies/"+beneficiary_id,
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
            {data: 'sid', name: 'sid'},
            {data: 'relation_name', name: 'relation_name'},
            {data: 'address', name: 'address'},
            {data: 'bod', name: 'bod'},
            {data: 'card_no', name: 'card_no'},
            {data: 'activate', name: 'activate'},
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
        oTable4 .draw();
    });

    jQuery(window).resize(function() {
        oTable4 .columns().search('').draw();
    });
    
    jQuery(document).on('click','.sorting_1',function() {
        mytooltipster();
        $('.popovers').popover();
    });
    
    $('.searchable').change(function () {
        if (flag) {
            flag = false;
            var column = jQuery(this).attr('data-column');
            oTable4 .columns(column).search(jQuery(this).val()).draw();
        }
        flag = true;
    });

    $('.searchableList').change(function () {
        var column = $(this).attr('data-column');
        oTable4 .columns(column).search($(this).val()).draw();
    });

   


    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable4 .columns().search('').draw();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";

    
    jQuery(document).on('click', '.dependenciesmodal', function () {
        var dependenciesid = jQuery(this).parents('tr').find('.dependenciesid').attr('data-id');
        jQuery(".id").val(dependenciesid);

        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        return false;
    });

    jQuery(document).on('submit', '#addDependencies', function () {
        var thisAction = jQuery(this);

        if (!errors) {
            jQuery.ajax({
                url: "hitechjobs/beneficiary/addDependencies",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                         

                     jQuery('#modal-dependenciesadd').find('.form-control').val('');
                        jQuery('#modal-dependenciesadd').modal('hide');
                        jQuery('#modal-dependenciesadd').find('.upload-beneficiary-dependencies').css('background-image', 'url( "1.jpg")');
                        
                        input_wlbl();
                        toasterMessage("success", data.message, "Updated Successfully");
                          oTable4 .draw();
                         
                    }
                },
                error: function (data) {
                    toasterMessage("error", "Error", "Check Error");
                }
            });
        }

        return false;
    });

     jQuery(document).on('click', '.dependenciesEditmodal', function () {
        var statid = jQuery(this).attr('data-id');
        jQuery(".id").val(statid);

        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
          jQuery('.modal-body').load('hitechjobs/beneficiary/editDependencies/'+statid);
        return false;
    });

    jQuery(document).on('submit', '#editDependencies', function () {
        var thisAction = jQuery(this);
         jQuery('#modal-dependenciesEdit').find('.uploading').removeClass('hidden');
         

        if (!errors) {
            jQuery.ajax({
                url: "hitechjobs/beneficiary/storeDependencies",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                       
                           oTable4.draw();


                        jQuery('#modal-dependenciesEdit').modal('hide');
                         jQuery('#modal-dependenciesEdit').find('.upload-beneficiary-dependencies').css('background-image', 'url(img/beneficiary/beneficiarys/1.jpg)');

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




jQuery(document).on('change', '.upload-beneficiary-dependencies', function () {

        if (flag == true) {


                      jQuery('.modal-body-dependenciesach').find('.uploading').removeClass('hidden');
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
                    url: 'hitechjobs/beneficiary/uploadDependencies/'+id,
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
                            var src = "uploads/beneficiary/" + data.file_name;

                            my_button.parents('.upload-beneficiary-dependencies').find('.icon').attr('value',data.file_name);
                                    jQuery('.modal-body-dependenciesach').find('.uploading').addClass('hidden');
                           // my_button.parents('.upload-beneficiary-dependencies').find('.icon').attr('value',data.file_name);
                        }
                        else {
                            flag = true;
                            var message = data.message;
                            toasterMessage("error", message, "Upload Error");
                                    jQuery('.modal-body-dependenciesach').find('.uploading').addClass('hidden');
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
    jQuery(document).on('click', '.btn-dependencies-status', function () {
        thisclick = jQuery(this);
        var status = "";
        if (thisclick.hasClass('dependencies-inactive'))
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
                
                    if (thisclick.hasClass('dependencies-active')) {
                        
                        thisclick.removeClass('dependencies-active').addClass('dependencies-inactive');

                        thisclick.find('i').removeClass('fa-square-o').addClass('fa-check-square');
                        thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger');
                        thisclick.tooltipster('content', 'Activate');
                      

                    } else {
                          
                        thisclick.removeClass('dependencies-inactive').addClass('dependencies-active');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                        thisclick.tooltipster('content', 'Deactivate');
                    }
                      oTable4 .draw();

                    toasterMessage("success", data.message, "Updated Successfully");
                
            }
        });
}
        return false;
    });

   
});

