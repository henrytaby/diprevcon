<?PHP
use App\Miofi\Hojaruta\Index\Index;
use App\Miofi\Hojaruta\Index\Catalog;
use Core\Core;

$objItem = new Index();
$objCatalog = new Catalog();

switch($action) {
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

        $objCatalog->confCatalog();
        $cataobj= $objCatalog->getCatalogList();
        $cataobj["activo"] = $catalogo=$objCatalog->getActiveOption();
        //print_struc($cataobj);exit;
        $smarty->assign("cataobj", $cataobj);
        /**
         * Grid configuration
         */
        $gridItem = $objItem->getGridItem("item");
        $smarty->assign("gridItem", $gridItem);
        /**
         * Template for index and js
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;
    /**
     * Creación de JSON
     */
    case 'list':
        //$datatable_debug = true;
        $res = $objItem->getItemDatatableRows();
        Core::printJson($res);
        break;
    case 'itemUpdate':
        $objItem->setDerivacionPermiso($item_id);
        /**
         * Smarty Options
         */
        //$smarty->caching = true;
        //$smarty->debugging = true;
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("item");
        /**
         * Smarty vars
         * Type = update, new
         * id = item id
         */
        $smarty->assign("type", $type);
        $smarty->assign("id", $id);
        /**
         * Tabs
         */
        $menu_tab = $objItem->getTabItem($type,"index");
        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");
        /**
         * GetItem
         */
        if ($type == "update") {
            $item = $objItem->getItem($id);
            $smarty->assign("item", $item);
        }
        /**
         * Template for index and js
         */
        $smarty->assign("subpage", $webm["item_index"]);
        $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;
    case 'delete':
        $res = $objItem->deleteData($id);
        Core::printJson($res);
        break;
    case 'get.form.derivar':
        $smarty->assign("item_id",$item_id);
        $objItem->setDerivacionPermiso($item_id);
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("formItem");
        $item = $objItem->getItem($id);
        $smarty->assign("item", $item);

        $objCatalog->conf_catalog_form($item,$item_id);
        $cataobj = $objCatalog->getCatalogList();
        $cataobj["persona"] = $objCatalog->getPersona();
        $cataobj["actividad"] = $objCatalog->getActividad();
        $smarty->assign("cataobj" , $cataobj);

        $templateModule = $frontend["baseAjax"];
        $smarty->assign("subpage",$webm["sc_form"]);

        break;

    case 'save':
        $objItem->setDerivacionPermiso($item_id);
        $respuesta = $objItem->updateData($_REQUEST["item"],$id,"new");
        Core::printJson($respuesta);
        break;
}