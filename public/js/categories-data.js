/*!
* 3ommal Web Application
* Questions Wizard
* author Ziad Ziadeh <ziadeh50@gmail.com>
*/
//##############################################################################################################################
//##################################################---Categories Data---#######################################################
//##############################################################################################################################


whatIsIdType = 'ما هو نوع بطاقة الهوية';
/*!
* 3ommal Web Application
* Questions Wizard
* author Ziad Ziadeh <ziadeh50@gmail.com>
*/
//##############################################################################################################################
//##################################################---Categories Data---#######################################################
//##############################################################################################################################



let categories =
    {}



;
$.ajax({
    type: "GET",
    'async': false,
    url: "/category",
    dataType: "json",
    success: function(json) {
        categories[0]=json;
    }
});
$.ajax({
    type: "GET",
    'async': false,
    url: "/subCategory",
    dataType: "json",
    success: function(json) {
        for (var i = 0; i < json.length; i++){
            categories[i+1]=json[i];
        }


    }
});
console.log(categories);



