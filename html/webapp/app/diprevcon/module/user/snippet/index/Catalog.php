<?PHP
namespace App\Diprevcon\User\Index;
use Core\CoreResources;
class Catalog extends CoreResources{
    function __construct(){
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }

    public function getActiveOption(){
        global $smarty;
        $dato = array();
        $dato["1"] = $smarty->config_vars["glOptActive"];
        $dato["0"] = $smarty->config_vars["glOptInactive"];
        return $dato;
    }

    public function getUserType(){
        global $smarty;
        $dato = array();
        $dato[1] = $smarty->config_vars["opt_typeuser_1"];
        $dato[2] = $smarty->config_vars["opt_typeuser_2"];
        $dato[3] = $smarty->config_vars["opt_typeuser_3"];
        //$dato[3] = $smarty->config_vars["opt_typeuser_3"];
        return $dato;
    }

    public function getJefe(){
        global $smarty;
        $dato = array();
        $dato[1] = "ES JEFE";
        $dato[0] = "NO ES JEFE";
        return $dato;
    }

    public function getHoja(){
        global $smarty;
        $dato = array();
        $dato[1] = "HABILITADO PARA CREAR";
        $dato[0] = "NO HABILITADO PARA CREAR";
        return $dato;
    }

    public function getOficinaOptions(){
        $sql = "select 
                e.sigla as entidad ,o.id, o.nombre, o.sigla, o.entidad_id
                from ".$this->table["oficina"]." as o
                LEFT JOIN ".$this->table["entidad"]." as e on e.id= o.entidad_id
                order by o.entidad_id, o.sigla
                ";
        $item = $this->dbm->Execute($sql)->GetRows();
        $res = array();
        foreach ($item as $row){
            $res[$row["entidad"]] [$row["id"]] = "[".$row["sigla"]."] - ". $row["nombre"];
        }
        return $res;
    }
}