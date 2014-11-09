<?PHP
/*                                                             
                                                                
 * File: validation.php
 * Contains validation functions for server side form validation.
 * Written by TEAM SPARTA  
 * Last updated: 26-10-14 by Rudhra.
 
*/

////////////////////////////////////////////////////////////////////////////////
// Globals
////////////////////////////////////////////////////////////////////////////////

// Our validation system uses an error code system to describe any 
// invalid fields encountered.  The code is stored in this global variable.

$vErrCode;

// Each code has a corresponding string description stored in this array.
// Not all validation functions will need a specific error code, as it will
// not be presented to a user.

$vDescriptions = array(
        0 => "Required Field is Empty.", // blank
        1 => "Please enter a valid email in the format user@host.com", //email
        2 => "Please enter a valid Date and Time", // date
        3 => "Please enter a valid URL address in the format www.domain.com(.net, .org, etc.)", // url
        4 => "Please enter a valid 10 digit mobile number.", // mobile
        5 => "Please enter a valid 8 or 11 digit landline number.", // phone
        6 => "Input is too long, please use fewer characters.", //
        7 => "Please use the correct amount of characters.", //
        8 => "Passwords do not match", //password
        9 => "Input must mix lower and upper case characters.", //password
        10 => "Input must contain a numerical character.", //password
        11 => "Field can only contain alphanumeric characters.", //string inputs
        12 => "Invalid file type. Must be JPEG, PNG, or GIF",
        13 => "File is too large. Must be under 5MB",
		//new code added for date validation/ Rudhra
		14 => "Start date and time must be earlier than end date and time",
		15 => "Input must be a numerical character."
);
buildErrorDescriptions();

$vDescVariables = array(
        0 => "",
        1 => "",
        2 => "",
);

////////////////////////////////////////////////////////////////////////////////
// Functions - Validation Checks.
////////////////////////////////////////////////////////////////////////////////

function buildErrorDescriptions()
{
    global $vDescriptions, $vDescVariables;
    $vDescriptions[20] = "Please enter at least $vDescVariables[0] characters.";
    $vDescriptions[21] = "Please enter no more than $vDescVariables[0] characters.";
    $vDescriptions[22] = "Please enter between $vDescVariables[0] and $vDescVariables[1] characters.";
    $vDescriptions[23] = "Please enter exactly $vDescVariables[0] characters.";
}


//// vIsBlank() - boolean
// Returns true if $input is null, "", or whitespace only.
// * Generates Error code.
function vIsBlank($input)
{
    global $vErrCode;
    if (empty($input) || (trim($input) == "")) {
        $vErrCode = 0;
        return true;

    }
    return false;
}

//// vIsAlphabetic() - boolean
// Returns true if input is only alphabetic characters and whitespace.
function vIsAlpha($input)
{
    global $vErrCode, $vDescVariables;
    // Check for blank string first.
    if (vIsBlank($input))
        return false;
    // Check to see if all characters in the string are [a-z, A-Z] only.
    // if (!ctype_alpha(trim($input))) {
	if (!preg_match ("/^[a-zA-Z\s]+$/",$input)) {
        $vErrCode = 11;
        return false;
    }
    return true;

}

function vIsAlphaNB($input)
{
    global $vErrCode, $vDescVariables;
    // Check to see if all characters in the string are [a-z, A-Z] only.
    if (!ctype_alpha(trim($input))) {
        $vErrCode = 11;
        return false;
    } else {
        return true;
    }

}

//// vIsNumeric() - boolean
// Returns true if input is only numeric characters and whitespace.
function vIsNumer($input)
{
    global $vErrCode;
    // Check for blank string first.
    if (vIsBlank($input))
        return false;
    // Check to see if all characters in the string are [0-9] only.
    if (ctype_digit(trim($input))) {
        return true;
    }
	$vErrCode = 15;
    return false;
}

//// vIsAlNum() - boolean
// Returns true if input is only numeric and alphabetic characters and 
// whitespace.
function vIsAlNum($input)
{
    global $vErrCode;
    // Check for blank string first.
    if (vIsBlank($input))
        return false;
    // Check to see if all characters in the string are [a-z, A-Z, 0-9].
    if (ctype_alnum(trim($input))) {
        return true;
    }
    return false;
}

//// vWordCount() - int
// Returns an integer of the number of words seperated by whitespace.
function vWordCount($input)
{
    return str_word_count($input);
}

//// vMinChars() - boolean
// Returns true if the input is AT LEAST $count characters long.
function vMinChars($input, $count)
{
    global $vErrCode, $vDescVariables;
    if (strlen($input) >= $count) {
        return true;
    }
    $vDescVariables[0] = $count;
    buildErrorDescriptions();
    $vErrCode = 20;
    return false;
}

//// vMaxChars() - boolean
// Returns true if the input is AT MAX INCLUSIVE $count characters long.
function vMaxChars($input, $count)
{
    global $vErrCode, $vDescVariables;
    if (strlen($input) < $count) {
        return true;
    }
    $vDescVariables[0] = $count;
    buildErrorDescriptions();
    $vErrCode = 21;
    return false;
}

//// vRangeChars() - boolean
// Returns true if the input string length is within the min and max 
// values INCLUSIVE.
function vRangeChars($input, $min, $max)
{
    global $vErrCode, $vDescVariables;
    if (vMinChars($input, $min) && vMaxChars($input, $max)) {
        return true;
    }
    $vDescVariables[0] = $min;
    $vDescVariables[1] = $max;
    buildErrorDescriptions();
    $vErrCode = 22;
    return false;
}

//// vSizeChars() - boolean
// Returns true if the input is exactly $count characters long.
function vSizeChars($input, $count)
{
    global $vErrCode, $vDescVariables;
    if (strlen($input) == $count) {
        return true;
    }
    $vDescVariables[0] = $count;
    buildErrorDescriptions();
    $vErrCode = 23;
    return false;
}

//// vIsEmail() - boolean
// Returns true if the input is a valid email.
// * Generates Error code.
function vIsEmail($input)
{
    global $vErrCode;
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    $vErrCode = 1;
    return false;
}

//// vIsDate() - boolean
// Returns true if the input is a valid date. 
// * Generates Error code.
function vIsDate2($input)
{
    global $vErrCode;
    // TODO: Tom.
    //^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-./])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$
    if (!preg_match("^(?ni:(?=\d)((?'year'((1[6-9])|([2-9]\d))\d\d)(?'sep'[/.-])(?'month'0?[1-9]|1[012])\2(?'day'((?<!(\2((0?[2469])|11)\2))31)|(?<!\2(0?2)\2)(29|30)|((?<=((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|(16|[2468][048]|[3579][26])00)\2\3\2)29)|((0?[1-9])|(1\d)|(2[0-8])))(?:(?=\x20\d)\x20|$))?((?<time>((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2}))?)$", $input)) {
        $vErrCode = 2;
        return false;
    }
    return true;
}

function vIsDate($input)
{
    global $vErrCode;

    // If month is in the format "Jan", Change month string from "Jan" to "01".
    if (!vIsNumer($input["month"])) {
        $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        $month = str_pad(array_search($input["month"], $months) + 1, 2, "0", STR_PAD_LEFT);
    } else
        $month = $input["month"];

    // Check characters.
    if (!vIsNumer($input["year"]) || !vSizeChars($input["year"], 4)
            || !vIsNumer($input["day"]) || !vSizeChars($input["day"], 2)
            || !vIsNumer($input["hour"]) || !vSizeChars($input["hour"], 2)
            || !vIsNumer($input["minute"]) || !vSizeChars($input["minute"], 2)
    ) {
        $vErrCode = 2;
        return false;
    }
    // Month limit check
    if ($month > 12 || $month < 0) {
        $vErrCode = 2;
        return false;
    }

    // Day limit check
    $monlim = array("nul" => 0,
            "Jan" => 31,
            "Feb" => 28,
            "Mar" => 31,
            "Apr" => 30,
            "May" => 31,
            "Jun" => 30,
            "Jul" => 31,
            "Aug" => 31,
            "Sep" => 30,
            "Oct" => 31,
            "Nov" => 30,
            "Dec" => 31);
    if ($input["year"] % 4 == 0)
        $monlim["Feb"] = 29;

    if ($input["day"] < 0 || ($input["day"] > $monlim[$input["month"]])) {
        $vErrCode = 2;
        return false;
    }

    //Time limit check
    if ($input["hour"] > 24 || $input["hour"] < 0) {
        $vErrCode = 2;
        return false;
    }

    if ($input["minute"] > 60 || $input["minute"] < 0) {
        $vErrCode = 2;
        return false;
    }
    return true;
}

//// vIsURL() - boolean
// Returns true if input is a valid URL.
// * Generates Error code.
function vIsURL($input)
{
    global $vErrCode;
	$pattern_1 = "/^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+.(com|org|net|dk|at|us|tv|info|uk|co.uk|biz|se)$)(:(\d+))?\/?/i";
      $pattern_2 = "/^(www)((\.[A-Z0-9][A-Z0-9_-]*)+.(com|org|net|dk|at|us|tv|info|uk|co.uk|biz|se)$)(:(\d+))?\/?/i";       
      if(preg_match($pattern_1, $input) || preg_match($pattern_2, $input))
    /*if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $input))*/
	{
        return true;
    }
	$vErrCode = 3;
    return false;
    
}

//// vIsMobile() - boolean
// Returns true if input is a valid 10 digit mobile number (dashes and 
// spaces OK)
// * Generates Error code.
function vIsMobile($input)
{
    // TODO: Shohei
    global $vErrCode;
    $search = array('-', ' ');
    //Mobile Number should start with "0".
    $boo = preg_match("/^0\d{9}$/", str_replace($search, "", $input));
    if ($boo == 0) {
        $vErrCode = 4;
        return false;
    }
    return true;
}

//// vIsPhone() - boolean
// Returns true if input is a valid 8 or 11 digit landline number 
// (dashes and spaces OK)
// * Generates Error code.
function vIsPhone($input)
{
    global $vErrCode;
    $clean = vRemWhiteSpecial($input);
    if (vIsNumer($clean)) {
        $len = strlen($clean);
        if ($len == 8 || $len == 11)
            return true;
    }
    $vErrCode = 5;
    return false;
}

//// vRegex() - boolean
// Returns true if input matches regex pattern
function vRegex($input, $pattern)
{
    global $vErrCode;
    if (preg_match($pattern, $input)) {
        return true;
    } else {
        $vErrCode = 1;
        return false;
    }
}

function vRegexString($input)
{
    global $vErrCode;
    $pattern = '/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/';
    if (preg_match($pattern, $input)) {
        $vErrCode = 11;
        return true;
    } else {
        return false;
    }
}

//returns true if string has mixed case
function vIsMixedCase($input)
{
    global $vErrCode;
    if (vHasLowerCase($input) && vHasUpperCase($input)) {
        return true;
    }
    $vErrCode = 9;
    return false;

}

//returns true if string is lower case
function vHasLowerCase($input)
{
    $len = strlen($input);
    for ($i = 0; $i < $len; $i++) {
        if (ctype_lower($input[$i])) {
            return true;
        }
    }
    return false;
}

//returns true if string is upper case
function vHasUpperCase($input)
{
    $len = strlen($input);
    for ($i = 0; $i < $len; $i++) {
        if (ctype_upper($input[$i])) {
            return true;
        }
    }
    return false;
}

//returns true if string has numeric digits case
function vHasNumeral($input)
{
    global $vErrCode;
    $len = strlen($input);
    for ($i = 0; $i < $len; $i++) {
        if (ctype_digit($input[$i])) {
            return true;
        }
    }
    $vErrCode = 10;
    return false;
}

//Password
function vPassWord($input)
{
    global $vErrCode;
    if (vRangeChars($input, 8, 16)) {
        return true;
    } else {
        //$vErrCode = 8;
        return false;
    }
}

//link for deleting: 
//http://stackoverflow.com/questions/18761516/php-delete-file
//Validate file upload
function fileUpload($page, $_files, $_post, $uploLoc)
{
    global $vErrCode;
    if ($page == "presenter") {
        $uploLoc = "UPLOADED_FILES/Presenter";
        //echo "presenter";
    }
    if ($page == "conference") {
        $uploLoc = "UPLOADED_FILES/Conference";
        //echo "conference";
    }

    if ($page == "sponsor") {
        $uploLoc = "UPLOADED_FILES/Sponsor";
        //echo "sponsor";
    }

    //$uploLoc = "UPLOADED_FILES/";

    /*//This function separates the extension from the rest of the file name and returns it
     function findexts ($filename)
     {
     $filename = strtolower($filename) ;
     $exts = split("[/\\.]", $filename) ;
     $n = count($exts)-1;
     $exts = $exts[$n];
     return $exts;
     }
     //This applies the function to our file
     $ext = findexts ($_FILES['file']['name']) ;
     //This line assigns a random number to a variable. You could also use a timestamp here if you prefer.
     $ran = rand () ;

     //This takes the random number (or timestamp) you generated and adds a . on the end, so it is ready of the file extension to be appended.
     $ran2 = $ran.".";
     //This combines the directory, the random file name, and the extension
     $target = $uploLoc . $ran2.$ext;
     */

    //if no file uploaded return false as validation is not required
    if (empty($_FILES["file"]["name"])) {
        return false;
    } else {
        //store details in temp file
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);

        //add restrictions on the type and size of uploaded file
        if (!((($_FILES["file"]["type"] == "image/gif")
                        || ($_FILES["file"]["type"] == "image/jpeg")
                        || ($_FILES["file"]["type"] == "image/jpg")
                        || ($_FILES["file"]["type"] == "image/png"))
                && in_array($extension, $allowedExts))
        ) {
            $vErrCode = 12;
            return true;
        } else if ($_FILES["file"]["size"] > 5000000) {
            $vErrCode = 13;
            return true;
        } else {
            return false;
        }
    }
}

////////////////////////////////////////////////////////////////////////////////
// Functions - String Manipulations
////////////////////////////////////////////////////////////////////////////////

//// vRemWhite() - String
// Removes whitespace from the input string.
function vRemWhite($input)
{
    return preg_replace('/\s+/', '', $input);
}

//// vRemSpecial() - String
// Removes special characters from the input string.
function vRemSpecial($input)
{
    return preg_replace('/[^A-Za-z0-9 ]/', '', $input);
}

//// vRemWhiteSpecial() - String
// Removes whitespace and special charaters from the input string.
function vRemWhiteSpecial($input)
{
    return vRemWhite(vRemSpecial($input));
}

//// vToLower() - String
// Makes a string lower case characters only.
function vToLower($input)
{
    return strtolower($input);
}

function vGetFirstWord($input)
{
    $allWords = explode(' ', trim($input));
    return $allWords[0];
}

////////////////////////////////////////////////////////////////////////////////
// Functions - Error Codes
////////////////////////////////////////////////////////////////////////////////

//// getInvDesc() - String
// Returns a string that describes the error via an error code arguement. 
function vGetInvDesc($code)
{
    global $vDescriptions;
    return $vDescriptions[$code];
}

//// getErr() - String.
// Returns a description of the last error encountered. 
function vGetErr()
{
    global $vErrCode;
    return vGetInvDesc($vErrCode);
}

//Validate valid end date - Rudhra
function vIsValidDate($StartDate,$EndDate)
{
	global $vErrCode;
	
list($strYear, $strMonth, $strDay) = explode('-', $StartDate);
list($endYear, $endMonth, $endDay) = explode('-', $EndDate);

list($strDays,$strTime)= explode(' ',$strDay);
list($endDays,$endTime)= explode(' ',$endDay);

list($strHour, $strMin, $strSec) = explode(':', $strTime);
list($endHour, $endMin, $endSec) = explode(':', $endTime);

 $startSeconds = mktime($strHour, $strMin, $strSec, $strMonth, $strDays, $strYear);
 $endSeconds   = mktime($endHour, $endMin, $endSec, $endMonth, $endDays, $endYear);

if ($startSeconds >= $endSeconds) {
   	$vErrCode = 14;
	return true;
	}
	return false;
}


// TODO: (Low priority) Function and assoc array to ensure correct ID 
// key formatting for correct database queries.


/// EOF