<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Fai una Richiesta di Preventivo</title>
</head>
<body>
    <h1>Fai una Richiesta</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;">
            <?= session()->getFlashdata('success') ?>
        </p>
    <?php endif; ?>

    <form action="<?= base_url('/faiUnaRichiesta') ?>" method="post">
        <?= csrf_field() ?>

        <label for="codiceprodotto">Codice Prodotto:</label>
        <input type="text" name="codiceprodotto" id="codiceprodotto" required>

        <br><br>

        <label for="note">Note Aggiuntive:</label><br>
        <textarea name="note" id="note" rows="4" cols="50"></textarea>

        <br><br>

        <button type="submit">Invia Richiesta</button>
    </form>

</body>
</html>
