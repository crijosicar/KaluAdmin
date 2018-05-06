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

class WalletController extends Controller {

    public function __construct() {}

    public function getIncomesAndExpensesByUser(Request $request) {

      $messages = [
          'required' => 'El campo :attribute es requerido.',
      ];

      $niceNames = array(
          'user_id' => 'ID de usuario',
          'token' => 'token',
          'tipo_transaccion' => 'tipo de transacción',
          'mes' => 'mes',
          'anho' => 'año'
      );

      $validator = Validator::make($request->all(), [
          'user_id' => 'required',
          'token' => 'required',
          'tipo_transaccion' => 'required',
          'mes' => 'required',
          'anho' => 'required'
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

      $lastDayFromMonth = Carbon::create($request->input('anho'), $request->input('mes'), 0, 0, 0, 0, 'America/Bogota');
      $minDate = $request->input('anho') . '-' . str_pad($request->input('mes'), 2, "0", STR_PAD_LEFT) . '-01 00:00:00';
      $maxDate = $request->input('anho') . '-' . str_pad($request->input('mes'), 2, "0", STR_PAD_LEFT) . '-' . $lastDayFromMonth->day .' 00:00:00';

      $results = DB::select("SELECT LCASE(lvl.valor) AS categoria,
                                    sum(dmv.monto) AS valor
                              FROM movimientos AS mov
                                INNER JOIN user_movimientos AS umv ON (mov.id = umv.movimiento_id)
                                INNER JOIN detalle_movimiento AS dmv ON (mov.id = dmv.movimiento_id)
                                INNER JOIN lista_valor AS lvl ON (dmv.categoria_activo_id = lvl.id)
                              WHERE mov.tipo_transaccion_id = :tipo_transaccion_id
                                AND umv.user_id = :user_id
                                AND mov.created_at >= :min_date
                                AND mov.created_at <= :max_date
                              GROUP BY lvl.valor",
                              ['tipo_transaccion_id' => $tipoTransaccion->id,
                                'user_id' => $request->input('user_id'),
                                'min_date' => $minDate,
                                'max_date' => $maxDate
                              ]
                            );

      $labels = [];
      $values = [];
      foreach ($results as $key => $value) {
        array_push($labels, $value->categoria);
        array_push($values, $value->valor);
      }

      if($request->input('tipo_transaccion') === "INGRESO"){
        $response = [
          "income_labels" => $labels,
          "income_values" => $values
        ];
      } else {
        $response = [
          "expense_labels" => $labels,
          "expense_values" => $values
        ];
      }

      return response()->json(["error" => true, "message" => $response]);
    }

    public function getIncomesAndExpectedExpensesByUser(Request $request) {

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

      $results = DB::select("SELECT lvl.valor AS categoria,
                                    dmv.monto AS valor
                              FROM movimientos AS mov
                                INNER JOIN user_movimientos AS umv ON (mov.id = umv.movimiento_id)
                                INNER JOIN detalle_movimiento AS dmv ON (mov.id = dmv.movimiento_id)
                                INNER JOIN lista_valor AS lvl ON (dmv.categoria_activo_id = lvl.id)
                              WHERE mov.tipo_transaccion_id = :tipo_transaccion_id
                                AND umv.user_id = :user_id",
                              [
                                'tipo_transaccion_id' => $tipoTransaccion->id,
                                'user_id' => $request->input('user_id')
                              ]
                          );

        foreach ($$results as $key => $value) {

        }


      dd($results);
      return response()->json(["error" => true, "message" => $results]);
    }
}
