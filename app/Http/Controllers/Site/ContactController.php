<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

use App\Models\Contact;
use App\Notifications\NewContact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.contact.index');
    }

    /**
     * Send the user contact informations.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function send(Request $request)
    {
        $contact = Contact::create($request->all());

        Notification::route('mail', config('mail.from.address'))
            ->notify(new NewContact($contact));
    }
}
