<?PHP
namespace App\Contratacion\Module\Contratacion\Snippet\general;
use Core\CoreResources;

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog(){
        $this->addCatalogList($this->table["contratacion_tipo"]
            ,"tipo","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["contratacion_modalidad"]
            ,"modalidad","","sigla",""
            ,"sigla","","","");

        $this->addCatalogList($this->table["contratacion_estado"]
            ,"estado","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["proponente"]
            ,"proponente","","nombre",""
            ,"nombre","","","");
    }

}