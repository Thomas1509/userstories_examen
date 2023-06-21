@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Overzicht Klanten</h1>
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Naam gezin</th>
                <th>Vertegenwoordiger</th>
                <th>Email</th>
                <th>Mobiel</th>
                <th>Adres</th>
                <th>Woonplaats</th>
                <th>Klant Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($klanten as $klant)
                <tr>
                    <td>{{ $klant->gezinNaam }}</td>
                    <td>{{ $klant->IsVertegenwoordiger ? 'Ja' : 'Nee' }}</td>
                    <td>{{ $klant->Email }}</td>
                    <td>{{ $klant->Mobiel }}</td>
                    <td>{{ $klant->Straat }} {{ $klant->Huisnummer }}{{ $klant->Toevoeging ? ' ' . $klant->Toevoeging : '' }}</td>
                    <td>{{ $klant->Woonplaats }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection