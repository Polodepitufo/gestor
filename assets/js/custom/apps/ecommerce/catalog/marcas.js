"use strict"; let crearMarca = function () {
    var e, t, i; return {
        init: function () {
            e = document.querySelector("#kt_modal_crear_marca_formulario")
                , t = document.querySelector("#kt_modal_crear_marca_submit")
                , i = FormValidation.formValidation(e, {
                    fields: {
                        nombre_marca: { validators: { notEmpty: { message: "El nombre es obligatorio." } } }, 
                        logotipo_marca_imagen: { 
                            validators: {
                                notEmpty: { 
                                    message: "El logotipo es obligatorio."
                                },
                                file: { 
                                    extension: 'jpeg,jpg,png', 
                                    message: 'Por favor, selecciona un archivo de imagen válido (JPEG, JPG, PNG).'
                                },
                                fileSelected: {
                                    message: 'El logotipo es obligatorio.',
                                    callback: function(input) {
                                        const file = input.files[0];
                                        return (file !== undefined);
                                    }
                                }
                            }
                        }
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger, bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) }
                })
                , t.addEventListener("click", (function (n) { n.preventDefault(), i.validate().then((function (i) { "Valid" == i ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () { document.querySelector("#kt_modal_crear_marca_formulario").submit(), 2e3 }))) : document.querySelector("#kt_modal_crear_marca_submit").preventDefault() })) }))
        }
    }
}(); KTUtil.onDOMContentLoaded((function () { crearMarca.init() }));

"use strict"; let editarMarca= function () {
    var e, t, i; return {
        init: function () {
            e = document.querySelector("#kt_modal_editar_marca_formulario")
                , t = document.querySelector("#kt_modal_edit_marca_submit")
                , i = FormValidation.formValidation(e, {
                    fields: {
                        editar_nombre_marca: { validators: { notEmpty: { message: "El nombre es obligatorio." } } }, 
                         
                        editar_logotipo_marca_imagen: { 
                            validators: {
                                file: { 
                                    extension: 'jpeg,jpg,png', 
                                    message: 'Por favor, selecciona un archivo de imagen válido (JPEG, JPG, PNG).'
                                },
                            }
                        }
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger, bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) }
                })
                , t.addEventListener("click", (function (n) { n.preventDefault(), i.validate().then((function (i) { "Valid" == i ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () { document.querySelector("#kt_modal_editar_marca_formulario").submit(), 2e3 }))) : document.querySelector("#kt_modal_edit_marca_submit").preventDefault() })) }))
        }
    }
}(); KTUtil.onDOMContentLoaded((function () { editarMarca.init() }));

let arrayBotonEliminar = document.querySelectorAll('.boton-eliminar');
arrayBotonEliminar.forEach(element =>
    element.addEventListener('click', botonEliminarDatos, false));

function botonEliminarDatos(e) {
    let id = e.target.getAttribute("data-id");
    document.getElementById('eliminar_marca').value = id;
}

let arrayBotonEditar = document.querySelectorAll('.boton-editar');
arrayBotonEditar.forEach(element =>
    element.addEventListener('click', botonEditarDatos, false));

function botonEditarDatos(e) {
    let id = e.target.getAttribute("data-id");
    let nombre = e.target.getAttribute("data-nombre");
    let imagen = e.target.getAttribute("data-imagen");
    let estado = e.target.getAttribute("data-estado");
    document.getElementById('editar_marca').value = id;
    document.getElementById('editar_nombre_marca').value = nombre;
    document.getElementById('editar_estado_marca').value = estado;
    document.getElementById('image_input_wrapper').style="background-size: cover; background-position: center;background-image: url(../assets/media/marcas/"+imagen+")";
}

"use strict";
var KTAppEcommerceMarca = (function () {
    var t, e, f, n = () => {
        t.querySelectorAll('[data-kt-ecommerce-marca-filter="delete_row"]').forEach((t) => {
            t.addEventListener("click", function (t) {
                t.preventDefault();
                const n = t.target.closest("tr"),
                    o = n.querySelector('[data-kt-ecommerce-marca-filter="marca_name"]').innerText;
                Swal.fire({
                    text: "¿Seguro que quieres eliminar la marca " + o + "?",
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
            (t = document.querySelector("#kt_ecommerce_marca_table")) &&
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
                document.querySelector('[data-kt-ecommerce-marca-filter="search"]').addEventListener("keyup", function (t) {
                    e.search(t.target.value).draw();
                }),
                n());
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceMarca.init();
});

