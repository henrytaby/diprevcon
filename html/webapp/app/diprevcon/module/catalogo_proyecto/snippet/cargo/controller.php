<?PHP
use App\Diprevcon\Module\Hoja_ruta\Snippet\destinatario\Index;
use App\Diprevcon\Module\Hoja_ruta\Snippet\destinatario\Catalog;
use Core\Core;
use App\Diprevcon\Module\Hoja_ruta\Snippet\Index\Index as indexParent;

$objItem = new Index();
$objCatalog = new Catalog();
$objItemParent = new indexParent();

/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $frontend["baseAjax"];

switch($action){
    /**
     * Página por defecto (index)
     */
    default:
        $item = $objItemParent->getItem($id);
        //print_r($item);exit;
        $smarty->assign("item",$item);
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("index");

        /**
         * Grid configuration
         */
        $gridItem = $objItem->getGridItem("index");
        //print_r($gridItem);
        $smarty->assign("gridItem", $gridItem);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'list':
        //$datatable_debug= true;
        $res = $objItem->getItemDatatableRows($item);
        print_r($item);//exit;
        Core::printJson($res);
        break;


}