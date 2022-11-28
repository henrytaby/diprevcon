<?php
namespace App\Diprevcon;
use Core\CoreResources;
class UserType extends CoreResources {
    var $objTable = "instalador";
    function __construct()
    {
        global $db;
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
        $this->dbm = $db;
    }

    public function setUserInfoAditional(){
        global $smarty;
        $sql = "select * from  ".$this->table_core["persona"]." as am where am.id=".$this->userId;
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        $_SESSION["uservAdd"] = $item;
        $smarty->assign("uservAdd", $item);
        /*
        $_SESSION["userv"]["oficina_id"]=$item["oficina_id"];
        $_SESSION["userv"]["entidad_id"]=$item["entidad_id"];
        $_SESSION["userv"]["ingreso_hoja"]=$item["ingreso_hoja"];
        $_SESSION["userv"]["jefe"]=$item["jefe"];
        $_SESSION["userv"]["cargo"]=$item["cargo"];
        $_SESSION["userv"]["superior_persona_id"]=$item["superior_persona_id"];
        */
    }

    public function setPermisos(){
        $sql = "select * from  ".$this->table_core["app_module"]." as am where am.app_id=7 ";
        $item = $this->dbm->Execute($sql);
        $item = $item->getRows();
        foreach ($item as $row){
            $this->save($row["id"]);
        }
    }
    public function save($id){
        $sql = "select * from ".$this->table_core["user_module"]." as um where um.user_id= ".$this->userId." and um.app_module_id=".$id;
        $m = $this->dbm->Execute($sql);
        $m = $m->fields;
        if($m["id"]==""){
            $rec = array();
            $rec["created_at"] = $rec["updated_at"] =  date("Y-m-d H:i:s");
            $rec["user_create"] = $rec["user_update"] = $this->userId;
            $rec["add"] =$rec["edit"]=$rec["delete"]="TRUE";
            $rec["user_id"] = $this->userId;
            $rec["app_module_id"] = $id;
            $this->dbm->AutoExecute($this->table_core["user_module"],$rec);
        }
    }
}