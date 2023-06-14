$(document).ready(function () {
    $('.delete-post').click(function(event) {
        event.preventDefault();
        let postTitle = $(this).closest('form').siblings('a:first').text();

        if (confirm('Are you sure of deleting the post:\n' + postTitle + '\n\nThis action can\'t be undone')) {
            $(this).closest('form').submit();
        }
    });

    $('.disable-all *').prop('disabled', true).off('click');
    
    $(window).on('load', function() {
        $('#search-bar').val('');
    })
});