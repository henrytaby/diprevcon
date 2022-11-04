<?PHP
namespace App\Diprevcon\Module\Hoja_ruta\Snippet\destinatario;
use Core\CoreResources;

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog(){
        $this->addCatalogList($this->table["catalogo_tipo_correspondencia"]
            ,"catalogo_tipo_correspondencia","","nombre",""
            ,"nombre","","","");
    }

}