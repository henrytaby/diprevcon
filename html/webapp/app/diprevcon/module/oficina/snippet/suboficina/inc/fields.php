<?PHP
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */
$fields = array();
/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$field_item = array();
$field_item["active"]=array("type"=>"checkbox_02");

$field_item["nombre"]=array("type"=>"text");
$field_item["sigla"]=array("type"=>"text");

$field_item["entidad_id"]=array("type"=>"text");
$group = "index";
$fields[$group]= $field_item;
unset($field_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */
