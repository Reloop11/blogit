$(document).ready(function() {
    
    $(document).on('change paste keyup', '.is-invalid', function() {
        let item = $(this);
        item.siblings('.invalid-feedback').fadeOut(200).slideUp(400);
        item.removeClass('is-invalid');
    });

    $('.is-invalid').siblings('.invalid-feedback').show();
});