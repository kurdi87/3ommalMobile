var flag=true;
var lists = function () {

    var handleUnsubscribeEmail = function() {
        jQuery(document).on('click','.btn-unsubscribe',function() {
            var thisclick = jQuery(this);
            bootbox.confirm("Are you sure?", function(result) {
                if(result==true && flag)
                {
                    flag=false;
                    jQuery.ajax({
                        type: 'GET',
                        url: thisclick.attr('href'),
                        dataType: 'json',
                        data: thisclick.serialize(),
                        beforeSend: function () {
                            if((jQuery('body').hasClass('body-site')==false))
                            {
                                App.blockUI({boxed: true});
                            }
                        },
                        success: function (data) {
                            flag = true;
                            if(jQuery('body').hasClass('body-site')==false) {App.unblockUI()}
                            if (data.status) {
                                oTable.draw();
                                toasterMessage("success", data.message, "Success Message");
                            } else {
                                toasterMessage("error", data.message, data.title);
                            }
                        }
                    });
                }
            });

            return false;
        });
    };

    var handleAddMember = function() {
        jQuery(document).on('click','.btn-addmemeber',function() {
            var thisclick = jQuery(this);
            jQuery('#modal-updatemember').find('.modal-title').text('Add Member');
            jQuery(".updatemember-form").attr("action",thisclick.attr("href"));
            jQuery('#modal-updatemember').modal('show');
            $('#modal-updatemember').on('shown.bs.modal', function () {
                $('.txtinput-email').focus();
            });
            return false;
        });

        jQuery(document).on("submit",".updatemember-form",function(){
            if(flag){
                flag=false;
                var thisclick=jQuery(this);
                jQuery.ajax({
                    type: 'POST',
                    url: thisclick.attr('action'),
                    dataType: 'json',
                    data: thisclick.serialize(),
                    beforeSend: function () {
                        if((jQuery('body').hasClass('body-site')==false))
                        {
                            App.blockUI({boxed: true});
                        }
                    },
                    success: function (data) {
                        flag = true;
                        if(jQuery('body').hasClass('body-site')==false) {App.unblockUI()}
                        if (data.status) {
                            oTable.draw();
                            jQuery('#modal-updatemember').modal('hide');
                            $('.txtinput-email').val("");
                            toasterMessage("success", data.message, "Success Message");
                        } else {
                            toasterMessage("error", data.message, data.title);
                        }
                    }
                });
            }

            return false;
        });
    };

    var handleUpdateMember = function() {
        jQuery(document).on('click','.btn-updatemember',function() {
            var thisclick = jQuery(this);
            var email_text = jQuery(this).parents('tr').find('.btn-editmember').text().trim();
            jQuery('#modal-updatemember').find('.modal-title').text('Update Member');
            jQuery('#modal-updatemember').find('.input-emailmember').removeClass('error-required');
            jQuery('#modal-updatemember').find('.error-msg-validation').remove();
            jQuery('#modal-updatemember').find('.input-emailmember').val(email_text);
            jQuery(".updatemember-form").attr("action",thisclick.attr("href"));
            jQuery('#modal-updatemember').modal('show');
            $('#modal-updatemember').on('shown.bs.modal', function () {
                $('.txtinput-email').focus();
            });
            return false;
        });

    };

    var handleBtnDeleteMember = function() {
        jQuery(document).on('click','.btn-unsubscribe',function() {
            var thisclick = jQuery(this);
            bootbox.confirm("Are you sure?", function(result) {
                if(result==true && flag)
                {
                    flag=false;
                    jQuery.ajax({
                        type: 'DELETE',
                        url: thisclick.attr('href'),
                        dataType: 'json',
                        beforeSend: function () {
                            if((jQuery('body').hasClass('body-site')==false))
                            {
                                App.blockUI({boxed: true});
                            }
                        },
                        success: function (data) {
                            flag = true;
                            if(jQuery('body').hasClass('body-site')==false) {App.unblockUI()}
                            if (data.status) {
                                oTable.draw();
                                toasterMessage("success", data.message, "Success Message");
                            } else {
                                toasterMessage("error", data.message, data.title);
                            }
                        }
                    });
                }
            });
            
            return false;
        });
    };

    var handleImportList = function(){
        jQuery(document).on('change', '.upload-list', function () {

            if (flag == true) {
                flag = false;
                var my_file = this.files[0];
                var my_button = jQuery(this);
                var file = jQuery(this).val();
                var extension = file.substr((file.lastIndexOf('.') + 1)).toLowerCase();
                var type = false;
                if (extension == 'csv')
                    type = true;

                if (type == true) {
                    var fd = new FormData();
                    fd.append("choose-file", my_file);
                    jQuery.ajax({
                        url: 'cp-attar/maillist/importList',
                        type: 'POST',
                        data: fd,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        xhr: function(){
                            var xhr = new window.XMLHttpRequest();
                            $(".progress-striped").show();
                            xhr.upload.addEventListener('progress', function (e) {
                                if (e.lengthComputable) {
                                    var prog = (e.loaded / e.total) * 100 + '%';
                                    jQuery('.progress-bar').css('width', prog);
                                }
                            }, false);

                            return xhr;
                        },
                        beforeSend: function () {
                            $(".progress-striped").show();
                        },
                        success: function (data) {
                            flag = true;
                            $(".progress-striped").hide();
                            jQuery('#modal-import').modal('hide');
                            
                            oTable.draw();
                            if (data.status == true) {
                                toasterMessage("success", data.message, "Upload Success");
                            }else{
                                toasterMessage("error", message, data.title);
                            }
                        }
                    });

                } else {
                    flag = true;
                    jQuery(this).val("");
                    var message = '';
                    if (type == false)
                        message = 'format not accepted';
                    toasterMessage("error", message, "Upload Error");
                }
            }
        });
    }

    var handleOpenImport = function() {
        jQuery(document).on('click','.btn-modalimport',function() {
            var thisclick = jQuery(this);
            jQuery('#modal-import').modal('show');
            return false;
        });
    };

    return {
        init: function () {
            handleUnsubscribeEmail();
            handleAddMember();
            handleUpdateMember();
            handleImportList();
            handleOpenImport();
        }
    };

}();

jQuery(document).ready(function() {
    lists.init();

    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "cp-attar/maillist/list",
        columnDefs: [
            {orderable: false, targets: -1},
            {orderable: false, targets: 0},
            {orderable: false, targets: 1},
        ],
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action'},
        ],
        "fnDrawCallback": function (oSettings) {
            oTable.column(0).nodes().each(function (cell, i) {
                cell.innerHTML = (parseInt(oTable.page.info().start)) + i + 1;
            });
        },
        //responsive: true,
        "autoWidth": false,
        "scrollX": true,
        "pagingType": "bootstrap_full_number"
    });

    jQuery(window).resize(function() {
        oTable.columns().search('').draw();
    });
});