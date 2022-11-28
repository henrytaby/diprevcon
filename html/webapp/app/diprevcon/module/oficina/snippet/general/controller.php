<?PHP
use App\Diprevcon\Module\Oficina\Snippet\General\Index;
use App\Diprevcon\Module\Oficina\Snippet\General\Catalog;
use Core\Core;
use App\Diprevcon\Module\Oficina\Snippet\index\Index as indexParent;
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
         * Language settings, section
         */
        \Core\Core::setLenguage("general");

        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $objItemParent->getItem($id);
        }else{
            $item["class"] = "fa fa-cogs";
        }
        $smarty->assign("item",$item);
        /**
         * Catalog
         */

        $objCatalog->confCatalog();
        $cataobj= $objCatalog->getCatalogList();
        $cataobj["group"] = $objCatalog->getGroupOptions();
        $cataobj["tipo"] = $objCatalog->getTypeOption();
        $smarty->assign("cataobj" , $cataobj);

        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'get.form':
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("general");

        $smarty->assign("item_id",$item_id);



        if($type=="update"){
            $item = $objItem->getItem($id2,$item_id);
        }else{
            //$item = "";
            $item["class"] = "fab fa-buffer";
            $item["order"] = "1";
            $item["active"] = "1";
        }
        $smarty->assign("item",$item);

        $objCatalog->conf_catalog_form($item,$item_id);
        $cataobj = $objCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);
//        print_struc($cataobj);exit;

        $smarty->assign("type",$type);
        $smarty->assign("id",$id2);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'save':
        $respuesta = $objItem->updateData($_REQUEST["item"],$id,$type);
        Core::printJson($respuesta);
        break;

}