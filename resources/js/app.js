import './bootstrap';


$(document).ready(function() {
    /**
     * Animations
     */
    // On Start
    $('#home-center-banner').click( function() {
        $(this).animate({'width': '600px'}, 1000, 'ease');
    });
    console.log("Ready");
    // Alert
    $('.alert').delay(2500).fadeTo(500, 0).slideUp(500);

})