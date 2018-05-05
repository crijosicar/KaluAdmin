<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Movimientos;
use App\Models\ListaValor;
use App\Models\UserMovimientos;
use App\Models\DetalleMovimiento;
use DB;
use stdClass;
use Carbon\Carbon;
use Storage;
use Ixudra\Curl\Facades\Curl;

class TransactionController extends Controller {

    public function __construct() {}

    public function addTransaction(Request $request) {

      $messages = [
          'required' => 'El campo :attribute es requerido.',
      ];

      $niceNames = array(
          'user_id' => 'ID de usuario',
          'token' => 'token',
          'tipo_transaccion' => 'tipo de transacción'
      );

      $validator = Validator::make($request->all(), [
          'user_id' => 'required',
          'token' => 'required',
          'tipo_transaccion' => 'required'
      ], $messages, $niceNames);

      if ($validator->fails()) {
          $messages = $validator->messages();
          return response()->json([
            'error' => true,
            'messages' => $messages
          ]);
      }
      $tipoTransaccion = ListaValor::where("categoria", "TIPO_TRANSACCION")
                                    ->where("valor", $request->input('tipo_transaccion'))
                                    ->first();
      $movimiento = new Movimientos();
      $movimiento->tipo_transaccion_id = $tipoTransaccion->id;
      $movimiento->tipo_movimiento_id = $tipoTransaccion->id;
      $now = new Carbon();
      $now->setTimezone('America/Bogota');
      $movimiento->fecha_movimiento = $now->toDateTimeString();

      if($movimiento->save()){
        $userMovimiento = new UserMovimientos();
        $userMovimiento->user_id = $request->input('user_id');
        $userMovimiento->movimiento_id = $movimiento->id;
        if($userMovimiento->save()){
          return response()->json(["error" => false, "message" => $movimiento]);
        }
        return response()->json(["error" => true, "message" =>  "No se pudo cargar el moviento al usuario"]);
      }

      return response()->json(["error" => true, "message" =>  "No se pudo realizar la transacción"]);
    }

    public function addItemsTransaction(Request $request) {

      $messages = [
          'required' => 'El campo :attribute es requerido.',
      ];

      $niceNames = array(
          'token' => 'token',
          'transaction_id' => 'ID de transacción',
          "items" => 'productos'
      );

      $validator = Validator::make($request->all(), [
          'items' => 'required|array|min:1',
          'token' => 'required',
          'transaction_id' => 'required'
      ], $messages, $niceNames);

      if ($validator->fails()) {
          $messages = $validator->messages();
          return response()->json([
            'error' => true,
            'messages' => $messages
          ]);
      }

      $valid = true;
      foreach($request->input("items") as $item => $value){
        $categoriaActivo = ListaValor::where("categoria", "CATEGORIA_ACTIVO")
                                      ->where("valor", $value['categoria_activo'])
                                      ->first();
        $movementDetail = new DetalleMovimiento();
        $movementDetail->categoria_activo_id = $categoriaActivo->id;
        $movementDetail->movimiento_id = $request->input('transaction_id');
        $movementDetail->nombre_activo = $value['nombre'];
        $movementDetail->monto = $value['monto'];
        if(!$movementDetail->save()) $valid = false;
      }
      
      if(!$valid){
        return response()->json(["error" => true, "message" =>  "Algunos productos no pudieron ser agregados"]);
      }

      return response()->json(["error" => false, "message" =>  "Proceso exitoso"]);
    }

}
