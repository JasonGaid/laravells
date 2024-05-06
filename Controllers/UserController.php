<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User;
 
class UserController extends Controller
{
    public function index()
    {
        $users = User::get(); 
    
        return view('user.index', ['users' => $users]);
    }
 
}