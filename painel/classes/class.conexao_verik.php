
<?
// include dirname(__FILE__)."/pdo/FluentPDO.php";	

$tns = "
(DESCRIPTION =
(ADDRESS_LIST =
(ADDRESS = (PROTOCOL = TCP)(HOST = 189.112.246.1)(PORT = 1521))
)
(CONNECT_DATA =
(SERVICE_NAME = SANTRIPDB1)
)
)
";
$db_username = "BANCOWEB";
$db_password = "D1T3C7";
    try{        
        $pdo2 = new PDO("oci:dbname=".$tns,$db_username,$db_password);
        $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $pdo2->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $pdo2->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $sqlGlv = new FluentPDO($pdo2);

    }catch(PDOException $e){
        echo ($e->getMessage());
    }
?>