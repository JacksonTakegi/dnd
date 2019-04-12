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
                <th>Actions</th>
                <th>Current Turn</th>
            </tr>
            <?php
                foreach ($users as $user) {
                	?> 
            <tr>
                <td> <?=$user->name?> </td>
                <td>
                    <span class='currentroll'><?=$user->roll?>  </span> 
                    <form class="rollform" action='combat/editroll/<?=$user->id?>' method="post" id='newroll'>
                        {{ csrf_field() }}
                        <input type="text" name="roll" id='roll' value='<?=$user->roll?>'>   
                    </form>
                </td>
                <td> <a href='combat/delete/<?=$user->id?>'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                    <a href="combat/maketurn/<?=$user->id?>">test</a>
                    <a href="#" class="editroll">Edit Roll</a>
                </td>
                <td> <?php if ($user->turn) {
                    echo "<span class= 'glyphicon glyphicon-flash'></span> ";
                    }?> </td>
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
                <label for="character">Character</label>
                <input type="text" class="form-control" id="character" name="character" placeholder="Butts">
            </div>
            <div class="form-group">
                <label for="roll">Roll</label>
                <input type="text" class="form-control roll-input" id="roll" name="roll" placeholder="11">
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