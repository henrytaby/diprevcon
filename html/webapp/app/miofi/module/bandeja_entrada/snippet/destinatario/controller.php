<?PHP
use App\Miofi\BandejaEntrada\destinatario\Index;
use App\Miofi\BandejaEntrada\destinatario\Catalog;
use Core\Core;
use App\Miofi\BandejaEntrada\Index\Index as indexParent;

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
        //print_r($item);//exit;
        Core::printJson($res);
        break;


}