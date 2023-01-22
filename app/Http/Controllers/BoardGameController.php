<?php

namespace App\Http\Controllers;

use App\Models\BoardGame;

class BoardGameController extends Controller
{
    /**
     * Return the list of the ressource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BoardGame::select('bg_boardgames.*', 'the_name AS theme', 'typ_name AS type')
            ->whereNull('bg_boardgames.deleted_at')
            ->leftJoin('bg_themes', 'fk_theme_id', '=', 'the_id')
            ->leftJoin('bg_types', 'fk_type_id', '=', 'typ_id')
            ->orderBy('bgg_weight')
            ->orderBy('min_age')
            ->orderBy('min_duration')
            ->orderBy('max_duration')
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
        return response(BoardGame::select('bg_boardgames.*', 'the_name AS theme', 'typ_name AS type')
            ->leftJoin('bg_themes', 'fk_theme_id', '=', 'the_id')
            ->leftJoin('bg_types', 'fk_type_id', '=', 'typ_id')->where('slug', '=', $slug)->first());
    }
}
