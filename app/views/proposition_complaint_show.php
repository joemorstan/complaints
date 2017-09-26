<p><strong>Name:</strong> <?= $data->name ?></p>
<p><strong>Email:</strong> <?= $data->email ?></p>
<?= empty($data->url) ? '' : '<p><strong>Url:</strong> '. $data->url. '</p>' ?>
<p>
    <strong>Message: </strong>
    <?= $data->content ?>
</p>