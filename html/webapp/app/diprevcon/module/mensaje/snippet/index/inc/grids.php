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

/**
 * Configuración de los campos que mostraremos en la grilla
 */

$grid_item[]=array("field"=> "titulo", "label"=> $smarty->config_vars["table_titulo"]);
$grid_item[]=array("field"=> "fecha_inicio", "label"=> $smarty->config_vars["table_fecha_inicio"]);
$grid_item[]=array("field"=> "fecha_fin", "label"=>  $smarty->config_vars["table_fecha_fin"]);
$grid_item[]=array("field"=> "active", "label"=> $smarty->config_vars["table_active"]);
$grid_item[]=array("field"=> "mensaje", "label"=> $smarty->config_vars["table_mensaje"]);

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
