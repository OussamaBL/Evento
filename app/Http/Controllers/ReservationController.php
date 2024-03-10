<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReservationController extends Controller
{
    
    public function generateTicketPDF(Reservation $reservation,$mediaUrls) {
        // Load your HTML template for the ticket
        $html = view('ticket', ['reservation' => $reservation,'image'=>$mediaUrls])->render();
    
        // Setup Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
    
        // Instantiate Dompdf with options
        $dompdf = new Dompdf($options);
    
        // Load HTML content
        $dompdf->loadHtml($html);
    
        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        
        // Save the generated PDF to the public folder
        $pdfFileName = 'ticket_' . $reservation->id . '.pdf';
        $pdfFilePath = public_path('tickets/' . $pdfFileName);
        file_put_contents($pdfFilePath, $dompdf->output());
 
        // Optionally, you can store the file path in the database for future reference
        $reservation->ticket = 'tickets/' . $pdfFileName;
        $reservation->save();

        // Output the generated PDF (you can also save it to a file, or return it as a response)
        // $dompdf->stream('ticket.pdf');
    }
   
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
        $this->generateTicketPDF($reservation,$mediaUrls);
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
