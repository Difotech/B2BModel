<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link al CSS, se ne hai uno -->
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
    <!-- Includi SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

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

        <button type="submit" class="btn btn-primary">Accedi</button>
    </form>

    <a href="<?= base_url('registrati') ?>">Non sei registrato? Registrati</a>
</div>

<!-- Script per mostrare il popup -->
<?php if (session()->getFlashdata('success')) : ?>
    <script>
        window.onload = function() {
            Swal.fire({
                title: "Successo!",
                text: "<?= session()->getFlashdata('success'); ?>",
                icon: "success",
                confirmButtonText: "OK"
            });
        };
    </script>
<?php endif; ?>

</body>
</html>
