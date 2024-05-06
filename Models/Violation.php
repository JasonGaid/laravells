<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $table = "violation_categories"; 
    protected $fillable = [
        'negative_comments',
        'intimidating_language',
        'insults_based_on_personal_characteristics',
        'threats_of_physical_violence',
        'public_ridicule',
        'shaming',
        'unsolicited_sexual_advances',
        'inappropriate_comments',
        'direct_threats',
        'offensive_language',

];
}
