

jQuery(document).ready(function () {
    // users.init();
    var invoice_id= jQuery(this).find('.invoice_id').attr('value');
    var flag = true;
    oTable1 = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/invoice/listProcedure/"+invoice_id,
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
            {data: 'serviceCode', name: 'serviceCode'},
            {data: 'cost', name: 'cost'},
            {data: 'qty', name: 'qty'},
            {data: 'total_cost', name: 'total_cost'},
            {data: 'discount', name: 'discount'},
            {data: 'grand_total', name: 'grand_total'},
            {data: 'active', name: 'active'},
            {data: 'm_action', name: 'm_action'}
        ],

        // setup responsive extension: http://datatables.net/extensions/responsive/
        //responsive: true,
        "paging": false,
        "autoWidth": false,
        "scrollX": true,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                if(typeof i === 'string') {
                    let multiplier = /[\(\)]/g.test(i) ? -1 : 1;

                    return (i.replace(/[\$,\(\)]/g, '') * multiplier)
                }

                return typeof i === 'number' ?
                    i : 0;
            };


            // Total over all pages
            grand_total = api
                .column( 7)
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a)  + parseFloat(b) ;
                }, 0 );

            total = api
                .column( 5)
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a)  + parseFloat(b) ;
                }, 0 );



            // Total over this page


            // Update footer
            $( api.column( 4 ).footer() ).html(
                '<h4 class="text-danger">  NIS '+ total +'</h4>'
            );
            jQuery(".grand").val(grand_total);
            jQuery(this).parents('form').find('.discount').attr('value', 0);
            var approved_cost = jQuery('.start_approved_cost').val();
            var discount = jQuery('.discountt').val();
            var perc = jQuery('.perc').is(':checked');
            if (perc)
                approved_cost = approved_cost - (approved_cost * discount / 100);
            else
                approved_cost = approved_cost -  discount ;
            if(approved_cost!=0)
            jQuery('.approved_cost').attr('value', approved_cost);

        }


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
    var placeholder = "Select an option";


    jQuery(document).on('click', '.promodal', function () {

        var proid = jQuery(this).parents('tr').find('.proid').attr('data-id');
        jQuery(".id").val(proid);

        var target = jQuery(this).attr('data-modal');
        $("#hh").select2().select2("val", 0);
        jQuery('#' + target).find('.qty').attr('value',1);
        jQuery('#' + target).modal('show');
        jQuery('#' + target).find('.cost').attr('value',0);
        jQuery('#' + target).find('.dolar').attr('value',3.5);
        jQuery('#' + target).find('.nis').attr('value',0);
        jQuery('#' + target).find('.dolar').attr('value',0);
        jQuery('#' + target).find('.qty').attr('value',1);

        return false;
    });

    jQuery(document).on('submit', '#addPro', function () {
        var thisAction = jQuery(this);
        var proid = jQuery(this).find('#pro_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/invoice/addPro",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        oTable1.draw();

                        $("#pro_id option[value="+proid+"]").remove();

                        // jQuery('#modal-proadd').find('.form-control').val('');

                        jQuery('#modal-proadd').modal('hide');

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

    jQuery(document).on('click', '.proEditmodal', function () {
        jQuery('#modal-proEdit').find('.form-control').val('');
        var proid = jQuery(this).attr('data-id');
        jQuery(".id").val(proid);

        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
        jQuery('.modal-body').load('crm/invoice/editPro/'+proid);
        return false;
    });

    jQuery(document).on('submit', '#editPro', function () {
        var thisAction = jQuery(this);


        if (!errors) {
            jQuery.ajax({
                url: "crm/invoice/storePro",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {

                        oTable1.draw();

                        jQuery('#modal-proEdit').find('.form-control').val('');
                        jQuery('#modal-proEdit').modal('hide');

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
                       // thisclick.tooltipster('content', 'Activate');

                        $("#pro_id").append('<option value='+id+'>'+value+'</option>');


                    } else {

                        thisclick.removeClass('pstatus-inactive').addClass('pstatus-active');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                       // thisclick.tooltipster('content', 'Deactivate');
                    }
                    oTable1.draw();

                    toasterMessage("success", data.message, "Updated Successfully");

                }
            });
        }

        return false;
    });


});