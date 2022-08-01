<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';

    /**
     * Model events
     * 
     * @return void
     */
    protected static function booted() {
        static::creating(function($contact) {
            $contact->message = Crypt::encryptString($contact->message);
        }); 
    }

    /**
     * Populate a new entry to table
     * @param array $requestData
     * @param boolean $sendUserCopy
     * 
     * @return \App\Models\ContactUs $this
     */
    public function populateEntry($requestData, $sendUserCopy) {
        [
            'contact_email' => $email, 'contact_firstname' => $firstname, 
            'contact_lastname' => $lastname, 'contact_query' => $query
        ] = $requestData;

        $this->email = $email;
        $this->firstname = $firstname;
        $this->surname = $lastname;
        $this->message = $query;
        $this->copy_sent = $sendUserCopy;
        return $this;
    }
}
