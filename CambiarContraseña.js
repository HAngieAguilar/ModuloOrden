function mostrarError(input, mensaje) {
  const errorMensaje = input.nextElementSibling;
  if (errorMensaje && errorMensaje.classList.contains("error-mensaje")) {
    errorMensaje.textContent = mensaje;
  }
}

function estaBien(input) {
  const errorMensaje = input.nextElementSibling;
  if (errorMensaje && errorMensaje.classList.contains("error-mensaje")) {
    errorMensaje.textContent = "";
  }
}

function validarContraseñas() {
  const nueva = document.getElementById("nueva");
  const repetir = document.getElementById("repetir");
  const valorNueva = nueva.value.trim();
  const valorRepetir = repetir.value.trim();
  
  let valido = true;

  if (valorNueva === "") {
    mostrarError(nueva, "La contraseña no puede estar vacía.");
    valido = false;
  } else if (valorNueva.length < 8 || valorNueva.length > 16) {
    mostrarError(nueva, "Debe tener entre 8 y 16 caracteres.");
    valido = false;
  } else if (!/[A-Z]/.test(valorNueva)) {
    mostrarError(nueva, "Debe contener al menos una letra mayúscula.");
    valido = false;
  } else if (!/[!@#$%^&*(),.?":{}|<>_\-+=/\\[\]~`';]/.test(valorNueva)) {
    mostrarError(nueva, "Debe contener al menos un carácter especial.");
    valido = false;
  } else {
    estaBien(nueva);
  }

  if (valorRepetir === "") {
    mostrarError(repetir, "Debe repetir la contraseña.");
    valido = false;
  } else if (valorRepetir !== valorNueva) {
    mostrarError(repetir, "Las contraseñas no coinciden.");
    valido = false;
  } else {
    estaBien(repetir);
  }

  return valido;
}

document.addEventListener("DOMContentLoaded", function () {
  const formulario = document.getElementById("DatosContraseña");
  const inputs = formulario.querySelectorAll("input");

  inputs.forEach((input) => {
    input.addEventListener("keyup", validarContraseñas);
    input.addEventListener("blur", validarContraseñas);
  });

  formulario.addEventListener("submit", function (e) {
    if (!validarContraseñas()) {
      e.preventDefault(); // Solo bloquea si hay error
    }
  });
});
