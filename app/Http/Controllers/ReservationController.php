<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
   
    public function index(Event $event)
    {
        $reservations=Reservation::where('event_id',$event->id)->where('status','accepted')->get();
        return view('organizer.reservation_accepted',compact('reservations'));
    }
    public function reservations_pending(Event $event){
        $reservations=Reservation::where('event_id',$event->id)->where('status','pending')->get();
        return view('organizer.reservation_pending',compact('reservations'));
    }
    public function accept(Reservation $reservation){
        $reservation->status="accepted";
        $reservation->event->place_dispo--;
        $reservation->save();
        $reservation->event->save();
        // GenerateTicket()
        return redirect()->route('event.approve',$reservation->event->id)->with("success", 'Reservation is accepted');
    }
    public function refuse(Reservation $reservation){
        $reservation->status="refuse";
        $reservation->save();
        return redirect()->route('event.approve',$reservation->event->id)->with("success", 'Reservation is refused');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
