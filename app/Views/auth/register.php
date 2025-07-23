<h2>Register</h2>

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

<form method="post" action="/register" class="row g-3">
    <input type="hidden" name="_csrf" value="<?= Csrf::token() ?>">
    <div class="col-md-6">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" required>
    </div>
    <div class="col-12">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required minlength="8">
    </div>
    <div class="col-12">
        <button class="btn btn-primary">Register</button>
    </div>
</form>
