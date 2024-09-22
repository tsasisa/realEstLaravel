<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeType extends Model
{
    use HasFactory;

    protected $table = "hometypes";

    protected $fillable = [
        'id',
        'hometypes'
        

    ];

    public $timestamps = true;

    public const CREATED_AT = 'created_at';
}
