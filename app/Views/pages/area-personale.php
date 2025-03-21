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
<body>
    <div class="container">
        <h1>Benvenuto: <?= esc(session()->get('nome')) ?> (ID: <?= esc(session()->get('id')) ?>)</h1>
        <h2>Le tue richieste di preventivo</h2>   
    </div>

    <div class="container">
        <div id="richieste-container">
            <p>Caricamento preventivi...</p>
        </div>
    </div>

    <script>
        function caricaPreventivi() {
            fetch('<?= base_url('/area-personale1') ?>')
                .then(response => response.json())
                .then(data => {
                    console.log("✅ Dati ricevuti:", data);
                    let container = document.getElementById("richieste-container");
                    container.innerHTML = ""; 

                    if (data.status === "success" && data.data.length > 0) {
                        let table = `<table border="1">
                                        <thead>
                                            <tr>
                                                <th>ID Preventivo</th>
                                                <th>Status</th>
                                                <th>Data Richiesta</th>
                                                <th>Base Pizza</th>
                                                <th>Vino Primitivo</th>
                                                <th>Olio extravergine di Oliva</th>
                                                <th>Base Panzerotto</th>
                                                <th>Focaccia Tonda Barese</th>
                                                <th>Focaccia Catering Barese</th>
                                                <th>Focaccia Catering Pomodoro</th>
                                                <th>Orecchiette di Bari</th>
                                                <th>Azioni</th>
                                            </tr>
                                        </thead>
                                        <tbody>`;

                        data.data.forEach(richiesta => {
                            table += `<tr>
                                        <td>${richiesta.id}</td>
                                        <td>${richiesta.status}</td>
                                        <td>${new Date(richiesta.created_at).toLocaleString()}</td>
                                        <td>${richiesta.basepizza}</td>
                                        <td>${richiesta.vino}</td>
                                        <td>${richiesta.olio}</td>
                                        <td>${richiesta.panzerotto}</td>
                                        <td>${richiesta.focacciatondabarese}</td>
                                        <td>${richiesta.focacciacateringbarese}</td>
                                        <td>${richiesta.focacciacateringpomodoro}</td>
                                        <td>${richiesta.orecchiette}</td>
                                        <td><button onclick="eliminaPreventivo(${richiesta.id})">Elimina</button></td>
                                    </tr>`;
                        });

                        table += `</tbody></table>`;
                        container.innerHTML = table;
                    } else {
                        container.innerHTML = "<p>Nessuna richiesta di preventivo trovata.</p>";
                    }
                })
                .catch(error => {
                    console.error("❌ Errore nel caricamento:", error);
                    document.getElementById("richieste-container").innerHTML = "<p>Errore nel caricamento dei preventivi.</p>";
                });
        }

        function eliminaPreventivo(id) {
    if (confirm("Sei sicuro di voler eliminare questo preventivo?")) {
        fetch('<?= base_url('/elimina-preventivo') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?= csrf_hash() ?>' // Aggiunge il token CSRF
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert("Preventivo eliminato con successo.");
                caricaPreventivi();
            } else {
                alert("Errore nell'eliminazione del preventivo.");
            }
        })
        .catch(error => {
            console.error("❌ Errore nella richiesta di eliminazione:", error);
            alert("Errore nella richiesta di eliminazione.");
        });
    }
}


        window.onload = caricaPreventivi;
    </script>
</body>
