<!-- klant/edit.blade.php -->

@extends('layouts.app')

@section('content')
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@elseif (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Klant</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('klant.update', $klant->Id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="voornaam" class="col-md-4 col-form-label text-md-right">Voornaam</label>
                            <div class="col-md-6">
                                <input id="voornaam" type="text" class="form-control" name="voornaam"
                                    value="{{ $klant->Voornaam }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tussenvoegsel"
                                class="col-md-4 col-form-label text-md-right">Tussenvoegsel</label>
                            <div class="col-md-6">
                                <input id="tussenvoegsel" type="text" class="form-control" name="tussenvoegsel"
                                    value="{{ $klant->Tussenvoegsel }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="achternaam" class="col-md-4 col-form-label text-md-right">Achternaam</label>
                            <div class="col-md-6">
                                <input id="achternaam" type="text" class="form-control" name="achternaam"
                                    value="{{ $klant->Achternaam }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="geboortedatum"
                                class="col-md-4 col-form-label text-md-right">Geboortedatum</label>
                            <div class="col-md-6">
                                <input id="geboortedatum" type="date" class="form-control" name="geboortedatum"
                                    value="{{ date('Y-m-d', strtotime($klant->Geboortedatum)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="TypePersoon" class="col-md-4 col-form-label text-md-right">Type Persoon</label>
                            <div class="col-md-6">
                                <select id="TypePersoon" class="form-control" name="TypePersoon" required>
                                    <option value="Klant" {{ $klant->TypePersoon === 'Klant' ? 'selected' : '' }}>Klant
                                    </option>
                                    <option value="Medewerker"
                                        {{ $klant->TypePersoon === 'Medewerker' ? 'selected' : '' }}>Medewerker</option>
                                    <option value="Manager" {{ $klant->TypePersoon === 'Manager' ? 'selected' : '' }}>
                                        Manager</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="IsVertegenwoordiger"
                                class="col-md-4 col-form-label text-md-right">IsVertegenwoordiger</label>
                            <div class="col-md-6">
                                <select id="IsVertegenwoordiger" class="form-control" name="IsVertegenwoordiger"
                                    required>
                                    <option value="0" {{ $klant->IsVertegenwoordiger == 0 ? 'selected' : '' }}>Nee
                                    </option>
                                    <option value="1" {{ $klant->IsVertegenwoordiger == 1 ? 'selected' : '' }}>Ja
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Straat" class="col-md-4 col-form-label text-md-right">Straat</label>
                            <div class="col-md-6">
                                <input id="Straat" type="text" class="form-control" name="Straat"
                                    value="{{ $klant->Straat }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Huisnummer" class="col-md-4 col-form-label text-md-right">Huisnummer</label>
                            <div class="col-md-6">
                                <input id="Huisnummer" type="text" class="form-control" name="Huisnummer"
                                    value="{{ $klant->Huisnummer }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Toevoeging" class="col-md-4 col-form-label text-md-right">Toevoeging</label>
                            <div class="col-md-6">
                                <input id="Toevoeging" type="text" class="form-control" name="Toevoeging"
                                    value="{{ $klant->Toevoeging }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Postcode" class="col-md-4 col-form-label text-md-right">Postcode</label>
                            <div class="col-md-6">
                                <input id="Postcode" type="text" class="form-control" name="Postcode"
                                    value="{{ $klant->Postcode }}" required>
                                @error('Postcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="Woonplaats" class="col-md-4 col-form-label text-md-right">Woonplaats</label>
                            <div class="col-md-6">
                                <input id="Woonplaats" type="text" class="form-control" name="Woonplaats"
                                    value="{{ $klant->Woonplaats }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-6">
                                <input id="Email" type="Email" class="form-control" name="Email"
                                    value="{{ $klant->Email }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Mobiel" class="col-md-4 col-form-label text-md-right">Mobiel</label>
                            <div class="col-md-6">
                                <input id="Mobiel" type="text" class="form-control" name="Mobiel"
                                    value="{{ $klant->Mobiel }}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Wijzig Klant Details</button>
                                <a href="{{ route('klant.index') }}" class="btn btn-secondary">Terug</a>
                            </div>
                        </div>
                    </form>
                </div>
                @endsection