<?PHP
use App\Contratacion\Module\Catalogo\Snippet\Index\Index;
use App\Contratacion\Module\Catalogo\Snippet\Index\Catalog;
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
         * Tabs
         */
        $menu_tab = $objItem->getTabItem($type,"index");
//        print_r($menu_tab);exit();
        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "tipo");

        /**
         * Template for index and js
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

}