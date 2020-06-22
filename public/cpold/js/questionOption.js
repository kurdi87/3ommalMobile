

jQuery(document).ready(function () {
    // users.init();
    var question_id= jQuery(this).find('.question_id').attr('value');
    var flag = true;
    oTable1 = $('#mydatatable1').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "hitechjobs/question/listOption/"+question_id,
        "order": [[ 1, "desc" ]],
        columnDefs: [
            //{orderable: false, targets: -1},
            //{orderable: false, targets: 0},
            //{searchable: false, targets: 7},
            //{searchable: false, targets: 1},
        ],
        "columns": [
            {data: 'id', name: 'id'},

            {data: 'question_option_text', name: 'question_option_text'},
            {data: 'rank', name: 'rank'},
            {data: 'option_order', name: 'option_order'},
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
                .column( 3)
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a)  + parseFloat(b) ;
                }, 0 );

            // Total over this page


            // Update footer
            $( api.column( 4 ).footer() ).html(
                '<h4 class="text-danger">   '+ total +'</h4>'
            );
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
    var placeholder = "Select a State";


    jQuery(document).on('click', '.optionmodal', function () {
        var optionid = jQuery(this).parents('tr').find('.optionid').attr('data-id');
        jQuery(".id").val(optionid);

        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
        return false;
    });
    jQuery(document).on('submit', '#addOption', function () {
        var thisAction = jQuery(this);
        var optionid = jQuery(this).find('#option_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "hitechjobs/question/addOption",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        oTable1.draw();

                        $("#option_id option[value="+optionid+"]").remove();

                        // jQuery('#modal-optionadd').find('.form-control').val('');

                        jQuery('#modal-optionadd').modal('hide');

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

    jQuery(document).on('click', '.optionEditmodal', function () {
        jQuery('#modal-optionEdit').find('.form-control').val('');
        var optionid = jQuery(this).attr('data-id');
        jQuery(".id").val(optionid);

        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
        jQuery('.modal-body').load('hitechjobs/question/editOption/'+optionid);
        return false;
    });
    jQuery(document).on('click', '.btn-delete', function () {
        thisclick = jQuery(this);
        var status = "";

        jQuery.ajax({
            url: jQuery(this).attr('link'),
            type: 'GET',
            data: {"id[]": thisclick.parents('tr').find('.id').attr('data-id'), status: status},
            dataType: "json",
            success: function (data) {

                oTable.draw();
                toasterMessage("success", data.message, "Updated Successfully");

            }

        });

        return false;
    });
    jQuery(document).on('submit', '#editOption', function () {
        var thisAction = jQuery(this);


        if (!errors) {
            jQuery.ajax({
                url: "hitechjobs/question/storeOption",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {

                        oTable1.draw();

                        jQuery('#modal-optionEdit').find('.form-control').val('');
                        jQuery('#modal-optionEdit').modal('hide');

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
                        //  thisclick.tooltipster('content', 'Activate');

                        $("#option_id").append('<option value='+id+'>'+value+'</option>');


                    } else {

                        thisclick.removeClass('pstatus-inactive').addClass('pstatus-active');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                        //thisclick.tooltipster('content', 'Deactivate');
                    }
                    oTable1.draw();

                    toasterMessage("success", data.message, "Updated Successfully");

                }
            });
        }

        return false;
    });


});