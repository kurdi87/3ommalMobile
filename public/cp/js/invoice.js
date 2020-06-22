
jQuery(document).ready(function () {
    // users.init();
    var flag = true;
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&employee="+$('#employeeN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val(),
        "order": [[ 0, "desc" ]],
        columnDefs: [
            //{orderable: false, targets: -1},
            //{orderable: false, targets: 0},
            {searchable: false, targets: 7},
            {searchable: false, targets: 1},

            {visible: false, targets:23 },
            {visible: false, targets:24 },
            {visible: false, targets:25 },
        ],
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'patient_name', name: 'patient_name'},
            {data: 'sid', name: 'sid'},
            {data: 'event_id', name: 'event_id'},
            {data: 'event_no', name: 'event_no'},
            {data: 'invoice_no', name: 'invoice_no'},
            {data: 'finance_party_name', name: 'finance_party_name'},
            {data: 'admission_id', name: 'admission_id'},
            {data: 'claim_id', name: 'claim_id'},
            {data: 'recipe', name: 'recipe'},
            {data: 'department', name: 'department'},
            {data: 'month', name: 'month'},
            {data: 'fmonth', name: 'fmonth'},
            {data: 'discharge_date', name: 'discharge_date'},
            {data: 'approved_cost', name: 'approved_cost'},
            {data: 'amount_commision', name: 'amount_commision'},
            {data: 'commission', name: 'commission'},
            {data: 'rfp_to_hos', name: 'rfp_to_hos'},
            {data: 'paid_finance_party', name: 'paid_finance_party'},
            {data: 'referral_agent', name: 'referral_agent'},
            {data: 'paid_to_hos', name: 'paid_to_hos'},
            {data: 'active', name: 'active'},
            {data: 'm_action', name: 'm_action'},
            {data: 'active2', name: 'active2'},
            {data: 'sum_cost', name: 'sum_cost'},
            {data: 'sum_comm', name: 'sum_comm'},



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
                $(this).attr("href",$(this).data("href")+"status="+$('#statusN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&agent="+$('#agentN').val()+"&employee="+$('#employeeN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val(),+input);

            });
        },
        // setup responsive extension: http://datatables.net/extensions/responsive/
        //responsive: true,
        "autoWidth": false,
        "pageLength": 50,
        "scrollX": true,
        "pagingType": "bootstrap_full_number",
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;


            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            var numberWithCommas=function (x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }


            // Total over all pages
            // Total over all pages
            active2 =( api
                .column( 25)
                .data()[2]);

            total = api
                .column( 14 )
                .data()
                .reduce( function (a, b) {

                    return intVal(a) + intVal(b);
                }, 0 );
            total2 = api
                .column( 15 )
                .data()
                .reduce( function (a, b) {

                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page


            pages_total =( api
                .column( 24)
                .data()[2]);
            pages_total2 =( api
                .column( 25)
                .data()[2]);


            // Total over this page


            // Update footer
            $( api.column( 2 ).footer() ).html(
                '<h4 class="text-danger">   '+ numberWithCommas(Math.round(total)) + ' of '+ pages_total+'</h4>'

            );
            $( api.column( 6 ).footer() ).html(
                '<h4 class="text-danger">   '+ numberWithCommas(Math.round(total2)) + ' of '+ pages_total2+'</h4>'
            );
        }
        /*"drawCallback": function( settings ) {
            $('.tooltip-one-info').tooltipster('destroy');
        }*/
    });




    jQuery(document).on('click', '.processModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#'+ target).modal('show');
        jQuery('.modal-body').load('crm/invoice/process/'+eid);
        return false;
    });

    jQuery(document).on('change', '#status', function () {
        var status=$('#statusN').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();
    });

    jQuery(document).on('change', '#recipe', function () {
        var status=$('#hospitalN').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();    });

    jQuery(document).on('change', '#finance_party', function () {
        var status=$('#finance_partyN').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();    });
    jQuery(document).on('change', '#commission', function () {
        var status=$('#commissionN').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();    });
    jQuery(document).on('change', '#agent', function () {
        var status=$('#agentN').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();    });
    jQuery(document).on('change', '#from', function () {
        var status=$('#from').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();    });

    jQuery(document).on('change', '#fromF', function () {
        var status=$('#fromF').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();
    });
    jQuery(document).on('change', '#to', function () {

        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();
    });
    jQuery(document).on('change', '#toF', function () {

        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();
    });
    jQuery(document).on('change', '#paid', function () {
        var status=$('#paidN').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();
    });
    jQuery(document).on('change', '#paid', function () {
        var status=$('#paidN').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();
    });
    jQuery(document).on('change', '#paid_finance_party', function () {
        var status=$('#paid_finance_partyN').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();
    });
    jQuery(document).on('change', '#rfp_to_hos', function () {
        var status=$('#rfp_to_hosN').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();
    });
    jQuery(document).on('change', '#paid_to_hos', function () {
        var status=$('#paid_to_hosN').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();
    });
    jQuery(document).on('change', '#issubmit', function () {
        var status=$('#issubmitN').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();
    });
    jQuery(document).on('change', '#related_accident', function () {
        var status=$('#related_accidentN').attr('value',this.value);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();
    });








    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable.draw();
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
        $('.select2').attr('value',0);
        $('.filter').attr('value',0);
        oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select an option";



    jQuery(document).on('click', '.btn-dropdown-wstatus', function () {
        if (jQuery(this).attr('disabled') != "disabled") {
            if (jQuery(this).parents('.btn-dropdown-wstatusrg').hasClass('open')) {
                jQuery(this).parents('.btn-dropdown-wstatusrg').removeClass('open');
            }
            else {
                jQuery(this).parents('.btn-dropdown-wstatusrg').addClass('open');
            }
        }
    });

    jQuery(document).on('click', '.btn-dropdown-wselect', function () {
        if (jQuery(this).attr('disabled') != "disabled") {
            if (jQuery(this).parents('.btn-dropdownrg').hasClass('open')) {
                jQuery(this).parents('.btn-dropdownrg').removeClass('open');
            }
            else {
                jQuery(this).parents('.btn-dropdownrg').addClass('open');
            }
        }
    });

    jQuery(document).on('click', 'body', function (e) {
        var target = $(e.target);
        if (!$(e.target).is('.dropdown-wselect, .dropdown-wselect *, .btn-dropdown-wselect, .btn-dropdown-wselect *,.select2-search__field')) {
            $('.btn-dropdownrg').removeClass('open');
        }
    });

    jQuery(document).on('click', 'body', function (e) {
        var target = $(e.target);
        if (!$(e.target).is('.btn-dropdown-wstatusrg ,.btn-dropdown-wstatus, .btn-dropdown-wstatus *')) {
            $('.btn-dropdown-wstatusrg').removeClass('open');
        }
    });



    // for change status
    jQuery(document).on('click', '.btn-mstatus', function () {
        thisclick = jQuery(this);
        var status = "";
        if (thisclick.hasClass('mstatus-inactive'))
            status = "0";
        else
            status = "1";
        jQuery.ajax({
            url: jQuery(this).attr('link'),
            type: 'GET',
            data: {"id[]": thisclick.parents('tr').find('.id').attr('data-id'), status: status},
            dataType: "json",
            success: function (data) {

                if (thisclick.hasClass('mstatus-active')) {

                    thisclick.removeClass('mstatus-active').addClass('mstatus-inactive');

                    thisclick.find('i').removeClass('fa-square-o').addClass('fa-check-square');
                    thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger');
                    thisclick.tooltipster('content', 'Activate');

                } else {

                    thisclick.removeClass('mstatus-inactive').addClass('mstatus-active');
                    thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                    thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                    thisclick.tooltipster('content', 'Deactivate');
                }
                oTable.ajax.url("crm/invoice/list?status="+$('#statusN').val()+"&commission="+$('#commissionN').val()+ "&issubmit=" + $('#issubmit').val()+ "&related_accident=" + $('#related_accident').val()+"&agent="+$('#agentN').val()+"&recipe="+$('#hospitalN').val()+"&finance_party="+$('#finance_partyN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&paid="+$('#paidN').val()+"&fromF="+$('#fromF').val()+"&toF="+$('#toF').val()+"&employee="+$('#employeeN').val()+"&paid_finance_party="+$('#paid_finance_partyN').val()+"&rfp_to_hos="+$('#rfp_to_hosN').val()+"&paid_to_hos="+$('#paid_to_hosN').val()).load();
                toasterMessage("success", data.message, "Updated Successfully");

            }
        });

        return false;
    });


});