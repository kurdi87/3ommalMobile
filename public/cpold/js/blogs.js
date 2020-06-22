var articles = function () {

    var handleBtnClear = function () {
        jQuery(document).on('click', '.cleardate', function () {
            jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val('');
            jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            input_wlbl();
            oTable.columns(4).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
            return false;
        });
    };

    var handleInputDate = function () {
        jQuery(document).on('change', '.inputdateclear', function () {
            if (jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val()) {
                jQuery(this).parents('.inputdate-wicon').find('.cleardate').removeClass('display-none');
            }
            else {
                jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            }
        });
    };

    return {
        init: function () {
            handleBtnClear();
            handleInputDate();
        }
    };

}();

function loadTable(link) {
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": link,
        "order": [[3,'desc'],[2, 'desc']],
        columnDefs: [
            {orderable: false, targets: -1},
            {orderable: false, targets: 0},
            {searchable: false, targets: 4},
        ],
        "columns": [
            {data: 'Article_ID', name: 'Article_ID'},
            {data: 'ArtLang_ArticleTitle', name: 'ArtLang_ArticleTitle'},
            {data: 'type', name: 'BlogApp_ApprovalStatus'},
            {data: 'status', name: 'Article_Status'},
            {data: 'creation_date', name: 'creation_date'},
            {data: 'fullName', name: 'fullName'},
            {data: 'action', name: 'action'}
        ],
        "fnDrawCallback": function (oSettings) {
            
            oTable.column(0).nodes().each(function (cell, i) {
                cell.innerHTML = (parseInt(oTable.page.info().start)) + i + 1;
            });
            var input=oSettings.oAjaxData;
            input.length="";
            input.start="";
            input=jQuery.param(input);
            input=input.replace("&length=", "");
            input=input.replace("&start=", "");
            $(".exportData").each(function(){
                $(this).attr("href",$(this).data("href")+input);
            });
            mytooltipster();
        },
        //responsive: true,
        "autoWidth": false,
        "scrollX": true,
        "pagingType": "bootstrap_full_number"
    });
}
window.loadTable = loadTable;

jQuery(document).ready(function () {
    var flag = true;
    articles.init();

    jQuery(window).resize(function() {
        oTable.columns().search('').draw();
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

    $('#from, #to').change(function () {
        if ($('#from').val() || $('#to').val()) {
            oTable.columns(4).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
        }
    });

    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable.columns().search('').draw();
    });

    jQuery(document).on("click", ".btn-ustatus", function () {
        if (flag && !jQuery(this).attr("disabled")) {
            flag = false;
            var this_click = jQuery(this);
            jQuery.ajax({
                type: 'GET',
                url: this_click.attr('href'),
                dataType: 'json',
                success: function (data) {
                    flag = true;
                    if (data.status) {
                        if (data.key == "BLOG_STATUS_PUBLISHED") {
                            this_click.find('i').removeAttr('class').addClass('fa fa-edit');
                            this_click.tooltipster('content', 'Draft');
                            this_click.parents('tr').find('.label-status').text("Publish").removeAttr('class').addClass("label label-status label-sm label-success");
                        }
                        else {
                            this_click.find('i').removeAttr('class').addClass('fa fa-globe');
                            this_click.tooltipster('content', 'Publish');
                            this_click.parents('tr').find('.label-status').text("Close").removeAttr('class').addClass("label label-status label-sm label-danger");
                        }

                        this_click.parents('tr').find('.article_link').attr('href', data.link);
                        toasterMessage("success", "Status changed successfully", "Success Message");
                    } else {
                        toasterMessage("error", data.message, "Error Message");
                    }
                }
            });
        }

        return false;
    });
});