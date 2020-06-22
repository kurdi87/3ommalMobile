

jQuery(document).ready(function () {
    // users.init();
    var gop_id= jQuery(this).find('.gop_id').attr('value');
    var flag = true;
    otable7 = $('#mydatatable7').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/gop/listMedication/"+gop_id,
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
            total = api
                .column( 5)
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a)  + parseFloat(b) ;
                }, 0 );

            // Total over this page


            // Update footer
            $( api.column( 4 ).footer() ).html(
                '<input class="totalcostmed form-control " name="tt" type="text" value="'+total+'">'
            );
            jQuery(document).find('.totalcostmed').change();
        }


        /*"drawCallback": function( settings ) {
            $('.tooltip-one-info').tooltipster('destroy');
        }*/
    });

    jQuery(document).on('click', '.btn-submit-search', function () {
        otable7.draw();
    });

    jQuery(window).resize(function() {
        otable7.columns().search('').draw();
    });

    jQuery(document).on('click','.sorting_1',function() {
        mytooltipster();
        $('.popovers').popover();
    });

    $('.searchable').change(function () {
        if (flag) {
            flag = false;
            var column = jQuery(this).attr('data-column');
            otable7.columns(column).search(jQuery(this).val()).draw();
        }
        flag = true;
    });

    $('.searchableList').change(function () {
        var column = $(this).attr('data-column');
        otable7.columns(column).search($(this).val()).draw();
    });




    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        otable7.columns().search('').draw();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";


    jQuery(document).on('click', '.medmodal', function () {
        var medid = jQuery(this).parents('tr').find('.medid').attr('data-id');
        jQuery(".id").val(medid);

        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        jQuery('#' + target).find('.mcost').attr('value',0);
        jQuery('#' + target).find('.mdolar').attr('value',3.5);
        jQuery('#' + target).find('.mnis').attr('value',0);
        jQuery('#' + target).find('.mdolar').attr('value',0);
        jQuery('#' + target).find('.mqty').attr('value',1);

        return false;
    });

    jQuery(document).on('submit', '#addMed', function () {
        var thisAction = jQuery(this);
        var medid = jQuery(this).find('#med_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/gop/addMed",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        otable7.draw();

                        $("#med_id option[value="+medid+"]").remove();

                        // jQuery('#modal-medadd').find('.form-control').val('');

                        jQuery('#modal-medadd').modal('hide');

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

    jQuery(document).on('click', '.medEditmodal', function () {
        jQuery('#modal-medEdit').find('.form-control').val('');
        var medid = jQuery(this).attr('data-id');
        jQuery(".id").val(medid);

        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
        jQuery('.modal-body').load('crm/gop/editMed/'+medid);
        return false;
    });

    jQuery(document).on('submit', '#editMed', function () {
        var thisAction = jQuery(this);


        if (!errors) {
            jQuery.ajax({
                url: "crm/gop/storeMed",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {

                        otable7.draw();

                        jQuery('#modal-medEdit').find('.form-control').val('');
                        jQuery('#modal-medEdit').modal('hide');

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





    jQuery(document).on('change', '.medicationchoose', function () {
        var mcost = $('#hhh :selected').attr('cost');
        var mqty = jQuery(this).parents('.addmed').find('.mqty').val();

        var mexchange = jQuery(this).parents('.addmed').find('.mexchange').val();
        var totalmcost = parseFloat(mcost);
        var totalmdolar = parseFloat(mcost) * parseFloat(mqty) / parseFloat(mexchange);
        var totalmcostnis = parseFloat(mcost) * parseFloat(mqty);
        jQuery(this).parents('.addmed').find('.mcost').attr('value', totalmcost);
        jQuery(this).parents('.addmed').find('.mdolar').attr('value', totalmdolar);
        jQuery(this).parents('.addmed').find('.mnis').attr('value', totalmcostnis);

    });
  

    jQuery(document).on('change', '.mqty', function () {
        var mcost = jQuery(this).parents('.addmed').find('.mcost').val();
        var mqty = jQuery(this).val()
        var totalmcost = parseFloat(mcost);
        var mexchange = jQuery(this).parents('.addmed').find('.mexchange').val();
        var totalmdolar = parseFloat(mcost) * parseFloat(mqty) / parseFloat(mexchange);
        var totalmcostmnis = parseFloat(mcost) * parseFloat(mqty);
        jQuery(this).parents('.addmed').find('.mcost').attr('value', totalmcost);
        jQuery(this).parents('.addmed').find('.mdolar').attr('value', totalmdolar);
        jQuery(this).parents('.addmed').find('.mnis').attr('value', totalmcostmnis);

    });
    jQuery(document).on('change', '.mcost', function () {
        var mcost = jQuery(this).val()
        var mqty = jQuery(this).parents('.addmed').find('.mqty').val();
        var totalmcost = parseFloat(mcost);
        var mexchange = jQuery(this).parents('.addmed').find('.mexchange').val();
        var totalmdolar = parseFloat(mcost) * parseFloat(mqty) / parseFloat(mexchange);
        var totalmcostmnis = parseFloat(mcost) * parseFloat(mqty);
        jQuery(this).parents('.addmed').find('.mcost').attr('value', totalmcost);
        jQuery(this).parents('.addmed').find('.mdolar').attr('value', totalmdolar);
        jQuery(this).parents('.addmed').find('.mnis').attr('value', totalmcostmnis);

    });
    jQuery(document).on('change', '.mexchange', function () {
        var mcost = jQuery(this).parents('.addmed').find('.mcost').val();
        var mqty = jQuery(this).parents('.addmed').find('.mqty').val();
        var totalmcost = parseFloat(mcost);
        var mexchange = jQuery(this).val();
        var totalmdolar = parseFloat(mcost) * parseFloat(mqty) / parseFloat(mexchange);
        var totalmcostmnis = parseFloat(mcost) * parseFloat(mqty);
        jQuery(this).parents('.addmed').find('.mcost').attr('value', totalmcost);
        jQuery(this).parents('.addmed').find('.mdolar').attr('value', totalmdolar);
        jQuery(this).parents('.addmed').find('.mnis').attr('value', totalmcostmnis);

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
                     //   thisclick.tooltipster('content', 'Activate');

                        $("#med_id").append('<option value='+id+'>'+value+'</option>');


                    } else {

                        thisclick.removeClass('pstatus-inactive').addClass('pstatus-active');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                       // thisclick.tooltipster('content', 'Deactivate');
                    }
                    otable7.draw();

                    toasterMessage("success", data.message, "Updated Successfully");

                }
            });
        }

        return false;
    });
    
    
    
    


});