<?PHP
namespace App\Miofi\Password\Index;
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
    function getItem($idItem){

        $info = '';

        if($idItem!=''){
            $sqlSelect = ' i.*
                           , concat(u1.name,\' \',u1.last_name) AS user_creater
                            , CONCAT(u2.name,\' \',u2.last_name) as user_updater';
            $sqlFrom = ' '.$this->table[$this->objTable].' i
                         LEFT JOIN '.$this->table_core["user"].' u1 on u1.id=i.user_create
                         LEFT JOIN '.$this->table_core["user"].' u2 on u2.id=i.user_update';
            $sqlWhere = ' i.id='.$idItem;
            $sqlGroup = ' ';

            $sql = 'SELECT '.$sqlSelect.'
                  FROM '.$sqlFrom.'
                  WHERE '.$sqlWhere.'
                  '.$sqlGroup;
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;


        }
        return $info;
    }
    function updateData($rec,$que_form){

        global $db;
        $accion = "update";
        $itemId = $this->userv["itemId"];
        $form="module";

        /**
         * preprocesamos los datos
         */
        $respuesta_procesa = $this->processData($form,$rec,$accion);

        /*
         * Procesamiento de verificacion
        */
        $verifica = true;

        if($rec["password2"] == $rec["password3"]){
            $item = $this->getItem($itemId);
            if($item["password"] == $rec["password1"]){
                $respuesta_procesa["password"] = $rec["password2"];
            }  else{
                $verifica = false;
                $res["msg"] = 'Error en la contraseña actual.';
            }
        }else{
            $verifica = false;
            $res["msg"] = 'Error: las contraseñas no son las mismas.';
        }
        /**
         * Guardo los datos ya procesados
         */
        $field_id = "id";
        $campo_id="itemId";
        /**
         * hacemos el cambio de la base de datos a utilizar en $this->dbm para usar la conexion $db
         */
        if($verifica){
            //$this->dbm = $db;
            //$res = $this->item_update_sbm($itemId,$respuesta_procesa,$this->tabla_core["usuario"],$accion,$campo_id);
            $res = $this->updateItem($itemId, $respuesta_procesa, $this->table[$this->objTable], $accion, $field_id);
            $res["accion"] = $accion;
        }else{
            $res["res"] = 2;

        }
        return $res;
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