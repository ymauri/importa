/**
 * Created by User on 14/01/2020.
 */
let ImpShipping = function () {
    let table_modal;
    let table_order;
    let timeout = false;
    let requestTimeout = 1000;

    let initTable = function () {
        if ($('#datatable_shipping').length > 0) {
            $('#datatable_shipping').DataTable({
                responsive: true,
                // Pagination settings
                dom: `<'row'<'col-sm-12'tr>>
                <'row'<'col-sm-12 col-md-5'p><'col-sm-12 col-md-7 text-right'i>>`,
                pageLength: 10,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/shipping/dt',
                    type: 'GET'
                },

                columns: [
                    {title: 'Id', data: 'id'},
                    {title: 'Descripción', data: 'description'},
                    {title:  'Acciones', data: 'id', width: '200px'}
                ],
                columnDefs: [
                    {
                        targets: -1,
                        orderable: false,
                        class: 'td-actions text-right',
                        render: function (data, type, full, meta) {
                                return `<form action="shipping/delete/${full.id}" method="post">
                                <input type="hidden" name="_token" value="TWcX32NXFMc2axMctaciXT1nDENcT9eVjLeYNWpL">                                  <input type="hidden" name="_method" value="delete">
                                <a rel="tooltip" class="btn btn-success btn-link" href="shipping/edit/${full.id}" data-original-title="" title="Editar">
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
        }
    };

    let initBultos = function () {
        if ($('#datatable_order').length > 0) {
            table_order = $('#datatable_order').DataTable({
                responsive: true,
                // Pagination settings
                dom: `<'row'<'col-sm-12'tr>>
                <'row'<'col-sm-12 col-md-5'p><'col-sm-12 col-md-7 text-right'i>>`,
                pageLength: 10,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/shipping/ordersDt/' + $('#shipping_id').val(),
                    type: 'GET'
                },

                columns: [
                    {title: 'Id', data: 'id_shipping_order'},
                    {title: 'Destinatario', data: 'name'},
                    {title: 'Barcode', data: 'barcode'},
                    {title: 'Eliminar', data: 'id_order'}
                ],
                columnDefs: [
                    {
                        targets: -1,
                        orderable: false,
                        class: 'td-actions text-right',
                        render: function (data, type, full, meta) {
                                return `<form action="/shipping/delete/" method="post">
                                <input type="hidden" name="_token" value="TWcX32NXFMc2axMctaciXT1nDENcT9eVjLeYNWpL">                                  <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="id_shipping_order" value="${full.id_shipping_order}">
                                <a rel="tooltip" class="btn btn-success btn-link" href="/order/pdf/${data}" data-original-title="" title="Comprobante">
                                <i class="material-icons">picture_as_pdf</i>
                                <div class="ripple-container"></div>
                                </a>
                                <button type="button" class="btn btn-danger btn-link delete-bulto" data-original-title="" title="Eliminar" >
                                    <i class="material-icons">close</i>
                                    <div class="ripple-container"></div>
                                <div class="ripple-container"></div></button>
                            </form>`
                        },
                    },
                    {
                        targets: 1,
                        render: function (data, type, full, meta) {
                            return full.name + " " + full.last_name;
                    },
                    }

                ],

                initComplete: function () {

                }
            });
        }
    }

    let initTableModal = function () {
        table_modal = $('#datatable_orders_modal').DataTable({
            responsive: true,
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'p><'col-sm-12 col-md-7 text-right'i>>`,
            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: '/shipping/modalDt/' + $('#shipping_id').val(),
                type: 'GET'
            },

            columns: [
                {title: 'Id', data: 'order'},
                {title: 'Comprador', data: 'name'},
                {title: 'Barcode', data: 'barcode'},
                {title:  'Acciones', data: 'order', width: '200px'}
            ],
            columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    class: 'td-actions text-right',
                    render: function (data, type, full, meta) {
                        return `<form action="/addOrder" method="post" class="m-0">
                        <input type="hidden" name="_token" value="">
                        <input type="hidden" name="id_shipping" value="">
                        <input type="hidden" name="id_order" value="${full.order}">
                        <button type="button" class="btn btn-success btn-link add-order" data-original-title="" title="Adicionar" id-product="${full.order}">
                            <i class="material-icons">add_shopping_cart</i>
                            <div class="ripple-container"></div>
                        <div class="ripple-container"></div></button>
                    </form>`

                    },
                },
                {
                    targets: 1,
                    render: function (data, type, full, meta) {
                        return full.name + " " + full.last_name;
                    }
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

            }
        });
    };

    let initModal = function () {
        $('#show-modal').click(function(e){
            e.preventDefault();
            if ( !$.fn.dataTable.isDataTable( '#datatable_orders_modal' )) {
                initTableModal();
            } else {
                table_modal.ajax.reload();
            }
            $('#areaOrdersList').modal().show();
        })
    }

    let addOrder = function () {
        $('#datatable_orders_modal').on('click', '.add-order', function (e) {
            e.preventDefault();
            form = $(this).closest('form');

            $(form).children('input[name="id_shipping"]').val(
                $('#shipping_id').val()
            )

            $(form).children('input[name="_token"]').val(
                $('meta[name="csrf-token"]').attr('content')
            )
            $.ajax({
                type: "POST",
                url: "/shipping/addOrder",
                data: $(form).serialize(),
                dataType: 'json',
                success: function(response){
                    // response = JSON.parse(response.status)
                    if (response.status === 200) {
                        Imp.notify('success', response.response)
                        table_order.ajax.reload();
                    } else {
                        Imp.notify('danger', response.response);
                    }
                }
              });
        })
    }

    let deleteOrder = function () {
       $('body').on('click', '.delete-bulto', function (e) {
            e.preventDefault();
            form = $(this).closest('form');

            $(form).children('input[name="id_shipping"]').val(
                $('#shipping_id').val()
            )
            $(form).children('input[name="_token"]').val(
                $('meta[name="csrf-token"]').attr('content')
            )
            $.ajax({
                type: "POST",
                url: "/shipping/deleteOrder",
                data: $(form).serialize(),
                dataType: 'json',
                success: function(response){
                    if (response.status === 200) {
                        Imp.notify('success', response.response)
                        table_order.ajax.reload();
                    } else {
                        Imp.notify('danger', response.response);
                    }
                }
              });
        })
    }

    return {
        init: function () {
            initTable();
            initBultos();
            initModal();
            addOrder();
            deleteOrder();
        }
    };
}();

jQuery(document).ready(function () {
    ImpShipping.init();
});
