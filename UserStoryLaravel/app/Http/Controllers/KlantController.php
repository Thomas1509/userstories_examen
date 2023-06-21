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
                ->select(
                    'Gezin.Naam AS gezinNaam',
                    'Persoon.IsVertegenwoordiger',
                    'Contact.Email',
                    'Contact.Mobiel',
                    'Contact.Straat',
                    'Contact.Huisnummer',
                    'Contact.Toevoeging',
                    'Contact.Postcode',
                    'Contact.Woonplaats',
                    'Persoon.Id AS Id' 
                );
    
            if ($postcode) {
                $klanten->where('Contact.Postcode', $postcode);
            }
    
            $klanten = $klanten->get();
    
            $postcodes = Contact::distinct('Postcode')->pluck('Postcode');
    
            if ($klanten->isEmpty()) {
                $errorMessage = "Er zijn geen klanten bekend die de geselecteerde postcode hebben.";
                return view('klant.index', compact('klanten', 'postcodes', 'errorMessage'));
            }
    
            return view('klant.index', compact('klanten', 'postcodes'));
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching the klanten.');
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Haalt de gegevens van de klant uit de database
            $klant = Persoon::where('TypePersoon', 'Klant')
                ->join('Gezin', 'Persoon.gezin_id', '=', 'Gezin.Id')
                ->join('ContactPerGezin', 'Gezin.Id', '=', 'ContactPerGezin.gezin_id')
                ->join('Contact', 'ContactPerGezin.contact_id', '=', 'Contact.Id')
                ->select(
                    'Persoon.Id AS Id',
                    'Gezin.Naam AS gezinNaam', 
                    'Persoon.Voornaam', 
                    'Persoon.Tussenvoegsel', 
                    'Persoon.Achternaam', 
                    'Persoon.Geboortedatum', 
                    'Persoon.TypePersoon', 
                    'Persoon.IsVertegenwoordiger', 
                    'Contact.Straat', 
                    'Contact.Huisnummer', 
                    'Contact.Toevoeging', 
                    'Contact.Postcode', 
                    'Contact.Woonplaats', 
                    'Contact.Email', 
                    'Contact.Mobiel'
                )
                ->findOrFail($id);

            // Display the view with the customer data
            return view('klant.show', compact('klant'));
        } catch (ModelNotFoundException $e) {
            // Handle the case where the customer was not found
            return redirect()->back()->with('error', 'Klant not found.');
        } catch (QueryException $e) {
            // Handle the case where an error occurred while fetching the customer
            return redirect()->back()->with('error', 'An error occurred while fetching the klant.');
        }
    }
    

    public function edit($id)
    {
        $klant = Persoon::where('TypePersoon', 'Klant')->findOrFail($id);
        return view('klant.edit', compact('klant'));
    }



}