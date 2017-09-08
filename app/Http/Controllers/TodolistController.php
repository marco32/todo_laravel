<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Todolist;
/**
* 
*/
class TodolistController extends Controller
{

	// Function get all bdd "todolist/list" and return this view.
	public function getAll()
	{
		$todolist=Todolist::orderby('name')->get();
		$list=DB::table('list')->get();

		return view('/welcome', ['todolist' =>$todolist],['list' =>$list] );

	}

	// Function get in bdd "list" and "todolist" if name egal request and return this view.
	public function tri(Request $request)
	{ 
	
		 if($request->tri == "all"){
			return redirect('/');
		 }else{
		 	$name=$request->tri;
		 $list=DB::table('list')->get();
		 $todolist=Todolist::where('name', $name)->get();
		 	

		 return view('/welcome', ['todolist' =>$todolist],['list' =>$list] );

		 }
	}
	// Function update with this "ID".
	public function updateTodolist($id, $tri)
	{
		$Todolist=Todolist::find($id);

       $Todolist->name= $Todolist->name;
      $Todolist->task= $Todolist->task;
      if($Todolist->status === "false"){

    $Todolist->status= "true";
      }else{
      	    $Todolist->status= "false";

      }
     $Todolist->created_at= $Todolist->created_at;
        $Todolist->save();
		return redirect('/');
	}
	// Function add task in todolist bdd.
	public function addTodolist(Request $request)
	{
		$Todolist= new Todolist;
		if(!empty($request->name)){
       $Todolist->name= $request->name;	
		}
      $Todolist->task= $request->task;
    	$Todolist->status= "false";
		$Todolist->save();
		return redirect('/');
	}

	// Function search and delete this whith this "ID".
	public function deleteTodolist(Request $request, $id)
	{
				$Todolist= Todolist::find($id);
				$Todolist->delete();
				return redirect('/');
	}
	public function updtask(Request $request)
	{
		$id= $request->id;
		$todolist= Todolist::find($id);
		$todolist->name = $todolist->name;
		$todolist->task = $request->task;
		$todolist->created_at = $todolist->created_at;
		$todolist->save();
		return redirect('/');
	}
}

 ?>