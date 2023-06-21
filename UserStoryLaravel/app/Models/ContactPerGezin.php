<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class ContactPerGezin extends Model
    {
        protected $table = 'ContactPerGezin';
        public $timestamps = false;
    
        public function gezin()
        {
            return $this->belongsTo(Gezin::class, 'gezin_id');
        }
    
        public function contact()
        {
            return $this->belongsTo(Contact::class, 'contact_id');
        }
    }
    