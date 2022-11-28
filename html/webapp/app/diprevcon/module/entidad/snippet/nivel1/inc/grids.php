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
/*$grid_item[]=array(
   "field" => "name" // el campo de la base de datos relacional
,   "label"=> $smarty->config_vars["tableGroupname"]
,   "table_as"=> "g"
,   "as" => "groupname"
);*/
$grid_item[]=array("field" => "id","label"=> $smarty->config_vars["tableId"]);
$grid_item[]=array("field" => "nombre","label"=> $smarty->config_vars["tableName"]);
$grid_item[]=array("field"=> "sigla","label"=> $smarty->config_vars["tableSigla"]);
$grid_item[]=array("field"=> "active","label"=> $smarty->config_vars["tableStatus"]);

$group = "index";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
