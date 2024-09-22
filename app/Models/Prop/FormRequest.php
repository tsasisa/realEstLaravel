<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRequest extends Model
{
    use HasFactory;

    protected $table = "requests";

    protected $fillable = [
        'prop_id',
        'agent_name',
        // meant for suers who's trying to fill the contact form
        'user_id',
        'name',
        'email',
        'phone'
    ];

    public $timestamps = true;

    const CREATED_AT = 'create_at';
}
