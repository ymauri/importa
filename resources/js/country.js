/**
 * Created by User on 14/01/2020.
 */
let ImpCountry = function () {

    //select_city
    let initSelect = function () {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $("#select_country").select2({
            ajax: {
              url: "/client/selectCountry",
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

    let selectState = function () {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $("#select_state").select2({
            ajax: {
              url: "/client/selectCountry",
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
    let checkCountry = function() {
        $('#select_country').change(function(){
            if($(this).val() > 1) {
                $('#select_state').prop('disabled', false);
                $("#select_state").empty();
                filterState($(this).val());

            }
        })
        $('#select_country').trigger('change')
    }

    let filterState = function  (id){
        $.get('/searchState/'+id, function(response) {

            response.forEach(function(state) {
                optionText = state.name;
            optionValue = state.id;

            $('#select_state').append(`<option value="${optionValue}">
                                       ${optionText}
                                  </option>`);
            });
    })

    }


    return {
        init: function () {
            initSelect();
            checkCountry();
        }
    };
}();

jQuery(document).ready(function () {
    ImpCountry.init();
});
