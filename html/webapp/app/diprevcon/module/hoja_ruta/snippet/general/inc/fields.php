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
$field_item["procedencia"]=array("type"=>"text");
$field_item["destinatario"]=array("type"=>"text");
$field_item["asunto"]=array("type"=>"text");

$field_item["fecha"]=array("type"=>"date");
$field_item["descripcion"]=array("type"=>"text");
$field_item["fojas"]=array("type"=>"text");
$field_item["id_tipo_correspondencia"]=array("type"=>"text");

$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
