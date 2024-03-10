<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StripController extends Controller
{
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

                $reservation->update([
                    'status' => "accepted",
                ]);
                $reservation->save();

                DB::commit();

                return redirect()->route('home.event', $eventId)->with("success", 'Reservation Successfully');
                
            } catch (\Throwable $th) {
                DB::rollback();
                $errorMessage = $th->getMessage();
                dd($errorMessage);
            }

            return view('product.checkout-success');
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }

        // send ticket here 
    }
}
