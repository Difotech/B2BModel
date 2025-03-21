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
                            
                                <a href="<?= base_url('') ?>${prodotto.url}">
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