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
    <style>
.container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
    padding: 0px;
    width: 80vw;
}

button {
    background-color: #a97c50;
    color: white;
    font-size: 16px;
    font-weight: bold;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    width: 200px;
    height: 50px;
    text-align: center;
    display: inline-block;
}

button:hover {
    background-color: #8c6239;
    transform: scale(1.05);
}

button:focus {
    outline: none;
    box-shadow: 0 0 10px rgba(169, 124, 80, 0.8);
}

form {
    border: none !important;
    box-shadow: none !important;
    background: transparent !important;
}

/* Etichette */
label {
    font-size: 20px;
    font-weight: bold;
    color: #fff;
    background: linear-gradient(to right, #8B4513, #D35400);
    padding: 8px 14px;
    border-radius: 8px;
    display: inline-block;
    margin-bottom: 10px;
}

label:hover {
    background: linear-gradient(to right, #D35400, #8B4513);
    transform: scale(1.08);
}

/* Campi di input */
input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    max-width: 400px;
    padding: 10px 15px;
    font-size: 18px;
    font-weight: bold;
    color: black !important; /* Forza il testo in nero */
    background: white;
    border: 2px solid #ccc;
    border-radius: 8px;
    outline: none;
    transition: all 0.3s ease-in-out;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #ff8a00;
    background: #f9f9f9;
}
</style>
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

<!-- SweetAlert per mostrare errori o successi -->
<?php if (session()->getFlashdata('error')) : ?>
    <script>
        Swal.fire({
            title: "Errore!",
            text: "<?= session()->getFlashdata('error'); ?>",
            icon: "error",
            confirmButtonText: "OK"
        });
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('success')) : ?>
    <script>
        Swal.fire({
            title: "Successo!",
            text: "<?= session()->getFlashdata('success'); ?>",
            icon: "success",
            confirmButtonText: "OK"
        });
    </script>
<?php endif; ?>

</body>
</html>
