<!DOCTYPE html>
<html lang="it">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Admin</title>
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
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Personale Admin</title>
    <meta name="csrf-token" content="<?= csrf_hash(); ?>"> <!-- Token CSRF -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let currentPage = 1;

        function visualizzaUtenti(page = 1) {
            fetch(`<?= base_url('/get-users') ?>?page=${page}`)
                .then(response => response.json())
                .then(data => {
                    let container = document.getElementById("users-container");
                    container.innerHTML = "";

                    if (data.status === "success" && data.users.length > 0) {
                        let table = `<table>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>`;

                        data.users.forEach(user => {
                            table += `<tr>
                                        <td>${user.id}</td>
                                        <td>${user.nome}</td>
                                        <td>${user.email}</td>
                                    </tr>`;
                        });

                        table += `</tbody></table>`;
                        container.innerHTML = table;

                        let pagination = `<div class="pagination">`;
                        for (let i = 1; i <= data.total_pages; i++) {
                            pagination += `<button onclick="visualizzaUtenti(${i})" ${i === page ? 'disabled' : ''}>${i}</button>`;
                        }
                        pagination += `</div>`;
                        container.innerHTML += pagination;
                    } else {
                        container.innerHTML = "<p>Nessun utente trovato.</p>";
                    }
                })
                .catch(error => {
                    console.error("Errore nel caricamento:", error);
                    document.getElementById("users-container").innerHTML = "<p>Errore nel caricamento degli utenti.</p>";
                });
        }

        function toggleVisualizzaUtenti(page = 1) {

            
            let container = document.getElementById("users-container");

            if (container.style.display === "none" || container.style.display === "") {
                container.style.display = "block";
                visualizzaUtenti(page);
            } else {
                container.style.display = "none";
            }
        }

        function mostraFormElimina() {
    let form = document.getElementById("elimina-form");

    // Alterna la visibilità del form
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}
function eliminaUtente() {
        let email = document.getElementById("emailToDelete").value.trim();

        if (!email) {
            Swal.fire("Errore", "Inserisci un'email valida!", "warning");
            return;
        }

        let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            Swal.fire("Errore", "Formato email non valido. Inserisci un'email corretta (es. esempio@email.com).", "error");
            return;
        }

        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        Swal.fire({
            title: "Sei sicuro?",
            text: "L'utente verrà eliminato definitivamente.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sì, elimina",
            cancelButtonText: "Annulla"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('<?= base_url('/delete-user') ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `email=${encodeURIComponent(email)}&csrf_test_name=${csrfToken}`
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire("Risultato", data.message, data.status === "success" ? "success" : "error");
                    if (data.status === "success") {
                        document.getElementById("elimina-form").style.display = "none";
                    }
                })
                .catch(error => {
                    Swal.fire("Errore", "Si è verificato un problema. Riprova più tardi.", "error");
                    console.error("Errore nell'eliminazione:", error);
                });
            }
        });
    }


        function mostraFormCaricaCatalogo() {
            let form = document.getElementById("carica-form");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }

        function mostraFormEliminaProdotto() {
            let form = document.getElementById("elimina-prodotto-form");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }

        function eliminaProdotto() {
            let codiceProdotto = document.getElementById("codiceProdottoDelete").value;
            if (!codiceProdotto) {
                alert("Inserisci un codice prodotto valido!");
                return;
            }

            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('<?= base_url('/delete-product') ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `codiceprodotto=${encodeURIComponent(codiceProdotto)}&csrf_test_name=${csrfToken}`
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === "success") {
                    document.getElementById("elimina-prodotto-form").style.display = "none";
                }
            })
            .catch(error => {
                console.error("Errore nell'eliminazione:", error);
            });
        }

        function mostraFormAggiornaPreventivo() {
            let form = document.getElementById("aggiorna-preventivo-form");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }


        function visualizzaPreventivi() {
            fetch('<?= base_url('/get-all-preventivi') ?>')
                .then(response => response.json())
                .then(data => {
                    let container = document.getElementById("preventivi-container");
                    container.innerHTML = "";

                    if (data.status === "success") {
                        let table = `<table border="1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Cliente</th>
                                                <th>Stato</th>
                                                <th>Data Richiesta</th>
                                                <th>Base Pizza</th>
                                                <th>Vino Primitivo</th>
                                                <th>Olio extravergine di Oliva</th>
                                                <th>Base Panzerotto</th>
                                                <th>Focaccia Tonda Barese</th>
                                                <th>Focaccia Catering Barese</th>
                                                <th>Focaccia Catering Pomodoro</th>
                                                <th>Orecchiette di Bari</th>
                                            </tr>
                                        </thead>
                                        <tbody>`;

                        data.preventivi.forEach(preventivo => {
                            table += `<tr>
                                        <td>${preventivo.id}</td>
                                        <td>${preventivo.user_id}</td>
                                        <td>${preventivo.status}</td>
                                         <td>${preventivo.created_at}</td>
                                        <td>${preventivo.basepizza}</td>
                                        <td>${preventivo.vino}</td>
                                        <td>${preventivo.olio}</td>
                                        <td>${preventivo.panzerotto}</td>
                                        <td>${preventivo.focacciatondabarese}</td>
                                        <td>${preventivo.focacciacateringbarese}</td>
                                        <td>${preventivo.focacciacateringpomodoro}</td>
                                        <td>${preventivo.orecchiette}</td>
                                    </tr>`;
                        });

                        table += `</tbody></table>`;
                        container.innerHTML = table;
                    } else {
                        container.innerHTML = "<p>Nessun preventivo trovato.</p>";
                    }
                })
                .catch(error => {
                    console.error("Errore nel caricamento:", error);
                    document.getElementById("preventivi-container").innerHTML = "<p>Errore nel caricamento dei preventivi.</p>";
                });
        }




        function aggiornaPreventivo() {
        let idPreventivo = document.getElementById("idPreventivo").value;
        if (!idPreventivo) {
            alert("Inserisci un ID preventivo valido!");
            return;
        }

        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('<?= base_url('/update-preventivo-status') ?>', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': csrfToken // Aggiunto nel header
            },
            body: `id_preventivo=${encodeURIComponent(idPreventivo)}&csrf_test_name=${csrfToken}`
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.status === "success") {
                document.getElementById("aggiorna-preventivo-form").style.display = "none";
            }
        })
        .catch(error => {
            console.error("Errore nell'aggiornamento:", error);
        });
    }
    </script>
</head>
<body>
    <div class="container">
        <h1>Area Personale Admin</h1>
    </div> 

    <div class="container">
   
        <button onclick="toggleVisualizzaUtenti()">Visualizza Users Registrati</button>
        
        <button onclick="mostraFormElimina()">Elimina Utente</button>
    
        <button onclick="mostraFormCaricaCatalogo()">Carica Elemento Catalogo</button>
   
        <button onclick="mostraFormEliminaProdotto()">Elimina Prodotto</button>
    
        <button onclick="visualizzaPreventivi()">Mostra Preventivi</button>
    
        <button onclick="mostraFormAggiornaPreventivo()">Aggiorna Stato Preventivo</button>
    
        <div id="users-container"></div>
    
    <div class="container" id="elimina-form" style="display: none;">
        <h3>Elimina Utente</h3><center>
        <label for="emailToDelete">Inserisci l'Email:</label>
        <input type="email" id="emailToDelete" required>
        <button onclick="eliminaUtente()">Conferma Eliminazione</button></center>
    </div>
    <div class="container" id="carica-form" style="display: none;">
    <h2>Carica Elemento nel Catalogo</h2>
    <center>
        <form action="<?= base_url('/add-product') ?>" method="post" onsubmit="return confermaInserimento()">
            <?= csrf_field() ?>
            <label for="nomeprodotto">Nome Prodotto:</label>
            <input type="text" id="nomeprodotto" name="nomeprodotto" required>

            <label for="immagine">Percorso Immagine:</label>
            <input type="text" id="immagine" name="immagine" required>
            
            <button type="submit">Carica Prodotto</button>
        </form>
    </center>
</div>

<script>
    function confermaInserimento() {
        return confirm("Sei sicuro di voler inserire questo prodotto?");
    }
</script>
  <!-- Form per eliminare un prodotto -->
  <div class="container" id="elimina-prodotto-form" style="display: none;">
        <h3>Elimina Prodotto</h3><center>
        <label for="codiceProdottoDelete">Inserisci il Codice Prodotto:</label>
        <input type="text" id="codiceProdottoDelete" required>
        <button onclick="eliminaProdotto()">Conferma Eliminazione</button></center>
    </div>

    <div class="container">
        <div id="preventivi-container"></div> <!-- Aggiunto questo div -->
    </div>
    
    <div class="container" id="aggiorna-preventivo-form" style="display: none;">
        <h3>Aggiorna Stato Preventivo</h3><center>
        <label for="idPreventivo">Inserisci l'ID del Preventivo:</label>
        <input type="text" id="idPreventivo" required>
        <button onclick="aggiornaPreventivo()">Conferma Aggiornamento</button></center>
    </div>
</body>
</html>
