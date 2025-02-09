<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Send email to admin
        Mail::send('emails.contact-form', [
            'name' => $request->name,
            'email' => $request->email,
            'userMessage' => $request->message,
        ], function ($mail) {
            $mail->to(config('mail.from.address'))
                ->subject('New Contact Form Submission');
        });

        return back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }

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
