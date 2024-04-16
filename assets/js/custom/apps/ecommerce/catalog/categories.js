"use strict"; let crearCategoria = function () {
    var e, t, i; return {
        init: function () {
            e = document.querySelector("#kt_modal_create_categoria_formulario")
                , t = document.querySelector("#kt_modal_create_categoria_submit")
                , i = FormValidation.formValidation(e, {
                    fields: {
                        nombre_categoria: {
                            validators: {
                                notEmpty: { message: "El nombre es obligatorio." }
                            }
                        },
                        slug_categoria: { validators: { notEmpty: { message: "El slug es obligatorio." } } }
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger, bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) }
                })
                , t.addEventListener("click", (function (n) { n.preventDefault(), i.validate().then((function (i) { "Valid" == i ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () { document.querySelector("#kt_modal_create_categoria_formulario").submit(), 2e3 }))) : document.querySelector("#kt_modal_create_categoria_submit").preventDefault() })) }))
        }
    }
}(); KTUtil.onDOMContentLoaded((function () { crearCategoria.init() }));

"use strict"; let editarCategoria = function () {
    var e, t, i; return {
        init: function () {
            e = document.querySelector("#kt_modal_editar_categoria_formulario")
                , t = document.querySelector("#kt_modal_edit_categoria_submit")
                , i = FormValidation.formValidation(e, {
                    fields: {
                        editar_nombre_categoria: {
                            validators: {
                                notEmpty: { message: "El nombre es obligatorio." }
                            }
                        },
                        editar_slug_categoria: { validators: { notEmpty: { message: "El slug es obligatorio." } } }
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger, bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) }
                })
                , t.addEventListener("click", (function (n) { n.preventDefault(), i.validate().then((function (i) { "Valid" == i ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () { document.querySelector("#kt_modal_editar_categoria_formulario").submit(), 2e3 }))) : document.querySelector("#kt_modal_edit_categoria_submit").preventDefault() })) }))
        }
    }
}(); KTUtil.onDOMContentLoaded((function () { editarCategoria.init() }));

let arrayBotonEditar = document.querySelectorAll('.boton-editar');
arrayBotonEditar.forEach(element =>
    element.addEventListener('click', botonEditarDatos, false));

function botonEditarDatos(e) {
    let nombre = e.target.getAttribute("data-nombre");
    let id = e.target.getAttribute("data-id");
    let slug = e.target.getAttribute("data-slug");
    let descripcion = e.target.getAttribute("data-descripcion");
    let estado = e.target.getAttribute("data-estado");
    let idDescuento = e.target.getAttribute("data-descuento");
    let idCategoriaPadre = e.target.getAttribute("data-id-padre");

    if (idCategoriaPadre === '') {
        idCategoriaPadre = 0;
    }
    if (idDescuento === '') {
        idDescuento = 0;
    }
    document.getElementById('editar_categoria').value = id;
    document.getElementById('editar_nombre_categoria').value = nombre;
    document.getElementById('editar_padre_categoria').value = idCategoriaPadre;
    document.getElementById('editar_slug_categoria').value = slug;
    document.getElementById('editar_estado_categoria').value = estado;
    document.getElementById('editar_descripcion_categoria').value = descripcion;
    document.getElementById('editar_descuento_categoria').value = idDescuento;

}
"use strict";
var KTAppEcommerceCategories = (function () {
    var t, e, f, n = () => {
        t.querySelectorAll('[data-kt-ecommerce-category-filter="delete_row"]').forEach((t) => {
            t.addEventListener("click", function (t) {
                t.preventDefault();
                const n = t.target.closest("tr"),
                    o = n.querySelector('[data-kt-ecommerce-category-filter="category_name"]').innerText;
                Swal.fire({
                    text: "¿Seguro que quieres eliminar la categoría " + o + "?",
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
            (t = document.querySelector("#kt_ecommerce_category_table")) &&
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
                document.querySelector('[data-kt-ecommerce-category-filter="search"]').addEventListener("keyup", function (t) {
                    e.search(t.target.value).draw();
                }),
                n());
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceCategories.init();
});