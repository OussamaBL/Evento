<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $mediaUrls = $reservation->event->getMedia('images')->map(function ($media) {
            return $media->getFullUrl();
        });
        $reservation->status="accepted";
        $reservation->event->place_dispo--;
        $reservation->save();
        $reservation->event->save();
        generateTicketPDF($reservation);
        return redirect()->route('event.approve',$reservation->event->id)->with("success", 'Reservation is accepted');
    }
    public function refuse(Reservation $reservation){
        $reservation->status="refuse";
        $reservation->save();
        return redirect()->route('event.approve',$reservation->event->id)->with("success", 'Reservation is refused');
    }
    public function my_reservation(Request $request){
        $reservations=Reservation::where('user_id',$request->user()->id)->paginate(20);
        return view('my_reservations',compact('reservations'));
    }


    public function success(Request $request)
    {

        $reservation_identity = session()->get('reservation_identity');
        $eventId = session()->get('eventId');

        $user = Auth::user()->id;

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');


        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);


            if (!$session) {
                throw new NotFoundHttpException();
            }

            try {
                $reservation = Reservation::where('reservation_identity', $reservation_identity)->firstOrFail();
            } catch (\Throwable $th) {
                $errorMessage = $th->getMessage();
                dd($errorMessage);
            }


            DB::beginTransaction();

            try {
                $payment = Payment::create([
                    'payment_id' => $session->id,
                    'reservation_identity' => $reservation_identity,
                    'amount' => $session->amount_total,
                    'currency' => $session->currency,
                    'payment_status' => $session->status,
                    'payment_method' => $session->payment_method_types[0],
                ]);

                $reservation->status="accepted";
                $reservation->save();
                $reservation->event->place_dispo--;
                $reservation->event->save();
                // $this->generateTicketPDF($reservation);
                generateTicketPDF($reservation);
                DB::commit();
                return redirect()->route('my_reservation')->with("success", 'Payment & Reservation Successfully');
                
            } catch (\Throwable $th) {
                DB::rollback();
                $errorMessage = $th->getMessage();
                dd($errorMessage);
            }

        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }

        // send ticket here 
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
