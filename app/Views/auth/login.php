<h2>Login</h2>

<?php use App\Core\Csrf;

if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="/login" class="row g-3">
    <input type="hidden" name="_csrf" value="<?= Csrf::token() ?>">
    <div class="col-12">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="col-12">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required minlength="8">
    </div>
    <div class="col-12">
        <button class="btn btn-primary">Login</button>
    </div>
</form>
