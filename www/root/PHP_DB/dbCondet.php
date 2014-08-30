<?PHP

class ConDet
{
    public static $localhost = "localhost";
    public static $db = "holmesglen_project";
    public static $user = "root";
    public static $password = "";
    public static $dsn;

    // Rob's hosting
	//public static $db = "robfaie_econ_2";
	//public static $db = "holmesglen_project";
	//public static $user = "robfaie_econ";
	//public static $user = "root";
	//public static $password = "ohmcMJH&VI!T";
	//public static $password = "";

    public static function dsn()
    {
        return "mysql:host=" . self::$localhost . ";dbname=" . self::$db . ";";
    }
}
