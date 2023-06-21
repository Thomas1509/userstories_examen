<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Persoon extends Model
    {
        protected $table = 'persoon';
        public $timestamps = false;
        public function contact()
        {
            return $this->hasOne(Contact::class, 'contact_id');
        }

    }
?>