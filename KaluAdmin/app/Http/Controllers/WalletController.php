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
        array_push($values, (float) $value->valor);
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

      return response()->json(["error" => false, "message" => $response]);
    }
    public function getPeriodIncomesAndExpensesExpectedByUser(Request $request){
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
                                    dmv.created_at AS valor
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

    
      //EGRESO

      $comidaList = array_filter($results, function ($element) { return ($element->categoria == "COMIDA"); } );
      $ropaList = array_filter($results, function ($element) { return ($element->categoria == "ROPA"); } );
      $facturasList = array_filter($results, function ($element) { return ($element->categoria == "FACTURAS"); } );
      $comunicacionesList = array_filter($results, function ($element) { return ($element->categoria == "COMUNICACIONES"); } );
      $entretenimientoList = array_filter($results, function ($element) { return ($element->categoria == "ENTRETENIMIENTO"); } );
      $saludList = array_filter($results, function ($element) { return ($element->categoria == "SALUD"); } );
      $hogarList = array_filter($results, function ($element) { return ($element->categoria == "HOGAR"); } );
      $transporteList = array_filter($results, function ($element) { return ($element->categoria == "TRANSPORTE"); } );
      
      
      //INGRESO

      $depositoList = array_filter($results, function ($element) { return ($element->categoria == "DEPOSITOS"); } );
      $salarioList = array_filter($results, function ($element) { return ($element->categoria == "SALARIO"); } );
      $ahorrosList = array_filter($results, function ($element) { return ($element->categoria == "AHORROS"); } );

      dd($comidaList);                      
    }


    public function getIncomesAndExpensesExpectedByUser(Request $request) {

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

      //EGRESO

      $comidaList = array_filter($results, function ($element) { return ($element->categoria == "COMIDA"); } );
      $ropaList = array_filter($results, function ($element) { return ($element->categoria == "ROPA"); } );
      $facturasList = array_filter($results, function ($element) { return ($element->categoria == "FACTURAS"); } );
      $comunicacionesList = array_filter($results, function ($element) { return ($element->categoria == "COMUNICACIONES"); } );
      $entretenimientoList = array_filter($results, function ($element) { return ($element->categoria == "ENTRETENIMIENTO"); } );
      $saludList = array_filter($results, function ($element) { return ($element->categoria == "SALUD"); } );
      $hogarList = array_filter($results, function ($element) { return ($element->categoria == "HOGAR"); } );
      $transporteList = array_filter($results, function ($element) { return ($element->categoria == "TRANSPORTE"); } );

      $sumComida = 0;
      foreach ($comidaList as $key => $value) {
        $sumComida =  $sumComida + $value->valor;
      }

      $sumRopa = 0;
      foreach ($ropaList as $key => $value) {
        $sumRopa = $sumRopa + $value->valor;
      }

      $sumFacturas = 0;
      foreach ($facturasList as $key => $value) {
        $sumFacturas =  $sumFacturas + $value->valor;
      }

      $sumComunicaciones = 0;
      foreach ($comunicacionesList as $key => $value) {
        $sumComunicaciones = $sumComunicaciones + $value->valor;
      }

      $sumEntretenimiento = 0;
      foreach ($entretenimientoList as $key => $value) {
        $sumEntretenimiento = $sumEntretenimiento + $value->valor;
      }

      $sumSalud = 0;
      foreach ($saludList as $key => $value) {
        $sumSalud =  $sumSalud + $value->valor;
      }

      $sumHogar = 0;
      foreach ($hogarList as $key => $value) {
        $sumHogar = $sumHogar + $value->valor;
      }

      $sumTransporte = 0;
      foreach ($transporteList as $key => $value) {
        $sumTransporte = $sumTransporte + $value->valor;
      }

      //INGRESO

      $depositoList = array_filter($results, function ($element) { return ($element->categoria == "DEPOSITOS"); } );
      $salarioList = array_filter($results, function ($element) { return ($element->categoria == "SALARIO"); } );
      $ahorrosList = array_filter($results, function ($element) { return ($element->categoria == "AHORROS"); } );

      $sumDeposito = 0;
      foreach ($depositoList as $key => $value) {
        $sumDeposito =  $sumDeposito + $value->valor;
      }

      $sumSalario = 0;
      foreach ($salarioList as $key => $value) {
        $sumSalario = $sumSalario + $value->valor;
      }

      $sumAhorros = 0;
      foreach ($ahorrosList as $key => $value) {
        $sumAhorros = $sumAhorros + $value->valor;
      }

      $comidaDiv = 0;
      $ropaDiv = 0;
      $facturasDiv = 0;
      $entretenimientoDiv = 0;
      $comunicacionesDiv = 0;
      $hogarDiv = 0;
      $saludDiv = 0;
      $transporteDiv = 0;

      $depositoDiv = 0;
      $salarioDiv = 0;
      $ahorrosDiv = 0;

      if(count($comidaList) > 0){
        $comidaDiv = $sumComida / count($comidaList);
      }

      if(count($ropaList) > 0){
        $ropaDiv = $sumRopa / count($ropaList);
      }

      if(count($facturasList) > 0){
        $facturasDiv = $sumFacturas / count($facturasList);
      }

      if(count($comunicacionesList) > 0){
        $comunicacionesDiv = $sumComunicaciones / count($comunicacionesList);
      }

      if(count($entretenimientoList) > 0){
        $entretenimientoDiv = $sumEntretenimiento / count($entretenimientoList);
      }

      if(count($saludList) > 0){
        $saluDiv = $sumSalud / count($saludList);
      }

      if(count($hogarList) > 0){
        $hogarDiv = $sumHogar / count($hogarList);
      }

      if(count($transporteList) > 0){
        $transporteDiv = $sumTransporte / count($transporteList);
      }

      if(count($depositoList) > 0){
        $depositoDiv = $sumDeposito / count($depositoList);
      }

      if(count($salarioList) > 0){
        $salarioDiv = $sumSalario / count($salarioList);
      }

      if(count($ahorrosList) > 0){
        $ahorrosDiv = $sumAhorros / count($ahorrosList);
      }

      if($request->input('tipo_transaccion') === "EGRESO"){
        $resultado = [
          "comida" => $comidaDiv,
          "ropa" => $ropaDiv,
          "facturas" => $facturasDiv,
          "entretenimiento" => $entretenimientoDiv,
          "comunicaciones" => $comunicacionesDiv,
          "hogar" => $hogarDiv,
          "salud" => $saludDiv,
          "transporte" => $transporteDiv
        ];
      } else {
        $resultado = [
          "deposito" => $depositoDiv,
          "salario" => $salarioDiv,
          "ahorros" => $ahorrosDiv
        ];
      }

      return response()->json(["error" => false, "message" => $resultado]);
    }
}
