<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoginData extends Model
{
    use HasFactory;

    protected $table = 'user_login_data';

    protected $fillable = [
        'user_id',
        'city',
        'temperature'
    ];

    protected $appends = ['celsius_temp', 'fahrenheit_temp'];

    public function getCelsiusTempAttribute()
    {
        return number_format(floatval(floatval($this->attributes['temperature']) - 273.15), 2, '.', '');
    }
    public function getFahrenheitTempAttribute()
    {
        return number_format(floatval((floatval($this->attributes['temperature']) - 273.15) * (9 / 5) + 32), 2, '.', '');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
