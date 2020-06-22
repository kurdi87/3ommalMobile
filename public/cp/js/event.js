
jQuery(document).ready(function () {
   // users.init();
    var flag = true;
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/event/list?status="+"&recipe="+$('#recipe').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&employee="+$('#employee').val()+"&from="+$('#from').val()+"&to="+$('#to').val(),
        "order": [[0, "desc"]],
        columnDefs: [

       {orderable: false, targets: 1},
            {searchable: false, targets: 6},
            {searchable: false, targets: 1},
        ],
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'patient_name', name: 'patient_name'},
            {data: 'sid', name: 'sid'},
            {data: 'event_no', name: 'event_no'},
             {data: 'recipe', name: 'recipe'},
            {data: 'department', name: 'department'},
            {data: 'finance_party_name', name: 'finance_party_name'},

            {data: 'referral_agent', name: 'referral_agent'},
            {data: 'employee', name: 'employee'},
            {data: 'coverage_date', name: 'coverage_date'},

            {data: 'accident_id', name: 'accident_id'},
            {data: 'accident_type', name: 'accident_type'},

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
                $(this).attr("href", $(this).data("href") +"status="+$('#status').val()+"&recipe="+$('#recipe').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&employee="+$('#employee').val()+"&agent="+$('#agent').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&from="+$('#from').val()+"&to="+$('#to').val(),+input);
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
        oTable.ajax.url("crm/event/list?status="+$('#status').val()+"&agent="+$('#agent').val()+"&recipe="+$('#recipe').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&employee="+$('#employee').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });

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
    jQuery(document).on('click', '.processModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#'+ target).modal('show');
        jQuery('.modal-body').load('crm/event/process/'+eid);
        return false;
    });
    jQuery(document).on('click', 'body', function (e) {
        var target = $(e.target);
        if (!$(e.target).is('.btn-dropdown-wstatusrg ,.btn-dropdown-wstatus, .btn-dropdown-wstatus *')) {
            $('.btn-dropdown-wstatusrg').removeClass('open');
        }
    });

    jQuery(document).on('change', '#status', function () {
        var status=$('#statusN').attr('value',this.value);
        oTable.ajax.url("crm/event/list?status="+$('#status').val()+"&agent="+$('#agent').val()+"&recipe="+$('#recipe').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&employee="+$('#employee').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });

    jQuery(document).on('change', '#recipe', function () {
        var status=$('#hospitalN').attr('value',this.value);
        oTable.ajax.url("crm/event/list?status="+$('#status').val()+"&agent="+$('#agent').val()+"&recipe="+$('#recipe').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&employee="+$('#employee').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });

    jQuery(document).on('change', '#finance_party', function () {
        var status=$('#finance_partyN').attr('value',this.value);
        oTable.ajax.url("crm/event/list?status="+$('#status').val()+"&agent="+$('#agent').val()+"&recipe="+$('#recipe').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&employee="+$('#employee').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });

    jQuery(document).on('change', '#department', function () {
        var status=$('#hospitalN').attr('value',this.value);
        oTable.ajax.url("crm/event/list?status="+$('#status').val()+"&agent="+$('#agent').val()+"&recipe="+$('#recipe').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&employee="+$('#employee').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });
    jQuery(document).on('change', '#employee', function () {
        var status=$('#employeeN').attr('value',this.value);
        oTable.ajax.url("crm/event/list?status="+$('#status').val()+"&agent="+$('#agent').val()+"&recipe="+$('#recipe').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&employee="+$('#employee').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });
    jQuery(document).on('change', '#commission', function () {
        var status=$('#commission').attr('value',this.value);
        oTable.ajax.url("crm/event/list?status="+$('#status').val()+"&agent="+$('#agent').val()+"&recipe="+$('#recipe').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&employee="+$('#employee').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });

    jQuery(document).on('change', '#from', function () {
        var status=$('#from').attr('value',this.value);
        oTable.ajax.url("crm/event/list?status="+$('#status').val()+"&agent="+$('#agent').val()+"&recipe="+$('#recipe').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&employee="+$('#employee').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });
    jQuery(document).on('change', '#to', function () {
        var status=$('#to').attr('value',this.value);
        oTable.ajax.url("crm/event/list?status="+$('#status').val()+"&agent="+$('#agent').val()+"&recipe="+$('#recipe').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&employee="+$('#employee').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });
    jQuery(document).on('change', '#agent', function () {
        var status=$('#agentN').attr('value',this.value);
        oTable.ajax.url("crm/event/list?status="+$('#status').val()+"&agent="+$('#agent').val()+"&recipe="+$('#recipe').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&employee="+$('#employee').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });
    jQuery(document).on('change', '#coverage_type', function () {
        var status=$('#coverage_typeN').attr('value',this.value);
        oTable.ajax.url("crm/event/list?status="+$('#status').val()+"&agent="+$('#agent').val()+"&recipe="+$('#recipe').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&employee="+$('#employee').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
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

                    toasterMessage("success", data.message, "Updated Successfully");
                oTable.ajax.url("crm/event/list?status="+$('#status').val()+"&agent="+$('#agent').val()+"&recipe="+$('#recipe').val()+"&employee="+$('#employee').val()+"&finance_party="+$('#finance_party').val()+"&coverage_type="+$('#coverage_type').val()+"&department="+$('#department').val()+"&commission="+$('#commission').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
            }
        });

        return false;
    });

   
});