<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/delete.php";
require_once __DIR__ . "/../lib/php/devuelveNoContent.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_USUARIOphp";

ejecutaServicio(function () {
  // Recupera el ID como entero
  $id = recuperaIdEntero("id");

  // Ejecuta el borrado en la tabla
  delete(
    pdo: Bd::pdo(),
    from: Usuario,
    where: [PAS_ID => $id]
  );

  // Devuelve respuesta 204 No Content
  devuelveNoContent();
});
