<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Persoon extends Model
    {
        protected $table = 'persoon';
        public $timestamps = false;

        // public function contactpersonen()
        // {
        //     return $this->belongsToMany(ContactPersoon::class, 'ContactPersoonPerLeverancier', 'leverancier_id', 'contactpersoon_id', 'Id');
        // }

        // public function levering()
        // {
        //     return $this->hasOne(Levering::class, 'leverancier_id', 'Id');
        // }

    }
?>