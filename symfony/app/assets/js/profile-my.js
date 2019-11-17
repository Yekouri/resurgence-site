$(document).ready(function () {  
    $('.card-link.delete-button').click(function(event) {
        if (confirm('Are you sure?')) {
            var $id = $(event.target).parent().data('id');

            fetch('/profile/delete?' + $.param({id: $id}), {
                method: 'DELETE'
            }).then(res => window.location.reload());
        }
    })  
});