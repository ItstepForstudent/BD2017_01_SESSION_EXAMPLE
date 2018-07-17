<?php
require "functions.php";

$notes = getAllNotes();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border="1">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>action</th>
    </tr>
    <?php foreach ($notes as $note): ?>
        <tr>
            <td><?= $note['id'] ?></td>
            <td><?= $note['name'] ?></td>
            <td><a href="b.php?id=<?= $note['id'] ?>">delete</a></td>
        </tr>
    <?php endforeach; ?>
</table>


<form action="a.php" method="post">
    <input type="text" name="name">
    <input type="submit">
</form>
</body>
</html>
