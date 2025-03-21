<!-- Form per inserire un nuovo preventivo -->
<style>
.container {
    display: flex;
    justify-content: center; /* Allinea i bottoni orizzontalmente al centro */
    flex-wrap: wrap; /* Permette di andare a capo su schermi piccoli */
    gap: 15px; /* Distanza tra i bottoni */
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
    width: 200px; /* Larghezza uniforme */
    height: 50px; /* Altezza uniforme */
    text-align: center;
    display: inline-block; /* Evita problemi con la dimensione */
}

button:hover {
    background-color: #8c6239;
    transform: scale(1.05);
}

button:focus {
    outline: none;
    box-shadow: 0 0 10px rgba(169, 124, 80, 0.8);
}
#carica-preventivo-form form {
    width: 30%; /* Occupa tutta la larghezza disponibile della box */
    max-width: 900px; /* Aumenta il limite massimo della larghezza */
    margin: 0 auto; /* Centra il form */
    
}
#carica-preventivo-form form {
    width: 30%; /* Occupa tutta la larghezza disponibile della box */
    max-width: 900px; /* Aumenta il limite massimo della larghezza */
    margin: 0 auto; /* Centra il form */
    border: none; /* Rimuove eventuali bordi del form */
    box-shadow: none; /* Rimuove eventuali ombre */
    background: transparent; /* Rende lo sfondo trasparente */
}
label {
    font-size: 20px;
    font-weight: bold;
    color: #fff; /* Testo bianco per massimo contrasto */
    background: linear-gradient(to right, #8B4513, #D35400); /* Marrone terra + arancione olio */
    padding: 8px 14px;
    border-radius: 8px;
    display: inline-block;
    margin-bottom: 10px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease-in-out;
}

label:hover {
    background: linear-gradient(to right, #D35400, #8B4513); /* Inverto i colori al passaggio del mouse */
    transform: scale(1.08);
}
input[type="text"],
input[type="number"] {
    width: 100%;
    max-width: 400px;
    padding: 10px 15px;
    font-size: 18px;
    font-weight: bold;
    color: #fff;
    background: #222;
    border: 2px solid transparent;
    border-radius: 8px;
    outline: none;
    transition: all 0.3s ease-in-out;
    box-shadow: inset 0 0 10px rgba(255, 138, 0, 0.5);
}

input[type="number"]:focus {
    border-color: #ff8a00;
    box-shadow: 0 0 15px rgba(255, 138, 0, 0.8);
    background: #111;
}

input[readonly] {
    background: #333;
    color: #aaa;
    cursor: not-allowed;
    border: 2px solid #444;
    box-shadow: none;
}
    </style>

    <body>
   
    <div class="container">
    <h1>Inserisci un nuovo preventivo</h1>
</div>
<div class="container" id="carica-preventivo-form">
    <form id="preventivo-form" action="<?= base_url('/faiunarichiesta1') ?>" method="post">
        <?= csrf_field() ?> <!-- Protezione CSRF -->

        <!-- ID Utente -->
        <label for="user_id">ID Utente:</label>
        <input type="number" id="user_id" name="user_id" value="<?= session()->get('id') ?>" readonly>

        <!-- Stato -->
        <label for="status">Stato:</label>
        <input type="text" id="status" name="status" value="In Attesa" readonly>

        <label for="basepizza">Base Pizza:</label>
        <input type="number" id="basepizza" name="basepizza" value="0" min="0">

        <label for="vino">Vino Primitivo:</label>
        <input type="number" id="vino" name="vino" value="0" min="0">

        <label for="olio">Olio Extravergine di oliva:</label>
        <input type="number" id="olio" name="olio" value="0" min="0">

        <label for="panzerotto">Base Panzerotto:</label>
        <input type="number" id="panzerotto" name="panzerotto" value="0" min="0">

        <label for="focacciatondabarese">Focaccia Tonda Barese:</label>
        <input type="number" id="focacciatondabarese" name="focacciatondabarese" value="0" min="0">

        <label for="focacciacateringbarese">Focaccia Catering Barese:</label>
        <input type="number" id="focacciacateringbarese" name="focacciacateringbarese" value="0" min="0">

        <label for="focacciacateringpomodoro">Focaccia Catering Pomodoro:</label>
        <input type="number" id="focacciacateringpomodoro" name="focacciacateringpomodoro" value="0" min="0">

        <label for="orecchiette">Orecchiette di Bari:</label>
        <input type="number" id="orecchiette" name="orecchiette" value="0" min="0" >

        <button type="submit">Carica Preventivo</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Controlla se c'è un messaggio di successo dalla sessione
    let successMessage = "<?= session()->getFlashdata('success') ?>";
    let errorMessage = "<?= session()->getFlashdata('error') ?>";

    if (successMessage) {
        Swal.fire({
            title: "Registrazione riuscita!",
            text: successMessage,
            icon: "success",
            confirmButtonText: "OK"
        });
    }

    if (errorMessage) {
        Swal.fire({
            title: "Errore!",
            text: errorMessage,
            icon: "error",
            confirmButtonText: "OK"
        });
    }

    // Validazione per evitare invio di campi numerici vuoti
    document.querySelector("form").addEventListener("submit", function (event) {
        let numericFields = ["basepizza", "vino", "olio", "panzerotto", "focacciatondabarese", 
                             "focacciacateringbarese", "focacciacateringpomodoro", "orecchiette"];
        let errorMessage = "";

        numericFields.forEach(function (field) {
            let fieldValue = document.getElementById(field).value.trim();
            if (fieldValue === "") {
                errorMessage += `Il campo "${field}" non può essere vuoto.\n`;
            }
        });

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
<script>
document.addEventListener("DOMContentLoaded", function () {
    let form = document.querySelector("#preventivo-form");
    
    form.addEventListener("submit", function (event) {
        let isLoggedIn = "<?= session()->has('id') ? 'yes' : 'no' ?>"; // Controlla se l'utente è loggato

        if (isLoggedIn === "no") {
            event.preventDefault(); // Blocca l'invio del form
            Swal.fire({
                title: "Effettua il login",
                text: "Devi essere loggato per inviare un preventivo.",
                icon: "warning",
                confirmButtonText: "Accedi",
                showCancelButton: true,
                cancelButtonText: "Annulla"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('/login') ?>"; // Reindirizza alla pagina di login
                }
            });
        }
    });
});
</script>

</body>