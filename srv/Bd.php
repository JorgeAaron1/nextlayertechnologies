<?php

class Bd
{
  private static ?PDO $pdo = null;

  static function pdo(): PDO
  {
    if (self::$pdo === null) {
      self::$pdo = new PDO(
        "sqlite:srvbd.db",
        null,
        null,
        [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
      );

      // Crea la tabla pasatiempo con las columnas correctas
      self::$pdo->exec(
        "CREATE TABLE IF NOT EXISTS pasatiempo (
          PAS_ID INTEGER PRIMARY KEY,
          PAS_NOMBRE TEXT NOT NULL,
          PAS_APELLIDO TEXT,
          PAS_CORREO TEXT,
          PAS_CONTRASENA TEXT,
          PAS_CV TEXT,
          PAS_FECHA_REGISTRO TEXT
        )"
      );
    }

    return self::$pdo;
  }
}
  