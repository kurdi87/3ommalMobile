

jQuery(document).ready(function () {
    // users.init();
    var procedure_id= jQuery(this).find('.procedure_id').attr('value');
    var flag = true;
    oTable1 = $('#mydatatable1').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "optimum/procedure/listSubProcedures/"+procedure_id,
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
            {data: 'cost', name: 'cost'},
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


    jQuery(document).on('click', '.submodal', function () {
        var subid = jQuery(this).parents('tr').find('.subid').attr('data-id');
        jQuery(".id").val(subid);

        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        return false;
    });

    jQuery(document).on('submit', '#addSub', function () {
        var thisAction = jQuery(this);
        if (!errors) {
            jQuery.ajax({
                url: "optimum/procedure/addSub",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        $("#addSub")[0].reset();
                        oTable1.draw();
                        jQuery('#modal-subadd').modal('hide');




                        input_wlbl();
                        toasterMessage("success", data.message, "Updated Successfully");

                    }
                },
                error: function (data) {
                    toasterMessage("error",  data.message, "Check Error");
                }
            });
        }

        return false;
    });

    jQuery(document).on('click', '.subEditmodal', function () {
        var subid = jQuery(this).parents('tr').find('.id').attr('data-id');
        var target = jQuery(this).attr('data-modal');
        jQuery('#div1').load('optimum/procedure/editSub/'+subid);
        jQuery('#' + target).modal('show');
        return false;
    });

    jQuery(document).on('submit', '#editSub', function () {
        var thisAction = jQuery(this);


        if (!errors) {
            jQuery.ajax({
                url: "optimum/procedure/storeSub",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        $("#editSub")[0].reset();
                        oTable1.draw();
                        jQuery('#modal-subEdit').modal('hide');
                        input_wlbl();

                        toasterMessage("success", data.message, "Updated Successfully");

                    }
                },
                error: function (data) {
                    toasterMessage("error",  data.message, "Check Error");
                }
            });
        }

        return false;
    });

    // for change status
    jQuery(document).on('click', '.btn-spstatus', function () {
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

                    oTable1.draw();

                    toasterMessage("success", data.message, "Updated Successfully");

                },
                failed: function(data)
                {
                    toasterMessage("Failed", data.message, "Failed");
                }

            });
        }

        return false;
    });


});