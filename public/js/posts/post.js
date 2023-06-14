$(document).ready(function () {
    $(document).on('click', '.post-link-container', function(event) {
        let link = $(this).find('.post-link').attr('href');
        
        if (link) {
            window.location.href = link;
        }
    });
});