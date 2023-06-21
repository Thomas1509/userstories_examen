<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Contact extends Model
    {
        protected $table = 'Contact';
        public $timestamps = false;
        
        public function gezinnen()
        {
            return $this->belongsToMany(Gezin::class, 'ContactPerGezin', 'contact_id', 'gezin_id')
                ->withPivot('Opmerking')
                ->withTimestamps();
        }
        protected $fillable = [
            'Straat',
            'Huisnummer',
            'Toevoeging',
            'Postcode',
            'Woonplaats',
            'Email',
            'Mobiel',
            'DatumAangemaakt',
            'DatumGewijzigd'
        ];
    }
    
?>
