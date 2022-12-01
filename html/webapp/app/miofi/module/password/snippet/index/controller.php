<?PHP
use App\Miofi\Password\Index\Index;
use App\Miofi\Password\Index\Catalog;
use Core\Core;

$objItem = new Index();
$objCatalog = new Catalog();

switch($action) {
    default:
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("index");
        /**
         * Get user login info
         */
//        $smarty->assign("userInfo", $_SESSION["userv"]);
//        print_r($_SESSION["userv"]);

        /**
         * Template for index and js
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;
    /**
     * Creación de JSON
     */
    case 'save':
        $respuesta = $objItem->updateData($_REQUEST["item"],"module");
        Core::printJson($respuesta);
        break;
}
