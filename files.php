<html>
    <head>
        <title>File Manager</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    You are here : <?= $inst->getPath() ?>
                </div>
                <div class="col-6">
                    <?php echo $up; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="h2">Files</div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sort by name
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="?f=<?= $_GET['f']?>&sort=name_asc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">ASC</a>
                                <a href="?f=<?= $_GET['f']?>&sort=name_desc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">DESC</a>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sort by type
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="?f=<?= $_GET['f']?>&sort=type_asc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">ASC</a>
                                <a href="?f=<?= $_GET['f']?>&sort=type_desc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">DESC</a>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sort by size
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="?f=<?= $_GET['f']?>&sort=size_asc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">ASC</a>
                                <a href="?f=<?= $_GET['f']?>&sort=size_desc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">DESC</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <?php if (isset($files)) : ?>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Size</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($files as $val) : ?>
                                    <tr>
                                        <td>
                                            <?php if ($val['type'] == 1) { ?>
                                                <a href="?f=<?= $_GET['f'] ?>/<?= $val['res'] ?>"><?= $val['res'] ?></a>
                                            <?php } else { ?>
                                                <?= $val['res'] ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?= $inst->getType($val['type']) ?>
                                        </td>
                                        <td>
                                            <?= $val['size'] ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </body>
</html>