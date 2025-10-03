<?php
// .env laden (ohne extra Paket)
if (file_exists(__DIR__.'/.env')) {
  $vars = parse_ini_file(__DIR__.'/.env', false, INI_SCANNER_RAW);
  foreach ($vars as $k=>$v) { $_ENV[$k]=$v; putenv("$k=$v"); }
}
$dsn = 'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'].';charset=utf8mb4';
try {
  $pdo = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
  echo "<h1>site1 läuft ✔</h1><p>DB-Verbindung OK</p>";
} catch (Throwable $e) {
  http_response_code(500);
  echo "<h1>site1 läuft ✔</h1><p>DB-Fehler: ".htmlspecialchars($e->getMessage())."</p>";
}
