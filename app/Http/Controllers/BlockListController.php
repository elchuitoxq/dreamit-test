<?php

namespace App\Http\Controllers;

use App\BlockList;
use Illuminate\Http\Request;

class BlockListController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->middleware('auth');
        $blockList = new BlockList;

        $blockList->user_id = $request->id;

        if($blockList->save()){
            return response()->json(['success' => true, 'message' => 'Se ha enviado al usuario a la Lista de Bloqueo'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'No se ha logrado procesar la solicitud.'], 200);
        }
    }
    public function store(Request $request)
    {
        $this->middleware('auth');
        $blokLists = BlockList::all();

        $blokLists->map(function($elem) {
            $elem['user'] = $elem->user;
        });

        return response()->json(['blockList' => $blokLists],200);
    }
    public function destroy(Request $request)
    {
        $this->middleware('auth');
        $blockList = BlockList::find($request->id);

        if($blockList->delete()){
            return response()->json(['success' => true, 'message' => 'El bloqueo ha sido eliminado correctamente'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'No se ha logrado procesar la solicitud.'], 200);
        }
    }
}
