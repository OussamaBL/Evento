<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $events = Event::where('user_id', Auth::id())
               ->whereIn('status', ['accepted', 'pending'])
               ->paginate(10);
        return view('organizer.events', compact('events'));
    }

     public function viewEvent($id)
    {
        try {
            $event = Event::where('id', $id) ->where('status', 'accepted')->firstOrFail();
            return view('event_page', ['event' => $event]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return view('404');
        }
    }

     public function Categoryfilter(Request $request)
    {
        $categoryToFilter = $request->input('category');
        return  $this->filterByCategory($categoryToFilter);
    }
  
     public function search(Request $request)
    {
        $titleToSearch = $request->input('title');
        $searchResults = $this->searchByTitle($titleToSearch);
        return $searchResults;
    }

    public function filterByCategory($categoryId)
    {

        $events = Event::where('category_id', $categoryId)->where('status','accepted')->get();
        $eventsWithMedia = $events->map(function ($event) {
            $mediaUrls = $event->getMedia('images')->map(function ($media) {
                return $media->getFullUrl();
            });

            return [
                'event' => $event,
                'media' => $mediaUrls,
            ];
        });

        return response()->json(['events' => $eventsWithMedia]);
    }

    public function searchByTitle($title)
    {
        if($title!="all") $events = Event::where('title', 'like', "%{$title}%")->where('status','accepted')->get();
        else $events = Event::where('status','accepted')->get();
        
        $eventsWithMedia = $events->map(function ($event) {
            $mediaUrls = $event->getMedia('images')->map(function ($media) {
                return $media->getFullUrl();
            });

            return [
                'event' => $event,
                'media' => $mediaUrls,
            ];
        });

        return response()->json(['events' => $eventsWithMedia]);
    }
    
    public function create(Request $request)
    {
        $categories = Category::all();
        return view('organizer.add_event', ['categories' => $categories]);
        
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

   
    public function edit($id)
    {
        $categories = Category::all();
        $event=Event::find($id);
        return view('organizer.edit_event',compact('event','categories'));
    }

   
    public function update(UpdateEventRequest $request, $id)
    {
        try{
            if($request->validated()){
                $userId = $request->user()->id;
                $event=Event::find($id);
                $form = $request->validated();
                $event->update($form);

                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $event->clearMediaCollection('images');
                    $event->addMediaFromRequest('image')->toMediaCollection('images');
                }
                return redirect()->route('event.index')->with("success", 'Updated Successfully');
            }
            
            else {
                return redirect()->back()->withInput()->withErrors($request->errors());
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
        return redirect()->route('event.index');

    }
    public function details(Request $request,Event $event){
        $access_reservation=true;
        $res=Reservation::where('user_id',$request->user()->id)->where('event_id',$event->id)->first();
        if($event->place_dispo<=0 || strtotime($event->date_event) < strtotime('today') || $res || $event->user_id==$request->user()->id || $request->user()->hasRole('admin')) $access_reservation=false;
        return view('event_page',compact('event','access_reservation'));
    }

    public function reservation(Request $request,Event $event){
        $access_reservation=true;
        $res=Reservation::where('user_id',$request->user()->id)->where('event_id',$event->id)->first();
        if($event->place_dispo<=0 || strtotime($event->date_event) < strtotime('today') || $res || $event->user_id==$request->user()->id || $request->user()->hasRole('admin')) $access_reservation=false; 
        if($access_reservation){
            if($event->price!=0){
                echo 'payment';
            }
            else{
                if($event->acceptance=='auto'){
                    $reservation=Reservation::create([
                        'user_id'=>$request->user()->id,
                        'event_id'=>$event->id,
                        'status'=>'accepted', 
                    ]);
                    $event->place_dispo--;
                    $event->save();
                    // $this->GenerateTicket();
                    return redirect()->route('event.details')->with("success", 'Reservation Successfully');
                }
                else{
                    $reservation=Reservation::create([
                        'user_id'=>$request->user()->id,
                        'event_id'=>$event->id,
                        'status'=>'pending', 
                    ]);
                    return redirect()->route('event.details')->with("success", 'Reservation in pending Successfully');
                }
            } 
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->errors());
        }
    }
    public function GenerateTicket(){

    }
}
