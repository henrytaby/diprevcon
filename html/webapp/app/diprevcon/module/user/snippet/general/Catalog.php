<?PHP
namespace App\Diprevcon\Module\User\Snippet\General;
use Core\CoreResources;
class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();

    }
    public function confCatalog(){
        /*
        $this->addCatalogList($this->table["distribuidor"]
            ,"distribuidor","","CONCAT(ciae,' | ', nombre) as name",""
            ,"nombre","","", true);
        */
    }
/*

    public function getTypeOption(){
        global $smarty;
        $dato = array();
        $dato["app"] = $smarty->config_vars["OptApp"];
        $dato["url"] = $smarty->config_vars["OptUrl"];
        return $dato;
    }*/

    public function getUserType(){
        global $smarty;
        $dato = array();
        $dato[1] = $smarty->config_vars["opt_typeuser_1"];
        $dato[2] = $smarty->config_vars["opt_typeuser_2"];
        $dato[3] = $smarty->config_vars["opt_typeuser_3"];
        $dato[4] = $smarty->config_vars["opt_typeuser_4"];
        //$dato[3] = $smarty->config_vars["opt_typeuser_3"];
        return $dato;
    }

    public function getOficinaOptions(){
        $sql = "select 
                e.sigla as entidad ,o.id, o.nombre, o.sigla, o.entidad_id
                from public.oficina as o
                LEFT JOIN entidad as e on e.id= o.entidad_id
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