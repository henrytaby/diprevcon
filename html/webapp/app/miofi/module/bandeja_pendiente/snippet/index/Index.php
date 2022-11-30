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
                $result['data'][$itemId]['accion_dias'] = $this->getDiasTranscurridos($result['data'][$itemId]['fecha_recepcion'],true);
            }

            if(isset($result['data'][$itemId]['total_seguimiento']))   $result['data'][$itemId]['total_seguimiento'] = $this->getSeguimientoTotal($result['data'][$itemId]['hojaruta_id']);

            if(isset($result['data'][$itemId]['fecha_emision'])) $result['data'][$itemId]['fecha_emision'] = $this->changeDataFormat($result['data'][$itemId]['fecha_emision'],"d/m/Y");
            if(isset($result['data'][$itemId]['fecha_recepcion'])) $result['data'][$itemId]['fecha_recepcion'] = $this->changeDataFormat($result['data'][$itemId]['fecha_recepcion'],"d/m/Y");

            if(isset($result['data'][$itemId]['nur'])) $result['data'][$itemId]['nur'] = htmlspecialchars($result['data'][$itemId]['nur'],ENT_QUOTES );

        }
        return $result;
    }

    public function getSeguimientoTotal($id){

        $sql = "select count(*) as total from ".$this->table["hojaruta_seguimiento"]." as hrs where hrs.hojaruta_id =".$id;
        $item = $this->dbm->Execute($sql)->fields;
        return $item["total"];
    }

    public function getDiasTranscurridos($fecha,$modificar = false){
        $fechaActual = date("Y-m-d");
        //$hoy = date("Y-m-d H:i:s");
        if($modificar){
            $fechaEnvio = explode(" ",$fecha);
            $fecha = $fechaEnvio[0];
        }

        $datetime1 = date_create($fecha);
        $datetime2 = date_create($fechaActual);
        $contador = date_diff($datetime1, $datetime2);
        $differenceFormat = '%a';
        //echo $contador->format($differenceFormat);
        return $contador->format($differenceFormat);
    }

    public function sumarDiasFecha($fecha,$dias){
        $mod_date = strtotime($fecha."+ ".$dias." days");
        return date("Y-m-d",$mod_date);
    }
    /**
     * Index::deleteData($id)
     *
     * Delete a record from the database
     *
     * @param $id
     * @return mixed
     */
    function estado($id){
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

}