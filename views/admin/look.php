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
<h1>Users:</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach ($users as $user) {
        ?>
        <tr>
            <th scope="row"><?= $user->id ?></th>
            <td><?= $user->name ?></td>
            <td><?= $user->email ?></td>
            <td><?= $user->status ?></td>
            <td>

            </td>
        </tr>
        <?
            }
        ?>
        </tbody>
    </table>
</body>
</html>