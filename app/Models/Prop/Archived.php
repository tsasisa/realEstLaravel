<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archived extends Model
{
    use HasFactory;

    protected $table = "archived";

    protected $fillable = [
        'prop_id',
        'user_id' ,
        'title',
        'image',
        'location',
        'price'

    ];

    public $timestamps = true;

    const CREATED_AT = 'create_at';

}
