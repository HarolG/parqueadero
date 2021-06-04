$(document).ready(function () {
    $('#ella').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - Lo sentimos",
            "info": "Mostar la página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Busqueda entre _MAX_ registros totales)"
        },
        scrollY: 400,
        scrollX: false,
        scrollCollapse: true,
        lengthMenu: [[5, 10, 25, 50], [5, 10, 25, 50, "All"]],

    });
});