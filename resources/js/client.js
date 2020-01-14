/**
 * Created by User on 14/01/2020.
 */
let ImpClient = function () {

    let initTable = function () {
        $('#datatable_client').DataTable({
            pageLength: 20,
            processing: true,
            serverSide: true,
            // paging: false,

            ajax: {
                url: 'client/dt',
            },

            columns: [
                {title: 'Nombre', data: 'name'},
                {title: 'Apellidos', data: 'last_name'},
                {title: 'Correo Electrónico', data: 'email'},
                {title:  'Acciones', data: 'id'}
            ],

            language: {
                // url: '/i18n/dt_'+ODCHelpers.lang()+'.json'
            },

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
