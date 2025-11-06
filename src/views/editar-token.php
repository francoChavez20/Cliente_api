<style>
    .form-container {
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
        background-color: #f0f2f5;
    }

    .form {
        background-color: #ffffff;
        margin: 20px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 400px;
        font-family: Arial, sans-serif;
    }

    .form div {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
        background-color: #f9f9f9;
    }

    .button {
        width: 100%;
        padding: 12px;
        background-color: #2196F3;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #1976D2;
    }

    input:focus {
        border-color: #2196F3;
        outline: none;
        background-color: #f1f9ff;
    }

    h2 {
        text-align: center;
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }
</style>

<div class="form-container">
    <form class="form" id="frmEditarToken">
        <h2>Editar Token</h2>

        <div>
            <label for="token">Token</label>
            <input type="text" id="token" name="token" required>
        </div>

        <button type="button" class="button" onclick="actualizar_token();">Actualizar Token</button>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </form>
</div>

<script src="<?php echo BASE_URL ?>src/views/js/functions_token.js"></script>

<script>
    // Cargar token actual automáticamente al abrir la página
    editar_token();
</script>
