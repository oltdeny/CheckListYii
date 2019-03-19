<table class="table table-sm">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">User</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($checklists as $checklist) {
        ?>
        <tr>
            <th scope="row">
                <?= $checklist->id?>
            </th>
            <td><?= $checklist->name?></td>
            <td><?= $checklist->user->name?></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>