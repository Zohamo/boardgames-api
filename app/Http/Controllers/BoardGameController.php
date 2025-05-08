<?php

namespace App\Http\Controllers;

use App\Models\BoardGame;
use App\Models\BoardGameHasMechanisms;

class BoardGameController extends Controller
{
    /**
     * Return the list of the ressource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return isset($_GET['full']) && $_GET['full'] == 'on'
            ? BoardGame::select('bg_boardgames.*', 'bg_bgg.*', 'bg_vindjeu.*', 'bg_gusandco.*', 'the_name AS theme', 'typ_name AS type', 'bgg_weight')
            ->whereNull('bg_boardgames.deleted_at')
            ->leftJoin('bg_themes', 'fk_theme_id', '=', 'the_id')
            ->leftJoin('bg_types', 'fk_type_id', '=', 'typ_id')
            ->leftJoin('bg_bgg', 'fk_bgg_id', '=', 'bgg_id')
            ->leftJoin('bg_vindjeu', 'bg_vindjeu.fk_bg_id', '=', 'id')
            ->leftJoin('bg_gusandco', 'bg_gusandco.fk_bg_id', '=', 'id')
            ->orderBy('bgg_weight')
            ->orderBy('min_age')
            ->orderBy('play_time_min')
            ->orderBy('play_time_max')
            ->get()
            : BoardGame::select('bg_boardgames.*', 'the_name AS theme', 'typ_name AS type', 'bgg_weight')
            ->whereNull('bg_boardgames.deleted_at')
            ->leftJoin('bg_themes', 'fk_theme_id', '=', 'the_id')
            ->leftJoin('bg_types', 'fk_type_id', '=', 'typ_id')
            ->leftJoin('bg_bgg', 'fk_bgg_id', '=', 'bgg_id')
            ->orderBy('bgg_weight')
            ->orderBy('min_age')
            ->orderBy('play_time_min')
            ->orderBy('play_time_max')
            ->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $slug)
    {
        $record = BoardGame::select('bg_boardgames.*', 'bg_bgg.*', 'bg_vindjeu.*', 'bg_gusandco.*', 'the_name AS theme', 'typ_name AS type')
            ->leftJoin('bg_themes', 'fk_theme_id', '=', 'the_id')
            ->leftJoin('bg_types', 'fk_type_id', '=', 'typ_id')
            ->leftJoin('bg_bgg', 'fk_bgg_id', '=', 'bgg_id')
            ->leftJoin('bg_vindjeu', 'bg_vindjeu.fk_bg_id', '=', 'id')
            ->leftJoin('bg_gusandco', 'bg_gusandco.fk_bg_id', '=', 'id')
            ->where('slug', '=', $slug)
            ->first();
        $record->mechanisms = BoardGameHasMechanisms::select('mec_id AS id', 'mec_name AS name')
            ->leftJoin('bg_mechanisms', 'fk_mec_id', '=', 'mec_id')
            ->where('fk_bg_id', '=', $record->id)
            ->orderBy('name')
            ->get();
        return response($record);
    }
}
