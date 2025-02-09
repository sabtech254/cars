<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contactSeller(Request $request, Car $car)
    {
        $request->validate([
            'message' => 'required|min:10',
            'phone' => 'required|string',
        ]);

        // Get seller's email
        $seller = User::find($car->user_id);

        // Send email to seller
        Mail::send('emails.contact-seller', [
            'car' => $car,
            'message' => $request->message,
            'phone' => $request->phone,
            'buyer' => auth()->user(),
        ], function ($mail) use ($seller, $car) {
            $mail->to($seller->email)
                ->subject("Interest in your car: {$car->title}");
        });

        return back()->with('success', 'Your message has been sent to the seller. They will contact you soon.');
    }
}
