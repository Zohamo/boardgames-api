<?php

namespace App\Http\Controllers;

use App\Models\BoardGame;
use Illuminate\Http\Request;

class BoardGameController extends Controller
{
    /**
     * Return the list of the ressource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BoardGame::with('type')->orderBy('bgg_weight')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        return response(BoardGame::with('type')->find($id));
    }
}
