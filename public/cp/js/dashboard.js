var Dashboard = function() {

    return {

        changeTab: function(){
            jQuery(document).on("click",".today-tab",function(){
                jQuery(".blog-noresult").show();
                jQuery(".blog-item").each(function(){
                    if(!jQuery(this).hasClass("today"))
                        jQuery(this).hide();
                    else{
                        jQuery(this).show();
                        jQuery(".blog-noresult").hide();
                    }
                });
            });

            jQuery(document).on("click",".week-tab",function(){
                jQuery(".blog-noresult").show();
                jQuery(".blog-item").each(function(){
                    if(!jQuery(this).hasClass("week"))
                        jQuery(this).hide();
                    else{
                        jQuery(this).show();
                        jQuery(".blog-noresult").hide();
                    }
                });
            });

            jQuery(document).on("click",".month-tab",function(){
                jQuery(".blog-noresult").show();
                jQuery(".blog-item").each(function(){
                    jQuery(this).show();
                    jQuery(".blog-noresult").hide();
                });
            });
        },

        changeCommentStatus: function(){
            jQuery(document).on('click', '.chn-status', function () {
                thisclick = jQuery(this);
                jQuery.ajax({
                    url: jQuery(this).attr('href'),
                    type: 'GET',
                    dataType: "json",
                    success: function (data) {
                        if (data.status) {
                            thisclick.parents(".item").remove();
                            toasterMessage("success", data.message, "Changed Successfully");
                        }
                    }
                });

                return false;
            });
        },

        initSparklineCharts: function() {
            if (!jQuery().sparkline) {
                return;
            }
            $("#sparkline_bar").sparkline([8, 9, 10, 11, 10, 10, 12, 10, 10, 11, 9, 12, 11, 10, 9, 11, 13, 13, 12], {
                type: 'bar',
                width: '100',
                barWidth: 5,
                height: '55',
                barColor: '#35aa47',
                negBarColor: '#e02222'
            });

            $("#sparkline_bar2").sparkline([9, 11, 12, 13, 12, 13, 10, 14, 13, 11, 11, 12, 11, 11, 10, 12, 11, 10], {
                type: 'bar',
                width: '100',
                barWidth: 5,
                height: '55',
                barColor: '#ffb848',
                negBarColor: '#e02222'
            });
        },

        initDashboardDaterange: function() {

            if (!jQuery().daterangepicker) {
                return;
            }

            $('#dashboard-report-range').daterangepicker({
                    opens: (App.isRTL() ? 'right' : 'left'),
                    startDate: moment().subtract('days', 29),
                    endDate: moment(),
                    showDropdowns: false,
                    showWeekNumbers: false,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    buttonClasses: ['btn btn-sm'],
                    applyClass: ' blue',
                    cancelClass: 'default',
                    format: 'YYYY-MM-DD',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Apply',
                        fromLabel: 'From',
                        toLabel: 'To',
                        customRangeLabel: 'Custom Range',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                    }
                },
                function(start, end) {
                    $('#dashboard-report-range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
            );


            $('#dashboard-report-range span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#dashboard-report-range').show();
        },

        init: function() {

            this.initSparklineCharts();
            this.initDashboardDaterange();
            
            this.changeTab();
            this.changeCommentStatus();
        }
    };

}();

if (App.isAngularJsApp() === false) { 
    jQuery(document).ready(function() {
        Dashboard.init(); // init metronic core componets

        jQuery(window).load(function(){
            jQuery(".blog-item").each(function(){
                if(!jQuery(this).hasClass("today"))
                    jQuery(this).hide();

                if(jQuery(".today").length)
                    jQuery(".blog-noresult").hide();
            });
        });
    });
}

