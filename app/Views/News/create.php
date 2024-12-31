<head>
</head>
<body>
<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= service('validation')->listErrors() ?>

<form action="create" method="post">
    <?= csrf_field() ?>

    <label for="id">News ID</label>
    <input type="input" name="id" /><br />

    <label for="title">Title</label>
    <input type="input" name="title" /><br />

    <label for="text">Text</label>
    <textarea name="text" cols="45" rows="4"></textarea><br />

    <label for="slug">Slug</label>
    <input type="input" name="slug" /><br />
    
     <input type="submit" name="submit" value="Create news item" />
</form>
</body>