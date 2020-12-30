<?php
require_once("lib/Conekta.php");

use \Conekta\Conekta as cnk;
use \Conekta\Customer as cnkCustomer;
use \Conekta\Order as cnkOrden;

// Errores
use \Conekta\ProcessingError as cnkProcessingError;
use \Conekta\ParameterValidationError as cnkParameterValidationError;
// Handle
use \Conekta\Handler as cnkHandler;

date_default_timezone_set("America/Mexico_City");




class CnkConekta
{

    function __construct()
    {
        cnk::setApiKey('key_Fq5U8GUU28hTqgxy4md4TQ');
    }


    // Funciones genericas
    public function rresponse($type=""){
      return array(
        'st' => 'fail',
        'response' => array(
          'data' => array(),
          'message' => array(),
        ),
        'error' => array(
          'code' => 300,
          'description' => 'Error en el servidor, no se pudo procesar la solicitud',
        ),
      );
    }


    public function buscarCliente($customer_id){
      $response = $this->rresponse();
      $st = 'fail';
      try {
        $customer = cnkCustomer::find($customer_id);
        $st = "success";
        $response['response']['data'] = $customer;
        $response['response']['message'] = 'Cliente obtenido con éxito';
      } catch (cnkProcessingError $e) {
        $st = 'error';
        $response['error']['code'] = 301;
        $response['error']['description'] = $e->getMessage();
      } catch (cnkParameterValidationError $e) {
        $st = 'error';
        $response['error']['code'] = 302;
        $response['error']['description'] = $e->getMessage();
      } catch (cnkHandler $e){
        $st = 'fail';
        $response['error']['code'] = 303;
        $response['error']['description'] = $e->getMessage();
      }

      if($st !== "success"){unset($response["response"]);}else{unset($response["error"]);}
      $response["st"] = $st;
      return $response;
    }
    public function crearCliente($dataCustomer){
      $response = $this->rresponse();
      $st = 'fail';
      try {
        $customer = cnkCustomer::create($dataCustomer);
        $st = "success";
        $response['response']['data'] = $customer;
        $response['response']['message'] = 'Cliente creado con éxito';
      } catch (cnkProcessingError $e) {
        $st = 'error';
        $response['error']['code'] = 301;
        $response['error']['description'] = $e->getMessage();
      } catch (cnkParameterValidationError $e) {
        $st = 'error';
        $response['error']['code'] = 302;
        $response['error']['description'] = $e->getMessage();
      } catch (cnkHandler $e){
        $st = 'fail';
        $response['error']['code'] = 303;
        $response['error']['description'] = $e->getMessage();
      }

      if($st !== "success"){unset($response["response"]);}else{unset($response["error"]);}
      $response["st"] = $st;
      return $response;
    }
    public function actualizarCliente($customer_id, $dataCustomer){
      $response = $this->rresponse();
      $st = 'fail';
      try {
        $customer = cnkCustomer::find($customer_id);
        $customer->update($dataCustomer);
        $st = "success";
        $response['response']['data'] = $customer;
        $response['response']['message'] = 'Cliente actualizado con éxito';
      } catch (cnkProcessingError $e) {
        $st = 'error';
        $response['error']['code'] = 301;
        $response['error']['description'] = $e->getMessage();
      } catch (cnkParameterValidationError $e) {
        $st = 'error';
        $response['error']['code'] = 302;
        $response['error']['description'] = $e->getMessage();
      } catch (cnkHandler $e){
        $st = 'fail';
        $response['error']['code'] = 303;
        $response['error']['description'] = $e->getMessage();
      }

      if($st !== "success"){unset($response["response"]);}else{unset($response["error"]);}
      $response["st"] = $st;
      return $response;
    }
    public function eliminarCliente($customer_id){
      $response = $this->rresponse();
      $st = 'fail';
      try {
        $customer = cnkCustomer::find($customer_id);
        $customer->delete();
        $st = "success";
        $response['response']['data'] = $customer;
        $response['response']['message'] = 'Cliente eliminado con éxito';
      } catch (cnkProcessingError $e) {
        $st = 'error';
        $response['error']['code'] = 301;
        $response['error']['description'] = $e->getMessage();
      } catch (cnkParameterValidationError $e) {
        $st = 'error';
        $response['error']['code'] = 302;
        $response['error']['description'] = $e->getMessage();
      } catch (cnkHandler $e){
        $st = 'fail';
        $response['error']['code'] = 303;
        $response['error']['description'] = $e->getMessage();
      }

      if($st !== "success"){unset($response["response"]);}else{unset($response["error"]);}
      $response["st"] = $st;
      return $response;
    }


    public function generarCargo($dataOrder){
      $response = $this->rresponse();
      $st = 'fail';
      try {
        $order = cnkOrden::create($dataOrder);
        $st = "success";
        $response['response']['data'] = $order;
        $response['response']['message'] = 'Cargo generado';
      } catch (cnkProcessingError $e) {
        $st = 'error';
        $response['error']['code'] = 301;
        $response['error']['description'] = $e->getMessage();
      } catch (cnkParameterValidationError $e) {
        $st = 'error';
        $response['error']['code'] = 302;
        $response['error']['description'] = $e->getMessage();
      } catch (cnkHandler $e){
        $st = 'fail';
        $response['error']['code'] = 303;
        $response['error']['description'] = $e->getMessage();
      }
      if($st !== "success"){unset($response["response"]);}else{unset($response["error"]);}
      $response["st"] = $st;
      return $response;
    }
}


$conekta = new CnkConekta();

// Objeto cliente
$dataCustomer =
[
  'name'  => "Mario Perez",
  'email' => "usuario@example.com",
  'phone' => "+5215555555555",

  // 'antifraud_info' => [
  //   'account_created_at' => 1484040996,
  //   'first_paid_at'      => 1485151007
  // ],

  // 'payment_sources' => [
  //     'token_id' => "tok_test_visa_4242",
  //     'type' => "card"
  // ],

  'shipping_contacts' => [
    [
      'phone' => "+5215555555555",
      'receiver' => "Marvin Fuller",
      'between_streets' => "Morelos Campeche",
      'address' => [
        'street1' => "Nuevo Leon 4",
        'street2' => "fake street",
        'city' => "Ciudad de Mexico",
        'state' => "Ciudad de Mexico",
        'country' => "MX",
        'postal_code' => "06100",
        'residential' => true
      ]
    ]
  ]
];

$dataCustomerActualiza =
[
  'name'  => "Manito Flores",
  'email' => 'usuari2o@example.com',
  'corporate' => false,
];

// ************* c r e a r   c l i e n t e *************
// $customer = $conekta->crearCliente($dataCustomer);
// var_dump($customer);
// echo '<br/><div style="color: blue">************************</div></br>';
// var_dump($customer['response']['data']->id);

// ************* a c t u a l i z a r   c  l i e n t e *************
// NOTE retorna cliente
// $customer = $conekta->actualizarCliente('cus_2ozGgyu3cxv5ESWhK',$dataCustomerActualiza);
// var_dump($customer);
// echo '<br/><div style="color: blue">************************</div></br>';


// ************* e l i m i a n r  c    l i e n t e *************
// $customer = $conekta->eliminarCliente('cus_2ozGgyu3cxv5ESWhK');
// var_dump($customer);
// echo '<br/><div style="color: blue">************************</div></br>';

// ************* o b t e n e r    c l i e n t e *************
// $customer = $conekta->buscarCliente('cus_2ozGgyu3cxv5ESWhK');
// var_dump($customer);
// echo '<br/><div style="color: blue">************************</div></br>';


// ************* crear cargo a cliente  *************
// tiempo de vigencia de pago
// $thirty_days_from_now = (new DateTime())->add(new DateInterval('P3D'))->getTimestamp();
// $dataOrder =
//     [
//         'currency' => 'MXN',
//         'customer_info' => [
//             'customer_id' => 'cus_zzmjKsnM9oacyCwV3',
//             'antifraud_info' => [
//                 'paid_transactions' => 4
//             ]
//         ],
//         'line_items' => [
//             [
//                 'name' => 'Box of Cohiba S1s',
//                 'unit_price' => 35000,
//                 'quantity' => 1,
//                 'antifraud_info' => [
//                     'trip_id'        => '12345',
//                     'driver_id'      => 'driv_1231',
//                     'ticket_class'   => 'economic',
//                     'pickup_latlon'  => '23.4323456,-123.1234567',
//                     'dropoff_latlon' => '23.4323456,-123.1234567'
//                 ],
//             ],
//         ],
//         'charges' => [
//             [
//                 'payment_method' => [
//                     "type" => "oxxo_cash",
//                     "expires_at" => $thirty_days_from_now
//                 ],
//             ],
//         ],
//     ];
// $charger = $conekta->generarCargo($dataOrder);
// var_dump($charger);
