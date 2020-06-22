
var reportAttar = function () {
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var handleAjaxReport = function() {
        var group_by = jQuery('.groupby-select').val();
        var inquiry_status = jQuery('.inquirystatus-select').val();
        var date_from = jQuery('.txt-inputfrom').val();
        var date_to = jQuery('.txt-inputto').val();
        var inquiry_types_select = jQuery('.inquirytype-select').val();
        var inquiry_types = [];
        if(inquiry_types_select != null)
        {
            inquiry_types = inquiry_types_select;
        }
        jQuery.ajax({
            type: 'GET',
            url: 'http://dcetest.com/new_attar/public/cp-attar/numberInquiries',
            data: {
                groupBy: group_by,
                //status: inquiry_status,
                'types[]': inquiry_types,
                from: date_from,
                to: date_to
            },
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                flag_reset = false;
                var result = data;
                var xaxies = [];
                var data_all = [];
                var data_one = [];
                var data_two = [];
                for (var i = 0; i < result.length; i++) {
                    if(group_by=="year")
                    {
                        xaxies.push(result[i].year);
                    }
                    if(group_by=="quarter")
                    {
                        xaxies.push('Q'+result[i].quarter+'/'+result[i].year);
                    }
                    if(group_by=="month")
                    {
                        xaxies.push(result[i].month+'/'+result[i].year);
                    }
                    if(group_by=="week")
                    {
                        xaxies.push(result[i].firstDay);
                    }
                    data_all.push(parseFloat(result[i].inqNo));
                    data_one.push(parseFloat(result[i].inqNo)-parseFloat(result[i].replied));
                    data_two.push(parseFloat(result[i].replied));
                }
                //console.log(result);
                if(result.length)
                {
                    jQuery('.chart-showing').removeClass('display-none');
                    jQuery('.chartmsg-showing').addClass('display-none');
                    handleChart_one(xaxies, data_all, data_one, data_two);
                }
                else
                {
                    jQuery('.chart-showing').addClass('display-none');
                    jQuery('.chartmsg-showing').removeClass('display-none');
                }
                
                jQuery('#mysample_1,.mysample_1').dataTable().fnDestroy();
                var oTable = $('#mysample_1,.mysample_1').DataTable({
                    "columnDefs": [{
                        "searchable": false,
                        "orderable": false,
                    }],
                    "aaData": result,
                    "aoColumns": [
                        { "mDataProp": "serial" },
                        { "mDataProp": "periodName" },
                        { "mDataProp": "inqNo" },
                        { "mDataProp": "waiting" },
                        { "mDataProp": "replied" },
                    ],
                    buttons: [
                        { extend: 'print', className: 'btn dark btn-outline' },
                        //{ extend: 'copy', className: 'btn red btn-outline' },
                        { extend: 'pdf', className: 'btn green btn-outline' },
                        { extend: 'excel', className: 'btn yellow btn-outline ' },
                        { extend: 'csv', className: 'btn purple btn-outline ' },
                        //{ extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
                    ],
                    dom: 'Bfrtip',
                });

                oTable.draw();
            }
        });
    };

    var handleBtnClear = function() {
        jQuery(document).on('click','.cleardate',function() {
            jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val('');
            jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            input_wlbl();
            jQuery('.txt-inputfrom,.txt-inputto').change();
            handleAjaxReport();
            return false;
        });
    };

    var handleInputDate = function() {
        jQuery(document).on('change','.inputdateclear',function() {
            if(jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val())
            {
                jQuery(this).parents('.inputdate-wicon').find('.cleardate').removeClass('display-none');
            }
            else
            {
                jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            }
        });
    };

    /*var handleDataTable = function() {
        var oTable = $('#mysample_1,.mysample_1').DataTable( {
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "order": [[ 1, 'asc' ]]
        });
     
        oTable.on( 'order.dt search.dt', function () {
            oTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        }).draw();
    };*/

    var flag_reset = false;
    var handleChangeElements = function() {
        jQuery(document).on('click','.btn-report-search',function(){
            return false;
        });

        jQuery(document).on('click','.btn-report-reset',function(){
            flag_reset = true;
            jQuery('.form-control').val('');
            jQuery('.lblinput').removeClass('lblinputtop');
            jQuery('select.bs-select').val(0);
            jQuery('.bs-select').selectpicker('refresh');
            if(jQuery('select.select2').length)
            {
                jQuery('select.select2').select2("val", "");
                jQuery('select.select2').select2('data', null);
            }
            jQuery('.select-wlbl,.selectbs-wlbl,.select2-wlbl').find('.lblselect').removeClass('lblselecttop');
            jQuery('.cleardate').addClass('display-none');
            if(flag_reset==true)
            {
                handleAjaxReport();
            }
        });

        jQuery('.groupby-select').change(function() {
            var thisclick = jQuery(this);
            var val = thisclick.val();
            //jQuery('.tdtxt-nopackages').text(val);
            if(flag_reset==false)
            {
                handleAjaxReport();
            }
        });

        jQuery('.inquirystatus-select').change(function() {
            var thisclick = jQuery(this);
            var val = thisclick.val();
            //jQuery('.tdtxt-nopackages').text(val);
            if(flag_reset==false)
            {
                handleAjaxReport();
            }
        });

        jQuery('.inquirytype-select').change(function() {
            var thisclick = jQuery(this);
            var val = thisclick.val();
            var thiselm = thisclick.parents('.form-group').find('.select2-selection__rendered>.select2-selection__choice');
            var foo = [];
            thisclick.find('option:selected').each(function(i, selected){
                foo[i] = $(selected).text();
            });
            //jQuery('.tdtxt-packagetype').html('').text(foo);
            if(flag_reset==false)
            {
                handleAjaxReport();
            }
        });

        $('.txt-inputfrom').datepicker({
            minViewMode: 1,
            autoclose: true,
            format: 'yyyy-mm'
        }).on('changeDate', function(ev){
            var thisclick = jQuery(this);
            var val = thisclick.val();
            var valto = jQuery('.txt-inputto').val();
            jQuery('.tdtxt-period').text(val);
            if(valto)
            {
                jQuery('.tdtxt-period').text(val+' , '+valto);
            }
            if(flag_reset==false)
            {
                handleAjaxReport();
            }
        });

        $('.txt-inputto').datepicker({
            minViewMode: 1,
            autoclose: true,
            format: 'yyyy-mm'
        }).on('changeDate', function(ev){
            var thisclick = jQuery(this);
            var val = thisclick.val();
            var valfrom = jQuery('.txt-inputfrom').val();
            jQuery('.tdtxt-period').text(val);
            if(valfrom)
            {
                jQuery('.tdtxt-period').text(valfrom+' , '+val);
            }
            if(flag_reset==false)
            {
                handleAjaxReport();
            }
        });
    };

    var handleChart_one = function(xaxies, data_all, data_one, data_two) {
        /*var categories_data = ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas'];
        var data_one = [5, 3, 4, 7, 2];
        var data_two = [2, 2, 3, 2, 1];*/
        var categories_data = xaxies;
        var data_one = data_one;
        var data_two = data_two;

        var series_data = [{
            name: 'All',
            data: data_all
        },{
            name: 'Waiting',
            data: data_one
        },{
            name: 'Replied',
            data: data_two
        }];
        
        if(jQuery('.inquirystatus-select>option:selected').text().trim() == "Waiting")
        {
            var series_data = [{
                name: 'All',
                data: data_all
            },{
                name: 'Waiting',
                data: data_one
            }];
        }
        if(jQuery('.inquirystatus-select>option:selected').text().trim() == "Replied")
        {
            var series_data = [{
                name: 'All',
                data: data_all
            },{
                name: 'Replied',
                data: data_two
            }];
        }

        var options = {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Number of Inquiries'
            },
            xAxis: {
                categories: categories_data
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'No. of Inquiries'
                },
                labels: {
                    format: '{value}',
                },
            },
            tooltip: {
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                //shared: true
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                    }
                }
            },
            series: series_data,
            credits: {
                enabled: false
            },
        };
        $('#report_chart_column_1').highcharts(options);
    };

    var handlePrintChart = function() {
        jQuery(document).on('click','.print-chart',function() {
            $(".chartprint").print({
                //Don't print this
                noPrintSelector : ".avoid-this",
                //Custom stylesheet
                stylesheet : "assets/css/customprint.css",
            });
        });
    };

    var handlePrintTable = function() {
        jQuery(document).on('click','.print-table',function() {
            $(".chartprint").print({
                //Don't print this
                noPrintSelector : ".avoid-this",
                //Custom stylesheet
                stylesheet : "assets/css/customprint.css",
            });
        });
    };

    var handlePDFTable = function() {
        $(document).on('click', ".htmlpdftable",function(){
            var doc = new jsPDF();
            var specialElementHandlers = {
                '#editor': function(element, renderer){
                    return true;
                }
            };
            doc.fromHTML($('body').get(0), 15, 15, {
                'width': 170, 
                'elementHandlers': specialElementHandlers
            });
            doc.save('Download.pdf');
        });
    };

    var handlePDFChart = function() {
        $(".htmlpdfchart").on('click', function(){
        });
    };

    return {
        init: function () {
            handleBtnClear();
            handleInputDate();
            //handleDataTable();
            //handleChart_one();
            handlePrintChart();
            handlePrintTable();
            handlePDFChart();
            handlePDFTable();
            handleChangeElements();
            handleAjaxReport();
        }
    };

}();

jQuery(document).ready(function() {
    reportAttar.init();
});