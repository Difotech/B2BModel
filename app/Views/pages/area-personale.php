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
                                                <th>Puccia</th>
                                                <th>Pinsa Romana</th>
                                                <th>Ciabatta</th>
                                                <th>Focaccia Tonda Barese</th>
                                                <th>Focaccia Catering Barese</th>
                                                <th>Focaccia Catering Pomodoro</th>
                                                <th>Focaccia Catering Bianca</th>
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
                                        <td>${richiesta.puccia}</td>
                                        <td>${richiesta.pinsaromana}</td>
                                        <td>${richiesta.ciabatta}</td>
                                        <td>${richiesta.focacciatondabarese}</td>
                                        <td>${richiesta.focacciacateringbarese}</td>
                                        <td>${richiesta.focacciacateringpomodoro}</td>
                                        <td>${richiesta.focacciacateringbianca}</td>
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
