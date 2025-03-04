<div class="container">
    <h3>Accedi</h3>
    <!-- Form di Login -->
    <form action="<?= base_url('/login') ?>" method="post">
        <?= csrf_field() ?> <!-- Protezione CSRF -->

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Accedi</button>
    </form>

    <a href="<?= base_url('/registrati') ?>" class="registrati.php">Non sei registrato? Registrati</a>
</div>
