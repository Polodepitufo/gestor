"use strict";
var mensajeError= (function () {
    var m = () => {
        const messageError = document.getElementById('errorMessage');
        console.log(messageError.value)
        if (messageError && messageError.value !== '') {
            Swal.fire({
                text: messageError.value,
                icon: "warning", 
                showCancelButton: false,
                confirmButtonText: "De acuerdo",
                confirmButtonColor: "#009ef7", 
            });
        }
    }
    return {
        init: m
    };
})();
KTUtil.onDOMContentLoaded(function () {
    mensajeError.init();
});