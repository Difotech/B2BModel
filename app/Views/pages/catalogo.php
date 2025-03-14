<body>
<div class="container">
<h1>Catalogo Prodotti</h1></div>
    <div class="container">
       
        <div class="sez_catalogo" id="catalogo">
            <p>Caricamento prodotti...</p>
        </div>
    </div>

    <script>
        console.log("🔍 Debug: La pagina è stata caricata correttamente.");

        function caricaCatalogo() {
            fetch('<?= base_url('/catalogo1') ?>')
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Errore nel recupero dei dati.");
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("✅ Debug: Dati ricevuti dal server:", data);
                    let container = document.getElementById("catalogo");
                    container.innerHTML = ""; // Svuota il contenitore

                    if (data.status === "success" && data.data.length > 0) {
                        data.data.forEach(prodotto => {
                            let articolo = `
                            <article>
                                <div>
                                    <h3>${prodotto.nomeprodotto}</h3>
                                </div>
                               <div>
    <img id="imgcatalogo" src="<?= base_url('public/img/catalogo/') ?>${prodotto.immagine}" width="250px" alt="${prodotto.nomeprodotto}">
</div>

                                <p id="testoCatalogo">
                                    Codice prodotto:
                                    <br>
                                    ${prodotto.codiceprodotto}
                                </p>
                                <a href="<?= base_url('catalogo/') ?>${prodotto.codiceprodotto}">
                                    <button class="bottone"><span>Caratteristiche</span></button>
                                </a>
                            </article>`;

                            container.insertAdjacentHTML("beforeend", articolo);
                        });
                    } else {
                        container.innerHTML = "<p>Nessun prodotto disponibile.</p>";
                    }
                })
                .catch(error => {
                    console.error("❌ Errore nel caricamento dei dati:", error);
                    document.getElementById("catalogo").innerHTML = "<p>Errore nel caricamento dei prodotti.</p>";
                });
        }

        // Carica il catalogo quando la pagina è caricata
        window.onload = caricaCatalogo;
    </script>
</body>
