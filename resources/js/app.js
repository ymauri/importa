require('./bootstrap');


window.Imp = function () {
    let notify = function (type, message){

    $.notify({
        message: message
    },{
        type: type,
        timer: 4000,
        placement: {
            from: 'top',
            align: 'right'
        }
    });
    }
  return {
    notify : notify
    };
}();

