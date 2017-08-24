
$(document).ready(function() {
    // run test on initial page load
    checkSize();

    // run test on resize of the window
    $(window).resize(checkSize);
});

//Function to the css rule
function checkSize(){
  var $earth = $("earthImg")
    if ($("#earthImg").css("float") == "right" ){

        $( "#earthImg" ).insertAfter( $( "#title" ) );

    }
}
