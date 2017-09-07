<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todolist</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <nav style="display: inline-flex;">
            
                <div class="col-sm-4">
                <a href="?add=1">
                    <button class="btn btn-default">
                Ajouter une liste        
                    </button>
                </a>
                </div>
                <div class="col-m-4 col-sm-offset-4">
                    <a href="?all">
                        Voir toutes les listes
                    </a>
                </div>
                <div></div>
            
        </nav>
            <div class="container"> 
    <form action="/addList" method="POST" class="form-horizontal">
           {{ csrf_field() }}
      <div class="form-group">
        <?php if(isset($_GET['add'])){
            echo '
        <label for="name" class="col-sm-2 control-label">Nom de la liste</label>
        <div class="col-sm-6">
          <input name="name" id="name">
        </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Valider</button>
        </div>
</div>';
            } ?>
      </div>
    </form> 
    <?php if(isset($_GET['add'])){
            echo '
      <a href="/">    
      <button class="btn btn-info">Retour</button>
      </a>';
      } ?>
    <ul>
       @foreach ($list as $value) 
        <?php if(isset($_GET['all'])){
        ?>
             
            <li>{{$value->name}}</li>
        <?php }
             ?>
@endforeach
    </ul>           
  <div> 
    <form action='/addTodolist' method="POST" class="form-horizontal">
      {{ csrf_field() }}
      
      <div class="form-group">
        <label for="task" class="col-sm-1 control-label">Taches</label>
        <div class="col-sm-4">
          <input id="task" class="form-control" name="task" >
        </div>
        <label for="name" class="col-sm-1 control-label">liste :</label>
        <div class="col-sm-2">
          <select name="name" id="name">
          @foreach ($list as $value)
          <option value={{$value->name}}>{{$value->name}}</option>
          @endforeach
          </select>
      </div>
      <div class="form-group">
        <div class="col-sm-2">
          <button type="submit" class="btn btn-success">Valider</button>
        </div>
      </div>
      </div>
    </form>        
</div>  
  <div>
  <table>
          
      @foreach ($todolist as $value)
      <tr>
      <td class={{$value->status}}>
      {{$value->task}}
      </td>
      <td>
          
      <a href="/updateTodolist/{{$value->id}}">Fait</a>
      </td>
      <td>
          
      <form action="/deleteTodolist/{{$value->id}}" method="Post">
      {{ csrf_field() }}
        <input type="text" name="id" value={{$value->id}} style="display:none;">
        <button class="btn btn-danger"></button>
      </form>
      </td>
      </tr>
      
      @endforeach
  </table>
  

  </div>
    </body>
</html>
