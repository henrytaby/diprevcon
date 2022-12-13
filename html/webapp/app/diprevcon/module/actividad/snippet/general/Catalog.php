<?PHP
namespace App\Diprevcon\Actividad\General;
use Core\CoreResources;

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog(){
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