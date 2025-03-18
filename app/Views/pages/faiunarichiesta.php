<!-- Form per inserire un nuovo preventivo -->

    <div class="container">
    <h1>Inserisci un nuovo preventivo</h1>
</div>
<div class="container" id="carica-preventivo-form">
    <form action="<?= base_url('/faiunarichiesta1') ?>" method="post">
        <?= csrf_field() ?> <!-- Protezione CSRF -->

        <!-- ID Utente -->
        <label for="user_id">ID Utente:</label>
        <input type="number" id="user_id" name="user_id" value="<?= session()->get('id') ?>" readonly>

        <!-- Stato -->
        <label for="status">Stato:</label>
        <input type="text" id="status" name="status" value="In Attesa" readonly>

        <label for="basepizza">Base Pizza:</label>
        <input type="number" id="basepizza" name="basepizza">

        <label for="puccia">Puccia:</label>
        <input type="number" id="puccia" name="puccia">

        <label for="pinsaromana">Pinsa Romana:</label>
        <input type="number" id="pinsaromana" name="pinsaromana">

        <label for="ciabatta">Ciabatta:</label>
        <input type="number" id="ciabatta" name="ciabatta">

        <label for="focacciatondabarese">Focaccia Tonda Barese:</label>
        <input type="number" id="focacciatondabarese" name="focacciatondabarese">

        <label for="focacciacateringbarese">Focaccia Catering Barese:</label>
        <input type="number" id="focacciacateringbarese" name="focacciacateringbarese">

        <label for="focacciacateringpomodoro">Focaccia Catering Pomodoro:</label>
        <input type="number" id="focacciacateringpomodoro" name="focacciacateringpomodoro">

        <label for="focacciacateringbianca">Focaccia Catering Bianca:</label>
        <input type="number" id="focacciacateringbianca" name="focacciacateringbianca">

        <button type="submit">Carica Preventivo</button>
    </form>
</div>
