<?PHP

class ConDet
{
    public static $localhost = "localhost";
    public static $db = "holmesglen_project";
    public static $user = "root";
//<<<<<<< HEAD
    // public static $password = "";
	public static $password = "root";
//=======
//	public static $password = "";
//>>>>>>> 183e1483354b6e7dc7d945ec4e19553291ac2884
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
?>