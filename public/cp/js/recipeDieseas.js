

jQuery(document).ready(function () {
   // users.init();
   var recipe_id= jQuery(this).find('.recipe_id').attr('value');
    var flag = true;
    oTable6 = $('#mydatatable6').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/recipe/listDieseas/"+recipe_id,
        "order": [[ 1, "desc" ]],
        columnDefs: [
           {orderable: false, targets: 1},
       //{orderable: false, targets: 0},
            //{searchable: false, targets: 7},
            //{searchable: false, targets: 1},
        ],
        "columns": [

            {data: 'name', name: 'name'},
            {data: 'notes', name: 'notes'},
            {data: 'dtype', name: 'dtype'},
            {data: 'active', name: 'active'},
            {data: 'm_action', name: 'm_action'}
        ].unshift({"data" : "Index"}),
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
        oTable6.draw();
    });

    jQuery(window).resize(function() {
        oTable6.columns().search('').draw();
    });
    
    jQuery(document).on('click','.sorting_1',function() {
        mytooltipster();
        $('.popovers').popover();
    });
    
    $('.searchable').change(function () {
        if (flag) {
            flag = false;
            var column = jQuery(this).attr('data-column');
            oTable6.columns(column).search(jQuery(this).val()).draw();
        }
        flag = true;
    });

    $('.searchableList').change(function () {
        var column = $(this).attr('data-column');
        oTable6.columns(column).search($(this).val()).draw();
    });

   


    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable6.columns().search('').draw();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";
    jQuery(document).on('click', '.ndieseasmodal', function () {

        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        return false;
    });

    jQuery(document).on('submit', '#addNdieseas', function () {
        var thisAction = jQuery(this);
        var addNdieseas = jQuery(this).find('#addNdieseas :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/recipe/addNdieseas",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {

                        $("#addNdieseas option[value="+addNdieseas+"]").remove();
                        $("#addNdieseas option:selected").remove();
                        jQuery(document).find('.dieseas_id').append(new Option( data.option,  data.value));


                        jQuery('#modal-ndieseasadd').find('.form-control').val('');
                        jQuery('#modal-ndieseasadd').modal('hide');

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
    
    jQuery(document).on('click', '.dieseasmodal', function () {
        var dieseasid = jQuery(this).parents('tr').find('.dieseasid').attr('data-id');
        jQuery(".id").val(dieseasid);

        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        return false;
    });

    jQuery(document).on('submit', '#addDieseas', function () {
        var thisAction = jQuery(this);
         var dieseas_id = jQuery(this).find('#dieseas_id :selected').val();

        if (!errors) {
            jQuery.ajax({
                url: "crm/recipe/addDieseas",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {

                        $("#dieseas_id option[value="+dieseas_id+"]").remove();
                        $("#dieseas_id option:selected").remove();

                     jQuery('#modal-dieseasadd').find('.form-control').val('');
                        jQuery('#modal-dieseasadd').modal('hide');

                        oTable6.draw();
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

    jQuery(document).on('click', '.dieseasEditmodal', function () {
        var dieseasid = jQuery(this).attr('data-id');
        jQuery(".id").val(dieseasid);

        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
          jQuery('.modal-body').load('crm/recipe/editDieseas/'+dieseasid);
        return false;
    });

    jQuery(document).on('click', '.dieseasEditmodal', function () {
        var dieseasid = jQuery(this).parents('tr').find('.dieseasid').attr('data-id');
        jQuery(".id").val(dieseasid);

        var target = jQuery(this).attr('data-modal');

        jQuery('.modal-body').load('crm/recipe/editDieseas/'+dieseasid);

        jQuery('#' + target).modal('show');
        return false;
    });


    jQuery(document).on('submit', '#editDieseas', function () {
        var thisAction = jQuery(this);
         

        if (!errors) {
            jQuery.ajax({
                url: "crm/recipe/storeDieseas",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                       
                           oTable6.draw();
                        $("#dieseas_id option:selected").trigger('change');
                        $("#dieseas_id option:selected").remove();
                     jQuery('#modal-dieseasEdit').find('.form-control').val('');
                        jQuery('#modal-dieseasEdit').modal('hide');
                        
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
    jQuery(document).on('click', '.btn-mstatus', function () {
        thisclick = jQuery(this);
         id=thisclick.parents('tr').find('.id').attr('item-id');
         value=thisclick.parents('tr').find('.id').attr('name');
        var status = "";
        if (thisclick.hasClass('mstatus-inactive'))
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
                
                    if (thisclick.hasClass('mstatus-active')) {
                        
                        thisclick.removeClass('mstatus-active').addClass('mstatus-inactive');

                        thisclick.find('i').removeClass('fa-square-o').addClass('fa-check-square');
                        thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger');
                        thisclick.tooltipster('content', 'Activate');
                         $("#dieseas_id").append('<option value='+id+'>'+value+'</option>');

                    } else {
                          
                        thisclick.removeClass('mstatus-inactive').addClass('mstatus-active');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                        thisclick.tooltipster('content', 'Deactivate');
                    }
                      oTable6.draw();

                    toasterMessage("success", data.message, "Updated Successfully");
                
            }
        });
    }

        return false;
    });

   
});