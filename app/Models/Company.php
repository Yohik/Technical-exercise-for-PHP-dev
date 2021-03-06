<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
    protected $table = 'companies';
    public $timestamps = false;

    protected $fillable = [
        'title', 'phone', 'description', 'user_id'
    ];

    protected $hidden = [
        'id',
        'user_id'
    ];
}
