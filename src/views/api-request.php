<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🎬 Buscador de Películas</title>
   <style>
    body {
      background-color: #0f172a;
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      background: #1e293b;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }

    h1 {
      text-align: center;
      color: #38bdf8;
      margin-bottom: 25px;
    }

    label {
      font-weight: 600;
      margin-right: 10px;
      color: #ffffff;
    }

    input[type="text"], select {
      background: #334155;
      border: none;
      border-radius: 8px;
      color: #ffffff;
      padding: 10px;
      margin: 8px 0;
      width: 100%;
      font-size: 15px;
    }

    input[type="text"]:focus, select:focus {
      outline: none;
      border: 2px solid #38bdf8;
    }

    button {
      background: #38bdf8;
      border: none;
      border-radius: 8px;
      color: #0f172a;
      font-weight: bold;
      padding: 12px 20px;
      cursor: pointer;
      transition: 0.3s;
      width: 100%;
      font-size: 16px;
      margin-top: 10px;
    }

    button:hover {
      background: #0ea5e9;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      color: #ffffff;
    }

    th, td {
      padding: 12px;
      text-align: center;
    }

    th {
      background: #0f172a;
      color: #38bdf8;
      position: sticky;
      top: 0;
      z-index: 1;
    }

    tr:nth-child(even) {
      background: #273449;
    }

    tr:nth-child(odd) {
      background: #334155;
    }

    tr:hover {
      background: #1e293b;
    }

    .tabla-container {
      max-height: 500px;
      overflow-y: auto;
      border: 2px solid #38bdf8;
      border-radius: 10px;
      margin-top: 20px;
      box-shadow: inset 0 0 10px rgba(56,189,248,0.3);
    }

    .filtros {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
      margin-top: 10px;
    }

    .api-url {
      margin-bottom: 20px;
      color: #94a3b8;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>🎬 Buscador de Películas</h1>

    <div class="api-url">
      <input type="text" id="ruta_api" value="https://peli-franco.estudiojuridico.com.pe/src/controller/api-request.php?tipo=verPeliculasApiByNombre" hidden>
    </div>

    <form id="frmApi">
      <!-- Token cargado dinámicamente -->
      <input type="hidden" name="token" id="token">

      <label for="data">🔍 Buscar película:</label>
      <input type="text" name="data" id="data" placeholder="Escribe el nombre de la película...">

        <div class="filtros">
        <div>
          <label>Idioma:</label>
          <select id="idioma" name="idioma">
            <option value="">Todos</option>
            <option value="Español">Español</option>
            <option value="Inglés">Inglés</option>
          </select>
        </div>

        <div>
          <label>Género:</label>
          <select id="genero" name="genero">
            <option value="">Todos</option>
            <option value="Acción">Acción</option>
            <option value="Comedia">Comedia</option>
            <option value="Terror">Terror</option>
            <option value="Drama">Drama</option>
          </select>
        </div>
      </div>

      <button type="button" onclick="llamar_api()">Buscar Películas</button>
    </form>

    <div class="tabla-container">
      <table>
        <thead>
          <tr>
            <th>N°</th><th>Título</th><th>Descripción</th><th>Año</th>
            <th>Duración</th><th>Calificación</th><th>Idioma</th><th>Género</th>
          </tr>
        </thead>
        <tbody id="contenido">
          <tr><td colspan="8">No hay resultados aún</td></tr>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?php echo BASE_URL; ?>src/views/js/api.js"></script>
</body>
</html>
