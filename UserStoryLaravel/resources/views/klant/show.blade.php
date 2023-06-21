@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Klant Details {{ $klant->Voornaam . ' ' . $klant->Tussenvoegsel . ' ' . $klant->Achternaam }}</h1>
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif  
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Voornaam:</th>
                    <td>{{ $klant->Voornaam }}</td>
                </tr>
                <tr>
                    <th>Tussenvoegsel:</th>
                    <td>{{ $klant->Tussenvoegsel ?: '-' }}</td>
                </tr>
                <tr>
                    <th>Achternaam:</th>
                    <td>{{ $klant->Achternaam }}</td>
                </tr>
                <tr>
                    <th>Geboortedatum:</th>
                    <td>{{ $klant->Geboortedatum }}</td>
                </tr>
                <tr>
                    <th>Type Persoon:</th>
                    <td>{{ $klant->TypePersoon }}</td>
                </tr>
                <tr>
                    <th>Vertegenwoordiger:</th>
                    <td>{{ $klant->IsVertegenwoordiger ? 'Ja' : 'Nee' }}</td>
                </tr>
                <tr>
                    <th>Straat:</th>
                    <td>{{ $klant->Straat }}</td>
                </tr>
                <tr>
                    <th>Huisnummer:</th>
                    <td>{{ $klant->Huisnummer }}</td>
                </tr>
                <tr>
                   <th>Toevoeging:</th>
                   <td>{{ $klant->Toevoeging }}</td>
                </tr>
                <tr>
                    <th>Postcode:</th>
                    <td>{{ $klant->Postcode }}</td>
                </tr>
                <tr>
                    <th>Woonplaats:</th>
                    <td>{{ $klant->Woonplaats }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $klant->Email }}</td>
                </tr>
                <tr>
                    <th>Mobiel:</th>
                    <td>{{ $klant->Mobiel }}</td>
                </tr>
            </tbody>
            </div>
        </div>
        
</table>
<a href="{{ route('klant.edit', $klant->Id) }}" class="btn btn-primary mt-3">Bewerken</a>

<a href="{{ route('klant.index') }}" class="btn btn-primary mt-3">Terug</a>

    </div>
@endsection
