<?PHP
namespace App\Latinosan\Module\Programa\Snippet\migra;
use Core\CoreResources;
/**
 * ayuda reset secuencias
 * ALTER SEQUENCE programa_id_seq RESTART;
 * select c.relname FROM pg_class c WHERE c.relkind = 'S' order by c.relname ;
 */
class Index extends CoreResources
{
    var $objTable = "programa";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();

    }

    public function migra(){

        /**
         * Cargamos actividades
         */
        /*
        $this->actividadesGetJson();
        echo "Termino de migrar actividades<br>";
        */
        /**
         * Carga participantes
         */
        $this->participanteGetJson();
        echo "Termino de migrar Participantes<br>";
        /**
         * Carga participantes
         */

        echo "-->Se ha migrado todos los datos<br>";
        /**
         * se actualizaron los datos
         */
        exit;
    }
    /**
     * Importación de datos de participantes
     */

    public function participanteGetJson(){
        //echo "<pre>";
        $itemJsonResponse =$this->restCall("GET","https://even2.app/latinosan/data/registros.php");
        //echo $itemJsonResponse;
        $itemJsonResponse = str_replace("Profesion\/ocupacion","profesion_ocupacion",$itemJsonResponse);
        $itemJsonResponse = str_replace("Institucion\/Organizacion","institucion_organizacion",$itemJsonResponse);
        $itemJsonResponse = str_replace("Años_Experiencia","anos_experiencia",$itemJsonResponse);
        //echo $itemJsonResponse;
        $itemObject = json_decode($itemJsonResponse);
        //echo $itemObject;
        foreach ($itemObject as $row){

            $rec  = array();
            //$rec["id"] = $row->IdActividad;
            $rec["nombres"] = $row->Nombres;
            $rec["apellidos"] = $row->Apellidos;
            $rec["correo"] = $row->Correo;
            $rec["tipo_participante"] = $row->Tipo_de_Participante;
            $rec["tipo_inscripcion"] = $row->Tipo_de_inscripcion;
            $rec["edad"] = $row->Edad;
            $rec["genero"] = $row->Genero;
            $rec["documento_tipo"] = $row->Tipo_Documento;
            $rec["documento_numero"] = $row->Numero_Documento;
            $rec["ocupacion"] = $row->profesion_ocupacion;
            $rec["especialidad"] = $row->Especialidad;
            $rec["institucion"] = $row->institucion_organizacion;
            $rec["cargo"] = $row->Cargo;
            $rec["anios_experiencia"] = $row->anos_experiencia;
            $rec["pais"] = $row->Pais;
            $rec["nacionalidad"] = $row->Nacionalidad;
            $rec["ciudad"] = $row->Ciudad;
            $rec["telefono_codigo"] = $row->Codigo_Telefono;
            $rec["telefono"] = $row->Movil;
            $rec["alimentacion_tipo"] = $row->Tipo_Alimentacion;
            $rec["idioma_materno"] = $row->Idioma_Materno;
            $rec["idioma_segundo"] = $row->Segundo_Idioma;
            $rec["ingreso"] = $row->Ingreso;
            $rec["idregistro"] = $row->IdRegistro;
            $rec["created_at"] = $rec["updated_at"] = date("Y-m-d H:i:s");;
            $item = $this->participanteGet($row->IdRegistro);
            $rec["actividades"] = count($row->Actividades);
            /*
            echo "total:".count($row->Actividades);
            echo "<pre>";
            print_r($rec);
            print_r($row->Actividades);
            echo "</pre>";
            exit;
            */

            if($item["id"]!=""){ //update
                //echo "Update -----<br>";
                unset($rec["created_at"]);
                $where = "id=".$item["id"];
                $this->dbm->autoExecute("migra.participante",$rec,"UPDATE",$where);
            }else{//insert
                //echo "insert -----<br>";
                $this->dbm->autoExecute("migra.participante",$rec);
            }

        }
        //echo "</pre>";
    }
    public function participanteGet($id){
        if($id!=""){
            $sql = "select * from migra.participante p where p.idregistro ='".$id."'";
            $item = $this->dbm->execute($sql);
            $item = $item->fields;
        }else{
            $item = array();
        }
        return $item;
    }

    /**
     * Importación de datos de Actividad
     */
    public function actividadesGetJson(){
        $itemJsonResponse =$this->restCall("GET","https://even2.app/latinosan/data/actividades.php");
        $itemObject = json_decode($itemJsonResponse);

        //echo "<pre>";
        foreach ($itemObject as $row){
            $rec  = array();
            $rec["id"] = $row->IdActividad;
            $rec["nombre"] = $row->Nombre_Actividad;
            $rec["total_inscritos"] = $row->Total_Incripciones;
            $rec["fecha"] = $row->Fecha;
            $rec["hora_inicio"] = $row->Hora_inicio;
            $rec["hora_fin"] = $row->Hora_fin;
            $rec["salon"] = $row->Salon;
            $rec["descripcion"] = $row->Descripcion;
            $rec["url_conf"] = $row->meet_url;
            $item = $this->actividadesGet($row->IdActividad);
            if($item["id"]!=""){ //update
                $where = "id=".$row->IdActividad;
                $this->dbm->autoExecute("migra.actividad",$rec,"UPDATE",$where);
            }else{//insert
                $this->dbm->autoExecute("migra.actividad",$rec);
            }
        }
        //echo "</pre>";
    }
    public function actividadesGet($id){
        if($id!=""){
            $sql = "select * from migra.actividad a where id =".$id;
            $item = $this->dbm->execute($sql);
            $item = $item->fields;
        }else{
            $item = array();
        }
        return $item;
    }

    function restCall($method, $url, $data = false, $contentType= false, $token = false)
    {
        $curl = curl_init();

        if($token){ //Add Bearer Token header in the request
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: '.$token
            ));
        }

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data){
                    if($contentType){
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                            'Content-Type: '.$contentType
                        ));
                    }
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }



    public function organismoFinanciadorSave(){
        $ofinanciador = $this->getOrganismoFinanciador();

        /**
         * Verificamos si no existe el programa
         */
        //$this->dbm->debug = true;
        $table = "programa_convenio";
        foreach ($ofinanciador as $row){
            if($row["programa_id"]!=""){
                //print_struc($row);
                //$this->dbm->debug= true;
                $programaConv = $this->getProgramaConvenio($row["ORGANISMO_FINANCIADOR_SIGLA_FUENTE_PRINCIPAL"],$row["programa_id"]);

                if(isset($rec)) unset($rec);
                $rec = array();
                $rec["nombre"] = trim($row["ORGANISMO_FINANCIADOR_SIGLA_FUENTE_PRINCIPAL"]);
                $rec["codigo"] = trim($row["ORGANISMO_FINANCIADOR_SIGLA_FUENTE_PRINCIPAL"]);
                $rec["estado_id"] = 1;
                $rec["programa_id"] = $row["programa_id"];
                $rec["descripcion"] = $row["descripcion"];

                //
                //print_struc($programaConv);
                //exit;


                if(isset($programaConv["id"]) && $programaConv["id"]>0){
                    $rec["updated_at"] = date("Y-m-d H:i:s");
                    $rec["user_update"] = $this->userId;
                    unset($rec["codigo"]);
                    $where ="id=".$programaConv["id"];
                    $this->dbm->AutoExecute($table,$rec,"UPDATE",$where);
                }else{
                    $rec["created_at"] = $rec["updated_at"] = date("Y-m-d H:i:s");
                    $rec["user_create"] = $rec["user_update"] = $this->userId;
                    $this->dbm->AutoExecute($table,$rec);
                }
                //print_struc($rec);
            }
        }

    }

    public function cleanText($str){
        $str = trim(preg_replace('/\s+/', ' ', $str));
        return $str;
    }


}
