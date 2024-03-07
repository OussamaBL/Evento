<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
       
        $categories = Category::all();
        $events = Event::where('status', 'accepted')->paginate(10);
        return view('welcome', compact('events','categories'));
    }
    public function event(){
        return view('event_page');
    }
}
