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
        }
        $field_id = "id";
        $res = $this->updateItem($id, $itemData, $this->table[$table], $action, $field_id);
        $res["accion"] = $action;
    }

    function getEntidadFromOficina($id){
        $table = "persona";
        $sql = "SELECT entidad_id,id FROM ". $this->table["oficina"]." AS o WHERE o.id ='".$id."'";
        $it = $this->dbm->Execute($sql);
        $item = $it->fields;
        return $item["entidad_id"];
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