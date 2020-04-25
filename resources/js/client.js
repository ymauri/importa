/**
 * Created by User on 14/01/2020.
 */
let ImpClient = function () {
    let table_order;
    let timeout = false;
    let requestTimeout = 1000;

    let initTable = function () {
       table_order = $('#datatable_client').DataTable({
            responsive: true,
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'p><'col-sm-12 col-md-7 text-right'i>>`,
            pageLength: 10,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: 'client/dt',
                type: 'GET'
            },

            columns: [
                {title: 'Nombre', data: 'name'},
                {title: 'Apellidos', data: 'last_name'},
                {title: 'Correo Electrónico', data: 'email'},
                {title:  'Acciones', data: 'id', width: '200px'}
            ],
            columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    class: 'td-actions text-right',
                    render: function (data, type, full, meta) {
                            token = $('meta[name="csrf-token"]').attr('content');
                            return `<form action="client/delete/${full.id}" method="post">
                            <input type="hidden" name="_token" value="${token}">                                  <input type="hidden" name="_method" value="delete">
                            <a rel="tooltip" class="btn btn-success btn-link" href="client/edit/${full.id}" data-original-title="" title="Editar">
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

            initComplete: function() {
                $('#order-global-search').on('keyup', function() {
                    if (timeout) {
                        clearTimeout(timeout);
                    }
                    timeout = setTimeout(function() {
                        offset = 0;
                        table_order.search($('input.search').val()).draw();
                    }, requestTimeout);

                });
            }
        });
    };

    //select_city
    let initSelect = function () {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $("#select_city").select2({
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

    return {
        init: function () {
            initTable();
            initSelect();
        }
    };
}();

jQuery(document).ready(function () {
    ImpClient.init();
});
