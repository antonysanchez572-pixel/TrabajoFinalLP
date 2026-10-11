document.getElementById('inscripcionForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Detiene la recarga de la página

    // Muestra pantalla de carga con SweetAlert2
    Swal.fire({
        title: 'Enviando formulario...',
        text: 'Por favor espere un momento.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Captura los datos del formulario
    const formData = new FormData(this);

    // Envío por AJAX hacia send_mail.php
    fetch('php/enviar.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "exito") {
            Swal.fire({
                icon: 'success',
                title: '¡Inscripción Exitosa!',
                text: 'Los datos del alumno se han enviado correctamente.',
                confirmButtonColor: '#521d28'
            });
            document.getElementById('inscripcionForm').reset(); // Limpia los campos
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error al enviar',
                text: 'Hubo un inconveniente al enviar la información. Inténtelo de nuevo.',
                confirmButtonColor: '#d33'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error de conexión',
            text: 'No se pudo conectar con el servidor PHP.',
            confirmButtonColor: '#d33'
        });
    });
});
