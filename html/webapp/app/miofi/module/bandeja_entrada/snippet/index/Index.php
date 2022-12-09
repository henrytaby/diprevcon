<?PHP
namespace App\Miofi\BandejaEntrada\Index;
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
        $extraWhere = "i.estado_id=1 and i.derivado_a_user_id=".$this->userId;
        $groupBy = "";
        $having = "";
        /**
         * Result of the query sent
         */
        $result = $this->getGridDatatableSimple($db,$grid,$table, $primaryKey, $extraWhere);

        foreach ($result['data'] as $itemId => $valor) {

            if(isset($result['data'][$itemId]['created_at'])) $result['data'][$itemId]['created_at'] = $this->changeDataFormat($result['data'][$itemId]['created_at'],"d/m/Y H:i:s");
            if(isset($result['data'][$itemId]['updated_at'])) $result['data'][$itemId]['updated_at'] = $this->changeDataFormat($result['data'][$itemId]['updated_at'],"d/m/Y H:i:s");

            if(isset($result['data'][$itemId]['fecha_emision'])) {
                $tiempo = $this->getTimeElapsed($result['data'][$itemId]['fecha_emision']);
                $column = "recepcion_dias";if(isset($result['data'][$itemId][$column])) $result['data'][$itemId][$column] = $tiempo["days"];
                $column = "recepcion_horas"; if(isset($result['data'][$itemId][$column])) $result['data'][$itemId][$column] = $tiempo["hours"];
                $column = "recepcion_minutos"; if(isset($result['data'][$itemId][$column])) $result['data'][$itemId][$column] = $tiempo["minutes"];
                $column = "recepcion_minutos_total"; if(isset($result['data'][$itemId][$column])) $result['data'][$itemId][$column] = $tiempo["total_minutes"];

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
    function recepcionar($id){
        $item = $this->getItem($id);

        if($item["estado_id"]==1){
            $rec = array();
            $rec["fecha_recepcion"]= date("Y-m-d H:i:s");
            $rec["estado_id"]= 2;

            $tiempo = $this->getTimeElapsed($item['fecha_emision']);
            $rec["recepcion_dias"] = $tiempo["days"];
            $rec["recepcion_horas"] = $tiempo["hours"];
            $rec["recepcion_minutos"] = $tiempo["minutes"];
            $rec["recepcion_minutos_total"] = $tiempo["total_minutes"];

            if($item["proceso_limite"]){
                $rec["proceso_fecha_fin"] = $this->addMinutesToDate($rec["fecha_recepcion"],$item["proceso_minutos_total"]);
            }
            $where = "id=".$id;
            $resupdate = $this->dbm->AutoExecute($this->table[$this->objTable],$rec,"UPDATE",$where);
            $res["res"] = 1;
            $res["msg"] = "Se realizado la recepción";
        }else{
            $res = array();
            $res["res"] = 2;
            $res["msg"] = "No se puede recepcionar el documento por que se encuentra en otro estado";
        }
        return $res;
    }

}