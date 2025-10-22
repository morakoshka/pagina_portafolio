<?php
require __DIR__ . '/config.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { http_response_code(400); exit; }

$stmt = $pdo->prepare("SELECT mime, data, name FROM images WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch();
if (!$row) { http_response_code(404); exit; }

header('Content-Type: ' . $row['mime']);
header('Content-Disposition: inline; filename="' . rawurlencode($row['name']) . '"');
echo $row['data'];