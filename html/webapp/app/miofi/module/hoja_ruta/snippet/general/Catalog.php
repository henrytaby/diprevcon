<?PHP
namespace App\Miofi\Hoja_ruta\general;
use Core\CoreResources;

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog(){
        $this->addCatalogList($this->table["tipo_correspondencia"]
            ,"tipo_correspondencia","","nombre",""
            ,"nombre","","","");
    }

}