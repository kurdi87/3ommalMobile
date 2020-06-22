  /*! 
 * 3ommal Web Application
 * Questions Wizard
 * Author Ziad Ziadeh
 * ziadeh50@gmail.com
 */
  //##############################################################################################################################
  //###############################################---Define Wizard Plugin---#####################################################
  //##############################################################################################################################

$("#wizard").steps({
    headerTag: "h5",
    bodyTag: "section",
    contentContainerTag: "div",
    actionContainerTag: "div",
    stepsContainerTag: "div",
    cssClass: "wizard", 
    titleTemplate: "#title#",
    loadingTemplate: '<span class="spinner"></span> #text#', 
    autoFocus: true,
    enableKeyNavigation: false,
    enablePagination: false,
    startIndex: 0, 
    transitionEffectSpeed: 200,
    transitionEffect: "slideLeft" ,
    onInit: function (event, currentIndex) { 
        updatePageHeight(currentIndex);
        setTimeout(() => {
            $("#wizard").show();
        },100);
    },
    onStepChanged: function (event, currentIndex, priorIndex) { 
        updatePageHeight(currentIndex);
    }
});

function updatePageHeight(currentIndex) {
    setTimeout(() => {
        let nextPageHeight = $("#wizard-p-"+ currentIndex).find("div").first().innerHeight();
        $("#wizard .content.clearfix").height(nextPageHeight+140);
    },150);
}

$("a[href=#]").click(function (e) {
    e.preventDefault(); 
});