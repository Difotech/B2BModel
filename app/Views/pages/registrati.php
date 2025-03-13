<div class="container">
    <h2>Registrati</h2>
    <form action="<?= base_url('/register') ?>" method="post">
        <?= csrf_field() ?>  <!-- Questo aggiunge automaticamente il token -->
    
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
    
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    
        <label for="confirm_password">Conferma Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    
        <button type="submit">Registrati</button>
    </form>
    
    <p>Hai già un account?</p>
    <a href="<?= base_url('/login') ?>" class="accesso.php">Accedi</a>
</div>
