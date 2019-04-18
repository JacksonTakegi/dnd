<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<style type="text/css">
    .glyphicon-trash{color:#c70404;
    font-size: large;}
    .roll-input{
    width:100px!important;
    }
    input#roll {
    width: 25px;
    }
    .main-table{
    	margin-top:50px;
    }
</style>
<div class="row main-table">
    <div class="col-md-4 col-md-offset-4">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Roll</th>
                <th>Health</th>
                <th>Actions</th>
                <th>Current Turn</th>
            </tr>
            <?php
                foreach ($combats as $combat) {
                    ?> 
            <tr>
                <td> <?=$combat->character->name?> </td>
                <td>
                    <span class='currentroll'><?=$combat->roll?>  </span> 
                    <form class="rollform" action='combat/editroll/<?=$combat->id?>' method="post" id='newroll'>
                        {{ csrf_field() }}
                        <input type="text" name="roll" id='roll' value='<?=$combat->roll?>'>   
                    </form>
                </td>
                <td> <?=$combat->character->current_health."/".$combat->character->max_health?>   </td>
                <td> <a href='combat/delete/<?=$combat->id?>'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                    <a href="combat/maketurn/<?=$combat->id?>"><span class='glyphicon glyphicon-triangle-left' aria-hidden='true'></span></a>
                    <a href="#" class="editroll"><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                </td>
                <td> <?php if ($combat->current_turn) {
                        echo "<span class= 'glyphicon glyphicon-flash'></span> ";
                    } ?> </td>
            </tr>
            <?php
                }
                ?>
        </table>
    </div>
    <div class="col-md-4">
        <a href="/combat/nexturn" class="btn btn-default">Next Turn</a>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-4">
        <form class="form-inline" action='combat/add' method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Character</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Butts">
            </div>
            <div class="form-group">
                <label for="race">Race</label>
                <input type="text" class="form-control" id="race" name="race" placeholder="Butts">
            </div>
            <div class="form-group">
                <label for="roll">Roll</label>
                <input type="text" class="form-control roll-input" id="roll" name="roll" placeholder="11">
            </div>
            <div class="form-group">
                <label for="api">Load Defaults</label>
                <input type="checkbox" name="api" >
            </div>
            <div class="form-group">
                <label for="health">Health</label>
                <input type="text" class="form-control" id="health" name="health" placeholder="11">
            </div>
            <div class="form-group">
                <label for="AC">AC</label>
                <input type="text" class="form-control" id="ac" name="ac" placeholder="11">
            </div>
            <div class="form-group">
                <label for="class">Class</label>
                <input type="text" class="form-control" id="class" name="class" placeholder="11">
            </div>
            <div class="form-group">
                <label for="level">Level</label>
                <input type="text" class="form-control" id="level" name="level" placeholder="11">
            </div>



            <button type="submit" class="btn btn-default">Send invitation</button>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(".rollform").hide()
    $(".editroll").click(function(){
    	console.log($(this).parent().parent().find(".currentroll").toggle())
    	console.log($(this).parent().parent().find(".rollform").toggle())
    })
    
    
    
</script>