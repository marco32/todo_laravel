<?php 
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Liste;
/**
* 
*/
class ListController extends Controller
{
	// Function add list in bdd.
	public function addList(Request $request)
	{
		$list=new Liste;
		$list->name = $request->name;
		$list->created_at= $list->created_at;
        $list->save();
		return redirect('/');
	}
	public function deleteList($id)
	{
		$list=Liste::find($id);
		//dd($list->name);
		$del=DB::table('todolist')->where('name', $list->name)->delete();
		$list->delete();
		return redirect('/');
	}
}
 ?>