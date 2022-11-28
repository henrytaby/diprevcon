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
,    "alias"=> "g" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"parent" //Campo de relación en la tabla principal
);


$grid_item[]=array("field" => "id","label"=> $smarty->config_vars["tableId"]);

/**
 * Configuración de los campos que mostraremos en la grilla
 */
$grid_item[]=array(
    "field" => "nombre" // el campo de la base de datos relacional
,   "label"=> $smarty->config_vars["tableName"]
,   "table_as"=> "g"
,   "as" => "oficinaname"
);
$grid_item[]=array("field" => "nombre","label"=> $smarty->config_vars["tableNamePadre"]);
$grid_item[]=array("field"=> "sigla","label"=> $smarty->config_vars["tableSigla"]);
$grid_item[]=array("field"=> "active","label"=> $smarty->config_vars["tableStatus"]);

$group = "index";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
