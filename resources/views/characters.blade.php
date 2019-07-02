<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"
            integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
            crossorigin="anonymous"></script>

    <style type="text/css">
        .ability-table table tr td, .ability-table table tr th {
            text-align: center !important;
        }

        .character-card {
            margin-top: 30px;
            margin-bottom: 20px;
            border: 2px solid cornflowerblue;
            background-color: #dde3ea;
            box-shadow: #DADAD5 4px 4px 5px;
            border-radius: 5px;

        }

        .hovertech {
            max-height: 0px;
            overflow: hidden;
            -webkit-transition: max-height 1s ease-out;
            -moz-transition: max-height 1s ease-out;
            -o-transition: max-height 1s ease-out;
            transition: max-height 1s ease-out;
        }

        .character-card:hover .hovertech {
            max-height: 300px;
            overflow: initial;
        }

        .row.cards {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
@include('navigation')
<div class="container-fluid">

    <?php $i = 0;
    echo "<div>";
    foreach ($characters as $character) {
    if ($i % 3 == 0) {
        echo "</div>";
        echo "<div class='row cards'>";
    }
    $i++;
    ?>
    <div class="col-md-3 col-sm-6 character-card well">
        <div class="row" style="min-height:50px">
            <div class="col-md-3"><strong><?=$character->name?></strong></div>
            <div class="col-md-3"><?php
                if ($character->character_type == "inpc" || $character->character_type == "npc") {
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
                <div class="current-health-bar"
                     style="background-color:#3c763d; width:<?=$character->current_health / $character->max_health * 100?>%; height:17px; border-right:1px solid black"></div>
                <?php } ?>
            </div>
            <div class="col-md-2"><strong>AC</strong> <?=$character->ac?></div>
        </div>

        <div class="hovertech">
            <a href='/character/delete/<?=$character->id?>'><span class='glyphicon glyphicon-trash'
                                                                  aria-hidden='true'></span></a>
            <a data-character='<?=json_encode($character)?>' href="#" class="edit-character" data-toggle="modal" data-target="#currentCard">
                <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>

        </div>

    </div>
    <div class="col-md-1"></div>


    <?php }
    echo "</div>";
    ?>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <form action='/characters/createcharacter' method="post">
                        {{ csrf_field() }}
                        <div class="character-card well">
                            <div class="row">
                                <div class="col-md-3"><input type="text" class="form-control" id="name" name="name"
                                                             placeholder="Name">
                                </div>
                                <div class="col-md-3"><input type="text" class="form-control" id="character_type"
                                                             name="character_type"
                                                             placeholder="npc"></div>
                                <div class="col-md-3"><input type="text" class="form-control" id="race" name="race"
                                                             placeholder="Race">
                                </div>
                                <div class="col-md-3"><input type="text" class="form-control" id="class" name="class"
                                                             placeholder="Class"><input type="text" class="form-control"
                                                                                        id="level"
                                                                                        name="level" placeholder="1">
                                </div>
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
                                        <td><input type="text" class="form-control" id="str" name="str" placeholder="3">
                                        </td>
                                        <td><input type="text" class="form-control" id="dex" name="dex" placeholder="3">
                                        </td>
                                        <td><input type="text" class="form-control" id="con" name="con" placeholder="3">
                                        </td>
                                        <td><input type="text" class="form-control" id="int" name="int" placeholder="3">
                                        </td>
                                        <td><input type="text" class="form-control" id="wis" name="wis" placeholder="3">
                                        </td>
                                        <td><input type="text" class="form-control" id="cha" name="cha" placeholder="3">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-3"><input type="text" class="form-control" id="max_health"
                                                             name="max_health"
                                                             placeholder="health">
                                </div>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-default">Create Character</button>
                                </div>
                                <div class="col-md-2"><input type="text" class="form-control" id="ac" name="ac"
                                                             placeholder="AC"></div>
                            </div>

                        </div>
                        <div class="col-md-1"></div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
        Create New Character
    </button>
</div>

<div class="modal fade" id="currentCard" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <form action='/characters/createcharacter' method="post">
                    {{ csrf_field() }}
                    <div class="character-card well">
                        <div class="row">
                            <div class="col-md-3"><input type="text" class="form-control name-edit" id="name" name="name"
                                                         placeholder="Name">
                            </div>
                            <div class="col-md-3"><input type="text" class="form-control type-edit" id="character_type"
                                                         name="character_type"
                                                         placeholder="npc"></div>
                            <div class="col-md-3"><input type="text" class="form-control race-edit" id="race" name="race"
                                                         placeholder="Race">
                            </div>
                            <div class="col-md-3"><input type="text" class="form-control class-edit" id="class" name="class"
                                                         placeholder="Class"><input type="text" class="form-control level-edit"
                                                                                    id="level"
                                                                                    name="level" placeholder="1">
                            </div>
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
                                    <td><input type="text" class="form-control str-edit" id="str" name="str" placeholder="3">
                                    </td>
                                    <td><input type="text" class="form-control dex-edit" id="dex" name="dex" placeholder="3">
                                    </td>
                                    <td><input type="text" class="form-control con-edit" id="con" name="con" placeholder="3">
                                    </td>
                                    <td><input type="text" class="form-control int-edit" id="int" name="int" placeholder="3">
                                    </td>
                                    <td><input type="text" class="form-control wis-edit" id="wis" name="wis" placeholder="3">
                                    </td>
                                    <td><input type="text" class="form-control cha-edit" id="cha" name="cha" placeholder="3">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><input type="text" class="form-control health-edit" id="max_health"
                                                         name="max_health"
                                                         placeholder="health">
                            </div>
                            <div class="col-md-7">
                                <button type="submit" class="btn btn-default">Create Character</button>
                            </div>
                            <div class="col-md-2"><input type="text" class="form-control ac-edit" id="ac" name="ac"
                                                         placeholder="AC"></div>
                        </div>

                    </div>
                    <div class="col-md-1"></div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(".edit-character").click(function () {
        var characterData = $(this).data("character");
        console.log($(this).data("character"))
        $('.name-edit').val(characterData.name);
        $('.type-edit').val(characterData.character_type);
        $('.race-edit').val(characterData.race);
        $('.class-edit').val(characterData.class);
        $('.level-edit').val(characterData.level);
        $('.str-edit').val(characterData.str);
        $('.dex-edit').val(characterData.dex);
        $('.con-edit').val(characterData.con);
        $('.int-edit').val(characterData.int);
        $('.wis-edit').val(characterData.wis);
        $('.cha-edit').val(characterData.cha);
        $('.health-edit').val(characterData.max_health);
        $('.ac-edit').val(characterData.ac);

    })
</script>

