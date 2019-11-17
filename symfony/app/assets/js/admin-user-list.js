$(document).ready(function () {  
    $('.delete-user-button').click(function(event) {
        if (confirm('Are you sure?')) {
            var $id = $(event.target).parent().data('id');

            fetch('/admin/user/delete?' + $.param({id: $id}), {
                method: 'DELETE'
            }).then(res => window.location.reload());
        }
    })  
});