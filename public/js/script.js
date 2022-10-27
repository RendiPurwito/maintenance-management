$(document).ready(function () {
    $('#table').DataTable({
        dom: 'Bfrtip',
        // pageLength: 10,
        // lengthMenu: [
        //     [5, 10, 25, 50, -1],
        //     [5, 10, 25, 50, 'All'],
        // ],
        pagingType: 'full_numbers',
        buttons: [
            'colvis'
        ]
    });
});

// const showbtn = document.querySelectorAll('.show-btn') 
// const actionbtn = document.querySelectorAll('.action-btn') 

// for( let i = 0; i < showbtn.length; i++){ 
//     $(showbtn[i]).on('click',function(e){ 
//         e.preventDefault();
//         $(actionbtn[i]).toggle("slide");
//     }) 
// }

// $('.show-btn').on('click', function (e) {
// $('.addproduct').each(function () {}
// e.preventDefault(); $('.action-btn').toggle("slide");
// });

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

function confirmDel(id) {
    let url = $('#deleteButton').attr('data-name');
    let message = $('#deleteButton').attr('data-message');
    swal({
        icon: 'warning',
        title: 'Are you sure?',
        text: message,
        buttons: true,
        dangerMode: true
    }).then((willDelete) => {
        if (willDelete) {
            window.location = "/admin/" + url + "/" + id
            swal({
                icon: "success",
                title: 'User successfully deleted!',
            });
        }
    })
}