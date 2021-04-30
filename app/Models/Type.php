<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bg_types';

    /**
     * The type of game.
     */
    public function boardgames()
    {
        return $this->hasMany('App\BoardGame', 'fk_id_type');
    }
}
