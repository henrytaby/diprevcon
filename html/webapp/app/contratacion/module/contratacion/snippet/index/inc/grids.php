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
    "table" => $appVars["table"] ["contratacion_tipo"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "t" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"tipo_id" //Campo de relación en la tabla principal
);

$grid_table[] = array(
    "table" => $appVars["table"] ["contratacion_modalidad"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "m" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"modalidad_id" //Campo de relación en la tabla principal
);

$grid_table[] = array(
    "table" => $appVars["table"] ["contratacion_estado"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "e" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"estado_id" //Campo de relación en la tabla principal
);
///**
// * Configuración de los campos que mostraremos en la grilla
// */
$grid_item[]=array("field"=> "objeto_contracion", "label"=>  $smarty->config_vars["table_objeto_contratacion"]);
$grid_item[]=array("field"=> "fecha_publicacion", "label"=> $smarty->config_vars["table_fecha_publicacion"]);
$grid_item[]=array("field"=> "cuce", "label"=> $smarty->config_vars["table_cuce"]);

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_tipo_contratacion"]
, "table_as"=> "t", "as" => "contratacion_tipo");

$grid_item[]=array( "field" => "sigla", "label"=> $smarty->config_vars["table_modalidad"]
, "table_as"=> "m", "as" => "contratacion_modalidad");

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_estado"]
, "table_as"=> "e", "as" => "contratacion_estado");

$grid_item[]=array("field"=> "subasta", "label"=> $smarty->config_vars["table_subasta"]);
$grid_item[]=array("field"=> "procesador", "label"=> $smarty->config_vars["table_procesador"]);

$grid_item[]=array("field"=> "proponente", "label"=> $smarty->config_vars["table_proponente_adjudicado"]);
$grid_item[]=array("field"=> "contrato_codigo", "label"=> $smarty->config_vars["table_contrato_codigo"]);
$grid_item[]=array("field" => "fecha_suscripcion","label"=> $smarty->config_vars["table_fecha_suscripcion"]);
$grid_item[]=array("field" => "fecha_fin","label"=> $smarty->config_vars["table_fecha_fin"]);

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