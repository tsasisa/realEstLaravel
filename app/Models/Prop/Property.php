<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    // ini buat tabelnya

    protected $table = "props";

    // represents columns inside table props (every components neneded in the page)
    protected $fillable = [
        'title',
        'price',
        'image',
        'beds',
        'baths',
        'sq_ft',
        'home_type',
        'year_built',
        'price_sqft',
        'more_info',
        'location',
        'agent_name',
        'city',
        'type'

    ];

    // true -> automatically update time created or updates
    public $timestamps = true;

    const CREATED_AT = 'create_at';
}
