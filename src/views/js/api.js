// ✅ Función para mostrar alertas con SweetAlert2
function mostrarAlerta(titulo, mensaje, tipo = "info") {
    Swal.fire({
        title: titulo,
        text: mensaje,
        icon: tipo,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Aceptar"
    });
}

// ✅ Cargar token desde el controlador PHP
async function cargarToken() {
    try {
        const respuesta = await fetch('src/controller/token.php?tipo=ver');
        const json = await respuesta.json();
        if (json.status) {
            document.getElementById('token').value = json.data.token;
        } else {
            mostrarAlerta("Advertencia", "No se encontró token guardado", "warning");
        }
    } catch (error) {
        console.error("Error cargando token:", error);
        mostrarAlerta("Error", "No se pudo obtener el token desde el servidor", "error");
    }
}

// ✅ Llamar API de películas
async function llamar_api() {
    const formulario = document.getElementById('frmApi');
    const datos = new FormData(formulario);
    let ruta_api = document.getElementById('ruta_api').value;

    try {
        const respuesta = await fetch(ruta_api, {
            method: 'POST',
            mode: 'cors',
            body: datos
        });

        const json = await respuesta.json();
        const contenido = document.getElementById('contenido');
        contenido.innerHTML = "";

        if (json.status && json.contenido.length > 0) {
            let contador = 0;
            json.contenido.forEach(peli => {
                contador++;
                contenido.innerHTML += `
                    <tr>
                        <td>${contador}</td>
                        <td>${peli.titulo}</td>
                        <td>${peli.descripcion}</td>
                        <td>${peli.anio_estreno}</td>
                        <td>${peli.duracion}</td>
                        <td>${peli.calificacion}</td>
                        <td>${peli.idioma}</td>
                        <td>${peli.genero}</td>
                    </tr>`;
            });
        } 
        else if (json.msg && json.msg.includes("token inválido")) {
            mostrarAlerta("Token inválido", "Tu token no es válido o ha expirado", "error");
            contenido.innerHTML = `<tr><td colspan="8">Token inválido o expirado.</td></tr>`;
        } 
        else {
            contenido.innerHTML = `<tr><td colspan="8">${json.msg || 'No se encontraron películas.'}</td></tr>`;
            mostrarAlerta("Sin resultados", "No se encontraron películas con los filtros dados", "info");
        }

    } catch (error) {
        console.error("Error al conectar con la API:", error);
        document.getElementById('contenido').innerHTML =
            `<tr><td colspan="8">⚠️ Error de conexión con el servidor.</td></tr>`;
        mostrarAlerta("Error", "No se pudo conectar con la API o el servidor no responde", "error");
    }
}

// 🔹 Ejecuta automáticamente la carga del token al iniciar la página
document.addEventListener("DOMContentLoaded", cargarToken);
