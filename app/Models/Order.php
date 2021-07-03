<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'topic',
        'type',
        'deadline',
        'paper_type',
        'quantity',
        'spacing',
        'status',
        'pages',
        'words',
        'academic_level',
        'instructions',
        'formating_style',
        'number_of_sources',
        'sample_file',
        'deleted_at',
        'suspended_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];
   
}
