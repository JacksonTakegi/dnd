<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="/js/awesomplete.js"></script>
    <link rel="stylesheet" href="/css/awesomplete.css">
    <style type="text/css">
        .glyphicon-trash {
            color: #c70404;
            font-size: large;
        }

        .glyphicon-tint {
            color: #c70404;
        }

        input.roll-input {
            width: 25px;
        }

        input.damage-input {
            width: 20px;
            display: inline !important;
        }

        form.damageform {
            display: inline;
        }

        .main-table {
            margin-top: 50px;
        }

        .awesomplete{
            width: 100%;
        }
        .character-card {
            margin-top:30px;
            margin-bottom:30px;
            padding: 15px;
            border: 2px solid cornflowerblue;
            background-color: #dde3ea;
            box-shadow: #DADAD5 4px 4px 5px;
            border-radius: 5px;
        }
    </style>
</head>
@include('navigation')
<div class="col-md-2" style="top:20px">
    <a href="/combat/reset" class="btn btn-default reset-button">Full Reset</a>
</div>
<div class="container">
<div class="row main-table">
    <div class="col-md-10">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Roll</th>
                <th>Health</th>
                <th>Actions</th>
                <th style="width:130px">Current Turn</th>
            </tr>
            <?php
            foreach ($combats as $combat) {
            ?>
            <tr>
                <td> <?=$combat->character->name?> </td>
                <td>
                    <span class='currentroll'><?=$combat->roll?>  </span>
                    <form class="rollform" action='/combat/editroll/<?=$combat->id?>' method="post">
                        {{ csrf_field() }}
                        <input class="roll-input" type="text" name="roll" value='<?=$combat->roll?>'>
                    </form>
                </td>

                <td>                                <?php if ($combat->character->max_health != 0) { // Avoid divide by zero errors ?>
                    <?=$combat->character->current_health . "/" . $combat->character->max_health?>
                    <div class="col-md-12" style="background-color:#d20b07; padding:0;">
                        <div class="current-health-bar"
                             style="background-color:#3c763d; width:<?=$combat->character->current_health / $combat->character->max_health * 100?>%; height:5px; border-right:1px solid black"></div>
                    </div>
                    <?php } ?>

                </td>
                <td><a href='/combat/delete/<?=$combat->id?>'><span class='glyphicon glyphicon-trash'
                                                                    aria-hidden='true'></span></a>
                    <a href="combat/maketurn/<?=$combat->id?>"><span class='glyphicon glyphicon-triangle-left'
                                                                     aria-hidden='true'></span></a>
                    <a href="#" class="editroll"><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                    <a href="#" class="takedamage"><span class='glyphicon glyphicon-tint' aria-hidden='true'></span></a>
                    <form class="damageform" action='/combat/takedamage/<?=$combat->id?>' method="post">
                        {{ csrf_field() }}
                        <input class="damage-input" type="text" name="damage" id='damage'>
                    </form>
                    <!-- Damage icon w/ hidden form to subtract from current health -->
                </td>
                <td style='text-align:center' > <?php if ($combat->current_turn) {
                        echo "<span class= 'glyphicon glyphicon-flash'></span> ";
                    } ?> </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="col-md-2">
        <a href="/combat/nexturn" class="btn btn-default">Next Turn</a>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-3"><button type="submit" data-show="add-existing" class="add-btn btn btn-default">Add Existing Character</button></div>
    <div class="col-md-3"><button type="submit" data-show="add-generated-monster" class="add-btn btn btn-default">Add Pre-made Monster</button></div>
    <div class="col-md-3"><button type="submit" data-show="create-monster" class="add-btn btn btn-default">Add Custom Character</button></div>
    <div class=col-md-3"><a href="/combat/addall" class="btn btn-default">Add All PCs</a></div>
</div>
<div class="row">
    <div class="add-existing character-card col-md-6 col-md-offset-3">
        <h3>Add Character</h3>
        <form action='/combat/add/existing' method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="form-group col-md-8 ">
                    <select name="id" class="form-control">
                    <?php 
                    foreach ($characters as $character) {
                        ?><option value="<?= $character->id ?>"><?= $character->name ?></option><?php
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <input class="form-control" type="number" name="roll" placeholder="Roll">
                </div>
            </div>
            <button class="submit">Send Invitation</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="add-generated-monster character-card col-md-10 col-md-offset-1">
        <h3>Add Generated Monster</h3>
        <form action='/combat/add/generate' method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control awesomplete" id="race" name="race"
                                   data-list="<?= implode(",", $monsters->pluck('name')->toArray()) ?>" placeholder="Type">
                </div>
                <div class="form-group col-md-2">
                    <input type="number" class="form-control" name="roll" placeholder="Roll">
                </div>
            </div>
            <button class="submit">Send Invitation</button>
        </form>
    </div>
</div>

<div class="row" id="">
    <div class="create-monster character-card col-md-10 col-md-offset-1">
                <h3>Create and Add Character</h3>

       <form action='/combat/add/create' method="post">
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3"><input type="text" class="form-control name" id="name" name="name"
                                                         placeholder="Name">
                            </div>
                            <div class="col-md-2"><select type="text" class="form-control type" id="character_type"
                                                         name="character_type"
                                                         placeholder="npc">

                                                         <option value="npc">NPC</option>
                                                         <option value="inpc">Important NPC</option>
                                                         <option value="pc">Player</option>
                            </select>
                            </div>
                            <div class="col-md-3"><input type="text" class="form-control race" id="race" name="race"
                                                         placeholder="Race">
                            </div>
                            <div class="col-md-2"><input type="text" class="form-control class" id="class" name="class"
                                                         placeholder="Class">
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control level"
                                                                                    id="level"
                                                                                    name="level" placeholder="Level">
                            </div>
                        </div>
                        <div class="row ability-table col-md-12">
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
                                    <td><input type="text" class="form-control str" id="str" name="str" placeholder="3">
                                    </td>
                                    <td><input type="text" class="form-control dex" id="dex" name="dex" placeholder="3">
                                    </td>
                                    <td><input type="text" class="form-control con" id="con" name="con" placeholder="3">
                                    </td>
                                    <td><input type="text" class="form-control int" id="int" name="int" placeholder="3">
                                    </td>
                                    <td><input type="text" class="form-control wis" id="wis" name="wis" placeholder="3">
                                    </td>
                                    <td><input type="text" class="form-control cha" id="cha" name="cha" placeholder="3">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group"><input type="text" class="form-control" id="max_health"
                                                         name="max_health"
                                                         placeholder="health">
                            </div>
                            <div class="col-md-3 form-group"><input type="text" class="form-control" id="roll"
                                                         name="roll"
                                                         placeholder="roll">
                            </div>
                           
                            <div class="col-md-3 form-group"><input type="text" class="form-control" id="ac" name="ac"
                                                         placeholder="AC"></div>
                                                          <div class="col-md-3">
                            </div>
                            <div class="col-md-3 form-group"><button class="submit btn btn-primary">Send Invitation</button></div>
                        </div>
                        
                </form>
    </div>
</div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(".rollform").hide()
    $(".editroll").click(function () {
        $(this).parent().parent().find(".currentroll").toggle()
        $(this).parent().parent().find(".rollform").toggle()
        $(this).parent().parent().find(".roll-input").focus()
    })
    $(".damageform").hide()
    $(".takedamage").click(function () {
        $(this).parent().parent().find(".takedamage").toggle()
        $(this).parent().parent().find(".damageform").toggle()
        $(this).parent().parent().find(".damage-input").focus()
    })

    // Hide all the input forms to start
    $(".character-card").hide()

    // When an add button is clicked, remove the btn-primary class
    // from all other buttons, and add btn-primary to the one that 
    // was just clicked.
    //
    // Hide all the character input fields, and show the one thats 
    // referenced in the buttons "data-show" attribute
    $(".add-btn").click(function(){

        $(".add-btn").removeClass("btn-primary")
        $(this).addClass("btn-primary")

        var toShow = $(this).data('show')
        $(".character-card").hide()
        $("." + toShow).show()
    })
    $(".reset-button").click(function () {
        var confirmation=confirm("This will delete everything in the combat, put the saved PCs at full health, and erase all NPCs. It would be a hassle to fix this mistake, tread carefully.")
        if (!confirmation) {
            return false
        }
    })
    
</script>

