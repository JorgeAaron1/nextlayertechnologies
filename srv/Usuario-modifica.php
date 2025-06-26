<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/update.php";             
require_once __DIR__ . "/../lib/php/devuelveNoContent.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_USUARIO.php";

ejecutaServicio(function () {
    // Recuperar el ID del registro a modificar
    $id = recuperaIdEntero("id");

    // Recuperar los demás datos del formulario (ajusta según campos)
    $nombre = recuperaTexto("nombre");
    $apellido = recuperaTexto("apellido");
    $correo = recuperaTexto("correo");
    $contrasena = recuperaTexto("contrasena");
    $fecha = recuperaTexto("fecha_registro");

    // Opcional: validar datos aquí, por ejemplo validaNombre($nombre)...

    // Preparar datos para actualizar
    $valoresActualizar = [
        "nombre" => $nombre,
        "apellido" => $apellido,
        "correo" => $correo,
        "contrasena" => $contrasena,
        "fecha_registro" => $fecha
    ];

    // Ejecutar actualización en la base de datos
  update(Bd::pdo(), Usuario, $valoresActualizar, [PAS_ID => $id]);




    // Responder con 204 No Content indicando éxito
    devuelveNoContent();
});
