<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardGame extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bg_boardgames';

    /**
     * The type of game.
     */
    public function type()
    {
        return $this->hasOne('App\Models\Type', 'id_type', 'fk_id_type');
    }
}
