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
            mostrarAlerta("Advertencia", json.msg || "No se encontró token guardado", "warning");
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
    const ruta_api = document.getElementById('ruta_api').value;
    const contenido = document.getElementById('contenido');
    contenido.innerHTML = "";

    try {
        const respuesta = await fetch(ruta_api, {
            method: 'POST',
            mode: 'cors',
            body: datos
        });

        const json = await respuesta.json();
        console.log("Respuesta API:", json);

        // 🟢 Si el servidor devuelve 'msg', se muestra tal cual.
        if (json.msg && json.msg.trim() !== "") {
            // Si el estado es falso, alerta tipo error
            const tipo = json.status ? "success" : "error";
            mostrarAlerta("Mensaje del servidor", json.msg, tipo);
        }

        // 🟢 Si hay películas en el contenido, se muestran
        if (json.status && json.contenido && json.contenido.length > 0) {
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
        } else if (!json.status && (!json.contenido || json.contenido.length === 0)) {
            // 🟠 Si no hay películas, mostrar mensaje del servidor o por defecto
            contenido.innerHTML = `<tr><td colspan="8">${json.msg || 'Sin resultados.'}</td></tr>`;
        }

    } catch (error) {
        console.error("Error al conectar con la API:", error);
        contenido.innerHTML = `<tr><td colspan="8">⚠️ Error de conexión con el servidor.</td></tr>`;
        mostrarAlerta("Error", "No se pudo conectar con la API o el servidor no responde", "error");
    }
}

// 🔹 Ejecuta automáticamente la carga del token al iniciar la página
document.addEventListener("DOMContentLoaded", cargarToken);
