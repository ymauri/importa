/**
 * Created by User on 14/01/2020.
 */
let ImpOrder = function() {
    let products;
    let ordersTables;
    let timeout = false;
    let requestTimeout = 1000;
    let initTable = function() {
        if ($('#datatable_order').length > 0) {
            ordersTables = $('#datatable_order').DataTable({
                responsive: true,
                // Pagination settings
                dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'p><'col-sm-12 col-md-7 text-right'i>>`,
                pageLength: 10,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'order/dt',
                    type: 'GET'
                },

                columns: [
                    { title: 'Id', data: 'id_order' },
                    { title: 'Comprador', data: 'client_name' },
                    { title: 'Destinatario', data: 'dest_name' },
                    { title: 'HBL', data: 'barcode' },
                    { title: 'Tipo', data: 'type' },
                    { title: 'Acciones', data: 'id_order', width: '200px' }
                ],
                columnDefs: [{
                        targets: -1,
                        orderable: false,
                        class: 'td-actions text-right',
                        render: function(data, type, full, meta) {
                            return `<form action="order/delete/${full.id_order}" method="post">
                            <input type="hidden" name="_token" value="${ $('meta[name="csrf-token"]').attr('content')}">                                  <input type="hidden" name="_method" value="delete">
                            <a rel="tooltip" class="btn btn-info btn-link" href="order/products/${full.id_order}" data-original-title="" title="Productos">
                            <i class="material-icons">widgets</i>
                            <div class="ripple-container"></div>
                            </a>
                            <a rel="tooltip" class="btn btn-success btn-link" href="order/edit/${full.id_order}" data-original-title="" title="Editar">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            </a>

                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="Eliminar" onclick="confirm('Confirmar acción') ? this.parentElement.submit() : ''">
                                <i class="material-icons">close</i>
                                <div class="ripple-container"></div>
                            <div class="ripple-container"></div></button>
                        </form>`
                        },
                    },

                    {
                        targets: 4,
                        render: function(data, type, full, meta) {
                            return data == 1 ? "ENA" : "Importacion";
                        },
                    }

                ],

                initComplete: function() {
                    $('input.search').on('keyup', function() {
                        if (timeout) {
                            clearTimeout(timeout);
                        }
                        timeout = setTimeout(function() {
                            offset = 0;
                            ordersTables.search($('input.search').val()).draw();
                        }, requestTimeout);

                    });
                }
            });
        }

    };

    let initTableProductos = function() {
        if ($('#datatable_products_order').length > 0) {
            products = $('#datatable_products_order').DataTable({
                responsive: true,
                // Pagination settings
                dom: `<'row'<'col-sm-12'tr>>
                <'row'<'col-sm-12 col-md-5'p><'col-sm-12 col-md-7 text-right'i>>`,
                pageLength: 10,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/order/productsDt/' + $("#id_order").val(),
                    type: 'GET'
                },

                columns: [
                    { title: 'Nombre', data: 'name' },
                    { title: 'Modelo', data: 'model' },
                    { title: 'Marca', data: 'brand' },
                    { title: 'Cantidad', data: 'quantity' },
                    { title: 'Flete', data: 'charter' },
                    { title: 'Eliminar', data: 'id', width: '200px' }
                ],
                columnDefs: [{
                    targets: -1,
                    orderable: false,
                    class: 'td-actions text-right',
                    render: function(data, type, full, meta) {
                        return `<form action="order/deleteProduct/${full.id}" method="post">
                                <input type="hidden" name="_token" value="">
                                <input type="hidden" name="order" value="">
                                <input type="hidden" name="product" value="${full.id}">
                                <input type="hidden" name="_token" value="${ $('meta[name="csrf-token"]').attr('content')}">                                  <input type="hidden" name="_method" value="delete">
                                <a rel="tooltip" class="btn btn-danger btn-link delete-product" href="#" data-original-title="" title="Eliminar">
                                <i class="material-icons">close</i>
                                <div class="ripple-container"></div>
                                </a>
                            </form>`
                    },
                }],

                initComplete: function() {
                    deleteProduct();
                }
            });
        }

    };


    let deleteProduct = function() {
        $('#datatable_products_order').on('click', '.delete-product', function(e) {
            e.preventDefault();
            form = $(this).closest('form');
            $(form).children('input[name="qty"]').val(
                $('#product-' + $(this).attr('id-product')).val()
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
                success: function(response) {
                    if (order.status === 200) {
                        Imp.notify('success', order.response)
                        products.ajax.reload();
                    } else {
                        Imp.notify('danger', order.response);
                    }
                }
            });
        })
    }

    let updateTableAfterModalClose = function() {
        $(document).on('hidden.bs.modal', '#areaProductoList', function() {
            products.ajax.reload();
        });
    }

    let initSelect = function() {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        if ($("#select_client").length > 0) {
            $("#select_client").select2({
                ajax: {
                    url: "/client/select",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        }
        if ($("#order_city").length > 0) {

            $("#order_city").select2({
                ajax: {
                    url: "/client/selectCity",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        }
        if ($("#select_dest").length > 0) {
            $("#select_dest").select2({
                ajax: {
                    url: "/order/select",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        }

    }

    let initComponents = function() {
        $('input[name="order[type]"]').click(function() {
            if ($(this).val() == 1) {
                $('#destiny-data').hide(300)
                $('#destiny-data input[name="order[name]"], #destiny-data input[name="order[last_name]"], #destiny-data input[name="order[id_city]"]').val("").removeAttr('required').removeAttr('aria-required');
            } else {
                $('#destiny-data').show(300)
                $('#destiny-data input[name="order[name]"], #destiny-data input[name="order[last_name]"], #destiny-data input[name="order[id_city]"]').attr('required', 'required').arrt('aria-required', "true");
            }
        })

        if ($('.datepicker').length > 0) {
            $('.datepicker').datepicker({ format: 'yyyy-mm-dd' });
        }


        $('body').on('change', '#select_dest', function() {
            $.get('get/' + $(this).val(), function(response) {
                let order = response.order;
                let city = response.city;
                $('input[name="order[name]"]').val(order.name);
                $('input[name="order[last_name]"]').val(order.last_name);
                $('input[name="order[email]"]').val(order.email);
                $('input[name="order[ci]"]').val(order.ci);
                $('input[name="order[passport]"]').val(order.passport);
                $('input[name="order[phone]"]').val(order.phone);
                $('input[name="order[mobile]"]').val(order.mobile);
                $('input[name="order[street]"]').val(order.street);
                $('input[name="order[between]"]').val(order.between);
                $('input[name="order[number]"]').val(order.number);
                $('#order_city').children('option').remove();
                let option = new Option(city.name, city.id, true, true);
                $('#order_city').append(option).trigger('change');
                $('#order_city').trigger({
                    type: 'select2:select'
                });
            });
        });

    }

    return {
        init: function() {
            initTable();
            initSelect();
            initTableProductos();
            initComponents();
            updateTableAfterModalClose();
        }
    };
}();

jQuery(document).ready(function() {
    ImpOrder.init();
});