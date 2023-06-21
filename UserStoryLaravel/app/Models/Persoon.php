<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Persoon extends Model
    {
        protected $table = 'Persoon';
        public $timestamps = false;
    
        public function gezin()
        {
            return $this->belongsTo(Gezin::class, 'gezin_id');
        }
        protected $fillable = [
            'Voornaam',
            'Tussenvoegsel',
            'Achternaam',
            'Geboortedatum',
            'TypePersoon',
            'IsVertegenwoordiger',
            'DatumAangemaakt',
            'DatumGewijzigd'
        ];
    }
    
?>