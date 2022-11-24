<?PHP
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */

/**
 * Arreglos que se utilizaran en esta configuración para guardar los grupos de campos
 */
$fields = array();

/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$field_item = array();
//*******Identificacion del consumidor rgula solicitante
$field_item["objeto_contracion"]=array("type"=>"text");
$field_item["fecha_publicacion"]=array("type"=>"date");
$field_item["cuce"]=array("type"=>"text");
$field_item["tipo_id"]=array("type"=>"text");
$field_item["modalidad_id"]=array("type"=>"text");
$field_item["estado_id"]=array("type"=>"text");
$field_item["subasta"]=array("type"=>"checkbox_02");
$field_item["procesador"]=array("type"=>"text");
$field_item["codigo_interno"]=array("type"=>"text");
$field_item["precio_referencial"]=array("type"=>"text");
$field_item["proponente_id"]=array("type"=>"text");
$field_item["proponente"]=array("type"=>"text");
$field_item["proponente_telefono"]=array("type"=>"text");
$field_item["proponente_email"]=array("type"=>"text");
$field_item["contrato_codigo"]=array("type"=>"text");
$field_item["numero_contrato"]=array("type"=>"text");
$field_item["fecha_suscripcion"]=array("type"=>"date");
$field_item["fecha_fin"]=array("type"=>"date");
$field_item["monto"]=array("type"=>"text");
$field_item["pago_total"]=array("type"=>"text");
$field_item["pago_parcial"]=array("type"=>"text");
$field_item["pago_pendiente"]=array("type"=>"text");
$field_item["observaciones"]=array("type"=>"date");

$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
