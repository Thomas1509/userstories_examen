<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Contact extends Model
    {
        protected $table = 'contact';
        public $timestamps = false;

        public function gezin()
        {
            return $this->belongsToMany(Gezin::class, 'ContactPerGezin', 'contact_id', 'gezin_id');
        }

    }
?>