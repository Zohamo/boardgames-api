<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bg_themes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['the_name'];

    /**
     * The games related to this theme.
     */
    public function boardgames()
    {
        return $this->hasMany('App\BoardGame', 'fk_theme_id');
    }
}
