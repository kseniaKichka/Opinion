<?php
/**
 * Created by PhpStorm.
 * User: ksu
 * Date: 18.05.18
 * Time: 19:54
 */

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
Вы смотрите <?= $inst->getPath() ?>
<br>
<?php echo $up; ?>
<h1>Files</h1>

<div class="dropdown">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        По названию
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a href="?f=<?= $_GET['f']?>&sort=name_asc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">ASC</a>
        <a href="?f=<?= $_GET['f']?>&sort=name_desc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">DESC</a>
    </div>
</div>

<div class="dropdown">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        По типу
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a href="?f=<?= $_GET['f']?>&sort=type_asc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">ASC</a>
        <a href="?f=<?= $_GET['f']?>&sort=type_desc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">DESC</a>
    </div>
</div>

<div class="dropdown">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        По размеру
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a href="?f=<?= $_GET['f']?>&sort=size_asc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">ASC</a>
        <a href="?f=<?= $_GET['f']?>&sort=size_desc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">DESC</a>
    </div>
</div>


<?php if (isset($files)) : ?>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Имя</th>
        <th scope="col">Type</th>
        <th scope="col">Size</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($files as $val) : ?>
            <tr>
                <td>
1
                </td>
                <td>
                    <?php if ($val['type'] == 1) { ?>
                        <a href="?f=<?= $_GET['f'] ?>/<?= $val['res'] ?>"><?= $val['res'] ?></a>
                    <?php } else { ?>
                        <?= $val['res'] ?>
                    <?php } ?>
                </td>
                <td>
                    <?= $val['type'] ?>
                </td>
                <td>
                    <?= $val['size'] ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
