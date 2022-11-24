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
    "label"=> "Tipo Contratacion"
,   "id_name"=>"tipo"
,   "icon" => "fas fa-network-wired m--font-success"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> "Modalidad"
,   "id_name"=>"modalidad"
,   "icon" => "fas fa-clipboard-check m--font-success"
,   "new" => 0
);
//-------------------------------------------------------------
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> "Estado"
,   "id_name"=>"estado"
,   "icon" => "fas fa-lightbulb m--font-success"
,   "new" => 0
);
/**
 * Se añade el arreglo de tabs configurada a $tabs
 */
$group = "index";
$tabs[$group]= $item_tab;
unset($item_tab); // siempre se borrar la variable para iniciar una nueva configuración

/**
 * A partir de aca puede añadir todos los grupos de tabs que sean necesarias para esta vista
 */
