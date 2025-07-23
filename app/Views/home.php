<h2>Welcome!</h2>

<?php if (isset($_SESSION['user_name'])): ?>
    <div class="alert alert-success">
        Hello, <?= htmlspecialchars($_SESSION['user_name']) ?>!
    </div>
<?php else: ?>
    <p class="lead">Please register or login to continue.</p>
<?php endif; ?>
