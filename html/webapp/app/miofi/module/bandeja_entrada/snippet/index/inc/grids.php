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
    "table" => $appVars["table"] ["proceso"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "pro" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"proceso_id" //Campo de relación en la tabla principal
);

/**
 * Configuración de los campos que mostraremos en la grilla
 */
$grid_item[]=array("field" => "hojaruta_id","label"=> $smarty->config_vars["table_fecha_emision"]);


$grid_item[]=array( "field" => "asunto", "label"=> $smarty->config_vars["table_asunto"]
, "table_as"=> "hr", "as" => "asunto");

$grid_item[]=array( "field" => "procedencia", "label"=> $smarty->config_vars["table_procedencia"]
, "table_as"=> "hr", "as" => "procedencia");

$grid_item[]=array( "field" => "destinatario", "label"=> $smarty->config_vars["table_destinatario"]
, "table_as"=> "hr", "as" => "destinatario");

//$grid_item[]=array("field"=> "nur", "label"=> $smarty->config_vars["table_nur"]);

$grid_item[]=array( "field" => "nur", "label"=> $smarty->config_vars["table_nur"]
, "table_as"=> "hr", "as" => "nur");

$grid_item[]=array( "field" => "fecha", "label"=> $smarty->config_vars["table_fecha"]
, "table_as"=> "hr", "as" => "fecha");

$grid_item[]=array( "field" => "hora", "label"=> $smarty->config_vars["table_hora"]
, "table_as"=> "hr", "as" => "hora");


$grid_item[]=array("field" => "emisor_nombre","label"=> $smarty->config_vars["table_fecha_emision"]);
$grid_item[]=array("field" => "emisor_cargo","label"=> $smarty->config_vars["table_fecha_emision"]);
$grid_item[]=array("field" => "emisor_oficina","label"=> $smarty->config_vars["table_fecha_emision"]);

$grid_item[]=array("field" => "receptor_nombre","label"=> $smarty->config_vars["table_fecha_emision"]);
$grid_item[]=array("field" => "receptor_cargo","label"=> $smarty->config_vars["table_fecha_emision"]);
$grid_item[]=array("field" => "receptor_oficina","label"=> $smarty->config_vars["table_fecha_emision"]);


$grid_item[]=array("field" => "fecha_emision","label"=> $smarty->config_vars["table_fecha_emision"]);
$grid_item[]=array("field" => "fecha_recepcion","label"=> $smarty->config_vars["table_fecha_recepcion"]);
$grid_item[]=array("field" => "recepcion_dias","label"=> $smarty->config_vars["table_fecha_recepcion"]);


$grid_item[]=array("field" => "estado_id","label"=> $smarty->config_vars["table_estado"]);

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_estado"]
, "table_as"=> "e", "as" => "estado");

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_instruccion"]
, "table_as"=> "ins", "as" => "instruccion");

$grid_item[]=array("field"=> "proveido", "label"=> $smarty->config_vars["table_proveido"]);

$grid_item[]=array("field"=> "urgente", "label"=> $smarty->config_vars["table_urgente"]);


$grid_item[]=array("field" => "proceso_id","label"=> $smarty->config_vars["table_estado"]);
$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_estado"]
, "table_as"=> "pro", "as" => "proceso");
$grid_item[]=array("field" => "proceso_dias","label"=> $smarty->config_vars["table_estado"]);
$grid_item[]=array("field" => "proceso_fecha_fin","label"=> $smarty->config_vars["table_estado"]);
$grid_item[]=array("field" => "proceso_dias_retraso","label"=> $smarty->config_vars["table_estado"]);
$grid_item[]=array("field" => "proceso_limite","label"=> $smarty->config_vars["table_estado"]);

$grid_item[]=array("field" => "id", "as" =>"total_seguimiento","label"=> $smarty->config_vars["table_estado"]);

$grid_item[]=array("field" => "accion_dias", "label"=> $smarty->config_vars["table_estado"]);
$grid_item[]=array("field" => "accion_fecha", "label"=> $smarty->config_vars["table_estado"]);

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