$(document).ready(function() {

    $(document).on('click', '.track', function() {

        swal.fire({
            title: 'Oops!',
            text: "Sorry, this feature is not yet available",
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#ffb854',
            confirmButtonText: 'Okay',
        })

    });
});