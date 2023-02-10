$(document).ready(function(){$("#datatable").DataTable({keys:!0});var t=$("#datatable-buttons").DataTable({lengthChange:!1,language: {
    search: "جستجو اطلاعات",
    oPaginate: {
        "sFirst": "صفحه اول", // This is the link to the first page
        "sPrevious": "قبلی", // This is the link to the previous page
        "sNext": "بعدی", // This is the link to the next page
        "sLast": "صفحه آخر" // This is the link to the last page
        }
    
}
});$("#selection-datatable").DataTable({select:{style:"multi"}}),t.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")});