$(document).ready(function () {
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      dropdownContainer: document.body,
      initialCountry: "ps",
      placeholderNumberType: "MOBILE",
      dropdownContainer: document.body,
      utilsScript: "/3ommal/js/vendors/intlTellInput/utils.js",
    });
    var countryData = window.intlTelInputGlobals.getCountryData(),
      input = document.querySelector("#phone");

    for (var i = 0; i < countryData.length; i++) {
      var country = countryData[i];
      country.name = country.name.replace(/.+\((.+)\)/, "$1");
    }

    window.intlTelInput(input, {
      preferredCountries: ["ps"],
      utilsScript: "/3ommal/js/vendors/intlTellInput/utils.js?1585994360633", // just for formatting/placeholders etc
    });

    $(".modal-view").click(function () {
      $(".modal").toggleClass('show');

    });


    $(".modal-message-view").click(function () {
      $(".modal-footer").fadeToggle();
      setTimeout(function() {
        $(".modal-footer").fadeOut();
      }, 2000);
    });




  });
   