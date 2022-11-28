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
$grid_table[] = array(
    "table" => $appVars["table"] ["tipo_correspondencia"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "c" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"tipo_correspondencia_id" //Campo de relación en la tabla principal
);

/**
 * Configuración de los campos que mostraremos en la grilla
 */

$grid_item[]=array("field"=> "procedencia", "label"=> $smarty->config_vars["table_procedencia"]);
$grid_item[]=array("field"=> "destinatario", "label"=> $smarty->config_vars["table_destinatario"]);

$grid_item[]=array("field"=> "asunto", "label"=>  $smarty->config_vars["table_asunto"]);
$grid_item[]=array("field"=> "fojas", "label"=> $smarty->config_vars["table_fojas"]);

$grid_item[]=array("field" => "fecha","label"=> $smarty->config_vars["table_fecha"]);

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_tipo_correspondenica"]
, "table_as"=> "c", "as" => "tipo_correspondencia");

$grid_item[]=array("field" => "created_at","label"=> $smarty->config_vars["gl_table_created_at"]);
$grid_item[]=array("field" => "updated_at","label"=> $smarty->config_vars["gl_table_updated_at"]);

$group = "item";
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