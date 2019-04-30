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
@include('navigation')
<div class="container-fluid">

    <?php foreach ($characters as $character) {
    ?>
    <div class="col-md-3 col-sm-6 character-card well">
        <div class="row" style="min-height:50px">
            <div class="col-md-3"><strong><?=$character->name?></strong></div>
            <div class="col-md-3"><?php
            if ($character->character_type=="inpc"||$character->character_type=="npc") {
            	echo $character->character_type;
            }
            echo $character->player;
            ?></div>
            <div class="col-md-3"><?=$character->race?></div>
            <div class="col-md-3"><?=$character->class . " " . $character->level?></div>
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
            <div class="col-md-3"><strong>HP</strong> <?=$character->current_health . "/" . $character->max_health?>
            </div>
            <div class="col-md-7" style="background-color:#d20b07; padding:0;"> 
                <?php if ( $character->max_health != 0) { // Avoid divide by zero errors ?>
            	<div class="current-health-bar" style="background-color:#3c763d; width:<?=$character->current_health/$character->max_health*100?>%; height:17px; border-right:1px solid black"></div> 
                <?php } ?>
            </div>
            <div class="col-md-2"><strong>AC</strong> <?=$character->ac?></div>
        </div>

    </div>
    <div class="col-md-1"></div>


    <?php }?>


    <form action='/characters/createcharacter' method="post">
    	{{ csrf_field() }}
    <div class="col-md-3 col-sm-6 character-card">
        <div class="row">
            <div class="col-md-3"><input type="text" class="form-control" id="name" name="name" placeholder="Name"></div>
            <div class="col-md-3"><input type="text" class="form-control" id="character_type" name="character_type" placeholder="npc"></div>
            <div class="col-md-3"><input type="text" class="form-control" id="race" name="race" placeholder="Race"></div>
            <div class="col-md-3"><input type="text" class="form-control" id="class" name="class" placeholder="Class"><input type="text" class="form-control" id="level" name="level" placeholder="1"></div>
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
                    <td><input type="text" class="form-control" id="str" name="str" placeholder="3"></td>
                    <td><input type="text" class="form-control" id="dex" name="dex" placeholder="3"></td>
                    <td><input type="text" class="form-control" id="con" name="con" placeholder="3"></td>
                    <td><input type="text" class="form-control" id="int" name="int" placeholder="3"></td>
                    <td><input type="text" class="form-control" id="wis" name="wis" placeholder="3"></td>
                    <td><input type="text" class="form-control" id="cha" name="cha" placeholder="3"></td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="text" class="form-control" id="max_health" name="max_health" placeholder="health">
            </div>
            <div class="col-md-7"> 
                <button type="submit" class="btn btn-default">Create Character</button>
            </div>
            <div class="col-md-2"><input type="text" class="form-control" id="ac" name="ac" placeholder="AC"></div>
        </div>

    </div>
    <div class="col-md-1"></div>

	</form>

</div>

