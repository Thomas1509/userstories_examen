<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Gezin extends Model
    {
        protected $table = 'gezin';
        public $timestamps = false;

        public function personen()
        {
            return $this->hasMany(Persoon::class, 'gezin_id');
        }
    
        public function contacten()
        {
            return $this->belongsToMany(Contact::class, 'ContactPerGezin', 'gezin_id', 'contact_id')
                ->withPivot('Opmerking')
                ->withTimestamps();
        }

    }
?>