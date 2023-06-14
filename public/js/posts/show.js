$(document).ready(function () {
    $('.post-delete').click(function(event) {
        event.preventDefault();
        
        if (confirm('Are you sure of deleting this post. This action can\'t be undone')) {
            $(this).closest('form').submit();
        }
    });
});