/**
 * Created by User on 14/01/2020.
 */
let ImpOrder = function () {

    let initTable = function () {
        $('#datatable_order').DataTable({
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
                {title: 'Id', data: 'id'},
                {title: 'Comprador', data: 'name'},
                {title: 'Barcode', data: 'barcode'},
                {title: 'Creado el', data: 'updated_at'},
                {title:  'Acciones', data: 'id', width: '200px'}
            ],
            columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    class: 'td-actions text-right',
                    render: function (data, type, full, meta) {
                            return `<form action="order/delete/${full.id}" method="post">
                            <input type="hidden" name="_token" value="TWcX32NXFMc2axMctaciXT1nDENcT9eVjLeYNWpL">                                  <input type="hidden" name="_method" value="delete">
                            <a rel="tooltip" class="btn btn-info btn-link" href="order/products/${full.id}" data-original-title="" title="Productos">
                            <i class="material-icons">widgets</i>
                            <div class="ripple-container"></div>
                            </a>
                            <a rel="tooltip" class="btn btn-success btn-link" href="order/edit/${full.id}" data-original-title="" title="Editar">
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
                    targets: 1,
                    render: function (data, type, full, meta) {
                        return full.name + " " + full.last_name;
                },
                }

            ],

            initComplete: function () {

            }
        });
    };

    let initSelect = function () {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        if ( $("#select_client").length > 0) {
            $("#select_client").select2({
                ajax: {
                  url: "/client/select",
                  type: "post",
                  dataType: 'json',
                  delay: 250,
                  data: function (params) {
                    return {
                      _token: CSRF_TOKEN,
                      search: params.term // search term
                    };
                  },
                  processResults: function (response) {
                    return {
                      results: response
                    };
                  },
                  cache: true
                }
              });
        }
        if ( $("#order_city").length > 0) {

          $("#order_city").select2({
            ajax: {
              url: "/client/selectCity",
              type: "post",
              dataType: 'json',
              delay: 250,
              data: function (params) {
                return {
                  _token: CSRF_TOKEN,
                  search: params.term // search term
                };
              },
              processResults: function (response) {
                return {
                  results: response
                };
              },
              cache: true
            }
          });
        }
    }

    return {
        init: function () {
            initTable();
            initSelect();
        }
    };
}();

jQuery(document).ready(function () {
    ImpOrder.init();
});
