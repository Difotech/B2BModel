<div class="container">
        <h3>Accedi</h3>
        <!-- Form di Login -->
        <form action="<?= base_url('/login') ?>" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <button type="submit">Accedi</button>
        </form>
        <a href="<?= base_url('/registrati') ?>" class="registrati.php">Non sei registrato? Registrati</a>
    </div>