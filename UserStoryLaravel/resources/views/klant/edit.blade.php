<div class="container">
    <h1>Klant Bewerken</h1>
    <form method="POST" action="{{ route('klant.update', $klant->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="voornaam">Voornaam</label>
            <input type="text" class="form-control" id="voornaam" name="voornaam" value="{{ $klant->Voornaam }}" required>
        </div>

        <div class="form-group">
            <label for="tussenvoegsel">Tussenvoegsel</label>
            <input type="text" class="form-control" id="tussenvoegsel" name="tussenvoegsel" value="{{ $klant->Tussenvoegsel }}">
        </div>

        <div class="form-group">
            <label for="achternaam">Achternaam</label>
            <input type="text" class="form-control" id="achternaam" name="achternaam" value="{{ $klant->Achternaam }}" required>
        </div>

        <div class="form-group">
            <label for="geboortedatum">Geboortedatum</label>
            <input type="date" class="form-control" id="geboortedatum" name="geboortedatum" value="{{ $klant->Geboortedatum }}" required>
        </div>

        <div class="form-group">
            <label for="typepersoon">Type persoon</label>
            <input type="text" class="form-control" id="typepersoon" name="typepersoon" value="{{ $klant->TypePersoon }}" required>
        </div>

        <div class="form-group">
            <label for="vertegenwoordiger">Vertegenwoordiger</label>
            <select class="form-control" id="vertegenwoordiger" name="vertegenwoordiger" required>
                <option value="0" {{ !$klant->IsVertegenwoordiger ? 'selected' : '' }}>Nee</option>
                <option value="1" {{ $klant->IsVertegenwoordiger ? 'selected' : '' }}>Ja</option>
            </select>
        </div>

        <div class="form-group">
            <label for="straat">Straat</label>
            <input type="text" class="form-control" id="straat" name="straat" value="{{ $klant->Straat }}" required>
        </div>

        <div class="form-group">
            <label for="huisnummer">Huisnummer</label>
            <input type="text" class="form-control" id="huisnummer" name="huisnummer" value="{{ $klant->Huisnummer }}" required>
        </div>

        <div class="form-group">
            <label for="toevoeging">Toevoeging</label>
            <input type="text" class="form-control" id="toevoeging" name="toevoeging" value="{{ $klant->Toevoeging }}">
        </div>

        <div class="form-group">
            <label for="postcode">Postcode</label>
            <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $klant->Postcode }}" required>
        </div>

        <div class="form-group">
            <label for="woonplaats">Woonplaats</label>
            <input type="text" class="form-control" id="woonplaats" name="woonplaats" value="{{ $klant->Woonplaats }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $klant->Email }}" required>
        </div>

        <div class="form-group">
            <label for="mobiel">Mobiel</label>
            <input type="text" class="form-control" id="mobiel" name="mobiel" value="{{ $klant->Mobiel }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Opslaan</button>
        <a href="{{ route('klant.show', $klant->id) }}" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
