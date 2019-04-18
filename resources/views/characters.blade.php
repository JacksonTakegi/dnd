<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <style type="text/css">
        .ability-table table tr td, .ability-table table tr th {
            text-align: center !important;
        }

        .character-card {
            margin-top: 30px;
            margin-bottom: 20px;
        }
    </style>
</head>
<div class="container-fluid">

    <?php foreach ($characters as $character) {
    ?>
    <div class="col-md-3 col-sm-6 character-card">
        <div class="row">
            <div class="col-md-4"><strong><?=$character->name?></strong></div>
            <div class="col-md-4"><?=$character->player?></div>
            <div class="col-md-4"><?=$character->class . " " . $character->level?></div>
        </div>
        <div class="row ability-table">
            <table class="table">
                <tr>
                    <th>STR</th>
                    <th>DEX</th>
                    <th>CON</th>
                    <th>INT</th>
                    <th>WIS</th>
                    <th>CHA</th>
                </tr>
                <tr>
                    <td><?=$character->str?></td>
                    <td><?=$character->dex?></td>
                    <td><?=$character->con?></td>
                    <td><?=$character->int?></td>
                    <td><?=$character->wis?></td>
                    <td><?=$character->cha?></td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="col-md-10"><strong>HP</strong> <?=$character->current_health . "/" . $character->max_health?>
            </div>
            <div class="col-md-2"><strong>AC</strong> <?=$character->ac?></div>
        </div>

    </div>
    <div class="col-md-1"></div>


    <?php }?>

</div>

