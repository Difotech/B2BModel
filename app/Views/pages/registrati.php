<head>
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
<div class="container">
    <h2>Registrati</h2>

    <form id="registerForm" action="<?= base_url('/register') ?>" method="post">
        <?= csrf_field() ?>  <!-- Protezione CSRF -->

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="piva">Partita IVA:</label>
        <input type="text" id="piva" name="piva" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Conferma Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit" id="registerButton">Registrati</button>
    </form>

    <p>Hai già un account?</p>
    <a href="<?= base_url('/login') ?>">Accedi</a>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let form = document.getElementById("registerForm");

    form.addEventListener("submit", function (event) {
        let nome = document.getElementById("nome").value.trim();
        let email = document.getElementById("email").value.trim();
        let piva = document.getElementById("piva").value.trim();
        let password = document.getElementById("password").value.trim();
        let confirmPassword = document.getElementById("confirm_password").value.trim();
        let errorMessage = "";

        // Controllo che i campi non siano vuoti
        if (!nome || !email || !piva || !password || !confirmPassword) {
            errorMessage += "Tutti i campi sono obbligatori.\n";
        }

        // Controllo P.IVA (11 cifre numeriche)
        if (piva.length !== 11 || isNaN(piva)) {
            errorMessage += "La Partita IVA deve contenere esattamente 11 cifre numeriche.\n";
        }

        // Controllo che le password coincidano
        if (password !== confirmPassword) {
            errorMessage += "Le password non coincidono.\n";
        }

        if (errorMessage) {
            event.preventDefault(); // Blocca l'invio del form
            Swal.fire({
                title: "Errore!",
                text: errorMessage,
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    });
});
</script>

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
