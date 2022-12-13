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
        //print_struc($_SESSION["uservAdd"]);
        if($_SESSION["uservAdd"]["jefe"]){
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
        }else{
            $sql = "select u.id , o.nombre as oficina ,u.name, u.last_name, p.cargo, p.jefe, p.oficina_id, p.entidad_id
            from core.user as u 
            left join personal.persona as p on p.id = u.id 
            left join public.oficina as o on o.id = p.oficina_id
            where u.active = true
            and p.entidad_id=".$_SESSION["uservAdd"]["entidad_id"]."
						
						and 
						( p.oficina_id = ".$_SESSION["uservAdd"]["oficina_id"]." and u.id <>".$_SESSION["userv"]["id"]." ) 

						order by o.nombre

						";
        }

        $item = $this->dbm->Execute($sql)->GetRows();
        $res = array();
        foreach ($item as $row){
            $persona = "";
            if($row["jefe"]){
                $persona .= "<span class='jefe'>".$row["name"]." ".$row["last_name"]."</span> - ".$row["cargo"];
            }else{
                $persona .= "<span class='persona'>".$row["name"]." ".$row["last_name"]."</span> - ".$row["cargo"];
            }
            $res[$row["id"]] = "<span class='oficina'>Of:</span> ".$row["oficina"]." | ".$persona;
        }
        return $res;
    }

    public function getActividad(){
        $sql = "select * from ".$this->table["proceso"]." as p  where p.active=true and p.oficina_id=".$_SESSION["uservAdd"]["oficina_id"];
        $item = $this->dbm->Execute($sql)->GetRows();
        $res = array();
        foreach ($item as $row){
            $res[$row["id"]] = $row["nombre"];

            $limite = "";
            if($row["dias"]<>0) $limite .= $row["dias"]." dias ";
            if($row["horas"]<>0) $limite .= $row["horas"]." horas ";
            if($row["minutos"]<>0) $limite .= $row["minutos"]." minutos ";

            if($row["limite"] == true) $res[$row["id"]] .= " | <span class='limite-option'>Límite</span>: <span class='limite-dato'>".$limite."</span> ";
        }
        return $res;
    }
    public function getActividadArray(){
        $sql = "select * from ".$this->table["proceso"]." as p  where p.active=true and p.oficina_id=".$_SESSION["uservAdd"]["oficina_id"];
        $item = $this->dbm->Execute($sql)->GetRows();
        return $item;
    }
}