<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Personale Admin</title>
    <meta name="csrf-token" content="<?= csrf_hash(); ?>"> <!-- Token CSRF -->
    <script>
        let currentPage = 1;

        function visualizzaUtenti(page = 1) {
            fetch(`<?= base_url('/get-users') ?>?page=${page}`)
                .then(response => response.json())
                .then(data => {
                    let container = document.getElementById("users-container");
                    container.innerHTML = "";

                    if (data.status === "success") {
                        let table = `<table border="1">
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

                        // Paginazione
                        let pagination = `<div class="pagination">`;
                        for (let i = 1; i <= data.total_pages; i++) {
                            pagination += `<button onclick="visualizzaUtenti(${i})" ${i === page ? 'disabled' : ''}>${i}</button>`;
                        }
                        pagination += `</div>`;
                        container.innerHTML += pagination;

                        currentPage = page;
                    } else {
                        container.innerHTML = "<p>Nessun utente trovato.</p>";
                    }
                })
                .catch(error => {
                    console.error("Errore nel caricamento:", error);
                    document.getElementById("users-container").innerHTML = "<p>Errore nel caricamento degli utenti.</p>";
                });
        }

        function mostraFormElimina() {
            document.getElementById("elimina-form").style.display = "block";
        }

        function eliminaUtente() {
            let email = document.getElementById("emailToDelete").value;
            if (!email) {
                alert("Inserisci un'email valida!");
                return;
            }

            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('<?= base_url('/delete-user') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `email=${encodeURIComponent(email)}&csrf_test_name=${csrfToken}`
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === "success") {
                    document.getElementById("elimina-form").style.display = "none";
                    visualizzaUtenti(currentPage);
                }
            })
            .catch(error => {
                console.error("Errore nell'eliminazione:", error);
            });
        }

        function mostraFormCaricaCatalogo() {
            let form = document.getElementById("carica-form");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Area Personale Admin</h1>
    </div> 
    <div class="container">
        <button onclick="visualizzaUtenti()">Visualizza Users Registrati</button>
    </div>
    <div class="container">
        <button onclick="mostraFormElimina()">Elimina Utente</button>
    </div> 
    <div class="container">
        <button onclick="mostraFormCaricaCatalogo()">Carica Elemento Catalogo</button>
    </div>
    <div class="container">
        <div id="users-container"></div>
    </div>

    <!-- Form di eliminazione utente (inizialmente nascosto) -->
    <div class="container" id="elimina-form" style="display: none;">
        <h3>Elimina Utente</h3>
        <label for="emailToDelete">Inserisci l'Email:</label>
        <input type="email" id="emailToDelete" required>
        <button onclick="eliminaUtente()">Conferma Eliminazione</button>
    </div>

    <!-- Form per caricare elemento nel catalogo (inizialmente nascosto) -->
    <div class="container" id="carica-form" style="display: none;">
        <h2>Carica Elemento nel Catalogo</h2>
        <form action="<?= base_url('/add-product') ?>" method="post">
            <?= csrf_field() ?>  <!-- Protezione CSRF -->

            <label for="nomeprodotto">Nome Prodotto:</label>
            <input type="text" id="nomeprodotto" name="nomeprodotto" required>

            <label for="codiceprodotto">Codice Prodotto:</label>
            <input type="text" id="codiceprodotto" name="codiceprodotto" required>

            <label for="immagine">Percorso Immagine:</label>
            <input type="text" id="immagine" name="immagine" placeholder="es. num.webp" required>

            <button type="submit">Carica Prodotto</button>
        </form>
    </div>
</body>
</html>
