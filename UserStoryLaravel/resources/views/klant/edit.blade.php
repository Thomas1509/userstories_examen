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
                        <label for="IsVertegenwoordiger" class="col-md-4 col-form-label text-md-right">IsVertegenwoordiger</label>
                        <div class="col-md-6">
                            <select id="IsVertegenwoordiger" class="form-control" name="IsVertegenwoordiger" required>
                                <option value="0" {{ $klant->IsVertegenwoordiger == 0 ? 'selected' : '' }}>0</option>
                                <option value="1" {{ $klant->IsVertegenwoordiger == 1 ? 'selected' : '' }}>1</option>
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
                            <label for="huisnummer" class="col-md-4 col-form-label text-md-right">Huisnummer</label>
                            <div class="col-md-6">
                                <input id="huisnummer" type="text" class="form-control" name="huisnummer"
                                    value="{{ $klant->Huisnummer }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="toevoeging" class="col-md-4 col-form-label text-md-right">Toevoeging</label>
                            <div class="col-md-6">
                                <input id="toevoeging" type="text" class="form-control" name="toevoeging"
                                    value="{{ $klant->Toevoeging }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postcode" class="col-md-4 col-form-label text-md-right">Postcode</label>
                            <div class="col-md-6">
                                <input id="postcode" type="text" class="form-control" name="postcode"
                                    value="{{ $klant->Postcode }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="woonplaats" class="col-md-4 col-form-label text-md-right">Woonplaats</label>
                            <div class="col-md-6">
                                <input id="woonplaats" type="text" class="form-control" name="woonplaats"
                                    value="{{ $klant->Woonplaats }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ $klant->Email }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobiel" class="col-md-4 col-form-label text-md-right">Mobiel</label>
                            <div class="col-md-6">
                                <input id="mobiel" type="text" class="form-control" name="mobiel"
                                    value="{{ $klant->Mobiel }}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('klant.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
                @endsection