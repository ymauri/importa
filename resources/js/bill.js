/**
 * Created by User on 14/01/2020.
 */
let ImpOrder = function() {
    let products;
    let ordersTables;
    let initTable = function() {
        if ($('#datatable_bills').length > 0) {
            ordersTables = $('#datatable_bills').DataTable({
                responsive: true,
                // Pagination settings
                dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'p><'col-sm-12 col-md-7 text-right'i>>`,
                pageLength: 10,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/order/enterprise/dt',
                    type: 'GET'
                },

                columns: [
                    { title: 'Id', data: 'id' },
                    { title: 'Name', data: 'name' },
                    { title: 'Email', data: 'email' },
                    { title: 'Acciones', data: 'id', width: '200px' }
                ],
                columnDefs: [{
                    targets: -1,
                    orderable: false,
                    class: 'td-actions text-right',
                    render: function(data, type, full, meta) {
                        return `<form action="/order/enterprise/delete/${full.id}" method="post">
                            <input type="hidden" name="_token" value="${ $('meta[name="csrf-token"]').attr('content')}">                                  <input type="hidden" name="_method" value="delete">
                            <a rel="tooltip" class="btn btn-success btn-link" href="/order/enterprise/bill/${data}" data-original-title="" title="Factura">
                                <i class="material-icons">list_alt</i>
                                <div class="ripple-container"></div>
                                </a>
                            <a rel="tooltip" class="btn btn-success btn-link" href="/order/enterprise/edit/${full.id}" data-original-title="" title="Editar">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            </a>

                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="Eliminar" onclick="confirm('Confirmar acción') ? this.parentElement.submit() : ''">
                                <i class="material-icons">close</i>
                                <div class="ripple-container"></div>
                            <div class="ripple-container"></div></button>
                        </form>`
                    },
                }, ],

            });
        }

    };

    //select_city
    let initSelect = function() {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        if ($('#select_city').length > 0) {
            $("#select_city").select2({
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

        if ($('#select_bulto').length > 0) {
            $("#select_bulto").select2({
                ajax: {
                    url: "/order/enterprise/selectOrder",
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

    let initCalcs = function() {
        $('input').on('keyup', function() {
            let id = $(this).attr('id').split('-');
            let qty = $('#qty-' + id[1]).val();
            let unit = $('#unit-' + id[1]).val();
            let product = 0;
            $('#total-' + id[1]).val(parseFloat(qty * unit, 2));

            $('.product').each(function() {
                if ($(this).val()) {
                    product += parseFloat($(this).val());
                }
            });
            $('#total-charter_products').val(product);
            $('#unit-charter').val(product);
            $('#total-charter').val(product * $("#qty-charter").val());

            let envio = 0;
            let mercancia = parseFloat($('#mercancia').val());
            $('.envio').each(function() {
                if ($(this).val()) {
                    envio += parseFloat($(this).val());
                }
            });
            $('#total-total_shipping').val(envio);
            $('#total-total_shipping_ware').val(envio + mercancia);
        });
    }

    return {
        init: function() {
            initTable();
            initSelect();
            initCalcs();
        }
    };
}();

jQuery(document).ready(function() {
    ImpOrder.init();
});