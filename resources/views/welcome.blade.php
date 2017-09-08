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
    <nav class="navbar  navbar-inverse">
        <a href="?add=1">
            <button class="navbar-btn btn btn-default">
                Ajouter une liste        
            </button>
        </a>
        <a href="?all">
            Voir toutes les listes
        </a>
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
<table>
    <tbody>
     @foreach ($list as $value) 
     <?php if(isset($_GET['all'])){
        ?>
        <tr>
            <td>{{$value->name}}</td> 
            <td><a href="/deleteList/{{$value->id}}"><button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></a></td>
        </tr>        
        <?php }
        ?>
        @endforeach
    </tbody>
</table>
<div> 
    <form action='/addTodolist' method="POST" class="form-horizontal">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="task" class="col-sm-1 control-label">Taches</label>
        <div class="col-sm-4">
          <input id="task" class="form-control" name="task" >
      </div>
      <label for="name" class="col-sm-1 control-label">liste :</label>
      <div class="col-sm-2 align">
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
  <div>
      <h4>Selection à afficher</h4>
      <form action="/t" method="get">
          <select name="tri" >
              <option value="all">Tout</option>
              @foreach ($list as $value)
              <option value={{$value->name}}>{{$value->name}}</option>
              @endforeach
          </select>
          <button class="btn btn-info chang">Valider</button>
      </form>
  </div>
  <table class="table">
      <tr>
          <th>Liste</th>
          <th>Tâche</th>
          <th></th>
          <th></th>
      </tr>
      <tbody class="table-stripped">
          @foreach ($todolist as $value)
          <tr>
              <td class={{$value->status}}>{{$value->name}}</td>
              <td class={{$value->status}}><a href="?task={{$value->task}}&id={{$value->id}}">{{$value->task}}</a></td>
              <td><a href="/updateTodolist/{{$value->id}}/{{$value->name}}"><i class="glyphicon glyphicon-ok"></i></a></td>
              <td><form action="/deleteTodolist/{{$value->id}}" method="Post">{{ csrf_field() }}<input type="text" name="id" value={{$value->id}} style="display:none;"><button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></form>
              </td>
          </tr>      
          @endforeach
      </tbody> 
  </table>
  <form action="/updtask" method="post">
      {{ csrf_field() }}
  <?php if (isset($_GET['task'])) {
    echo '
    <label id="task">Tache à modifier: </label>  
  <input id="task" type="text" name="task" value='.$_GET["task"].'>';
  echo '
  <input type="text" name="id" style="display:none;" value='.$_GET["id"].'>';
  echo '
  <button class="btn btn-success">Valider</button>';
  } ?>
  </form>
</div>
</body>
</html>
