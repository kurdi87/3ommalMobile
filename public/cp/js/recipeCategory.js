

jQuery(document).ready(function () {
   // users.init();
   var recipe_id= jQuery(this).find('.recipe_id').attr('value');
    var flag = true;
    oTable1 = $('#mydatatable1').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/recipe/listCategory/"+recipe_id,
        "order": [[ 1, "desc" ]],
        columnDefs: [
           //{orderable: false, targets: -1},
       //{orderable: false, targets: 0},

            //{searchable: false, targets: 7},
            //{searchable: false, targets: 1},
        ],
        "columns": [
            {data: 'name', name: 'name'},
            {data: 'parent', name: 'parent'},
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
        oTable1.draw();
    });

    jQuery(window).resize(function() {
        oTable1.columns().search('').draw();
    });
    
    jQuery(document).on('click','.sorting_1',function() {
        mytooltipster();
        $('.popovers').popover();
    });
    
    $('.searchable').change(function () {
        if (flag) {
            flag = false;
            var column = jQuery(this).attr('data-column');
            oTable1.columns(column).search(jQuery(this).val()).draw();
        }
        flag = true;
    });

    $('.searchableList').change(function () {
        var column = $(this).attr('data-column');
        oTable1.columns(column).search($(this).val()).draw();
    });

   


    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable1.columns().search('').draw();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";

    
    jQuery(document).on('click', '.categorymodal', function () {
        var categoryid = jQuery(this).parents('tr').find('.categoryid').attr('data-id');
        jQuery(".id").val(categoryid);

        var target = jQuery(this).attr('data-modal');
      
        jQuery('#' + target).modal('show');
        return false;
    });

        jQuery(document).on('submit', '#addCategory', function () {
        var thisAction = jQuery(this);
        var categoryid = jQuery(this).find('#category_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/recipe/addCategory",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                           oTable1.draw();

                           $("#category_id option[value="+categoryid+"]").trigger('change');

                        $("#category_id option:selected").remove();

                     jQuery('#modal-categoryadd').find('.form-control').val('');
                        jQuery('#modal-categoryadd').modal('hide');
                        
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

         jQuery(document).on('click', '.categoryEditmodal', function () {
        var categoryid = jQuery(this).attr('data-id');
        jQuery(".id").val(categoryid);

        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
          jQuery('.modal-body').load('crm/recipe/editCategory/'+categoryid);
        return false;
    });

    jQuery(document).on('submit', '#editCategory', function () {
        var thisAction = jQuery(this);
         

        if (!errors) {
            jQuery.ajax({
                url: "crm/recipe/storeCategory",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                       
                           oTable1.draw();

                     jQuery('#modal-categoryEdit').find('.form-control').val('');
                        jQuery('#modal-categoryEdit').modal('hide');
                        
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
    jQuery(document).on('click', '.btn-pstatus', function () {
        thisclick = jQuery(this);
        id=thisclick.parents('tr').find('.id').attr('item-id');
         value=thisclick.parents('tr').find('.id').attr('name');

        var status = "";
        if (thisclick.hasClass('pstatus-inactive'))
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
                
                    if (thisclick.hasClass('pstatus-active')) {
                        
                        thisclick.removeClass('pstatus-active').addClass('pstatus-inactive');

                        thisclick.find('i').removeClass('fa-square-o').addClass('fa-check-square');
                        thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger');
                        thisclick.tooltipster('content', 'Activate');
                       
                        $("#category_id").append('<option value='+id+'>'+value+'</option>');
                      

                    } else {
                          
                        thisclick.removeClass('pstatus-inactive').addClass('pstatus-active');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                        thisclick.tooltipster('content', 'Deactivate');
                    }
                      oTable1.draw();

                    toasterMessage("success", data.message, "Updated Successfully");
                
            }
        });
    }

        return false;
    });

   
});