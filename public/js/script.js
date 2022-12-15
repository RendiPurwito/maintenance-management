// Datatable
$(document).ready(function () {
    $('#table').DataTable({
        dom: 'lfrtip',
        responsive: true,
        pagingType: 'full_numbers',
        pageLength: 10,
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, 'All'],
        ],
        // buttons: [
        //     'colvis'
        // ],
    });
});

$('#submitButton').on('click', function (e) {
    e.preventDefault();
    var form = $(this).parents('form');
    swal({
        icon: "warning",
        title: "Are you sure?",
        text: "Save this user definition?",
        buttons: true,
        dangerMode: true
    }).then((isConfirm) => {
        if (isConfirm) {
            form.submit();
            swal({
                icon: "success",
                title: 'User successfully created!',
            });
        }
    });
});

$('#submitEditButton').on('click', function (e) {
    e.preventDefault();
    var form = $(this).parents('form');
    swal({
        icon: "warning",
        title: "Are you sure?",
        text: "Save this user definition?",
        buttons: true,
        dangerMode: true
    }).then((isConfirm) => {
        if (isConfirm) {
            form.submit();
            swal({
                icon: "success",
                title: 'User successfully updated!',
            });
        }
    });
});

// function confirmDel(id) {
//     let url = $('#deleteButton').attr('data-name');
//     let name = $('#deleteButton').attr('data-message');
//     swal({
//         icon: 'warning',
//         title: 'Are you sure?',
//         text: "Delete user" + name + '?',
//         buttons: true,
//         dangerMode: true
//     }).then((willDelete) => {
//         if (willDelete) {
//             window.location = "/admin/" + url + "/" + id
//             swal({
//                 icon: "success",
//                 title: 'User successfully deleted!',
//             });
//         }
//     })
// }

$('#deleteButton').on('click', function (e) {
    e.preventDefault();
    var form = $(this).parents('form');
    var message = $('#deleteButton').attr('data-message');
    // var name = $('#deleteButton').attr('data-name');
    swal({
        icon: "warning",
        title: "Are you sure?",
        text: message,
        buttons: true,
        dangerMode: true
    }).then((isConfirm) => {
        if (isConfirm) {
            form.submit();
            swal({
                icon: "success",
                title: 'User successfully deleted!',
            });
        }
    });
});

$('.sidebar-toggler').on('click', function (e) {
    $('.image').toggle();
})



