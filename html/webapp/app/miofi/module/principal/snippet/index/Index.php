<?PHP

namespace App\Diprevcon\Module\Hoja_ruta\Snippet\Index;

use Core\CoreResources;

class Index extends CoreResources
{
    var $objTable = "mensaje";

    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }

    function getItem($idItem)
    {

        $info = '';

        if ($idItem != '') {
            $sqlSelect = ' i.*
                           , concat(u1.name,\' \',u1.last_name) AS user_creater
                            , CONCAT(u2.name,\' \',u2.last_name) as user_updater';
            $sqlFrom = ' ' . $this->table[$this->objTable] . ' i
                         LEFT JOIN ' . $this->table_core["user"] . ' u1 on u1.id=i.user_create
                         LEFT JOIN ' . $this->table_core["user"] . ' u2 on u2.id=i.user_update';
            $sqlWhere = ' i.id=' . $idItem;
            $sqlGroup = ' ';

            $sql = 'SELECT ' . $sqlSelect . '
                  FROM ' . $sqlFrom . '
                  WHERE ' . $sqlWhere . '
                  ' . $sqlGroup;
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;


        }
        return $info;
    }


    public function getItemDatatableRows()
    {
        global $dbSetting;
        $table = $this->table[$this->objTable];
        $primaryKey = 'id';
        $grid = "item";
        $db = $dbSetting[0];
        /**
         * Additional configuration
         */
        $extraWhere = "";
        $groupBy = "";
        $having = "";
        /**
         * Result of the query sent
         */
        $result = $this->getGridDatatableSimple($db, $grid, $table, $primaryKey, $extraWhere);
        foreach ($result['data'] as $itemId => $valor) {
            if (isset($result['data'][$itemId]['fecha_inicio'])) $result['data'][$itemId]['fecha_inicio'] = $this->changeDataFormat($result['data'][$itemId]['fecha_inicio'], "d/m/Y");
            if (isset($result['data'][$itemId]['fecha_conclusion'])) $result['data'][$itemId]['fecha_conclusion'] = $this->changeDataFormat($result['data'][$itemId]['fecha_conclusion'], "d/m/Y");


            $result['data'][$itemId]['created_at'] = $this->changeDataFormat($result['data'][$itemId]['created_at'], "d/m/Y H:i:s");
            $result['data'][$itemId]['updated_at'] = $this->changeDataFormat($result['data'][$itemId]['updated_at'], "d/m/Y H:i:s");

        }
        return $result;
    }

    /**
     * Index::deleteData($id)
     *
     * Delete a record from the database
     *
     * @param $id
     * @return mixed
     */
    function deleteData($id)
    {
        $field_id = "id";
        $res = $this->deleteItem($id, $field_id, $this->table[$this->objTable]);
        return $res;
    }

    function getActiveItems()
    {

        global $db;
        $data = [];
//        $fechaActual = date('Y-m-d');
//        $fechaFin = date("Y-m-d", strtotime($fechaActual . "+ 30 days"));
        $sql = "SELECT m.id, m.fecha_inicio, m.fecha_fin, m.titulo, m.active,m.mensaje
FROM public.mensaje AS m
WHERE m.active=true
ORDER BY m.id
                ";
        $item = $db->Execute($sql);
        while (!$item->EOF) {
            $id = $item->fields["id"];
            $fecha_inicio = $item->fields["fecha_inicio"];
            $fecha_fin = $item->fields["fecha_fin"];
            $titulo = $item->fields["titulo"];
            $active = $item->fields["active"];
            $mensaje = $item->fields["mensaje"];
            $data[] = array(
                "id" => $id,
                "fecha_inicio" => $fecha_inicio,
                "fecha_fin" => $fecha_fin,
                "titulo" => $titulo,
                "active" => $active,
                "mensaje" => $mensaje,
//                "dias_restantes" => $days . " dias"
            );
            $item->MoveNext();
        }

        return $data;

    }

}
