<?php

namespace App\Http\Controllers;

use App\Models\BoardGamePlay;

class BoardGamePlayController extends Controller
{
    /**
     * Return the list of the ressource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $slug)
    {
        $records = BoardGamePlay::select('pla_json_content')
            ->leftJoin('bg_boardgames', 'fk_bg_id', '=', 'id')
            ->where('slug', '=', $slug)
            ->orderBy('pla_date')
            ->get();
        $res = [];
        foreach ($records as $rec) {
            $res[] = json_decode($rec['pla_json_content']);
        }
        return response($res);
    }
}
