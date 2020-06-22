
var InquiryDetails = function () {

    var handleOfferTable = function() {
        $.each( $('.offer-region table', this.$el), function( index, table ){
            var rowspan = 0;
            $.each( $('tr', table), function( index, tr ){
                if( rowspan > 0 ){
                    $('td:first-child', tr).addClass("not-first-child");
                    rowspan = (rowspan>0) ? rowspan-1 : 0;
                } else if( $('td:first-child', tr).attr("rowspan") > 0){
                    rowspan = parseInt( $('td:first-child', tr).attr("rowspan")) - 1;
                }
            });
        });
    };

    return {
        init: function () {
            handleOfferTable();
        }
    };

}();

jQuery(document).ready(function() {
    InquiryDetails.init();
});