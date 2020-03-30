<?PHP
//engine for load evrything needed here..
//define ecrything needed here
define('_VERSION', "1");
define('PRODUCT_NAME', "Ujian Labor");
define('_EXECUTION',microtime(TRUE));
define("APP_PATH", ROOT);

define("FILE_PUT_CONTENTS_ATOMIC_TEMP", dirname(__FILE__)."/cache");
define("FILE_PUT_CONTENTS_ATOMIC_MODE", 0775);
//CLASSES
require_once(ROOT."/core/db.class.php");
$db=new Database(_DB_HOST, _DB_USER, _DB_PASS, _DB_NAME);
require_once(ROOT."/core/app.class.php");
$app=new App();
//auto load library needed here
?>