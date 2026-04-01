<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:newsletter_subscribers,email'
        ]);

        NewsletterSubscriber::create([
            'email' => $request->email,
            'is_active' => true
        ]);

        session()->flash('success', 'Thank you for subscribing to our newsletter!');
        
        return redirect()->back();
    }
}