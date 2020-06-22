

jQuery(document).ready(function () {
   // users.init();
   var recipe_id= jQuery(this).find('.recipe_id').attr('value');
    var flag = true;
    oTable2 = $('#mydatatable2').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/recipe/listStatistics/"+recipe_id,
        "order": [[ 0, "desc" ]],
        "columnDefs": [
            { "width": "120%", "targets": 0 },
            { "width": "150%", "targets": 1 },
        ],
        "columns": [

            {data: 'name', name: 'name'},
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
        "pageLength": 100,
        "scrollX": true,
        "pagingType": "bootstrap_full_number"
        /*"drawCallback": function( settings ) {
            $('.tooltip-one-info').tooltipster('destroy');            
        }*/
    });

    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable2 .draw();
    });

    jQuery(window).resize(function() {
        oTable2 .columns().search('').draw();
    });
    
    jQuery(document).on('click','.sorting_1',function() {
        mytooltipster();
        $('.popovers').popover();
    });
    
    $('.searchable').change(function () {
        if (flag) {
            flag = false;
            var column = jQuery(this).attr('data-column');
            oTable2 .columns(column).search(jQuery(this).val()).draw();
        }
        flag = true;
    });

    $('.searchableList').change(function () {
        var column = $(this).attr('data-column');
        oTable2 .columns(column).search($(this).val()).draw();
    });

   


    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable2 .columns().search('').draw();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";

    
    jQuery(document).on('click', '.statmodal', function () {
        var proid = jQuery(this).parents('tr').find('.statid').attr('data-id');
        jQuery(".id").val(proid);

        var target = jQuery(this).attr('data-modal');
      
        jQuery('#' + target).modal('show');
        return false;
    });

    jQuery(document).on('submit', '#addStat', function () {
        var thisAction = jQuery(this);

        if (!errors) {
            jQuery.ajax({
                url: "crm/recipe/addStat",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                         

                     jQuery('#modal-statadd').find('.form-control').val('');
                        jQuery('#modal-statadd').modal('hide');
                        
                        input_wlbl();
                        toasterMessage("success", data.message, "Updated Successfully");
                          oTable2 .draw();
                         
                    }
                },
                error: function (data) {
                    toasterMessage("error", "Error", "Check Error");
                }
            });
        }

        return false;
    });

     jQuery(document).on('click', '.statEditmodal', function () {
        var statid = jQuery(this).attr('data-id');
        jQuery(".id").val(statid);

        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
          jQuery('.modal-body').load('crm/recipe/editStat/'+statid);
        return false;
    });

    jQuery(document).on('submit', '#editStat', function () {
        var thisAction = jQuery(this);
         

        if (!errors) {
            jQuery.ajax({
                url: "crm/recipe/storeStat",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                       
                           oTable2.draw();

                     jQuery('#modal-statEdit').find('.form-control').val('');
                        jQuery('#modal-statEdit').modal('hide');
                        
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


    

    

   

    // for change status
    jQuery(document).on('click', '.btn-sstatus', function () {
        thisclick = jQuery(this);
        var status = "";
        if (thisclick.hasClass('sstatus-inactive'))
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
                
                    if (thisclick.hasClass('sstatus-active')) {
                        
                        thisclick.removeClass('sstatus-active').addClass('sstatus-inactive');

                        thisclick.find('i').removeClass('fa-square-o').addClass('fa-check-square');
                        thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger');
                        thisclick.tooltipster('content', 'Activate');
                      

                    } else {
                          
                        thisclick.removeClass('sstatus-inactive').addClass('sstatus-active');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                        thisclick.tooltipster('content', 'Deactivate');
                    }
                      oTable2 .draw();

                    toasterMessage("success", data.message, "Updated Successfully");
                
            }
        });
}
        return false;
    });

    jQuery(document).on('change', '.inputStat', function () {
        thisclick = jQuery(this);
        var data=jQuery(this).val();
            jQuery.ajax({
                url: jQuery(this).attr('link')+"&value="+data,
                type: 'GET',
                dataType: "json",
                success: function (data) {
                    oTable2 .draw();
                    toasterMessage("success", data.message, "Updated Successfully");
                }
            });
        return false;
        });





});