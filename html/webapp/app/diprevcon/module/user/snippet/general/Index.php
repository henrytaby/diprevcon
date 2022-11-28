<?PHP
namespace App\Diprevcon\User\General;
use Core\CoreResources;
class Index extends CoreResources
{
    var $objTable = "user";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();

    }

    function updateData($rec,$itemId,$action,$form="module"){
        $rec["username"]=strtolower(trim($rec["username"]));
        /**
         * Sacamos los datos del usuario para verificar si no existe.
         */
        $sql = "SELECT * FROM ". $this->table[$this->objTable]." AS u WHERE u.username ='".$rec["username"]."'";
        $it = $this->dbm->Execute($sql);
        $item = $it->fields;

        if($item["id"]=="" or $action=="update") {
            $itemData = $this->processData($form, $rec, $action);
            if (count($itemData)) {
                /**
                 * Save processed data
                 */
                $field_id = "id";
                $res = $this->updateItem($itemId, $itemData, $this->table[$this->objTable], $action, $field_id);
                $res["accion"] = $action;

                if($res["res"]==1){
                    $this->updateDataAditional($res["id"],$itemData);
                }

            } else {
                $res["res"] = 2;
                $res["msg"] = "No existe datos de registro";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "El nombre de usuario ya se encuentra registrado";
        }
        return $res;
    }

    function updateDataAditional($id,$itemData){
        $table = "persona";
        $sql = "SELECT * FROM ". $this->table[$table]." AS u WHERE u.id ='".$id."'";
        $it = $this->dbm->Execute($sql);
        $item = $it->fields;

        $action = ($item["id"]=="")?"new":"update";

        if($item["id"]==""){
            $itemData["id"] = $id;
            $itemData["created_at"] = $itemData["updated_at"];
            $itemData["user_create"] = $itemData["user_update"];
        }
        $itemData["entidad_id"]=$this->getEntidadFromOficina($itemData["oficina_id"]);

        if($itemData["type"]!=3 && $itemData["type"]!=4){
            $itemData["oficina_id"] = NULL;
            $itemData["superior_persona_id"] = NULL;
            $itemData["cargo"] = NULL;
            $itemData["jefe"] = "FALSE";
            $itemData["entidad_id"] = NULL;
            /**
             * Quita los permisos de mi ofi
             */
            $this->deletePermisos($id);
        }else{
            /**
             * Da los permisos correspondientes
             */
            $this->setPermisos($id);
        }
        $field_id = "id";
        $res = $this->updateItem($id, $itemData, $this->table[$table], $action, $field_id);
        $res["accion"] = $action;
    }

    function getEntidadFromOficina($id){
        $sql = "SELECT entidad_id,id FROM ". $this->table["oficina"]." AS o WHERE o.id ='".$id."'";
        $it = $this->dbm->Execute($sql);
        $item = $it->fields;
        return $item["entidad_id"];
    }

    public function deletePermisos($user_id){
        $app_id= 7;
        $sql = "delete from ".$this->table_core["user_module"]."  where user_id =".$user_id."
                and app_module_id in ( SELECT am.id FROM ".$this->table_core["app_module"]." as am where am.app_id = ".$app_id.")";
        $this->dbm->execute($sql);
    }
    public function setPermisos($user_id){
        $app_id= 7;
        $sql = "select * from  ".$this->table_core["app_module"]." as am where am.app_id=".$app_id;
        $item = $this->dbm->Execute($sql);
        $item = $item->getRows();
        foreach ($item as $row){
            $this->save($row["id"],$user_id);
        }
    }
    public function save($id,$user_id){
        $sql = "select * from ".$this->table_core["user_module"]." as um where um.user_id= ".$user_id." and um.app_module_id=".$id;
        $m = $this->dbm->Execute($sql);
        $m = $m->fields;
        if($m["id"]==""){
            $rec = array();
            $rec["created_at"] = $rec["updated_at"] =  date("Y-m-d H:i:s");
            $rec["user_create"] = $rec["user_update"] = $this->userId;
            $rec["add"] =$rec["edit"]=$rec["delete"]="TRUE";
            $rec["user_id"] = $user_id;
            $rec["app_module_id"] = $id;
            $this->dbm->AutoExecute($this->table_core["user_module"],$rec);
        }
    }


    function processData($form,$rec,$action="new"){
        $dataResult = array();
        switch($form){
            case 'module':
                $dataResult = $this->processFields($rec,$this->campos[$form],$action);

                /**
                 * Additional processes when saving the data
                 */
                if ($action=="new" or $rec["password"]!= ""){
                    //$dataResult["active"] = 1;
                    $dataResult["password"] = md5(trim($dataResult["password"]));
                }else{
                    unset($dataResult["password"]);
                    if($rec["type"] != "3"){
                        $dataResult["distribuidor_id"] = NULL;
                    }
                }

                break;
        }
        return $dataResult;
    }
}