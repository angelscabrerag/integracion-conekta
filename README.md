# integracion-conekta
Ejemplo de integración de pasarela de pagos CONEKTA


FUNCIONES en /index.php


// ************* o b t e n e r    c l i e n t e *************
$customer = $conekta->buscarCliente($customer_id);
var_dump($customer);


// ************* c r e a r   c l i e n t e *************
$customer = $conekta->crearCliente($dataCustomer);
var_dump($customer);

// ************* a c t u a l i z a r   c  l i e n t e *************
// NOTE retorna cliente
$customer = $conekta->actualizarCliente($customer_id,$dataCustomerActualiza);
var_dump($customer);

// ************* e l i m i a n r  c    l i e n t e *************
$customer = $conekta->eliminarCliente($customer_id);
var_dump($customer);

