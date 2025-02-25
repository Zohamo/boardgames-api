<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanism extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bg_mechanisms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mec_name'];
}
