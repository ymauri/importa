/**
 * Created by User on 14/01/2020.
 */
let ImpModalProducts = function () {
    let table;
    let timeout = false;
    let requestTimeout = 1000;
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
                        return `<form action="/addProduct" method="post" class="m-0">
                        <input type="hidden" name="_token" value="">
                        <input type="hidden" name="qty" value="">
                        <input type="hidden" name="order" value="">
                        <input type="hidden" name="product" value="${full.id}">
                        <button type="button" class="btn btn-success btn-link add-product" data-original-title="" title="Adicionar" id-product="${full.id}">
                            <i class="material-icons">add_shopping_cart</i>
                            <div class="ripple-container"></div>
                        <div class="ripple-container"></div></button>
                        <a rel="tooltip" class="btn btn-danger btn-link delete-product" href="#" data-original-title="" title="Eliminar">
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
                        return `<input class="form-control qty float-right w-25 text-right" data-product="${full.id}" id="product-${full.id}"  value="1"/>`
                    },
                }
            ],

            initComplete: function () {
                $('input.search').on( 'keyup', function () {
                    if (timeout) {
                        clearTimeout(timeout);
                    }
                    timeout = setTimeout(function() {
                        offset = 0;
                        table.search($('input.search').val()).draw();
                    }, requestTimeout);

                } );
                addProduct();
                deleteProduct();
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
            $().change(function(){})
            $('table#asa').on('change', '#elqueyouiero', function(){

            })

        })
    }

    let addProduct = function () {
        $('#datatable_products').on('click', '.add-product', function (e) {
            e.preventDefault();
            form = $(this).closest('form');
            $(form).children('input[name="qty"]').val(
                $('#product-'+ $(this).attr('id-product')).val()
            )
            $(form).children('input[name="order"]').val(
                $('#id_order').val()
            )
            $(form).children('input[name="_token"]').val(
                $('meta[name="csrf-token"]').attr('content')
            )
            $.ajax({
                type: "POST",
                url: "/order/addProduct",
                data: $(form).serialize(),
                dataType: 'json',
                success: function(response){
                    // response = JSON.parse(response.status)
                    if (response.status === 200) {
                        Imp.notify('success', response.response)
                        drawProductTable();
                    } else {
                        Imp.notify('error', response.response);
                    }
                }
              });
        })
    }

    let deleteProduct = function () {
        $('#datatable_products').on('click', '.delete-product', function (e) {
            e.preventDefault();
            form = $(this).closest('form');
            $(form).children('input[name="qty"]').val(
                $('#product-'+ $(this).attr('id-product')).val()
            )
            $(form).children('input[name="order"]').val(
                $('#id_order').val()
            )
            $(form).children('input[name="_token"]').val(
                $('meta[name="csrf-token"]').attr('content')
            )
            $.ajax({
                type: "POST",
                url: "/order/deleteProduct",
                data: $(form).serialize(),
                dataType: 'json',
                success: function(response){
                    if (response.status === 200) {
                        Imp.notify('success', response.response)
                        drawProductTable();
                    } else {
                        Imp.notify('error', response.response);
                    }
                }
              });
        })
    }

    let drawProductTable = function () {
        //TODO
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
