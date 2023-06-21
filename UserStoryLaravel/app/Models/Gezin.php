<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Gezin extends Model
    {
        protected $table = 'gezin';
        public $timestamps = false;

        public function contact()
        {
            return $this->belongsToMany(Contact::class, 'ContactPerGezin', 'gezin_id', 'contact_id', 'Id');
        }

        public function Persoon()
        {
            return $this->hasOne(Persoon::class, 'gezin_id', 'Id');
        }

    }
?>