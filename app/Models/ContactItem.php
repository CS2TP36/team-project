<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Where the data is sent from the form in the contact page
class ContactItem extends Model
{
    protected $table = 'contact_items';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message'
    ];
}
