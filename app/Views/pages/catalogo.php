<body>
<div class="container">
<h1>Catalogo Prodotti</h1>
<div id="catalogo">
<p>Caricamento prodotti...</p>
</div>
</div>
 
    <script>
        console.log("🔍 Debug: La pagina è stata caricata correttamente.");
 
        // Funzione per caricare i dati da /catalogo1
        function caricaCatalogo() {
            fetch('<?= base_url('/ catalogo1') ?>')
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
                            let div = document.createElement("div");
                            div.classList.add("product");
                            div.innerHTML = `<h2>${prodotto.nomeprodotto}</h2>
<p>Codice: ${prodotto.codiceprodotto}</p>
<img src="${prodotto.immagine}" alt="${prodotto.nomeprodotto}">`;
                            container.appendChild(div);
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
