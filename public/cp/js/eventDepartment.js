

jQuery(document).ready(function () {
   // users.init();
   var event_id= jQuery(this).find('.event_id').attr('value');
    var flag = true;
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/event/listDepartment/"+event_id,
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
            {data: 'active', name: 'active'},
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
        oTable.draw();
    });

    jQuery(window).resize(function() {
        oTable.columns().search('').draw();
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

   


    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable.columns().search('').draw();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";

    
    jQuery(document).on('click', '.deptmodal', function () {
        var deptid = jQuery(this).parents('tr').find('.deptid').attr('data-id');
        jQuery(".id").val(deptid);

        var target = jQuery(this).attr('data-modal');
      
        jQuery('#' + target).modal('show');
        return false;
    });

    jQuery(document).on('submit', '#addDept', function () {
        var thisAction = jQuery(this);
         var deptid = jQuery(this).find('#dept_id :selected').val();

        if (!errors) {
            jQuery.ajax({
                url: "crm/event/addDept",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                           $("#dept_id option[value="+deptid+"]").remove();
                           oTable.draw();

                     jQuery('#modal-deptadd').find('.form-control').val('');
                        jQuery('#modal-deptadd').modal('hide');
                        
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

    jQuery(document).on('click', '.deptEditmodal', function () {
        var deptid = jQuery(this).attr('data-id');
        jQuery(".id").val(deptid);

        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
          jQuery('.modal-body').load('crm/event/editDept/'+deptid);
        return false;
    });

    jQuery(document).on('submit', '#editDept', function () {
        var thisAction = jQuery(this);
         

        if (!errors) {
            jQuery.ajax({
                url: "crm/event/storeDept",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                       
                           oTable.draw();

                     jQuery('#modal-deptEdit').find('.form-control').val('');
                        jQuery('#modal-deptEdit').modal('hide');
                        
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
                         $("#dept_id").append('<option value='+id+'>'+value+'</option>');

                    } else {
                          
                        thisclick.removeClass('mstatus-inactive').addClass('mstatus-active');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                        thisclick.tooltipster('content', 'Deactivate');
                    }
                      oTable.draw();

                    toasterMessage("success", data.message, "Updated Successfully");
                
            }
        });
    }

        return false;
    });

   
});