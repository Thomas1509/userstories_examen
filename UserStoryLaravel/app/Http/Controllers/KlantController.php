<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Gezin;
use App\Models\ContactPerGezin;
use App\Models\Persoon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Throwable;
use Illuminate\Validation\Rule;

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
        $klant = Persoon::where('Persoon.TypePersoon', 'Klant')
            ->join('ContactPerGezin', 'Persoon.gezin_id', '=', 'ContactPerGezin.gezin_id')
            ->join('Contact', 'ContactPerGezin.contact_id', '=', 'Contact.Id')
            ->select(
                'Persoon.Id AS Id',
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
                'Contact.Mobiel',
                'Contact.Id AS contact_id'
            )->findOrFail($id);
    
        return view('klant.edit', compact('klant'));
    }
    
    public function update(Request $request, $id)
    {
        try {
            // Retrieve the input data from the request
            $voornaam = $request->input('voornaam');
            $tussenvoegsel = $request->input('tussenvoegsel');
            $achternaam = $request->input('achternaam');
            $geboortedatum = $request->input('geboortedatum');
            $typePersoon = $request->input('TypePersoon');
            $isVertegenwoordiger = $request->input('IsVertegenwoordiger');
            $straat = $request->input('Straat');
            $huisnummer = $request->input('Huisnummer');
            $toevoeging = $request->input('Toevoeging');
            $postcode = $request->input('Postcode');
            $woonplaats = $request->input('Woonplaats');
            $email = $request->input('Email');
            $mobiel = $request->input('Mobiel');
            
            // Validate the selected postcode
            $existingPostcode = DB::table('Contact')
                ->where('Postcode', $postcode)
                ->exists();
    
            if (!$existingPostcode) {
                return redirect()
                    ->back()
                    ->with('error', 'Invalid Postcode. Please select a valid Postcode.')
                    ->withInput();
            }
                // Update the customer in the database
                DB::table('Persoon')
                    ->where('Id', $id)
                    ->update([
                        'Voornaam' => $voornaam,
                        'Tussenvoegsel' => $tussenvoegsel,
                        'Achternaam' => $achternaam,
                        'Geboortedatum' => $geboortedatum,
                        'TypePersoon' => $typePersoon,
                        'IsVertegenwoordiger' => $isVertegenwoordiger,
                    ]);
            
                $contactPerGezin = DB::table('ContactPerGezin')
                    ->where('gezin_id', $id)
                    ->first();
            

                if ($contactPerGezin) {
                    $contactId = $contactPerGezin->contact_id;
            
                
                    DB::table('Contact')
                        ->where('Id', $contactId)
                        ->update([
                            'Straat' => $straat,
                            'Huisnummer' => $huisnummer,
                            'Toevoeging' => $toevoeging,
                            'Postcode' => $postcode,
                            'Woonplaats' => $woonplaats,
                            'Email' => $email,
                            'Mobiel' => $mobiel,
                        ]);
                    // Return a response indicating the success of the update
                    return redirect()
                        ->route('klant.show', $id)
                        ->with('success', 'Klant updated successfully.');
                } else {
                    return redirect()
                        ->back()
                        ->with('error', 'An error occurred while updating the contact information.');
                }
            } catch (\Exception $e) {
                return redirect()
                    ->back()
                    ->with('error', 'An error occurred while updating the klant: ' . $e->getMessage());
            }
            
            
    }
    
    
    
    

}