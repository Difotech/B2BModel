<body>
    <div class="container">
        <h1>Richiesta Preventivo</h1>
    </div>
    <div class="container">
        <div class="sez_catalogo" id="catalogo">
            <p>Caricamento prodotti...</p>
        </div>
    </div>
    <div class="container">
        <label for="email" id="emailLabel" style="display: none;">Email:</label>
        <input type="email" id="email" placeholder="Inserisci la tua email" style="display: none;">
        <button class="bottone" id="btnInvia" onclick="inviaRichiesta()">Invia richiesta di preventivo</button>
        <p id="feedback" style="display: none; color: green;"></p>
    </div>

    <script>
        console.log("🔍 Debug: Pagina caricata.");
        let richieste = [];

        async function caricaCatalogo() {
            try {
                let response = await fetch('<?= base_url('/catalogo1') ?>');
                let data = await response.json();
                let container = document.getElementById("catalogo");
                container.innerHTML = "";

                if (data.status === "success" && data.data.length > 0) {
                    data.data.forEach(prodotto => {
                        let articolo = `
                        <article>
                            <h3>${prodotto.nomeprodotto}</h3>
                            <img src="<?= base_url('public/img/catalogo/') ?>${prodotto.immagine}" width="250px">
                            <p>Codice: <span class="codice">${prodotto.codiceprodotto}</span></p>
                            <label>Quantità:</label>
                            <input type="number" min="0" value="0">
                        </article>`;
                        container.insertAdjacentHTML("beforeend", articolo);
                    });
                } else {
                    container.innerHTML = "<p>Nessun prodotto disponibile.</p>";
                }
            } catch (error) {
                console.error("❌ Errore nel caricamento catalogo:", error);
                document.getElementById("catalogo").innerHTML = "<p>Errore nel caricamento prodotti.</p>";
            }
        }

        async function inviaRichiesta() {
            let prodotti = [];
            document.querySelectorAll("article").forEach(articolo => {
                let codice = articolo.querySelector(".codice").innerText;
                let nome = articolo.querySelector("h3").innerText;
                let quantita = articolo.querySelector("input").value;
                if (quantita > 0) prodotti.push({ codice, nome, quantita });
            });

            if (prodotti.length === 0) {
                alert("Seleziona almeno un prodotto!");
                return;
            }

            let richiesta = { prodotti };
            let emailField = document.getElementById("email");

            if (emailField.style.display !== "none" && emailField.value.trim() === "") {
                alert("Inserisci un'email.");
                return;
            } else if (emailField.style.display !== "none") {
                richiesta.email = emailField.value.trim();
            }

            document.getElementById("btnInvia").disabled = true;
            document.getElementById("feedback").style.display = "block";
            document.getElementById("feedback").textContent = "Invio in corso...";

            try {
                let response = await fetch('<?= base_url('/faiunarichiesta1') ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(richiesta)
                });
                let data = await response.json();
                alert(data.message);
                document.getElementById("feedback").textContent = "Richiesta inviata con successo!";
            } catch (error) {
                alert("Errore tecnico. Contatta il supporto.");
                console.error("❌ Errore durante l'invio della richiesta:", error);
                document.getElementById("feedback").textContent = "Errore durante l'invio.";
            }

            document.getElementById("btnInvia").disabled = false;
        }

        window.onload = function() {
            caricaCatalogo();
            <?php if (!session()->get('isLoggedIn')): ?>
                document.getElementById("email").style.display = "block";
                document.getElementById("emailLabel").style.display = "block";
            <?php endif; ?>
        };
    </script>
</body>
