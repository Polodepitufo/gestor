"use strict"; var KTSigninGeneral = function () {
    var e, t, i; return {
        init: function () {
            e = document.querySelector("#kt_sign_in_form")
            , t = document.querySelector("#kt_sign_in_submit")
            , i = FormValidation.formValidation(e, {
                fields: {
                    email: {
                        validators: {
                            regexp: { regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, message: "Introduce un email válido." },
                            notEmpty: { message: "El email es obligatorio." }
                        }
                    },
                    password: { validators: { notEmpty: { message: "La contraseña es obligatoria." } } }
                },
                plugins: { trigger: new FormValidation.plugins.Trigger, bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) }
            })
            , t.addEventListener("click", (function (n) { n.preventDefault(), i.validate().then((function (i) { "Valid" == i ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () { document.querySelector("#kt_sign_in_form").submit(), 2e3}))):document.querySelector("#kt_sign_in_submit").preventDefault() })) }))
        }
    }
}(); KTUtil.onDOMContentLoaded((function () { KTSigninGeneral.init() }));