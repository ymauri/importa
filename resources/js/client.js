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
                {title:  'Acciones', data: 'id', width: '200px'}
            ],
            columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    class: 'td-actions text-right',
                    render: function (data, type, full, meta) {
                            return `<form action="client/delete/${full.id}" method="post">
                            <input type="hidden" name="_token" value="TWcX32NXFMc2axMctaciXT1nDENcT9eVjLeYNWpL">                                  <input type="hidden" name="_method" value="delete">
                            <a rel="tooltip" class="btn btn-success btn-link" href="client/edit/${full.id}" data-original-title="" title="">
                            <i class="material-icons">edit</i>
                            <div class="ripple-container"></div>
                            </a>
                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('Are you sure you want to delete this user?') ? this.parentElement.submit() : ''">
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
    ImpClient.init();
});
