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
            <div class="col-sm-12">
                <form action="create/levelone" class="form-controll text-center" method="POST">
                    <div class="form-group">
                        <input type="text" name="levelname" id="" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="status" class="status" value="1"> Define as finalnode
                    </div>
                    <div class="form-group">
                        <button type="submit">Create level</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 text-center msg">
                <h3 class="btn"></h3>
            </div>
            <div class="col-sm-12 level_cont">
                <ul>
                    <?php foreach ($data as $row){ ?>
                        <li id="level_one<?=$row['id']?>">
                            <?php if(isset($row['status']) && $row['status'] == 1 ) {?>
                                <span class="btn btn-default level_one" data-id="<?=$row['id']?>"><?=$row['name']?></span>
                            <?php } else { ?>
                                <span class="btn btn-default level_one" data-toggle="modal" data-target="#myModal" data-id="<?=$row['id']?>"><?=$row['name']?></span>
                                <span data-id="<?=$row['id']?>" data-level="level_one" class="getchilddirectories">+</span>
                                <ul></ul>
                            <?php }?>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">New directory name</h4>
                        </div>
                        <div class="modal-body">
                            <div>
                                <input type="text" placeholder="Name" class="levelname">
                            </div>
                            <div>
                                <input type="checkbox" class="status" value="1"> Define as finalnode
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary create_level" id="get_data" data-leveltype="" data-levelid="">save</button>
                        </div>
                    </div>
                </div>
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