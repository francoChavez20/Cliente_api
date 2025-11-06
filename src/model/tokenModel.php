<?php
require_once '../library/conexion.php';

class TokenModel {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::connect(); 
    }

    /* === OBTENER TOKEN (único registro) === */
    public function obtenerToken() {
        $sql = "SELECT token FROM `cliente-api` LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_object(); // devuelve objeto con ->token
    }

    /* === ACTUALIZAR TOKEN === */
    public function actualizarToken($nuevoToken) {
        $sql = "UPDATE `cliente-api` SET token = ? LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $nuevoToken);
        return $stmt->execute();
    }

    /* === LISTAR TOKEN (para mostrar en la tabla del JS) === */
    public function obtener_tokens() {
        $arrRespuesta = [];
        $sql = "SELECT token FROM `cliente-api` LIMIT 1";
        $resultado = $this->conexion->query($sql);

        while ($fila = $resultado->fetch_object()) {
            array_push($arrRespuesta, $fila);
        }
        return $arrRespuesta;
    }
}
?>
