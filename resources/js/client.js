/**
 * Created by User on 14/01/2020.
 */
let ImpClient = function () {

    let initTable = function () {
        $('#datatable_client').DataTable({
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
                {title:  'Acciones', data: 'id', width: '85px'}
            ],
            columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return `<a rel="tooltip" class="btn btn-success btn-link" href="client/edit/${full.id}" data-original-title="" title="Editar">
                            <i class="material-icons">edit</i> <div class="ripple-container"></div> <div class="ripple-container"></div></a>`;
                    },
                }
            ],

            // language: {
            //     // url: '/i18n/dt_'+ODCHelpers.lang()+'.json'
            // },


            // select: {
            //     style:    'os',
            //     selector: 'td:first-child'
            // },

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
    ImpClient.init();
});
