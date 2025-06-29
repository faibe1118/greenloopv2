const tipoPersona = document.getElementById("tipo_persona");
const selectRol = document.getElementById("select-rol");
const tipoDocumento = document.getElementById("tipo_documento");
const fotosDocumento = document.getElementById("fotos-documento");
const caraCedula = document.getElementById("cara-cedula");
const reversoCedula = document.getElementById("reverso-cedula");

tipoPersona.addEventListener("change", () => {
    if (tipoPersona.value === "natural") {
        // Fija el rol como vendedor y desactiva cambios
        selectRol.value = "vendedor";
        selectRol.style.pointerEvents = "none";  // El usuario NO podrá hacer clic
        selectRol.style.backgroundColor = "none"; // Estética de campo deshabilitado
        selectRol.setAttribute("aria-readonly", "true"); // Accesibilidad
        selectRol.required = true; // Se envía correctamente

        // Fija el tipo de documento como cédula y desactiva cambios
        tipoDocumento.value = "cc";
        tipoDocumento.disabled = true;

        // Muestra los campos para cargar fotos y los marca como obligatorios
        fotosDocumento.style.display = "block";
        caraCedula.required = true;
        reversoCedula.required = true;
    } else if (tipoPersona.value === "juridica") {
        // Habilita el rol para que el usuario escoja
        selectRol.value = "";
        selectRol.style.pointerEvents = "auto";
        selectRol.style.backgroundColor = "";
        selectRol.removeAttribute("aria-readonly");
        selectRol.required = true;

        // Fija el tipo de documento como NIT y desactiva cambios
        tipoDocumento.value = "nit";
        tipoDocumento.disabled = true;

        // Oculta los campos de fotos y quita el obligatorio
        fotosDocumento.style.display = "none";
        caraCedula.required = false;
        reversoCedula.required = false;
    } else {
        // Si no selecciona nada, reinicia todo
        selectRol.value = "";
        selectRol.style.pointerEvents = "auto";
        selectRol.style.backgroundColor = "";
        selectRol.removeAttribute("aria-readonly");
        tipoDocumento.value = "";
        tipoDocumento.disabled = false;
        fotosDocumento.style.display = "none";
        caraCedula.required = false;
        reversoCedula.required = false;
    }
});



