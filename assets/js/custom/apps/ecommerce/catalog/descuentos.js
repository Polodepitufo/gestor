"use strict"; let crearDescuento = function () {
    var e, t, i; return {
        init: function () {
            e = document.querySelector("#kt_modal_create_descuento_formulario")
                , t = document.querySelector("#kt_modal_create_descuento_submit")
                , i = FormValidation.formValidation(e, {
                    fields: {
                        nombre_descuento: { validators: { notEmpty: { message: "El nombre es obligatorio." } } },
                        minimo_descuento: { validators: { notEmpty: { message: "El mínimo es obligatorio." } } },
                        maximo_descuento: { validators: { notEmpty: { message: "El máximo es obligatorio." } } },
                        cantidad_descuento: { validators: { notEmpty: { message: "La cantidad del descuento es obligatoria." } } }
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger, bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) }
                })
                , t.addEventListener("click", (function (n) { n.preventDefault(), i.validate().then((function (i) { "Valid" == i ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () { document.querySelector("#kt_modal_create_descuento_formulario").submit(), 2e3 }))) : document.querySelector("#kt_modal_create_descuento_submit").preventDefault() })) }))
        }
    }
}(); KTUtil.onDOMContentLoaded((function () { crearDescuento.init() }));

"use strict"; let editarDescuento= function () {
    var e, t, i; return {
        init: function () {
            e = document.querySelector("#kt_modal_editar_descuento_formulario")
                , t = document.querySelector("#kt_modal_edit_descuento_submit")
                , i = FormValidation.formValidation(e, {
                    fields: {
                        editar_nombre_descuento: {validators: {notEmpty: { message: "El nombre es obligatorio." }}},
                        editar_minimo_descuento: { validators: { notEmpty: { message: "El mínimo es obligatorio." } } },
                        editar_maximo_descuento: { validators: { notEmpty: { message: "El máximo es obligatorio." } } },
                        editar_cantidad_descuento: { validators: { notEmpty: { message: "La cantidad del descuento es obligatoria." } } }
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger, bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) }
                })
                , t.addEventListener("click", (function (n) { n.preventDefault(), i.validate().then((function (i) { "Valid" == i ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () { document.querySelector("#kt_modal_editar_descuento_formulario").submit(), 2e3 }))) : document.querySelector("#kt_modal_edit_descuento_submit").preventDefault() })) }))
        }
    }
}(); KTUtil.onDOMContentLoaded((function () { editarDescuento.init() }));

let arrayBotonEditar = document.querySelectorAll('.boton-editar');
arrayBotonEditar.forEach(element =>
    element.addEventListener('click', botonEditarDatos, false));

function botonEditarDatos(e) {
    let id = e.target.getAttribute("data-id");
    let nombre = e.target.getAttribute("data-nombre");
    let minima = e.target.getAttribute("data-minima");
    let maxima = e.target.getAttribute("data-maxima");
    let cantidad = e.target.getAttribute("data-cantidad");
    let tipo = e.target.getAttribute("data-tipo");
    document.getElementById('editar_descuento').value = id;
    document.getElementById('editar_nombre_descuento').value = nombre;
    document.getElementById('editar_minimo_descuento').value = minima;
    document.getElementById('editar_maximo_descuento').value = maxima;
    document.getElementById('editar_tipo_descuento').value = tipo;
    document.getElementById('editar_cantidad_descuento').value = cantidad;
}
let arrayBotonEliminar = document.querySelectorAll('.boton-eliminar');
arrayBotonEliminar.forEach(element =>
    element.addEventListener('click', botonEliminarDatos, false));

function botonEliminarDatos(e) {
    let id = e.target.getAttribute("data-id");
    document.getElementById('eliminar_descuento').value = id;
}

"use strict";
var KTAppEcommerceDescuento = (function () {
    var t, e, f, n = () => {
        t.querySelectorAll('[data-kt-ecommerce-descuento-filter="delete_row"]').forEach((t) => {
            t.addEventListener("click", function (t) {
                t.preventDefault();
                const n = t.target.closest("tr"),
                    o = n.querySelector('[data-kt-ecommerce-descuento-filter="descuento_name"]').innerText;
                Swal.fire({
                    text: "¿Seguro que quieres eliminar el descuento " + o + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Si",
                    cancelButtonText: "No",
                    customClass: { confirmButton: "btn fw-bold btn-danger", cancelButton: "btn fw-bold btn-active-light-primary" },
                }).then((result) => {
                    if (result.value) {
                        document.querySelector("#formulario_eliminar").submit();

                    }
                });
            });
        });
    };
    return {
        init: function () {
            (t = document.querySelector("#kt_ecommerce_descuento_table")) &&
                ((e = $(t).DataTable({
                    info: false,
                    order: [],
                    pageLength: 10,
                    columnDefs: [
                        { orderable: false, targets: 0 },
                        { orderable: false, targets: 3 },
                    ],
                })).on("draw", function () {
                    n();
                }),
                document.querySelector('[data-kt-ecommerce-descuento-filter="search"]').addEventListener("keyup", function (t) {
                    e.search(t.target.value).draw();
                }),
                n());
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceDescuento.init();
});