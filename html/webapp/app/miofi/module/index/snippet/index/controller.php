<?PHP
use App\Miofi\Index\Index\Index;
use App\Miofi\Index\Index\Catalog;
use Core\Core;
$objItem = new Index();
$objCatalog = new Catalog();

switch($action) {
    /**
     * Página por defecto
     */
    default:
        $url = 'Location: /miofi/principal';
        header($url);exit;
        //$smarty->debugging = true;
        /**
         * usamos el template para mootools
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;
}
/**
 * Como la página no cambia muy frecuentemente, se crea una cache
 */
//$smarty->caching = true;