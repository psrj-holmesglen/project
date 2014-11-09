<?PHP

function dtConvertToArray($str)
{
    $dtString = explode(" ", $str);
    $dString = explode("-", $dtString[0]);
    $tString = explode(":", $dtString[1]);

    return array("year" => $dString[0],
            "month" => $dString[1],
            "day" => $dString[2],
            "hour" => $tString[0],
            "minute" => $tString[1],
            "second" => $tString[2]);
    return $out;
}

function dtMonthToNumber($str)
{
    $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
    return str_pad(array_search($str, $months) + 1, 2, "0", STR_PAD_LEFT);
}

function dtConvertToString($d)
{
    return "" . $d["year"]
    . "-" . dtMonthToNumber($d["month"])
    . "-" . $d["day"]
    . " " . $d["hour"]
    . ":" . $d["minute"]
    . ":" . $d["second"];
}

function printOptionYears($selected)
{
    for ($i = 2014; $i <= 2030; $i++) {
        if ($selected == $i)
            echo "<option selected>$i</option>";
        else
            echo "<option>$i</option>";
    }
}

function printOptionDays($selected)
{
    for ($i = 1; $i <= 31; $i++) {
        $day = str_pad($i, 2, "0", STR_PAD_LEFT);
        if ($selected == $i)
            echo "<option selected>$day</option>";
        else
            echo "<option>$day</option>";
    }
}

function printOptionMonths($selected)
{
    $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
    for ($i = 0; $i < 12; $i++) {
        if ($selected == $i + 1 || $selected == $months[$i])
            echo "<option selected>$months[$i]</option>";
        else
            echo "<option>$months[$i]</option>";
    }
}

function printOptionHours($selected)
{
    for ($i = 0; $i < 24; $i++) {
        $hours = str_pad($i, 2, "0", STR_PAD_LEFT);
        if ($selected == $i)
            echo "<option selected>$hours</option>";
        else
            echo "<option>$hours</option>";
    }
}

function printOptionMinutes($selected)
{
    $selected = intval(round($selected / 5) * 5);
    for ($i = 0; $i < 60; $i += 5) {
        $mins = str_pad($i, 2, "0", STR_PAD_LEFT);
        if ($selected == $i)
            echo "<option selected>$mins</option>";
        else
            echo "<option>$mins</option>";
    }
}
//Function to show current returned time in the document
//Function added by Rudhra
function get_Datetime_Now()
{
		$tz_object = new DateTimeZone('Australia/Melbourne');
		
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);
		return $datetime->format('Y\-m\-d\ h:i:s A'); 
}