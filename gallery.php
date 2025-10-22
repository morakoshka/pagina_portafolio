<?php
require __DIR__ . '/config.php';
$images = $pdo->query("SELECT id, name FROM images ORDER BY created_at DESC")->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Galería</title>
<style>
.gallery{ display:flex; flex-wrap:wrap; gap:12px; }
.thumb{ width:200px; border-radius:8px; overflow:hidden; background:#111; padding:6px; box-shadow:0 6px 18px rgba(0,0,0,.6); }
.thumb img{ width:100%; height:auto; display:block; }
.caption{ font-size:13px; color:#ddd; text-align:center; margin-top:6px; }
</style>
</head>
<body>
<h1>Galería</h1>
<p><a href="upload.php">Subir nueva</a></p>
<div class="gallery">
<?php foreach($images as $img): ?>
    <div class="thumb">
        <a href="image.php?id=<?= $img['id'] ?>" target="_blank">
            <img src="image.php?id=<?= $img['id'] ?>" alt="<?= htmlspecialchars($img['name']) ?>">
        </a>
        <div class="caption"><?= htmlspecialchars($img['name']) ?></div>
    </div>
<?php endforeach; ?>
</div>
</body>
</html>