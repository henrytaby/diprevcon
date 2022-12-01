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
//*******datos a registrar de mensajes globales
$field_item["titulo"]=array("type"=>"text");
$field_item["mensaje"]=array("type"=>"text");
$field_item["fecha_inicio"]=array("type"=>"date_01");
$field_item["fecha_fin"]=array("type"=>"date_01");
$field_item["active"]=array("type"=>"checkbox_02");

$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
