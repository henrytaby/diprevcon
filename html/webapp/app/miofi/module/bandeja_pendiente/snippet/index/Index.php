<?PHP
namespace App\Miofi\BandejaPendiente\Index;

use Core\CoreResources;
class Index extends CoreResources {
    var $objTable = "hojaruta_seguimiento";
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


    public function getItemDatatableRows(){
        global $dbSetting;
        $table = $this->table[$this->objTable];
        $primaryKey = 'id';
        $grid = "item";
        $db=$dbSetting[0];
        /**
         * Additional configuration
         */
        $extraWhere = "i.estado_id=2 and i.derivado_a_user_id=".$this->userId;
        $groupBy = "";
        $having = "";
        /**
         * Result of the query sent
         */
        $result = $this->getGridDatatableSimple($db,$grid,$table, $primaryKey, $extraWhere);

        foreach ($result['data'] as $itemId => $valor) {

            if(isset($result['data'][$itemId]['created_at'])) $result['data'][$itemId]['created_at'] = $this->changeDataFormat($result['data'][$itemId]['created_at'],"d/m/Y H:i:s");
            if(isset($result['data'][$itemId]['updated_at'])) $result['data'][$itemId]['updated_at'] = $this->changeDataFormat($result['data'][$itemId]['updated_at'],"d/m/Y H:i:s");

            if(isset($result['data'][$itemId]['fecha_recepcion'])) {
                //$result['data'][$itemId]['recepcion_dias'] = $this->getDiasTranscurridos($result['data'][$itemId]['fecha_emision'],true);

                $tiempo = $this->getTimeElapsed($result['data'][$itemId]['fecha_recepcion']);
                $column = "accion_dias";if(isset($result['data'][$itemId][$column])) $result['data'][$itemId][$column] = $tiempo["days"];
                $column = "accion_horas"; if(isset($result['data'][$itemId][$column])) $result['data'][$itemId][$column] = $tiempo["hours"];
                $column = "accion_minutos"; if(isset($result['data'][$itemId][$column])) $result['data'][$itemId][$column] = $tiempo["minutes"];
                $column = "accion_minutos_total"; if(isset($result['data'][$itemId][$column])) $result['data'][$itemId][$column] = $tiempo["total_minutes"];

            }

            if(isset($result['data'][$itemId]['total_seguimiento']))   $result['data'][$itemId]['total_seguimiento'] = $this->getSeguimientoTotal($result['data'][$itemId]['hojaruta_id']);


            $column = "fecha_emision";
            if(isset($result['data'][$itemId][$column])) $result['data'][$itemId][$column] = $this->changeDataFormat($result['data'][$itemId][$column],"d/m/Y H:i");
            $column = "fecha_recepcion";
            if(isset($result['data'][$itemId][$column])) $result['data'][$itemId][$column] = $this->changeDataFormat($result['data'][$itemId][$column],"d/m/Y H:i");

            $column = "fecha";
            if(isset($result['data'][$itemId][$column])) $result['data'][$itemId][$column] = $this->changeDataFormat($result['data'][$itemId][$column],"d/m/Y");
            $column = "hora";
            if(isset($result['data'][$itemId][$column])) $result['data'][$itemId][$column] = $this->changeDataFormat($result['data'][$itemId][$column],"H:i");

            if(isset($result['data'][$itemId]['nur'])) $result['data'][$itemId]['nur'] = htmlspecialchars($result['data'][$itemId]['nur'],ENT_QUOTES );

            $column = "accion_fecha";
            if(isset($result['data'][$itemId][$column])) $result['data'][$itemId][$column] = $this->changeDataFormat($result['data'][$itemId][$column],"d/m/Y H:i");
        }
        return $result;
    }

    public function getSeguimientoTotal($id){

        $sql = "select count(*) as total from ".$this->table["hojaruta_seguimiento"]." as hrs where hrs.hojaruta_id =".$id;
        $item = $this->dbm->Execute($sql)->fields;
        return $item["total"];
    }


    /**
     * Index::deleteData($id)
     *
     * Delete a record from the database
     *
     * @param $id
     * @return mixed
     */
    function estado($id,$estado_id=4){
        $item = $this->getItem($id);

        if($item["estado_id"]==2){
            $rec = array();
            $rec["accion_fecha"]= date("Y-m-d H:i:s");
            $rec["estado_id"]= $estado_id;

            $tiempo = $this->getTimeElapsed($item['fecha_recepcion'],$rec["accion_fecha"]);
            $rec["accion_dias"] = $tiempo["days"];
            $rec["accion_horas"] = $tiempo["hours"];
            $rec["accion_minutos"] = $tiempo["minutes"];
            $rec["accion_minutos_total"] = $tiempo["total_minutes"];

            $where = "id=".$id;
            $resupdate = $this->dbm->AutoExecute($this->table[$this->objTable],$rec,"UPDATE",$where);

            $res["res"] = 1;
            $res["msg"] = "Se ha realizado el archivo del documento";
        }else{
            $res = array();
            $res["res"] = 2;
            $res["msg"] = "No se puede archivar el documento por que se encuentra en otro estado";
        }
        return $res;
    }

    function estadoDerivado($id){
        $item = $this->getItem($id);

        if($item["estado_id"]==2){
            $rec = array();
            $rec["accion_fecha"]= date("Y-m-d H:i:s");
            $rec["estado_id"]= 4;
            $rec["accion_dias"] = $this->getDiasTranscurridos($item["fecha_recepcion"],true);
            $where = "id=".$id;
            $resupdate = $this->dbm->AutoExecute($this->table[$this->objTable],$rec,"UPDATE",$where);

            $res["res"] = 1;
            $res["msg"] = "Se ha realizado el archivo del documento";
        }else{
            $res = array();
            $res["res"] = 2;
            $res["msg"] = "No se puede archivar el documento por que se encuentra en otro estado";
        }
        return $res;
    }

    function updateData($rec,$itemId,$action){
        $derivacion = $this->getDerivacion($itemId);
        if($derivacion["total"]==0){
            $seguimiento = $this->getItem($itemId);
            if($seguimiento["estado_id"]==2){

                $table = "hojaruta_seguimiento";
                $form="module";
                $itemData  = $this->processData($form,$rec,$action,$itemId,$seguimiento);
                /**
                 * Save processed data
                 */
                $field_id="id";
                $res = $this->updateItem($itemId,$itemData ,$this->table[$table],$action,$field_id);
                $res["accion"] = $action;
                /**
                 * Cambiamos el estado del seguimiento
                 */
                if($res["res"]==1){
                    $this->estado($itemId,3);
                }

            }else{
                $res["res"] = 2;
                $res["type"] = 10;
                $res["msg"] = "Este seguimiento ya fue derivado o archivado";
            }
        }else{
            $res["res"] = 2;
            $res["type"] = 10;
            $res["msg"] = "Esta hoja de ruta ya fue derivado";
        }
        return $res;
    }
    public function getDerivacion($id){
        $sql = "select count(*) as total from ".$this->table["hojaruta_seguimiento"]." as hs where hs.hojaruta_seguimiento_id =".$id;
        $item = $this->dbm->Execute($sql)->fields;
        return $item;
    }

    function processData($form,$rec,$action="new",$itemId,$seguimiento){
        $dataResult = array();
        switch($form){
            case 'module':
                $dataResult = $this->processFields($rec,$this->campos[$form],$action);

                /**
                 * Additional processes when saving the data
                 */
                if ($action=="new"){
                    //$dataResult["active"] = 1;
                }
                $dataResult["derivado_por_user_id"] = $_SESSION["uservAdd"]["id"];
                $dataResult["emisor_nombre"] = $_SESSION["userv"]["name"]." ".$_SESSION["userv"]["last_name"];
                $dataResult["emisor_cargo"] = $_SESSION["uservAdd"]["cargo"];
                $dataResult["emisor_oficina"] = $_SESSION["uservAdd"]["oficina"];
                $dataResult["emisor_oficina_id"] = $_SESSION["uservAdd"]["oficina_id"];
                $dataResult["fecha_emision"] = date("Y-m-d H:i:s");
                /**
                 * Sacamos los datos de la persona
                 */
                $persona = $this->getPersona($dataResult["derivado_a_user_id"]);
                $dataResult["receptor_nombre"] = $persona["name"]." ".$persona["last_name"];
                $dataResult["receptor_cargo"] = $persona["cargo"];
                $dataResult["receptor_oficina"] = $persona["oficina"];
                $dataResult["receptor_oficina_id"] = $persona["oficina_id"];

                $dataResult["entidad_id"] = $persona["entidad_id"];
                $dataResult["estado_id"] = 1;

                //$proceso = $this->getProceso($dataResult["proceso_id"]);
                //$dataResult["proceso_dias"] = $proceso["dias"];
                //$dataResult["proceso_limite"] =  $proceso["limite"]?"TRUE":"FALSE";
                //$hojaruta = $this->getItem($itemId);
                $dataResult["nur"] =  $seguimiento["nur"];
                $dataResult["hojaruta_id"] = $seguimiento["hojaruta_id"];
                $dataResult["hojaruta_seguimiento_id"] = $itemId;
                break;
        }
        return $dataResult;
    }

    public function getProceso($id){
        $sql = "select * from public.proceso as p where p.id = ".$id;
        $item = $this->dbm->Execute($sql)->fields;
        return $item;
    }

    public function getPersona($id){

        $sql = "select u.id
            , o.nombre as oficina
            ,u.name, u.last_name
            , p.cargo, p.jefe, p.oficina_id, p.entidad_id
            from core.user as u 
            left join personal.persona as p on p.id = u.id 
            left join public.oficina as o on o.id = p.oficina_id
            where u.active = true
            and p.entidad_id=".$_SESSION["uservAdd"]["entidad_id"]." and u.id=".$id;
        $item = $this->dbm->Execute($sql)->fields;
        return $item;
    }

}