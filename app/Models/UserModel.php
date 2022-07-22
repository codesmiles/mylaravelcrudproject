<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class UserModel extends Model
{
    use HasFactory,hasApiTokens,Notifiable;
    protected $fillable = ['name', 'username', 'email', 'phone', 'age', 'description', 'password']; //enanable mass assignment to these values from the migration
}
