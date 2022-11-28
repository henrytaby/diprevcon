<?PHP
use App\Diprevcon\Module\User\Snippet\General\Index;
use App\Diprevcon\Module\User\Snippet\General\Catalog;
use Core\Core;

use App\Diprevcon\Module\User\Snippet\Index\Index as indexPrincipal;
$objItemIndex = new indexPrincipal();

$objItem = new Index();
$objCatalog = new Catalog();

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
         * Language settings, section
         */
        \Core\Core::setLenguage("general");

        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $objItemIndex->getItem($id,"app");
        }else{
            /**
             * Datos por defecto
             */
            $item["active"] = 1;
        }
        $smarty->assign("item",$item);
        /**
         * Catalog
         */
        $objCatalog->confCatalog();
        $cataobj= $objCatalog->getCatalogList();
        $cataobj["type"] = $objCatalog->getUserType();
        $cataobj["oficina"] = $objCatalog->getOficinaOptions();


        $smarty->assign("cataobj" , $cataobj);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'save':
        $respuesta = $objItem->updateData($_REQUEST["item"],$id,$type);
        Core::printJson($respuesta);
        break;

}