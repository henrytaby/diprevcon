<?PHP
use App\Diprevcon\Entidad\Nivel1\Index;
use App\Diprevcon\Entidad\Nivel1\Catalog;
use Core\Core;

use App\Diprevcon\Entidad\Index\Index as indexParent;
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
        /**
         * Smarty Options
         */
        //$smarty->caching = true;
        //$smarty->debugging = true;
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("index");
        /**
         * catalog configuration
         */

        $cataobj["activo"] = $objCatalog->get_activo_option();
        $smarty->assign("cataobj", $cataobj);
        /**
         * Grid configuration
         */
        $gridItem = $objItem->getGridItem("index");
        $smarty->assign("gridItem", $gridItem);
        /**
         * Template for index and js
         */
        $smarty->assign("subpage",$webm["sc_index"]);
        break;
    case 'list':
        //$datatable_debug=true;
        $res = $objItem->getItemDatatableRows($item_id);
        Core::printJson($res);
        break;
    case 'get.form':
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("formItem");

        $smarty->assign("item_id",$item_id);

        if($type=="update"){

            $item = $objItem->getItem($id2,$item_id);

        }else{
            $item["class"] = "fab fa-buffer";
            $item["order"] = "1";
            $item["active"] = "1";
        }
        $smarty->assign("item",$item);

        //$opt_item = $objCatalog->get_item_options();
        //$cataobj["items"] = $opt_item;
        $smarty->assign("opt_item",$opt_item);

        $smarty->assign("type",$type);
        $smarty->assign("id",$id2);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'save':
        $respuesta = $objItem->updateData($_REQUEST["item"],$id2,"index",$type,$item_id);
        Core::printJson($respuesta);
        break;

    case 'delete':
        $res = $objItem->deleteData($id2,$item_id);
        Core::printJson($res);
        break;
}
