<?PHP
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */
$fields = array();
/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$field_item = array();
$field_item["derivado_a_user_id"]=array("type"=>"text");
$field_item["instruccion_id"]=array("type"=>"text");
$field_item["proceso_id"]=array("type"=>"text");
$field_item["proveido"]=array("type"=>"text");


$group = "module";
$fields[$group]= $field_item;
unset($field_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */
