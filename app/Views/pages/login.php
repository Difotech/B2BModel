<div class="container">
    <h3>Accedi</h3>
    <!-- Form di Login -->
    <form action="<?= base_url('/login1') ?>" method="post">
        <?= csrf_field() ?> <!-- Protezione CSRF -->

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary" button class="bottone">Accedi</button>
    </form>

    <a href="<?= base_url('registrati') ?>">Non sei registrato? Registrati</a>

</div>
