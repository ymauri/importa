/**
 * Created by User on 14/01/2020.
 */
let ImpCity = function () {

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
            initSelect();
        }
    };
}();

jQuery(document).ready(function () {
    ImpCity.init();
});
