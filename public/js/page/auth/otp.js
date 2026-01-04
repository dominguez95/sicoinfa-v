import Swal from "sweetalert2";

// Función para manejar la entrada de datos (mejorada para password inputs)
function handleInput(element, index) {
    if (element.value.length === 1) {
        if (index < 5) {
            document.getElementById("otp_" + (index + 1)).focus();
        }
        updateCompleteOtp();
    }
}

// Función para manejar las teclas
function handleKeyDown(event, index) {
    if (event.key === "Backspace" && !event.target.value && index > 0) {
        document.getElementById("otp_" + (index - 1)).focus();
    }
}

// Función para manejar el pegado (adaptada para password inputs)
function handlePaste(event) {
    event.preventDefault();
    const paste = (event.clipboardData || window.clipboardData).getData("text");
    const cleanPaste = paste.replace(/[^a-zA-Z0-9]/g, ""); // Alfanumérico

    if (cleanPaste.length === 6) {
        for (let i = 0; i < 6; i++) {
            document.getElementById("otp_" + i).value = cleanPaste[i] || "";
        }
        updateCompleteOtp();
        // Auto submit después del pegado
        setTimeout(() => {
            if (document.getElementById("completeOtp").value.length === 6) {
                document.getElementById("otpForm").submit();
            }
        }, 100);
    }
}

// Función para actualizar el campo oculto con el código completo
function updateCompleteOtp() {
    let completeOtp = "";
    for (let i = 0; i < 6; i++) {
        completeOtp += document.getElementById("otp_" + i).value || "";
    }
    document.getElementById("completeOtp").value = completeOtp;

    // Auto submit cuando se completen los 6 caracteres
    if (completeOtp.length === 6) {
        showSubmitLoading();
        setTimeout(() => {
            document.getElementById("otpForm").submit();
        }, 500);
    }
}

// Función para mostrar el loading en el botón submit
function showSubmitLoading() {
    const btn = document.getElementById("submitBtn");
    const text = document.getElementById("submitText");
    const loader = document.getElementById("submitLoader");

    btn.disabled = true;
    text.textContent = "Verificando...";
    loader.classList.remove("hidden");
}

// Temporizador para mostrar opción de reenvío después de 10 segundos
let countdown = 10;
const countdownElement = document.getElementById("countdown");
const timerContainer = document.getElementById("timerContainer");
const resendContainer = document.getElementById("resendContainer");

function updateCountdown() {
    countdownElement.textContent = countdown;
    if (countdown <= 0) {
        timerContainer.classList.add("hidden");
        resendContainer.classList.remove("hidden");
        return;
    }
    countdown--;
    setTimeout(updateCountdown, 1000);
}

// Funciones del modal
function openResendModal() {
    window.dispatchEvent(
        new CustomEvent("open-modal", { detail: "resend-otp" })
    );
    setTimeout(() => {
        document.getElementById("modal_email").focus();
    }, 100);
}

function closeResendModal() {
    window.dispatchEvent(
        new CustomEvent("close-modal", { detail: "resend-otp" })
    );
    document.getElementById("resendForm").reset();
    document.getElementById("modal_email").value = "";
    // Reset loading state
    const btn = document.getElementById("resendBtn");
    const text = document.getElementById("resendText");
    const loader = document.getElementById("resendLoader");

    btn.disabled = false;
    text.classList.remove("hidden");
    loader.classList.add("hidden");
}

// Función para manejar el envío del formulario de solicitud
async function handleResendSubmit(event) {
    event.preventDefault();

    const btn = document.getElementById("resendBtn");
    const text = document.getElementById("resendText");
    const loader = document.getElementById("resendLoader");

    // Show loading state
    btn.disabled = true;
    text.classList.add("hidden");
    loader.classList.remove("hidden");

    const formData = new FormData(event.target);
    const resendRoute = event.target.dataset.resendRoute;

    try {
        const response = await fetch(resendRoute, {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN":
                    document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content") ||
                    document.querySelector('input[name="_token"]').value,
            },
        });

        const data = await response.json();

        if (response.ok) {
            Swal.fire({
                title: "¡Éxito!",
                text: "Código enviado exitosamente al administrador",
                icon: "success",
                confirmButtonText: "OK",
            });
            closeResendModal();
        } else {
            Swal.fire({
                title: "Error",
                text: data.message || "Error al solicitar el código",
                icon: "error",
                confirmButtonText: "OK",
            });
        }
    } catch (error) {
        Swal.fire({
            title: "Error de Conexión",
            text: "Intente nuevamente.",
            icon: "error",
            confirmButtonText: "OK",
        });
    } finally {
        // Reset loading state
        btn.disabled = false;
        text.classList.remove("hidden");
        loader.classList.add("hidden");
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", function () {
    // Iniciar el temporizador
    updateCountdown();

    // Exponer funciones globales para los event handlers inline
    window.handleInput = handleInput;
    window.handleKeyDown = handleKeyDown;
    window.handlePaste = handlePaste;
    window.showSubmitLoading = showSubmitLoading;
    window.openResendModal = openResendModal;
    window.closeResendModal = closeResendModal;
    window.handleResendSubmit = handleResendSubmit;
});
