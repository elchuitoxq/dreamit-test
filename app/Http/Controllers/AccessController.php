<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{AccessList,User,Building,BlockList};
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $this->middleware('auth');
        $access = AccessList::all();

        $access->map(function($elem) {
            $elem['building'] = $elem->building;
            $elem['user'] = $elem->user;
            $elem['access'] = $elem->accessType;
        });

        return response()->json($access, 200);
    }
    public function store(Request $request)
    {
        $access = AccessList::where('user_id', Auth::user()->id)->get();

        $access->map(function($elem) {
            $elem['building'] = $elem->building;
            $elem['access'] = $elem->accessType;
        });

        return response()->json($access, 200);
    }

    public function entry(Request $request)
    {

        
        $user = User::where('code_access',$request->code)->get();

        if(count($user) == 0) {
            return response()->json(['success' => false, 'message' => 'No se encontro usuario con este codigo.'], 200);
        }

        $building = Building::find($request->building);

        if(empty($building)) {
            return response()->json(['success' => false, 'message' => 'No se encontro el edificio seleccionado.'], 200);
        }

        $block = BlockList::where('user_id', $user[0]->id)->get();

        $access = new AccessList();

        if(count($block) > 0) {

            $access->user_id = $user[0]->id;
            $access->building_id = $building->id;
            $access->access_type_id = 2;

            $access->save();

            return response()->json(['success' => false, 'message' => 'Usted se encuentra bloqueado en nuestro sistema.'], 200);
        } else {
            $access->user_id = $user[0]->id;
            $access->building_id = $building->id;
            $access->access_type_id = 1;

            $access->save();

            return response()->json(['success' => true, 'message' => 'Se ha guardado el INGRESO de manera exitosa.'], 200);
        }
    }

    public function exit(Request $request)
    {
        $user = User::where('code_access',$request->code)->get();

        if(count($user) == 0) {
            return response()->json(['success' => false, 'message' => 'No se encontro usuario con este codigo.'], 200);
        }

        $building = Building::find($request->building);

        if(empty($building)) {
            return response()->json(['success' => false, 'message' => 'No se encontro el edificio seleccionado.'], 200);
        }

        $block = BlockList::where('user_id', $user[0]->id)->get();

        $access = new AccessList();

        if(count($block) > 0) {

            $access->user_id = $user[0]->id;
            $access->building_id = $building->id;
            $access->access_type_id = 2;

            $access->save();

            return response()->json(['success' => false, 'message' => 'Usted se encuentra bloqueado en nuestro sistema.'], 200);
        } else {
            $access->user_id = $user[0]->id;
            $access->building_id = $building->id;
            $access->access_type_id = 1;

            $access->save();

            return response()->json(['success' => true, 'message' => 'Se ha guardado la SALIDA de manera exitosa.'], 200);
        }
    }
    public function show($id)
    {
        //
    }
}
