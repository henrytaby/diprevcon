<?PHP
namespace App\Diprevcon\Entidad\Nivel1;
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

    public function conf_catalog_form(){
       // $this->dbm->debug = true;
        $where = "parent = 1 ";
        $this->addCatalogList($this->table["oficina"],"oficina","","nombre","","", $where,"","");
        //$this->addCatalogList($this->table["modulo"],"modulo","","titulo","","itemid","","");
    }

}