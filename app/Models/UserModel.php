<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'username', 'email', 'phone', 'age', 'description', 'password']; //enanable mass assignment to these values from the migration
}
