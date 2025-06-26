<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_USUARIO.php";

ejecutaServicio(function () {
  // Recuperar campos del formulario
  $nombre = recuperaTexto("nombre");
  $apellido = recuperaTexto("apellido");
  $correo = recuperaTexto("correo");
  $contrasena = recuperaTexto("contrasena");
  $fecha = recuperaTexto("fecha_registro");

  // Validar campos necesarios
  $nombre = validaNombre($nombre);

  // Procesar archivo CV (opcional)
  $cvNombre = null;

  if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
    $carpeta = __DIR__ . "/../archivos";
    if (!file_exists($carpeta)) {
      mkdir($carpeta, 0777, true);
    }

    $cvNombre = basename($_FILES['cv']['name']);
    $cvTemporal = $_FILES['cv']['tmp_name'];
    $cvDestino = $carpeta . "/" . $cvNombre;

    if (!move_uploaded_file($cvTemporal, $cvDestino)) {
      http_response_code(500);
      echo json_encode(["error" => "No se pudo guardar el archivo CV"]);
      exit;
    }
  }

  // Guardar en la base de datos
  $pdo = Bd::pdo();

  insert(pdo: $pdo, into: Usuario, values: [
    PAS_NOMBRE => $nombre,
    PAS_APELLIDO => $apellido,
    PAS_CORREO => $correo,
    PAS_CONTRASENA => $contrasena,
    PAS_CV => $cvNombre ?? '',
    PAS_FECHA_REGISTRO => $fecha
  ]);

  $id = $pdo->lastInsertId();
  $encodeId = urlencode($id);

  devuelveCreated("/srv/pasatiempo.php?id=$encodeId", [
    "id" => ["value" => $id],
    "nombre" => ["value" => $nombre],
    "apellido" => ["value" => $apellido],
    "correo" => ["value" => $correo],
    "cv" => ["value" => $cvNombre ?? ''],
    "fecha_registro" => ["value" => $fecha]
  ]);
});
