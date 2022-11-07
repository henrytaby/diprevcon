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
    "table" => $appVars["table"] ["hojaruta"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "hr" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"hojaruta_id" //Campo de relación en la tabla principal
);

$grid_table[] = array(
    "table" => $appVars["table"] ["estado"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "e" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"estado_id" //Campo de relación en la tabla principal
);

$grid_table[] = array(
    "table" => $appVars["table"] ["instruccion"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "ins" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"instruccion_id" //Campo de relación en la tabla principal
);

$grid_table[] = array(
    "table" => $appVars["table"] ["entidad"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "ent" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"entidad_id" //Campo de relación en la tabla principal
);

$grid_table[] = array(
    "table" => $appVars["table"] ["proceso"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "pr" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"proceco_id" //Campo de relación en la tabla principal
);

/**
 * Configuración de los campos que mostraremos en la grilla
 */
$grid_item[]=array( "field" => "asunto", "label"=> $smarty->config_vars["table_asunto"]
, "table_as"=> "hr", "as" => "asunto");

$grid_item[]=array( "field" => "procedencia", "label"=> $smarty->config_vars["table_procedencia"]
, "table_as"=> "hr", "as" => "procedencia");

$grid_item[]=array( "field" => "destinatario", "label"=> $smarty->config_vars["table_destinatario"]
, "table_as"=> "hr", "as" => "destinatario");

$grid_item[]=array("field"=> "nur", "label"=> $smarty->config_vars["table_nur"]);

//Emisor
$grid_item[]=array("field"=> "emisor_nombre", "label"=> $smarty->config_vars["table_emisor_nombre"]);
$grid_item[]=array("field"=> "emisor_cargo", "label"=> $smarty->config_vars["table_emisor_cargo"]);
//

$grid_item[]=array("field"=> "emisor_oficina", "label"=> $smarty->config_vars["table_emisor_oficina"]);


////Receptor
$grid_item[]=array("field"=> "receptor_nombre", "label"=> $smarty->config_vars["table_receptor_nombre"]);
$grid_item[]=array("field"=> "receptor_cargo", "label"=> $smarty->config_vars["table_receptor_cargo"]);


$grid_item[]=array("field"=> "receptor_oficina", "label"=> $smarty->config_vars["table_receptor_oficina"]);



$grid_item[]=array("field" => "fecha_emision","label"=> $smarty->config_vars["table_fecha_emision"]);
$grid_item[]=array("field" => "fecha_recepcion","label"=> $smarty->config_vars["table_fecha_recepcion"]);

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_estado"]
, "table_as"=> "e", "as" => "estado");

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_instruccion"]
, "table_as"=> "ins", "as" => "instruccion");

$grid_item[]=array("field"=> "proveido", "label"=> $smarty->config_vars["table_proveido"]);

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_entidad"]
, "table_as"=> "ent", "as" => "entidad");

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_proceso"]
, "table_as"=> "pr", "as" => "proceso");

$grid_item[]=array("field"=> "urgente", "label"=> $smarty->config_vars["table_urgente"]);

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