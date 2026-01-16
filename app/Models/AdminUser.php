<?php
// app/Models/AdminUser.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $fillable = [
        'name', 
        'email',
        'password',
        // ... other attributes
    ];

    // ... rest of the model code
}
