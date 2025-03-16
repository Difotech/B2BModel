

<h1>test</h1>
<body>
<div class="container">
<h1>Benvenuto: <?= esc(session()->get('nome')) ?> (ID: <?= esc(session()->get('id')) ?>)</h1>

</div>
<div class="container">
    <?php if (!session()->get('isLoggedIn')): ?>
        <p>Devi effettuare l'accesso per vedere le tue richieste.</p>
    <?php else: ?>
        <?php if (empty($richieste)): ?>
            <p>Non hai ancora effettuato richieste di preventivo.</p>
        <?php else: ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID Preventivo</th>
                        <th>Status</th>
                        <th>Data Richiesta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($richieste as $richiesta): ?>
                        <tr>
                            <td><?= esc($richiesta['id']) ?></td>
                            <td><?= esc($richiesta['status']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($richiesta['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>
