<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\User;
  
class UserController extends Controller
{
   
    public function index(Request $request)
    {
        $users = User::select("*");
  
        if ($request->has('view_deleted')) {
            $users = $users->onlyTrashed();
        }
  
        $users = $users->paginate(8);
          
        return view('users', compact('users'));
    }
  
   
    public function delete($id)
    {
        User::find($id)->delete();
  
        return  back()->with('success');
       }
  
   
    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
        return  back();

    }  
  
    
    public function restoreAll()
    {
      User::onlyTrashed()->restore();
      return  back();

  
     }
}
