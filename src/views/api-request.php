<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Películas</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>🎬 Catálogo de Películas</h1>

    <form id="frmApi">
      <!-- Token del cliente autorizado -->
      <input type="hidden" id="token" name="token" value="b2c3d4e5-20251009-2">

      <label>Buscar:</label>
      <input type="text" id="data" name="data" placeholder="Nombre de la película">

      <label>Idioma:</label>
      <select id="idioma" name="idioma">
        <option value="">Todos</option>
        <option value="Español">Español</option>
        <option value="Inglés">Inglés</option>
      </select>

      <label>Género:</label>
      <select id="genero" name="genero">
        <option value="">Todos</option>
        <option value="Acción">Acción</option>
        <option value="Comedia">Comedia</option>
        <option value="Drama">Drama</option>
        <option value="Terror">Terror</option>
      </select>

      <button type="button" onclick="llamar_api()">Buscar</button>
    </form>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Título</th>
          <th>Descripción</th>
          <th>Año</th>
          <th>Duración</th>
          <th>Calificación</th>
          <th>Idioma</th>
          <th>Género</th>
        </tr>
      </thead>
      <tbody id="contenido"></tbody>
    </table>
  </div>

  <script src="js/api.js"></script>
</body>
</html>
