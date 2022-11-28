<?PHP
/**
 * Include
 * special application programming
 * Example include: include_once($appPath . "classes/ModuloCore.php");
 * $modulo_core = new ModuloCore();
 */
use Core\Core;
use App\Diprevcon\UserType;

$action_path = APP_PATH."inc/action.path.php";
include_once($action_path);

/**
 * Añadimos un esquemas mas a la base de datos principal
 */
$db_table = array();
$dbSchemaName = "personal";
$db_table[] = Core::getTableConfig("persona");
$tableCore  = Core::getDbTablesFromArray($db_table,$dbSchemaName,$tableCore);
unset($db_table);
unset($db_prefix);
/*/
print_struc($tableCore);
exit;
/**/
/**
 * Funcionalidad para añadir datos extras a userv
 */


if($_SESSION["userv"]["type"]==3){
    $action_path = APP_PATH."./../diprevcon/inc/UserType.php";
    include_once($action_path);
    $userType = new UserType;
    $userType->setUserInfoAditional();
}
//print_struc($_SESSION["uservAdd"]);exit;
