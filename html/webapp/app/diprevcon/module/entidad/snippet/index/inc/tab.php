<?PHP
/**
 * Configuración de los tabs a utilizarse en el snippet
 */

$tabs = array();
\Core\Core::setLenguage("tabItem"); //cargamos idioma

/**
 * Realizamos la configuración de los taps para cada grupo que utilicemos
 */
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> $smarty->config_vars["tabGeneral"]
,   "id_name"=>"general"
,   "icon" => "flaticon-home m--font-success"
,   "new" => 1
);

$item_tab[]=array(
    "label"=> $smarty->config_vars["tabNivel1"]
,   "id_name"=>"nivel1"
,   "icon" => "flaticon-layer m--font-success"
,   "new" => 0
);

$item_tab[]=array(
    "label"=> $smarty->config_vars["tabNivel2"]
,   "id_name"=>"nivel2"
,   "icon" => "flaticon-layer m--font-success"
,   "new" => 0
);
$item_tab[]=array(
    "label"=> $smarty->config_vars["tabNivel3"]
,   "id_name"=>"nivel3"
,   "icon" => "flaticon-layer m--font-success"
,   "new" => 0
);

//-------------------------------------------------------------
/**
 * Se añade el arreglo de tabs configurada a $tabs
 */
$group = "index";
$tabs[$group]= $item_tab;
unset($item_tab); // siempre se borrar la variable para iniciar una nueva configuración

/**
 * A partir de aca puede añadir todos los grupos de tabs que sean necesarias para esta vista
 */
