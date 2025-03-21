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
/* HERO SECTION */
.hero {
  background: url('public/img/puglia-background.jpg') no-repeat center center/cover;
  color: white;
  text-align: center;
  padding: 80px 20px;
}

.hero-content h1 {
  font-size: 38px;
  font-weight: bold;
}

.hero-content span {
  color: #ffcc00;
}

.cta-button {
  display: inline-block;
  background: #ff5722;
  color: white;
  padding: 12px 24px;
  border-radius: 6px;
  font-size: 18px;
  margin-top: 20px;
  text-decoration: none;
}

.cta-button:hover {
  background: #e64a19;
}

/* PRODOTTI */
.products {
  text-align: center;
  padding: 50px 20px;
  background: #f9f9f9;
}

.product-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
}

.product-item {
  background: white;
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  text-align: center;
  max-width: 250px;
}

.product-item img {
  max-width: 100%;
  border-radius: 8px;
}

.btn {
  display: inline-block;
  margin-top: 10px;
  background:#a97c50;
  color: white;
  padding: 8px 16px;
  border-radius: 4px;
  text-decoration: none;
}


/* CALL TO ACTION */
.cta {
  background: #ffcc00;
  text-align: center;
  padding: 40px;
}

.cta h2 {
  font-size: 28px;
  margin-bottom: 10px;
}

.cta p {
  font-size: 18px;
}

.cta-button {
  background: #ff5722;
}

    </style>
<body>
<div id="sez_principale">

       
        
        <section id="prodotti" class="products">
  <h2>🍕 I Nostri Prodotti</h2>
  <div class="product-grid">
    <div class="product-item">
      <img src="public/img/catalogo/1.webp" alt="Base per Pizza">
      <h3>Base per Pizza</h3>
      <p>Pronta da farcire, croccante e leggera.</p>
      <a href="#" class="btn">Scopri di più</a>
    </div>
    <div class="product-item">
      <img src="public/img/catalogo/9.webp" alt="Focaccia Barese">
      <h3>Olio extra vergine di oliva</h3>
      <p>Dal sapore intenso e convolgente</p>
      <a href="#" class="btn">Scopri di più</a>
    </div>
    <div class="product-item">
      <img src="public/img/catalogo/13.webp" alt="Panzerotto">
      <h3>Pasticciotto Leccese</h3>
      <p>Per una colazione da campioni</p>
      <a href="#" class="btn">Scopri di più</a>
    </div>
    <div class="product-item">
      <img src="public/img/catalogo/10.webp" alt="Pinsa Romana">
      <h3>Orecchiette baresi</h3>
      <p>Per un pranzo con cime di rape con i fiocchi</p>
      <a href="#" class="btn">Scopri di più</a>
    </div>
  </div>
</section>
<div id="sez_home">
                 <div class="containerhome">
                    
                          <div class="texthome">
                                <h2><b>ORO DI PUGLIA B2B</b> - Vendita di <strong>prodotti pugliesi per locali commerciali</strong>
                                </h2>
                                <h2><strong>Taralli</strong>, orecchiette, olio, vino e tanto altro con l'essenza della <strong>PUGLIA</strong></h2>
                                
                                <a href="<?= base_url('catalogo') ?>"><center> <button><span>VAI AL CATALOGO</span></button></center></a>
                          </div>
                          
                            <div class="imagehome">
                         
                            <video class="video-overlay" autoplay muted loop  controls>
                            <source src="<?= base_url('public/video/home.mp4') ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                  </video>
                             </div>
                      
                </div>
         
        </div>

</body>

