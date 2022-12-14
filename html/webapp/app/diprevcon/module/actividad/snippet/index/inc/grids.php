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
    "table" => $appVars["table"] ["oficina"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "d" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"oficina_id" //Campo de relación en la tabla principal
);
$grid_table[] = array(
    "table" => $appVars["table"] ["entidad"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "e" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"entidad_id" //Campo de relación en la tabla principal
);
/**
 * Configuración de los campos que mostraremos en la grilla
 */

$grid_item[]=array("field" => "nombre","label"=> $smarty->config_vars["table_nombre"]);
$grid_item[]=array("field"=> "limite", "label"=> $smarty->config_vars["table_limite"]);
$grid_item[]=array("field"=> "dias", "label"=> $smarty->config_vars["table_dias"]);
$grid_item[]=array("field"=> "horas", "label"=> $smarty->config_vars["table_horas"]);
$grid_item[]=array("field"=> "minutos", "label"=> $smarty->config_vars["table_min"]);

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_entidad"]
, "table_as"=> "e", "as" => "entidad");
$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_oficina"]
, "table_as"=> "d", "as" => "oficina");
$grid_item[]=array("field"=> "descripcion", "label"=> $smarty->config_vars["table_descripcion"]);
$grid_item[]=array("field"=> "active", "label"=> $smarty->config_vars["table_activo"]);


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