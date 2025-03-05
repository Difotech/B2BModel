<!--<html>
        <head>
                <title>CodeIgniter Tutorial</title>
        </head>
        <body>
       --<h1><?= esc($title) ?></h1>-$_COOKIE->

-->

<!DOCTYPE html>
<html lang="it">
        <head>
          <title>Murgiapizza - Vendita di basi pizza all'ingrosso</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="Description" CONTENT="Scopri le autentiche basi per pizza di Santeramo in Colle, Puglia. Semplici da usare e irresistibilmente deliziose. Gusta la Puglia con ogni morso!">
  
  <meta name="keywords" content="basi pizza, basi per pizza, puccia, focaccia barese, panzerotto, pinsa romana, saltimbocca, ciabatta, prodotti italiani, prodotti pugliesi, ingredienti di qualità, spedizioni internazionali, basi pizza precotte, basi per puccia, prodotti precotti italiani, base pizza italiana, base pizza napoletana, focaccia barese preparata, murgia pizza, murgiapizza, basi per pizza puglia, basi per pizza Italia, murgia pizza basi pizza, murgia, pizza, prodotti precotti, pizza per ristoranti">


  <meta name="robots" content="index, follow" />

<link rel="canonical" href="" />

  <!--CSS, ICON, FONTS-->
  <link rel="stylesheet" href="<?= base_url('public/style.css'); ?>" type="text/css">
  <link  rel = "apple-touch-icon"  href="./immagini/favicon.webp" >
  <link rel="icon" href="<?= base_url('public/img/favicon.webp'); ?>">
  

  
        </head>
        
        
        <body>
            
            
             <h1 hidden>Murgiapizza - Vendita di basi pizza all'ingrosso</h1>
    
  <div class="blog_title">
    <h2>Le basi pizza e prodotti ideali per la tua attività</h2>
        <img id="logo" src="<?= base_url('public/img/avatar.webp'); ?>" alt="murgiapizza">
  </div>
 
  <nav class="navbar">
  <ul>
    <li><a href="<?= base_url() ?>">HOME</a></li>
    <li><a href="<?= base_url('chi-siamo') ?>">CHI SIAMO</a></li>
    <li><a href="<?= base_url('catalogo') ?>">CATALOGO</a></li>
    <li><a href="<?= base_url('faiunarichiesta') ?>">FAI UNA RICHIESTA</a></li>
    <li><a href="<?= base_url('contattaci') ?>">CONTATTACI</a></li>
    <li><a href="<?= base_url('blog') ?>">BLOG</a></li>
  </ul>
  <div class="user-info">
    <?php if (session()->get('isLoggedIn')): ?>
      <span>
            <a href="<?= base_url('area-personale') ?>">👤 <?= session()->get('nome') ?></a>
        </span>
   </div>  
        <button onclick="window.location.href='<?= base_url('logout') ?>';">Logout</button>
    <?php else: ?>
        <button onclick="window.location.href='<?= base_url('login') ?>';">Login</button>
    <?php endif; ?>


</nav>
