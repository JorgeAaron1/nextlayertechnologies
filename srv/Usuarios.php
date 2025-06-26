<?php
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/Bd.php";

ejecutaServicio(function () {
    $pdo = Bd::pdo();
    $stmt = $pdo->query("SELECT * FROM Usuario"); 
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($usuarios);
});
