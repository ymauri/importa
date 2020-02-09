/**
 * Created by User on 14/01/2020.
 */
let ImpProduct = function () {

    let initTable = function () {
        $('#datatable_product').DataTable({
            responsive: true,
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'p><'col-sm-12 col-md-7 text-right'i>>`,
            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: 'product/dt',
                type: 'GET'
            },

            columns: [
                {title: 'Nombre', data: 'name'},
                {title: 'Modelo', data: 'model'},
                {title: 'Marca', data: 'brand'},
                {title:  'Acciones', data: 'id', width: '200px'}
            ],
            columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    class: 'td-actions text-right',
                    render: function (data, type, full, meta) {
                            token = $('meta[name="csrf-token"]').attr('content');
                            return `<form action="product/delete/${full.id}" method="post">
                            <input type="hidden" name="_token" value="${token}">
                            <input type="hidden" name="_method" value="delete">
                            <a rel="tooltip" class="btn btn-success btn-link" href="product/edit/${full.id}" data-original-title="" title="Editar">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            </a>
                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="Eliminar" onclick="confirm('Confirmar acción') ? this.parentElement.submit() : ''">
                                <i class="material-icons">close</i>
                                <div class="ripple-container"></div>
                            <div class="ripple-container"></div></button>
                        </form>`
                    },
                }
            ],

            initComplete: function () {

            }
        });
    };

    return {
        init: function () {
            initTable();
        }
    };
}();

jQuery(document).ready(function () {
    ImpProduct.init();
});
