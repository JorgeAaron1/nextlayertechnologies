<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_USUARIO.php";

ejecutaServicio(function () {
    $id = recuperaIdEntero("id");

    $modelo = selectFirst(Bd::pdo(), from: Usuario, where: [PAS_ID => $id]);

    if ($modelo === false) {
        $idHtml = htmlentities($id);
        throw new ProblemDetails(
            NOT_FOUND,
            "Pasatiempo no encontrado.",
            "/error/pasatiemponoencontrado.html",
            "No se encontró ningún pasatiempo con el id $idHtml."
        );
    }

    devuelveJson([
        "id" => ["value" => $id],
        "nombre" => ["value" => $modelo[PAS_NOMBRE]],
        "apellido" => ["value" => $modelo[PAS_APELLIDO] ?? ''],
        "correo" => ["value" => $modelo[PAS_CORREO] ?? ''],
        "contrasena" => ["value" => $modelo[PAS_CONTRASENA] ?? ''],
        "cv" => ["value" => $modelo[PAS_CV] ?? ''],
        "fecha_registro" => ["value" => $modelo[PAS_FECHA_REGISTRO] ?? '']
    ]);
});
