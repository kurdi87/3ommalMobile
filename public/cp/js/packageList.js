var packages = function () {

    var handleBtnClearPublish = function () {
        jQuery(document).on('click', '.cleardatepublish', function () {
            jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val('');
            jQuery(this).parents('.inputdate-wicon').find('.cleardatepublish').addClass('display-none');
            input_wlbl();
            oTable.columns(4).search(jQuery('#fromPublishedDate').val() + '|' + jQuery('#toPublishedDate').val()).draw();
            return false;
        });
    };

    var handleBtnClearUnPublish = function () {
        jQuery(document).on('click', '.cleardateunpublish', function () {
            jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val('');
            jQuery(this).parents('.inputdate-wicon').find('.cleardateunpublish').addClass('display-none');
            input_wlbl();
            oTable.columns(5).search(jQuery('#fromUnpublishedDate').val() + '|' + jQuery('#toUnpublishedDate').val()).draw();
            return false;
        });
    };

    var handleInputDatePublish = function () {
        jQuery(document).on('change', '.inputdateclearpublish', function () {
            if (jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val()) {
                jQuery(this).parents('.inputdate-wicon').find('.cleardatepublish').removeClass('display-none');
            }
            else {
                jQuery(this).parents('.inputdate-wicon').find('.cleardatepublish').addClass('display-none');
            }
        });
    };

    var handleInputDateUnPublish = function () {
        jQuery(document).on('change', '.inputdateclearunpublish', function () {
            if (jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val()) {
                jQuery(this).parents('.inputdate-wicon').find('.cleardateunpublish').removeClass('display-none');
            }
            else {
                jQuery(this).parents('.inputdate-wicon').find('.cleardateunpublish').addClass('display-none');
            }
        });
    };

    return {
        init: function () {
            handleBtnClearPublish();
            handleBtnClearUnPublish();
            handleInputDatePublish();
            handleInputDateUnPublish();
        }
    };

}();

$(document).ready(function () {
    packages.init();
    jQuery(document).on('click', '#packagetitle,#packagetitle>i,.packagetitle,.packagetitle>i', function () {
        jQuery('.dataTables_scrollBody').addClass('bodytable-overflow');
        return false;
    });

    select_city();

    function select_city()
    {
       if(jQuery('select.city').length)
       {
           jQuery("select.city").select2({
               ajax: {
                  url: "cp-attar/ajax/city",
                  dataType: 'json',
                  width: null,
                  delay: 250,
                  data: function (params) {
                      return {
                          q: params.term, // search term
                          page: params.page
                      };
                  },
                  processResults: function (data, params) {
                      params.page = params.page || 1;

                      return {
                          results: data.data,
                          pagination: {
                              more: (params.page * 30) < data.total
                          }
                      };
                  },
                  cache: true
               },
               escapeMarkup: function (markup) {
                  return markup;
               }, // let our custom formatter work
               minimumInputLength: 1
           });
       }
    }

    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable.draw();
    });
    
    var flag = true;
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "./cp-attar/packages/list",
        "order": [[4, 'desc']],
        columnDefs: [
            {orderable: false, targets: -1},
            {orderable: false, targets: 0},
            {searchable: false, targets: 0},
            {searchable: false, targets: 4},
            {searchable: false, targets: 5}
        ],
        "columns": [
            {data: 'Pack_ID', name: 'Pack_ID'},
            {data: 'Pack_Name', name: 'Pack_Name'},
            {data: 'type', name: 'Pack_Type'},
            {data: 'status', name: 'Pack_Status'},
            {data: 'Pack_PublishDate', name: 'Pack_PublishDate'},
            {data: 'Pack_UnpublishedDate', name: 'Pack_UnpublishedDate'},
            {data: 'SysUsr_FullName', name: 'SysUsr_FullName'},
            {data: 'action', name: 'action'}
        ],
        "fnDrawCallback": function (oSettings) {
            mytooltipster();
            oTable.column(0).nodes().each(function (cell, i) {
                cell.innerHTML = (parseInt(oTable.page.info().start)) + i + 1;
            });
            function package_title() {
                $('#packagetitle,.packagetitle').editable({
                    inputclass: 'inputpackage-title input-medium',
                    type: 'text',
                    pk: 1,
                    placement: "bottom",
                    //value: ,
                    validate: function (value) {
                        if ($.trim(value) == '') return 'This field is required';
                    },
                    display: function (value) {
                        if (value) {
                            var mylink = jQuery(this).attr('href');
                            var newlink = mylink + '?Pack_Name=' + encodeURI(value);
                            var clonelink = encodeURI(newlink);
                            window.location.replace(clonelink);
                            return true;
                        }
                    }
                });
            }

            window.package_title = package_title;
            package_title();

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
        "pagingType": "bootstrap_full_number",
    });
    
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

    $('#fromPublishedDate, #toPublishedDate').change(function () {
        if ($('#fromPublishedDate').val() || $('#toPublishedDate').val()) {
            oTable.columns(4).search(jQuery('#fromPublishedDate').val() + '|' + jQuery('#toPublishedDate').val()).draw();
        }
    });

    $('#fromUnpublishedDate, #toUnpublishedDate').change(function () {
        if ($('#fromUnpublishedDate').val() || $('#toUnpublishedDate').val()) {
            oTable.columns(5).search(jQuery('#fromUnpublishedDate').val() + '|' + jQuery('#toUnpublishedDate').val()).draw();
        }
    });

    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        jQuery(".select2-selection__rendered").remove();
        select_city();
        oTable.columns().search('').draw();
    });

    jQuery(document).on("click", ".publish-package", function () {
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
                        if (data.key == "PACKAGE_PUBLISH") {
                            this_click.find('i').removeAttr('class').addClass('fa fa-edit');
                            this_click.tooltipster('content', 'Draft');
                            this_click.parents('tr').find('.label-sm').text("Publish").removeAttr('class').addClass("label label-sm label-success");
                            this_click.parents('tr').find('.pack_link').attr('href', './cp-attar/packages/preview/' + data.Pack_ID);
                        }
                        else if (data.key == "PACKAGE_TOBEPUBLISHED") {
                            this_click.find('i').removeAttr('class').addClass('fa fa-edit');
                            this_click.tooltipster('content', 'Draft');
                            this_click.parents('tr').find('.label-sm').text("To be Published").removeAttr('class').addClass("label label-sm label-warning");
                            this_click.parents('tr').find('.pack_link').attr('href', './cp-attar/packages/preview/' + data.Pack_ID);
                        }
                        else {
                            this_click.find('i').removeAttr('class').addClass('fa fa-globe');
                            this_click.tooltipster('content', 'Publish');
                            this_click.parents('tr').find('.label-sm').text("Draft").removeAttr('class').addClass("label label-sm label-default");
                            this_click.parents('tr').find('.pack_link').attr('href', './cp-attar/packages/update/' + data.Pack_ID);
                        }
                        toasterMessage("success", "Status changed successfully", "Success Message");
                    } else {
                        bootbox.confirm(data.message, function (result) {
                            if (result) {
                                window.top.location = (data.url + "/cp-attar/packages/preview/" + data.Pack_ID);
                            }
                        });
                    }
                }
            });
        }

        return false;
    });

});