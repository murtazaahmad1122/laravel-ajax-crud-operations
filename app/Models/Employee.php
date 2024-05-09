<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'address', 'phone','edit_name', // New fields for editing
        'edit_email',
        'edit_address',
        'edit_phone',

    ];
}
