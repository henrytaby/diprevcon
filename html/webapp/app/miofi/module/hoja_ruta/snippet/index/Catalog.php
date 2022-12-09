<?PHP
namespace App\Miofi\Hojaruta\Index;
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

    public function confCatalog(){
        $this->addCatalogList($this->table["tipo_correspondencia"]
            ,"tipo_correspondencia","","nombre",""
            ,"nombre","","","");

    }

    public function conf_catalog_form(){

        $this->addCatalogList($this->table["instruccion"]
            ,"instruccion","","nombre",""
            ,"nombre","","","");
    }
    public function getPersona(){
        $sql = "select u.id
            , o.nombre as oficina
            ,u.name, u.last_name
            , p.cargo, p.jefe, p.oficina_id, p.entidad_id
            from core.user as u 
            left join personal.persona as p on p.id = u.id 
            left join public.oficina as o on o.id = p.oficina_id
            where u.active = true
            and p.jefe = true
            and p.entidad_id=".$_SESSION["uservAdd"]["entidad_id"]." 
            and p.oficina_id=".$_SESSION["uservAdd"]["oficina_id"]."
            ";
        $item = $this->dbm->Execute($sql)->GetRows();
        $res = array();
        foreach ($item as $row){
            $res[$row["id"]] = "Of: ".$row["oficina"]." | ".$row["name"]." ".$row["last_name"]." - ".$row["cargo"];
        }
        return $res;
    }

    public function getActividad(){
        $sql = "select * from proceso as p  where p.active=true;";
        $item = $this->dbm->Execute($sql)->GetRows();
        $res = array();
        foreach ($item as $row){
            $res[$row["id"]] = $row["nombre"];
            if($row["limite"] == true) $res[$row["id"]] .= " | Límite:  ".$row["dias"]." Dias ";
        }
        return $res;
    }
}