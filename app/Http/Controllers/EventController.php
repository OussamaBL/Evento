<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function events_pending(){
        $events=Event::where('status','pending')->paginate(10);
        return view('dashboard.events.events_pending',compact('events'));
    }
    public function events_refused(){
        $events=Event::where('status','refused')->paginate(10);
        return view('dashboard.events.events_refused',compact('events'));
    }
    public function events_accepted(){
        $events=Event::where('status','accepted')->paginate(10);
        return view('dashboard.events.events_accepted',compact('events'));
    }
    public function refuse_event($id){
        $event=Event::find($id);
        $event->status='refused';
        $event->save();
        return redirect()->route('dashboard.events.pending');
    }
    public function validate_event($id){
        $event=Event::find($id);
        $event->status='accepted';
        $event->save();
        return redirect()->route('dashboard.events.pending');
    }
    
    public function index()
    {
     }
  
    public function create(Request $request)
    {
        $categories = Category::all();
        return view('organizer.index', ['categories' => $categories]);
        
    }

    public function store(StoreEventRequest $request)
    {
        $userId = $request->user()->id;
        // dd($request->input('price'));
        if ($request->validated()) {
            try {
                $event = Event::create([
                    'place' => $request->input('place'),
                    'title' => $request->input('title'),
                    'price' => $request->input('price'),
                    'duration' => $request->input('duration'),
                    'description' => $request->input('description'),
                    'acceptance' => $request->input('acceptance'),
                    'nbr_place' => $request->input('nbr_place'),
                    'date_event' => $request->input('date_event'),
                    'category_id' => $request->input('category_id'),
                    'place_dispo' => $request->input('nbr_place'),
                    'user_id' => $userId,
                ]);

                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $event->addMediaFromRequest('image')->toMediaCollection('images');
                }
                return redirect()->route('event.create')->with("success", 'Created Successfully');

            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
            
        } else {
            return redirect()->back()->withInput()->withErrors($request->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event=Event::find($id);
        
    }

   
    public function update(StoreEventRequest $request, $id)
    {
        try{
            if($request->validated()){
                $userId = $request->user()->id;
                $event=Event::find($id);
                $event->update($request->validated());

            }
            
        }
        catch (\Throwable $th) {
            dd($th->getMessage());
        }
        
    }

  
    public function destroy($id)
    {
        $event=Event::find($id);
        $event->delete();

    }
}
