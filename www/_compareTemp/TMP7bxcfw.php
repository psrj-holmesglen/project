<?PHP

class ConDet
{
    /**
        PLEASE DONT CHANGE THIS VALUES, THEY SHOULD BE COMMENTED, NOT CHANGED.
    */
    public static $localhost = "localhost";
    public static $db = "eConference";
    public static $user = "eConference_user";
	public static $password = "UewSLJMV3r%m";
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