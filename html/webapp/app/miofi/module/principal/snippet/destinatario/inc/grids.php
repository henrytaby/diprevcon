<?PHP
/**
 * Configuramos todas las grillas que utilizaremos en este snippet
 */
$grid = array();
$grid_table_join = array();

\Core\Core::setLenguage("tableIndex"); //cargamos idioma
/**
 * Configuración de tablas relacionales, (JOIN)
 */
//$grid_table[] = array(
//    "table" => $appVars["table"] ["hoja_ruta_destinatario"] // Nombre de la tabla con la que hara la relación
//,    "alias"=> "hrd" //Alias de la tabla para el join
//,   "field_id"=>"itemId" //Id de la tabla que hara la relación
//,   "relationship_id"=>"id_tipo_correspondencia" //Campo de relación en la tabla principal
//);
//$grid_table[] = array(
//    "table" => $appVars["table"] ["catalogo_codigo_instruccion"] // Nombre de la tabla con la que hara la relación
//,    "alias"=> "cci" //Alias de la tabla para el join
//,   "field_id"=>"itemId" //Id de la tabla que hara la relación
//,   "relationship_id"=>"id_tipo_correspondencia" //Campo de relación en la tabla principal
//);

/**
 * Configuración de los campos que mostraremos en la grilla
 */

$grid_item[]=array("field"=> "nivel_destinatario", "label"=> $smarty->config_vars["table_nivel_destinatario"]);
$grid_item[]=array("field"=> "nombre", "label"=> $smarty->config_vars["table_nombre"]);
$grid_item[]=array("field" => "fecha_ingreso","label"=> $smarty->config_vars["table_fecha_ingreso"]);
$grid_item[]=array("field" => "fecha_salida","label"=> $smarty->config_vars["table_fecha_salida"]);

//$grid_item[]=array("field" => "created_at","label"=> $smarty->config_vars["gl_table_created_at"]);
//$grid_item[]=array("field" => "updated_at","label"=> $smarty->config_vars["gl_table_updated_at"]);
//$grid_item[]=array("field" => "created_at","label"=> $smarty->config_vars["gl_table_created_at"]);
//$grid_item[]=array("field" => "updated_at","label"=> $smarty->config_vars["gl_table_updated_at"]);

$group = "index";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
/**
 * A partir de aca puede añadir todas las grillas que sean necesarias para esta vista
 */
/*/
print_struc($grid_table_join);
print_struc($grid);
exit;
/**/