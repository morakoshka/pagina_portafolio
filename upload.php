<?php
require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $err = 'Error en la subida';
    } else {
        $file = $_FILES['image'];
        // validaciones básicas
        if ($file['size'] > 5 * 1024 * 1024) { // 5MB limite
            $err = 'Archivo demasiado grande.';
        } else {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($file['tmp_name']);
            if (!in_array($mime, ['image/jpeg','image/png','image/gif','image/webp'])) {
                $err = 'Tipo no permitido.';
            } else {
                $name = basename($file['name']);
                $data = file_get_contents($file['tmp_name']);
                $stmt = $pdo->prepare("INSERT INTO images (name, mime, data) VALUES (?, ?, ?)");
                $stmt->bindParam(1, $name);
                $stmt->bindParam(2, $mime);
                $stmt->bindParam(3, $data, PDO::PARAM_LOB);
                $stmt->execute();
                header('Location: gallery.php');
                exit;
            }
        }
    }
}
?>
<!doctype html>
<html lang="es">
<head><meta charset="utf-8"><title>Subir imagen</title></head>
<body>
<h1>Subir imagen</h1>
<?php if (!empty($err)): ?><p style="color:red;"><?=htmlspecialchars($err)?></p><?php endif; ?>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" required>
    <input type="text" name="title" placeholder="Título (opcional)">
    <button type="submit">Subir</button>
</form>
<p><a href="gallery.php">Ver galería</a></p>
</body>
</html>