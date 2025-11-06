<?php
require_once('../model/tokenModel.php');

$tipo = $_REQUEST['tipo'];
$objToken = new TokenModel();

/* === LISTAR TOKEN === */
if ($tipo == "listar") {
    $arr_Respuestas = array('status' => false, 'contenido' => '');
    $token = $objToken->obtenerToken(); // obtiene el único token

    if ($token) {
        // Preparamos estructura similar a una tabla con options
        $arr_Respuestas['status'] = true;
        $arr_Respuestas['contenido'] = array(array(
            'token' => $token->token,
            'options' => '
                <a href="' . BASE_URL . 'editar-token" 
                   class="btn btn-warning btn-sm px-4 d-inline-flex align-items-center">
                    <i class="fa fa-pencil"></i> Editar
                </a>'
        ));
    }

    echo json_encode($arr_Respuestas);
}


/* === VER TOKEN (precargar formulario) === */
if ($tipo == "ver") {
    $token = $objToken->obtenerToken();
    if ($token) {
        echo json_encode(['status' => true, 'data' => $token]);
    } else {
        echo json_encode(['status' => false, 'mensaje' => 'Token no encontrado']);
    }
}


/* === ACTUALIZAR TOKEN === */
if ($tipo == "editar") {
    if ($_POST) {
        $nuevoToken = $_POST['token'];

        if ($nuevoToken == "") {
            echo json_encode(['status' => false, 'mensaje' => 'Error: campo vacío']);
            exit;
        }

        $editado = $objToken->actualizarToken($nuevoToken);

        if ($editado) {
            echo json_encode(['status' => true, 'mensaje' => 'Token actualizado con éxito']);
        } else {
            echo json_encode(['status' => false, 'mensaje' => 'Error al actualizar token']);
        }
    }
}
?>
