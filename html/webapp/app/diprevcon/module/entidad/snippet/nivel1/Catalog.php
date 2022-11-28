<?PHP
namespace App\Diprevcon\Module\Entidad\Snippet\Nivel1;
use Core\CoreResources;
class Catalog extends CoreResources{

    function __construct(){
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }

    public function get_activo_option(){
        global $smarty;
        $dato = array();
        $dato["1"] = $smarty->config_vars["glOptActive"];
        $dato["0"] = $smarty->config_vars["glOptInactive"];
        return $dato;
    }

}