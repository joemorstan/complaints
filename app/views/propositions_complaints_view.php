<table class="table">

    <thead>
        <tr>
            <th>id</th>
            <th><a href="<?= URL. $data['topic']. '/page/1/name/'. ($data['order'] == 'asc' ?  'desc' : 'asc')?>">Name</a></th>
            <th><a href="<?= URL. $data['topic']. '/page/1/email/'. ($data['order'] == 'asc' ?  'desc' : 'asc')?>">Email</a></th>
            <th>Url</th>
            <th><?= ucfirst(rtrim($data['topic'], 's')) ?></th>
            <th><a href="<?= URL. $data['topic']. '/page/1/created_at/'. ($data['order'] == 'asc' ?  'desc' : 'asc')?>">Created at</a></th>

            <?php if (Auth::check()):?>
                <th>Edit</th>
                <th>Delete</th>
            <?php endif;?>

        </tr>
    </thead>

    <?php foreach ($data['items'] as $item): ?>
    <tbody>
        <tr>
            <th scope="row"><?= $item->id ?></th>
            <td><?= $item->name ?></td>
            <td><?= $item->email ?></td>
            <td><?= !empty($item->url) ? $item->url : '-' ?></td>
            <td><a href="<?= URL. strtolower($data['topic']) ?>/show/<?= $item->id ?>">view</a></td>
            <td><?= $item->created_at ?></td>

            <?php if (Auth::check()):?>
                <td><a href="<?= URL. strtolower($data['topic']) ?>/edit/<?= $item->id ?>">edit</a></td>
                <td><a class="delete-row" href="<?= URL. strtolower($data['topic']) ?>/delete/<?= $item->id ?>">delete</a></td>
            <?php endif;?>

        </tr>
    </tbody>
    <?php endforeach ?>

</table>

<div class="row justify-content-center">
    <nav>
        <?php require_once ROOT. '/app/views/includes/pagination.php'?>
    </nav>
</div>
