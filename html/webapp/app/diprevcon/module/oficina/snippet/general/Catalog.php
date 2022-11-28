<?PHP
namespace App\Diprevcon\Module\Oficina\Snippet\General;
use Core\CoreResources;
class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function getGroupOptions(){
        $sql = "select 
                g2.nombre as padre_name ,g.id, g.nombre
                
                from ".$this->table["oficina"]." as g
                left join ".$this->table["oficina"]." as g2 on g2.id = g.parent
                where g.parent is not null
                order by g.parent, g.nombre
                ";

        $item = $this->dbm->Execute($sql)->GetRows();
        $res = array();
        foreach ($item as $row){
            $res[$row["padre_name"]] [$row["id"]] = $row["name"];
        }

        return $res;
    }
    public function confCatalog(){
        $this->addCatalogList($this->table["entidad"]
            ,"entidad","","nombre",""
            ,"nombre","","","");
    }
    public function conf_catalog_form(){
        //$this->addCatalogList($this->table["app"],"","","","","","","");
    }

    public function getTypeOption(){
        global $smarty;
        $dato = array();
        $dato["app"] = $smarty->config_vars["OptApp"];
        $dato["url"] = $smarty->config_vars["OptUrl"];
        return $dato;
    }
}