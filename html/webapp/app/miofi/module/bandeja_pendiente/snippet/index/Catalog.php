<?PHP
namespace App\Miofi\BandejaPendiente\Index;
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
        $this->addCatalogList($this->table["estado"]
            ,"estado","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["instruccion"]
            ,"instruccion","","nombre",""
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
            and p.entidad_id=".$_SESSION["uservAdd"]["entidad_id"];


        $sql = "select u.id , o.nombre as oficina ,u.name, u.last_name, p.cargo, p.jefe, p.oficina_id, p.entidad_id
            from core.user as u 
            left join personal.persona as p on p.id = u.id 
            left join public.oficina as o on o.id = p.oficina_id
            where u.active = true
            and p.entidad_id=".$_SESSION["uservAdd"]["entidad_id"]."
						
						and (
						( p.oficina_id = ".$_SESSION["uservAdd"]["oficina_id"]." and u.id <>".$_SESSION["userv"]["id"]." ) 
						or 
						(p.oficina_id in (select of.id from public.oficina as of where of.parent=".$_SESSION["uservAdd"]["oficina_id"].") and p.jefe = true )
						or
						(p.oficina_id in (select of2.parent from public.oficina as of2 where of2.id=".$_SESSION["uservAdd"]["oficina_id"].") and p.jefe = true )
						)
						order by o.nombre

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