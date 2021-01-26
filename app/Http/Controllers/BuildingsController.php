<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use Validator;

class BuildingsController extends Controller
{
    public function create(Request $request)
    {
        $this->middleware('auth');
        //return response()->json([$request->all()], 500);

        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'address.required' => 'El campo direccion es obligatorio.',
        ];

        // validate the info, create rules for the inputs
        $rules = array(
            'name' => 'required',
            'address' => 'required'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make($request->all(), $rules, $messages);
        
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 422);

        } else { 
            $building = new Building;

            $building->name = $request->name;
            $building->address = $request->address;

            if($building->save()){
                return response()->json(['success' => true, 'message' => 'El edificio ha sido creado correctamente', 'buildings' => Building::all()], 200);
            } else {
                return response()->json(['success' => true, 'message' => 'El edificio no ha sido almacenado.'], 200);
            }
        }
    }
    public function store(Request $request)
    {
        $this->middleware('auth');
        return response()->json(['buildings' => Building::all()],200);
    }
    public function update(Request $request)
    {

        $this->middleware('auth');

        $messages = [
            'id.required' => 'El campo id es obligatorio.',
            'name.required' => 'El campo nombre es obligatorio.',
            'address.required' => 'El campo address es obligatorio.',
        ];

        // validate the info, create rules for the inputs
        $rules = array(
            'id' => 'required',
            'name' => 'required',
            'address' => 'required'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make($request->all(), $rules, $messages);
        
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 422);

        } else { 
            $building = Building::find($request->id);

            $building->name = $request->name;
            $building->address = $request->address;

            if($building->save()){
                return response()->json(['success' => true, 'message' => 'El edificio ha sido editado correctamente', 'buildings' => Building::all()], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'El edificio no ha sido almacenado.'], 200);
            }
        }
    }
    public function destroy(Request $request)
    {
        $this->middleware('auth');
        $building = Building::find($request->id);

        if($building->delete()){
            return response()->json(['success' => true, 'message' => 'El edificio ha sido eliminado correctamente', 'buildings' => Building::all()], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'No se ha logrado procesar la solicitud.'], 200);
        }
    }
}
