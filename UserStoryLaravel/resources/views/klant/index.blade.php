@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Overzicht Klanten</h1>

<!-- Existing code for customer records -->
 @if (session('success'))
     <div class="alert alert-success">
         {{ session('success') }}
     </div>
 @endif

 @if (session('error'))
     <div class="alert alert-danger">
         {{ session('error') }}
     </div>
 @endif
<div class="d-flex justify-content-end mt-3">
    <form action="{{ route('klant.index') }}" method="GET" class="form-inline">
        <div class="d-flex align-items-center">
            <label class="mr-1" for="postcode"></label>
            <select name="postcode" id="postcode" class="form-control mr-2">
                <option value="">All Postcodes</option>
                @foreach($postcodes as $code)
                    <option value="{{ $code }}" {{ request('postcode') == $code ? 'selected' : '' }}>{{ $code }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Toon</button>
        </div>
    </form>
</div>

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
                <td>{{ $klant->Straat . ' ' . $klant->Huisnummer }}{{ $klant->Toevoeging ? ' ' . $klant->Toevoeging : '' }}</td>
                <td>{{ $klant->Woonplaats }}</td>
                <td><a href="{{ route('klant.show', ['id' => $klant->Id]) }}" class="btn btn-primary">Details</a></td>
            </tr>
            @endforeach
            @if(isset($errorMessage))
            <div class="alert alert-danger">{{ $errorMessage }}</div>
            @endif
        </tbody>
    </table>
</div>
@endsection