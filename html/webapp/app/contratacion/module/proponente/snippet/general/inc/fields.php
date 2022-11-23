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
$field_item["nombre"]=array("type"=>"text");
$field_item["direccion"]=array("type"=>"text");
$field_item["telefono"]=array("type"=>"text");
$field_item["email"]=array("type"=>"text");
$field_item["descripcion"]=array("type"=>"text");
//$field_item["active"]=array("type"=>"checkbox_02");


$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
