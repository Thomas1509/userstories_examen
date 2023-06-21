<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Gezin;
use App\Models\ContactPerGezin;
use App\Models\Persoon;

class KlantController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        try {
            $postcode = $request->input('postcode');
    
            $klanten = Persoon::where('TypePersoon', 'Klant')
                ->join('Gezin', 'Persoon.gezin_id', '=', 'Gezin.Id')
                ->join('ContactPerGezin', 'Gezin.Id', '=', 'ContactPerGezin.gezin_id')
                ->join('Contact', 'ContactPerGezin.contact_id', '=', 'Contact.Id')
                ->select('Gezin.Naam AS gezinNaam', 'Persoon.IsVertegenwoordiger', 'Contact.Email', 'Contact.Mobiel', 'Contact.Straat', 'Contact.Huisnummer', 'Contact.Toevoeging', 'Contact.Postcode', 'Contact.Woonplaats');
    
            if ($postcode) {
                $klanten->where('Contact.Postcode', $postcode);
            }
    
            $klanten = $klanten->get();
    
            $postcodes = Contact::select('Postcode')->distinct()->pluck('Postcode');
    
            if ($postcode && $klanten->isEmpty()) {
                return back()->withErrors('Er zijn geen klanten bekend die de geselecteerde postcode hebben.');
            }
    
            return view('klant.index', compact('klanten', 'postcodes'));
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching the klanten.');
        }
    }
    
}
