<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= DOMAIN ?>/public/css/custom.css" type="text/css">
    <title>Title</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-center">Structure 4 level</h1>
        </div>
        <div class="col-sm-12 text-center msg">
            <h3 class="btn"></h3>
        </div>
        <div class="col-sm-12 level_cont">
            <ul>
                <?php foreach ($data[0] as $row){ ?>
                    <li id="<?= $data[1]['level_class_name']?><?=$row['id']?>">
                        <?php if(isset($row['status']) && $row['status'] == 1 ) {?>
                            <span class="btn btn-default level_one" data-id="<?=$row['id']?>"><?=$row['name']?></span>
                        <?php } elseif (isset($row['status']) && $row['status'] == 0) { ?>
                            <span class="btn btn-default"><?=$row['name']?></span>
                            <span data-id="<?=$row['id']?>" data-level="<?= $data[1]['level_class_name']?>" class="getchilddirectories">+</span>
                            <ul></ul>
                        <?php } else {?>
                            <span class="btn btn-default level_one" data-id="<?=$row['id']?>"><?=$row['name']?></span>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?= DOMAIN ?>/public/js/custom.js"></script>
<script>
    let domain = '<?= DOMAIN ?>';
</script>
</body>
</html>