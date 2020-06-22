

jQuery(document).ready(function () {
   // users.init();
   var recipe_id= jQuery(this).find('.recipe_id').attr('value');
    var flag = true;
    oTable5 = $('#mydatatable5').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/recipe/listRecipeAdv/"+recipe_id,
        "order": [[ 0, "asc" ]],
        columnDefs: [
           // {orderable: true, targets: 0},
       //{orderable: false, targets: 0},
            //{searchable: false, targets: 7},
            //{searchable: false, targets: 1},
        ],
        "columns": [
            {data: 'adv_order', name: 'adv_order'},

            {data: 'adv', name: 'adv'},

            {data: 'adv_time', name: 'adv_time'},
            {data: 'img', name: 'img'},
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
        "pageLength": 200,
        "scrollX": true,
        "pagingType": "bootstrap_full_number"
        /*"drawCallback": function( settings ) {
            $('.tooltip-one-info').tooltipster('destroy');            
        }*/
    });

    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable5 .draw();
    });

    jQuery(window).resize(function() {
        oTable5 .columns().search('').draw();
    });
    
    jQuery(document).on('click','.sorting_1',function() {
        mytooltipster();
        $('.popovers').popover();
    });
    
    $('.searchable').change(function () {
        if (flag) {
            flag = false;
            var column = jQuery(this).attr('data-column');
            oTable5 .columns(column).search(jQuery(this).val()).draw();
        }
        flag = true;
    });

    $('.searchableList').change(function () {
        var column = $(this).attr('data-column');
        oTable5 .columns(column).search($(this).val()).draw();
    });

   


    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable5 .columns().search('').draw();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";

    
    jQuery(document).on('click', '.advmodal', function () {
        var advid = jQuery(this).parents('tr').find('.statid').attr('data-id');
        jQuery(".id").val(advid);

        var target = jQuery(this).attr('data-modal');
      
        jQuery('#' + target).modal('show');
        return false;
    });

    jQuery(document).on('submit', '#addAdv', function () {
        var thisAction = jQuery(this);

        if (!errors) {
            jQuery.ajax({
                url: "crm/recipe/addRecipeAdv",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                         

                     jQuery('#modal-advadd').find('.form-control').val('');
                        jQuery('#modal-advadd').modal('hide');
                        
                        input_wlbl();
                        toasterMessage("success", data.message, "Updated Successfully");
                          oTable5 .draw();
                         
                    }
                },
                error: function (data) {
                    toasterMessage("error", "Error", "Check Error");
                }
            });
        }

        return false;
    });

     jQuery(document).on('click', '.advEditmodal', function () {
        var statid = jQuery(this).attr('data-id');
        jQuery(".id").val(statid);

        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
          jQuery('.modal-body').load('crm/recipe/editAdv/'+statid);
        return false;
    });

    jQuery(document).on('submit', '#editAdv', function () {
        var thisAction = jQuery(this);
         

        if (!errors) {
            jQuery.ajax({
                url: "crm/recipe/storeAdv",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                       
                           oTable5.draw();

                     jQuery('#modal-advEdit').find('.form-control').val('');
                        jQuery('#modal-advEdit').modal('hide');
                        
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





    jQuery(document).on('change', '.inputAdv', function () {
        thisclick = jQuery(this);
        var data=jQuery(this).val();
        jQuery.ajax({
            url: jQuery(this).attr('link')+"&value="+data,
            type: 'GET',
            dataType: "json",
            success: function (data) {
                oTable5 .draw();
                toasterMessage("success", data.message, "Updated Successfully");
            }
        });
        return false;
    });
   

    // for change status
    jQuery(document).on('click', '.btn-astatus', function () {
        thisclick = jQuery(this);
        var status = "";
        if (thisclick.hasClass('astatus-inactive'))
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
                
                    if (thisclick.hasClass('astatus-active')) {
                        
                        thisclick.removeClass('astatus-active').addClass('astatus-inactive');

                        thisclick.find('i').removeClass('fa-square-o').addClass('fa-check-square');
                        thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger');
                        thisclick.tooltipster('content', 'Activate');
                      

                    } else {
                          
                        thisclick.removeClass('astatus-inactive').addClass('astatus-active');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                        thisclick.tooltipster('content', 'Deactivate');
                    }
                      oTable5.draw();

                    toasterMessage("success", data.message, "Updated Successfully");
                
            }
        });
}
        return false;
    });

   
});