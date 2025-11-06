// ===================== LISTAR TOKENS =====================
async function listar_tokens() {
    try {
        let respuesta = await fetch(base_url + 'src/controller/token.php?tipo=listar');
        let json = await respuesta.json();

        if (json.status) {
            let datos = json.contenido;
            let cont = 0;
            const tabla = document.querySelector('#tbl_tokens');
            tabla.innerHTML = ""; // limpiar tabla antes de listar

            datos.forEach(item => {
                cont += 1;
                let fila = document.createElement("tr");

                fila.innerHTML = `
                    <th>${cont}</th>
                    <td>${item.token}</td>
                    <td>${item.options}</td>
                `;

                tabla.appendChild(fila);
            });
        }
    } catch (error) {
        console.log("Error al listar tokens: " + error);
    }
}

if (document.querySelector('#tbl_tokens')) {
    listar_tokens();
}


// === OBTENER TOKEN ACTUAL ===
async function editar_token() {
    try {
        let respuesta = await fetch(base_url + 'src/controller/token.php?tipo=ver', {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache'
        });

        let json = await respuesta.json();

        if (json.status && json.data) {
            document.querySelector('#token').value = json.data.token;
        } else {
            swal("Token", "No se encontró ningún token registrado.", "info");
        }

        console.log("Token cargado:", json);
    } catch (e) {
        console.error("Error al obtener el token:", e);
        swal("Error", "Ocurrió un error al obtener el token.", "error");
    }
}


// === ACTUALIZAR TOKEN ===
async function actualizar_token() {
    let token = document.querySelector('#token').value.trim();

    if (token === "") {
        swal("Campo vacío", "Debe ingresar un token válido.", "warning");
        return;
    }

    try {
        let datos = new FormData();
        datos.append('token', token);

        let respuesta = await fetch(base_url + 'src/controller/token.php?tipo=editar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();

        if (json.status) {
            swal("Éxito", json.mensaje, "success")
            .then(() => {
                // Redirigir al inicio
                window.location.href = base_url + "inicio"; 
            });
        } else {
            swal("Error", json.mensaje, "error");
        }

        console.log("Respuesta actualización:", json);
    } catch (e) {
        console.error("Error al actualizar token:", e);
        swal("Error", "Ocurrió un error al actualizar el token.", "error");
    }
}
