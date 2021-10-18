<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmtpConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = ['id'];
    protected $table = 'smtp_configuration';
    
}
