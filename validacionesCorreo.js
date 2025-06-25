// Mensaje si hay error
function mostrarError(input, mensaje) {
  let errorMensaje = input.parentNode.querySelector(".error-mensaje");
  if (!errorMensaje) {
    errorMensaje = document.createElement("p");
    errorMensaje.classList.add("error-mensaje");
    input.parentNode.appendChild(errorMensaje);
  }
  errorMensaje.textContent = mensaje;
}

// Quita el mensaje si está correcto
function estaBien(input) {
  let errorMensaje = input.parentNode.querySelector(".error-mensaje");
  if (errorMensaje) {
    errorMensaje.remove();
  }
}

// Validar el correo electrónico
const ValidarCorreo = (evento) => {
  const email = evento.target.value.trim();
  const input = evento.target;

  // Valida que tenga @ y termine en .com
  const esValido = /^[^@]+@[^@]+\.[cC][oO][mM]$/.test(email);

  if (esValido) {
    estadoCampos.ValidarCorreo = true;
    estaBien(input);
  } else {
    estadoCampos.ValidarCorreo = false;
    mostrarError(input, "El correo no es válido. Debe tener '@' y terminar en '.com'");
  }
};

// Estado global
const estadoCampos = {
  ValidarCorreo: false,
};

// EVENTOS AL CARGAR LA PÁGINA
document.addEventListener("DOMContentLoaded", function () {
  const formulario = document.getElementById("formularioCorreo");
  const inputCorreo = document.getElementById("correo");

  inputCorreo.addEventListener("keyup", ValidarCorreo);
  inputCorreo.addEventListener("blur", ValidarCorreo);

  formulario.addEventListener("submit", function (e) {
    e.preventDefault();
    ValidarCorreo({ target: inputCorreo });

    if (estadoCampos.ValidarCorreo) {
      formulario.submit(); // ahora sí se envía si está bien
    } else {
      mostrarError(inputCorreo, "Por favor ingrese un correo válido antes de enviar");
    }
  });
});
