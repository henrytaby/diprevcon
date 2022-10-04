<?PHP
use App\Latinosan\Module\Programa\Snippet\migra\Index;
use App\Latinosan\Module\Programa\Snippet\migra\Catalog;
use Core\Core;

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
         * Inicio de migración
         */
        echo "Inicio de migración de datos<br>";
        $objItem->migra();
        exit;
        break;

    case 'save':
        $respuesta = $objItem->updateData($item,$id,$type);
        Core::printJson($respuesta);
        break;


}