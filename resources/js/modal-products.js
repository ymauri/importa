/**
 * Created by User on 14/01/2020.
 */
let ImpModalProducts = function () {
    let table;
    let initTable = function () {
        table = $('#datatable_products').DataTable({
            responsive: true,
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'p><'col-sm-12 col-md-7 text-right'i>>`,
            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: '/product/dt',
                type: 'GET'
            },

            columns: [
                {title: 'Nombre', data: 'name'},
                {title: 'Modelo', data: 'model'},
                {title: 'Marca', data: 'brand'},
                {title: 'Cantidad', data: null},
                {title:  'Acciones', data: 'id', width: '200px'}
            ],
            columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    class: 'td-actions text-right',
                    render: function (data, type, full, meta) {
                        return `<form action="/addProduct/${full.id}" method="post" class="m-0">
                        <input type="hidden" name="_token" value="TWcX32NXFMc2axMctaciXT1nDENcT9eVjLeYNWpL">                                  <input type="hidden" name="_method" value="delete">
                        <button type="button" class="btn btn-success btn-link" data-original-title="" title="Eliminar" onclick="confirm('Confirmar acción') ? this.parentElement.submit() : ''">
                            <i class="material-icons">add_shopping_cart</i>
                            <div class="ripple-container"></div>
                        <div class="ripple-container"></div></button>
                        <a rel="tooltip" class="btn btn-danger btn-link" href="#" data-original-title="" title="Adicionar">
                        <i class="material-icons">remove_shopping_cart</i>
                        <div class="ripple-container"></div>
                        </a>
                    </form>`

                    },
                },
                {
                    targets: 3,
                    orderable: false,
                    class: 'td-actions text-right',
                    render: function (data, type, full, meta) {
                        return `<input class="form-control qty float-right w-25 text-right" data-product="${full.id}"  value="1"/>`
                    },
                }
            ],

            initComplete: function () {

            }
        });
    };

    let initModal = function () {
        $('#show-modal').click(function(e){
            e.preventDefault();
            if ( !$.fn.dataTable.isDataTable( '#datatable_products' )) {
                initTable();
            }
            $('#areaProductoList').modal().show();
        })
    }

    return {
        init: function () {
            initModal()
        }
    };
}();

jQuery(document).ready(function () {
    ImpModalProducts.init();
});
