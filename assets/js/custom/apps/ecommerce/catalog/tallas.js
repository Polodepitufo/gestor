"use strict"; let crearTalla = function () {
    var e, t, i; return {
        init: function () {
            e = document.querySelector("#kt_modal_create_talla_formulario")
                , t = document.querySelector("#kt_modal_create_talla_submit")
                , i = FormValidation.formValidation(e, {
                    fields: {
                        nombre_talla: { validators: { notEmpty: { message: "El nombre es obligatorio." } } },
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger, bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) }
                })
                , t.addEventListener("click", (function (n) { n.preventDefault(), i.validate().then((function (i) { "Valid" == i ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () { document.querySelector("#kt_modal_create_talla_formulario").submit(), 2e3 }))) : document.querySelector("#kt_modal_create_talla_submit").preventDefault() })) }))
        }
    }
}(); KTUtil.onDOMContentLoaded((function () { crearTalla.init() }));

"use strict"; let editarTalla = function () {
    var e, t, i; return {
        init: function () {
            e = document.querySelector("#kt_modal_editar_talla_formulario")
                , t = document.querySelector("#kt_modal_edit_talla_submit")
                , i = FormValidation.formValidation(e, {
                    fields: {
                        editar_nombre_talla: { validators: { notEmpty: { message: "El nombre es obligatorio." } } },
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger, bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) }
                })
                , t.addEventListener("click", (function (n) { n.preventDefault(), i.validate().then((function (i) { "Valid" == i ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () { document.querySelector("#kt_modal_editar_talla_formulario").submit(), 2e3 }))) : document.querySelector("#kt_modal_edit_talla_submit").preventDefault() })) }))
        }
    }
}(); KTUtil.onDOMContentLoaded((function () { editarTalla.init() }));

let arrayBotonEditar = document.querySelectorAll('.boton-editar');
arrayBotonEditar.forEach(element =>
    element.addEventListener('click', botonEditarDatos, false));

function botonEditarDatos(e) {
    let id = e.target.getAttribute("data-id");
    let nombre = e.target.getAttribute("data-nombre");
    let estado = e.target.getAttribute("data-estado");
    let marca = e.target.getAttribute("data-marca");
    document.getElementById('editar_talla').value = id;
    document.getElementById('editar_nombre_talla').value = nombre;
    document.getElementById('editar_estado_talla').value = estado;
    document.getElementById('editar_marca_talla').value = marca;
}
let arrayBotonEliminar = document.querySelectorAll('.boton-eliminar');
arrayBotonEliminar.forEach(element =>
    element.addEventListener('click', botonEliminarDatos, false));

function botonEliminarDatos(e) {
    let id = e.target.getAttribute("data-id");
    document.getElementById('eliminar_talla').value = id;
}

"use strict";
var KTAppEcommerceTalla = (function () {
    var t, e, f, n = () => {
        t.querySelectorAll('[data-kt-ecommerce-talla-filter="delete_row"]').forEach((t) => {
            t.addEventListener("click", function (t) {
                t.preventDefault();
                const n = t.target.closest("tr"),
                    o = n.querySelector('[data-kt-ecommerce-talla-filter="talla_name"]').innerText;
                Swal.fire({
                    text: "¿Seguro que quieres eliminar la talla " + o + "?",
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
            (t = document.querySelector("#kt_ecommerce_talla_table")) &&
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
                    document.querySelector('[data-kt-ecommerce-talla-filter="search"]').addEventListener("keyup", function (t) {
                        e.search(t.target.value).draw();
                    }),
                    n());
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceTalla.init();
});