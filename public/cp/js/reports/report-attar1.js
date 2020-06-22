
var reportAttar = function () {
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var handleAjaxReport = function() {
        var package_no = jQuery('.nopackages-select').val();
        var date_from = jQuery('.txt-inputfrom').val();
        var date_to = jQuery('.txt-inputto').val();
        var package_types_select = jQuery('.packagetype-select').val();
        //console.log(package_types_select);
        var package_types = [];
        if(package_types_select != null)
        {
            package_types = package_types_select;
        }
        jQuery.ajax({
            type: 'GET',
            url: 'http://dcetest.com/new_attar/public/cp-attar/topBooking',
            data: {
                packagesNo: package_no,
                'types[]': package_types,
                from: date_from,
                to: date_to
            },
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                flag_reset = false;
                var result = data;
                var xaxies = [];
                var yaxies = [];
                var serial = [];
                for (var i = 0; i < result.length; i++) {
                    xaxies.push(result[i].Pack_Name);
                    yaxies.push(parseFloat(result[i].bookingNo));
                    serial.push(parseFloat(result[i].rank));
                }
                //console.log(result);
                if(result.length)
                {
                    jQuery('.chart-showing').removeClass('display-none');
                    jQuery('.chartmsg-showing').addClass('display-none');
                    handleChart_one(xaxies, yaxies, serial);
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
                        //"targets": 0
                    }],
                    "order": [[ 0, 'asc' ]],
                    "aaData": result,
                    "aoColumns": [
                        { "mDataProp": "serial" },
                        { "mDataProp": "Pack_Name" },
                        { "mDataProp": "type" },
                        { "mDataProp": "Pack_PublishDate" },
                        { "mDataProp": "Pack_UnpublishedDate" },
                        { "mDataProp": "bookingNo" },
                        { "mDataProp": "rank" }
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
                    /*buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]*/
                });
                oTable.draw();
                /*oTable.on( 'order.dt search.dt', function () {
                    oTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    });
                }).draw();*/
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

    var handleDataTable = function() {
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
    };
    var flag_reset = false;
    var handleChangeElements = function() {
        jQuery(document).on('click','.btn-report-search',function(){
            return false;
        });

        jQuery(document).on('click','.btn-report-reset',function(){
            //jQuery('.nopackages-select,.packagetype-select,.txt-inputfrom,.txt-inputto').change();
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
            setTimeout(function(){
                jQuery('.switch-prank').bootstrapSwitch('state', true);
            },1000);
        });

        jQuery('.nopackages-select').change(function() {
            var thisclick = jQuery(this);
            var val = thisclick.val();
            jQuery('.tdtxt-nopackages').text(val);
            if(flag_reset==false)
            {
                handleAjaxReport();
            }
        });

        jQuery('.packagetype-select').change(function() {
            var thisclick = jQuery(this);
            var val = thisclick.val();
            var thiselm = thisclick.parents('.form-group').find('.select2-selection__rendered>.select2-selection__choice');
            var foo = [];
            thisclick.find('option:selected').each(function(i, selected){
                foo[i] = $(selected).text();
            });
            jQuery('.tdtxt-packagetype').html('').text(foo);
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

        jQuery('.switch-prank').on('switchChange.bootstrapSwitch', function (event, state) {
            if(state==true)
            {
                jQuery('.tdtxt-packagerank').text('Show');
            }
            else
            {
                jQuery('.tdtxt-packagerank').text('Hide');
            }
        });
    };

    var handleChart_one = function(xaxies, yaxies, serial) {
        /*var categories_data = ['Package One', 'Package Two', 'Package Three', 'Package Four', 'Package Five', 'Package Sex'];
        var nobooking_data = [49.9, 71.5, 106.4, 129.2, 144.0, 176.0];*/
        //var rank_data = [7.0, 16.9, 29.5, 0, 121.5];
        var categories_data = xaxies;
        var nobooking_data = yaxies;
        var rank_data = serial;
        var options = {
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'The top Booking Packages'
            },
            subtitle: {
                //text: 'Source: WorldClimate.com'
            },
            xAxis: [{
                categories: categories_data,
                crosshair: true
            }],
            yAxis: [{ // Primary yAxis
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'No. of Booking',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                }
            },{ // Secondary yAxis
                title: {
                    text: 'Rank',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                opposite: true
            }],
            tooltip: {
                //shared: true
            },
            legend: {
                floating: true,
                verticalAlign: 'top',
                align: 'left',
                y: 10,
                x: 50,
                //backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                    }
                },
                series: {
                    dataLabels: {
                        enabled: true,
                    }
                }
            },
            series: [{
                name: 'No. of Booking',
                type: 'column',
                //yAxis: 1,
                data: nobooking_data,
                tooltip: {
                    //valueSuffix: ' mm'
                }
            }, {
                name: 'Rank',
                type: 'spline',
                yAxis: 1,
                data: rank_data,
                tooltip: {
                    //valueSuffix: '°C'
                }
            }],
            credits: {
                enabled: false
            },
        };

        var options2 = {
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'The top Booking Packages'
            },
            subtitle: {
                //text: 'Source: WorldClimate.com'
            },
            xAxis: [{
                categories: categories_data,
                crosshair: true
            }],
            yAxis: [{ // Primary yAxis
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'No. of Booking',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                }
            }],
            tooltip: {
                //shared: true
            },
            legend: {
                floating: true,
                verticalAlign: 'top',
                align: 'left',
                y: 10,
                x: 50,
                //backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                    }
                },
                series: {
                    dataLabels: {
                        enabled: true,
                    }
                }
            },
            series: [{
                name: 'No. of Booking',
                type: 'column',
                //yAxis: 1,
                data: nobooking_data,
                tooltip: {
                    //valueSuffix: ' mm'
                }
            }],
            credits: {
                enabled: false
            },
        };

        if(jQuery('input.switch-prank').prop('checked')==true)
        {
            $('#report_chart_column_1').highcharts(options);
        }
        else
        {
            $('#report_chart_column_1').highcharts(options2);
        }

        jQuery('.switch-prank').on('switchChange.bootstrapSwitch', function (event, state) {
            if(state==true)
            {
                //$($('.highcharts-legend-item')[1]).click();
                $('#report_chart_column_1').highcharts(options);
            }
            else
            {
                $('#report_chart_column_1').highcharts(options2);
            }
        });
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