<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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
        $events_pending=Event::where('status','pending')->count();
        $events_accepted=Event::where('status','accepted')->count();
        $reservations=Reservation::count();
        $roles=Role::count();

        return view('dashboard',compact('spectators','organizers','categories','events_pending','events_accepted','reservations','roles'));
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
