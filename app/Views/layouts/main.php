<?php

use App\Core\Csrf;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Auth service' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">Auth service</a>
        <div class="ms-auto">
            <?php if (isset($_SESSION['user_name'])): ?>
                <span class="me-3"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                <form method="post" action="/logout" class="d-inline">
                    <input type="hidden" name="_csrf" value="<?= Csrf::token() ?>">
                    <button class="btn btn-sm btn-outline-danger">Logout</button>
                </form>
            <?php else: ?>
                <a href="/register" class="btn btn-sm btn-outline-primary me-2">Register</a>
                <a href="/login" class="btn btn-sm btn-outline-secondary">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">
    <?= $content ?? '' ?>
</div>

</body>
</html>
