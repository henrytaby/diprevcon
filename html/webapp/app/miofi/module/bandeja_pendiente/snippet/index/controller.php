<?PHP
use App\Miofi\BandejaPendiente\Index\Index;
use App\Miofi\BandejaPendiente\Index\Catalog;
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
        $smarty->assign("menu_tab_active", "seguimiento");
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
    case 'estado':
        $res = $objItem->estado($id);
        Core::printJson($res);
        break;

    case 'get.form.derivar':
        //print_struc($_SESSION["uservAdd"]);exit;
        $smarty->assign("item_id",$item_id);
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("formItem");

        $item = $objItem->getItem($id);
        $item2["id"] =$item["id"];
        $smarty->assign("item", $item2);

        $objCatalog->conf_catalog_form($item,$item_id);
        $cataobj = $objCatalog->getCatalogList();
        $cataobj["persona"] = $objCatalog->getPersona();
        $cataobj["actividad"] = $objCatalog->getActividad();
        $cataobj["actividadArray"] = $objCatalog->getActividadArray();
        $smarty->assign("cataobj" , $cataobj);

        $templateModule = $frontend["baseAjax"];
        $smarty->assign("subpage",$webm["sc_form"]);

        break;

    case 'save':
        $respuesta = $objItem->updateData($_REQUEST["item"],$id,"new");
        Core::printJson($respuesta);
        break;
}