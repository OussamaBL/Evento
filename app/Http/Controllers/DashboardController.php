<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $spectators=User::whereHas('roles',function($query){
            $query->where('name','spectator');
        })->count();
        $organizers=User::whereHas('roles',function($query){
            $query->where('name','organizer');
        })->count();
        $categories=Category::count();
        $Events=Event::count();
        

        return view('dashboard');
    }
    public function users(){
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'organizer')
                  ->orWhere('name', 'spectator');
        })->paginate(10);
        return view('dashboard.users',compact('users'));
    }
    public function delete_user($id){
        $user=User::find($id);
        $user->delete();
        return redirect()->route('dashboard.users');
    }
    
}
