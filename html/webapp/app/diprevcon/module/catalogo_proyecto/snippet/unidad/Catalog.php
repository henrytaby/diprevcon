<?PHP
namespace App\Diprevcon\Module\Catalogo_proyecto\Snippet\unidad;
use Core\CoreResources;

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function conf_catalog_form(){
        //$this->addCatalogList($this->table["app"],"","","","","","","");
    }
    public function get_activo_option(){
        global $smarty;
        $dato = array();
        $dato["1"] = $smarty->config_vars["glOptActive"];
        $dato["0"] = $smarty->config_vars["glOptInactive"];
        return $dato;
    }
    public function confCatalog(){
        $this->addCatalogList($this->table["catalogo_unidad"]
            ,"catalogo_unidad","","nombre",""
            ,"nombre","","","");
    }

}