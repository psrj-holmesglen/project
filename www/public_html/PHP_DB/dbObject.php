<?PHP

require "dbCondet.php";
require "dbTable.php";

class Conference extends Table
{
    function Conference()
    {
        parent::init();
        $this->tableName = "conference";
        $this->idName = "ID";
    }
	
	function printDropDownOptions_conferenceSection()
    {
		global $grpName;

        // Get function arguments.
        $selected = func_get_arg(0);
        for ($i = 1; $i < func_num_args(); $i++) {
            $extraColumns[$i - 1] = func_get_arg($i);
        }
		
		$sql = "SELECT conference.ID, Title  FROM conference, venue, conference_admin WHERE Venue = venue.ID and conference.ID = conference_admin.Conference_ID and Group_Name='".$grpName."'";
echo $sql;

// Execute our statement.
        $this->Connect();
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $str = "";
                foreach ($row as $colName => $value) {
                    if (!is_int($colName))
                        $str .= $value . " ";
                }
                if ($row[$this->idName] == $selected) {
                    echo "<option value='" . $row[$this->idName] . "' selected >$str</option>\n";
                } else {
                    echo "<option value='" . $row[$this->idName] . "'>$str</option>\n";
                }
            }
            unset($pdo);
            unset($query);
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occurred: " . $error->getMessage();
        }
	}
	
    function getRowWithVenueName($id)
    {
		global $userid;
        $sql = "SELECT conference.ID, Title, Description, Start_Time, End_Time, Organiser, Location, Token, Contact, Name FROM conference, venue WHERE Venue = venue.ID ORDER BY conference.Title ASC ";
	   
		
        if (isset($id))
        $sql = "SELECT conference.ID, Title, Description, Start_Time, End_Time, Organiser, Location, Token, Contact, Name FROM conference, venue WHERE Venue = venue.ID AND conference.ID = :id";
        $this->Connect();
        try {
				$query = $this->pdo->prepare($sql);
				//$query -> execute(["id" => $id]);
				$query->bindParam(":id", $id);
           		$query->execute();
				$results = $query->fetchAll();
				if ($results == null) {
                	echo $this->pdo->errorInfo();//[2];
            	}
           		unset($pdo);
            	unset($query);
				return $results;
        }catch (PDOException $error) {
            // Display error message if applicable
            echo "An error occurred: " . $error->getMessage();
        }
    }

}

class Venue extends Table
{
    function Venue()
    {
        parent::init();
        $this->tableName = "venue";
    }
}

class Section extends Table
{
    function Section()
    {
        parent::init();
        $this->tableName = "conference_section";
    }
}

class Session extends Table
{
    function Session()
    {
        parent::init();
        $this->tableName = "session";
		  $this->idName = "ID";
    }

    function getRow_MAX()
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE ID = (SELECT MAX(ID) FROM " . $this->tableName . ");";

        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":id", $id);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            //$results = $query->fetchAll();
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                return null;
            }
            if ($type == "all")
                return $results;
				
            else
                return $results[0];
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occurred: " . $error->getMessage();
        }
    }
	
	
	  function printDropDownOptions_session()
    {
		global $userid;
        // Get function arguments.
        $selected = func_get_arg(0);
        for ($i = 1; $i < func_num_args(); $i++) {
            $extraColumns[$i - 1] = func_get_arg($i);
        }

        // Make sql string.
        $sql = "SELECT " . $this->tableName . "." . $this->idName;
        if (isset($extraColumns)) {
            foreach ($extraColumns as $value) {
                $sql .= " , ". $this->tableName . "." . $value;
            }
       		if($userid != 1){
        	$sql .= " FROM conference,conference_section JOIN session ON session.Conference_Section = conference_section.ID WHERE Conference_Admin_Id = ".$userid." AND conference_section.Conference = conference.ID"; 
			}
			if($userid == 1){
        	$sql .= " FROM conference,conference_section JOIN session ON session.Conference_Section = conference_section.ID WHERE conference_section.Conference = conference.ID"; 
			}
		}
echo $sql;
        // Execute our statement.
        $this->Connect();
        try {
            $query = $this->pdo->prepare($sql);
          	$query->execute();
			//echo $query;
            for ($i = 0; $row = $query->fetch(); $i++) {
                $str = "";
                foreach ($row as $colName => $value) {
                    if (!is_int($colName))
                        $str .= $value . " ";
                }
                if ($row[$this->idName] == $selected) {
                    echo "<option value='" . $row[$this->idName] . "' selected >$str</option>\n";
                } else {
                    echo "<option value='" . $row[$this->idName] . "'>$str</option>\n";
                }
            }
            unset($pdo);
            unset($query);
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occurred: " . $error->getMessage();
        }
    }

}

class Sponsor extends Table
{
    function Sponsor()
    {
        parent::init();
        $this->tableName = "sponsor";
    }
}

class SessionPresenter extends Table
{
    function SessionPresenter()
    {
        parent::init();
        $this->tableName = "session_presenter";
        $this->idName = "Presenter";
    }

    function getRowCount_sp($id)
    {
        $sql = "SELECT COUNT(*) FROM " . $this->tableName . " WHERE Session = " . $id . ";";
        //echo $sql;
        $this->Connect();
        // Execute our statement.
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute();
            $result = $query->fetch();
            unset($pdo);
            unset($query);
            return intval($result[0]);
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }

    function deleteRow_sp($value)
    {
        $sql = "DELETE FROM " . $this->tableName . " WHERE Session = :value;";
        $this->Connect();
        try {
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();
            unset($pdo);
            unset($query);
            return true;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occurred: " . $error->getMessage();
            return false;
        }
    }

    function getRowByMatch_sp($value)
    {

        $sql = "SELECT * FROM presenter WHERE ID IN (SELECT Presenter FROM session_presenter WHERE Session = :value ) ORDER BY ID;";

        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                //die("<br><br>Get Row for $this->tableName: No Results Found!<br><br>");
                return NULL;
            }
            return $results;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }

}

class Presenter extends Table
{
    function Presenter()
    {
        parent::init();
        $this->tableName = "presenter";
        $this->idName = "ID";
    }
    /*
        function Presenter(){
            parent::init();
            $this->tableName = "presenter";
        }*/
}

class AttendeeProfile extends Table
{
    function AttendeeProfile()
    {
        parent::init();
        $this->tableName = "attendee_profile";
    }
}

class Feedback extends Table
{
	function Feedback()
	{
		parent::init();
		$this->tableName="feedback";
        $this->idName = "ID";	
	}
	
//Rudhra - Get feedback form that are associated to conference for the logged user	
	
	function getRowByMatch_fb_conference($id)
    {
		global $userid;
		
		// Determine query type.  all = full table array.
       // $type = "single";
        // To display Feedback Form Normal User and All conference
        if (($id == "All")&&($userid !=1)) {
            $sql ="SELECT ID, Feedback_Title, Feedback_Desc FROM feedback WHERE ID IN (SELECT Feedback FROM conference WHERE conference.Conference_Admin_Id = ".$userid.") ORDER BY ID";
        }
		// To display Feedback Form Normal User and seleted conference
		else if (($id != "All")&&($userid != 1)) {
             $sql ="SELECT ID, Feedback_Title, Feedback_Desc FROM feedback WHERE ID IN (SELECT Feedback FROM conference WHERE ID = ".$id." and  conference.Conference_Admin_Id = ".$userid.") ORDER BY ID";
		}
		// To display Feedback Form Admin User and All conference
		else if (($id == "All")&&($userid ==1)) {
             $sql ="SELECT ID, Feedback_Title, Feedback_Desc FROM feedback WHERE ID IN (SELECT Feedback FROM conference ) ORDER BY ID";
        }
		// To display Feedback Form Admin User and seleted conference
		else if (($id != "All")&&($userid == 1)) {
             $sql ="SELECT ID, Feedback_Title, Feedback_Desc FROM feedback WHERE ID IN (SELECT Feedback FROM conference WHERE ID = ".$id.") ORDER BY ID";
		}
		
		// Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();

            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                return NULL;
            }
			
            return $results;
			
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
	}
	
	//Rudhra - Get feedback form that are associated to Session for the logged user	
	
	function getRowByMatch_fb_session($id)
    {
		global $userid;
			
		// Normal user and all session
        if (($id == "All")&&($userid != 1)) {
           $sql="SELECT DISTINCT feedback.ID, feedback.Feedback_Title, feedback.Feedback_Desc from feedback,session JOIN conference_section ON session.Conference_Section = conference_section.ID
JOIN conference ON conference.ID = conference_section.Conference 
WHERE conference.Conference_Admin_Id = ".$userid." AND feedback.ID = session.Feedback";			
        }// Normal user and selected session
		else if (($id != "All")&&($userid != 1)) {
           $sql="SELECT DISTINCT feedback.ID, feedback.Feedback_Title, feedback.Feedback_Desc from feedback,session JOIN conference_section ON session.Conference_Section = conference_section.ID
JOIN conference ON conference.ID = conference_section.Conference 
WHERE conference.Conference_Admin_Id = ".$userid." AND feedback.ID = session.Feedback AND session.ID = ".$id.";";
		}
		// Admin user and all session
		else if(($id == "All")&&($userid == 1)){
			$sql="SELECT DISTINCT feedback.ID, feedback.Feedback_Title, feedback.Feedback_Desc from feedback,session JOIN conference_section ON session.Conference_Section = conference_section.ID
JOIN conference ON conference.ID = conference_section.Conference 
WHERE  feedback.ID = session.Feedback";;	
		}
		// Admin user and selected session
		else if (($id != "All")&&($userid == 1)) {
           $sql="SELECT DISTINCT feedback.ID, feedback.Feedback_Title, feedback.Feedback_Desc from feedback,session JOIN conference_section ON session.Conference_Section = conference_section.ID
JOIN conference ON conference.ID = conference_section.Conference 
WHERE feedback.ID = session.Feedback AND session.ID = ".$id.";";
		}
		// Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();

            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                return NULL;
            }
			
            return $results;
			
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
	}
	
}

class FeedbackSection extends Table
{
    function FeedbackSection()
    {
        parent::init();
        $this->tableName = "feedback_section";
		$this->idName = "ID";
    }
	 //To display demography in mobile app
	 function getRowByMatch_fb_section_confID($colName, $value)
    { 
		if($colName == "Feedback"){
        $sql = "SELECT conference.ID FROM " . $this->tableName . ", conference WHERE conference." . $colName . " = ".$value.";";
		//echo $sql;
				 
		}
		else if($colName == "ID"){		
		$sql = "SELECT Conference from " . $this->tableName . ", session
JOIN conference_section ON session.Conference_Section = conference_section.ID 
WHERE " . $this->tableName . ".Feedback = session.Feedback and " . $this->tableName . "." . $colName . " = ".$value.";";
		//echo $sql;
				 
		}
        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();

            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                //die("<br><br>Get Row for $this->tableName: No Results Found!<br><br>");
				
                return NULL;
            }
			
            return $results[0];
			
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
}

	 function getRowByMatch_fb($colName, $value)
    {

        echo $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $colName . " = ".$value." ORDER BY " . $this->idName . ";";

        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();

            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                //die("<br><br>Get Row for $this->tableName: No Results Found!<br><br>");
				
                return NULL;
            }
			
            return $results;
			
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
}
}
//ConferenceFbSection	 to display demography
class ConferenceFbSection extends Table
{
    function ConferenceFbSection()
    {
        parent::init();
        $this->tableName = "conference_fb_section";
		 $this->idName = "Feedback_Section";
    }
	
	 function updateRow($id, $data)
    {
		
        $sql = "UPDATE " . $this->tableName . " SET ";
        foreach ($data as $colName => $value) {
            if (!is_int($colName))
                $sql .= " " . $colName . " = " . $value . ",";
        }
        $sql = rtrim($sql, ",");
        $sql .= " WHERE " . $this->idName . " = ".$id.";";
      //echo $sql;
	  // echo "<br/>";
        // Execute our statement.
        $this->Connect();
        try {
            $query = $this->pdo->prepare($sql);

            foreach ($data as $colName => &$value) {
                if (!is_int($colName))
                  $query->bindParam($colName, $value);
            }
            		$query->bindParam(":id", $id);
			echo $id;
			echo $value;
            $query->execute();
			
            unset($pdo);
            unset($query);
            return true;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occurred: " . $error->getMessage();
            return false;
        }
    }

}


class FeedbackQuestion extends Table
{
    function FeedbackQuestion()
    {
        parent::init();
        $this->tableName = "feedback_question";
    }


    function getRowByMatch_fq($colName, $value)
    {
		global $userid;
		//Displays Feedback Question - Normal user - particular conference 
		if(($userid != 1)&& ($value != 'All'))
		{
        $sql = "SELECT * FROM " . $this->tableName . " WHERE Feedback_Section IN (SELECT ID FROM feedback_section WHERE Feedback IN (SELECT feedback FROM conference WHERE " . $colName . " = ".$value." AND Conference_Admin_Id = ".$userid." )) ORDER BY " . $this->idName . ";";
		//echo $sql;
		}
		//Displays Feedback Question - Normal user - all conference 
		else if(($userid != 1)&&($value == 'All')){
		 $sql = "SELECT * FROM " . $this->tableName . " WHERE Feedback_Section IN (SELECT ID FROM feedback_section WHERE Feedback IN (SELECT feedback FROM conference WHERE Conference_Admin_Id = ".$userid." )) ORDER BY " . $this->idName . ";";
		// echo $sql;	
		}
		//Displays Feedback Question - Admin user - particular conference 
		else if(($userid == 1) &&($value != 'All'))
		{
        $sql = "SELECT * FROM " . $this->tableName . " WHERE Feedback_Section IN (SELECT ID FROM feedback_section WHERE Feedback IN (SELECT feedback FROM conference WHERE " . $colName . " = ".$value.")) ORDER BY " . $this->idName . ";";
		//echo $sql;
		}
		//Displays Feedback Question - Admin user - All conference 
		else if(($userid == 1)&& ($value == 'All')){
		 $sql = "SELECT * FROM " . $this->tableName . " WHERE Feedback_Section IN (SELECT ID FROM feedback_section WHERE Feedback IN (SELECT feedback FROM conference )) ORDER BY " . $this->idName . ";";
		 //echo $sql;	
		}
        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                //die("<br><br>Get Row for $this->tableName: No Results Found!<br><br>");
                return NULL;
            }
            return $results;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }


    function getRow_MAX()
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE ID = (SELECT MAX(ID) FROM " . $this->tableName . ");";

        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":id", $id);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            //$results = $query->fetchAll();
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                return null;
            }
            if ($type == "all")
                return $results;
            else
                return $results[0];
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occurred: " . $error->getMessage();
        }
    }

    function getRowByMatch_ff($value)
    {

        // Check to see if its a valid col name

        //TODO.

        // Write our statement.

        $sql = "SELECT * FROM feedback_question WHERE Feedback_Section = " . $value . " ORDER BY " . $this->idName . ";";

        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                //die("<br><br>Get Row for $this->tableName: No Results Found!<br><br>");
                return NULL;
            }
            return $results;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }


}

class FeedbackOption extends Table
{
    function FeedbackOption()
    {
        parent::init();
        $this->tableName = "feedback_option";
        $this->idName = "Feedback_Question";
        $this->idName2 = "ID";
    }

    function getRowByMatch_fo($colName, $value)
    {

        // Check to see if its a valid col name

        //TODO.

        // Write our statement.

        $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $colName . " = :value ORDER BY " . $this->idName2 . ";";

        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                return NULL;
            }
            return $results;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }

    function getRowByMatch_fo_no($colName, $value)
    {

        // Check to see if its a valid col name

        //TODO.

        // Write our statement.

        $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $colName . " = :value ORDER BY LPAD(Option_Number, 10, 0);";

        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                return NULL;
            }
            return $results;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }


    function updateRow_fo($id, $data)
    {
        $sql = "UPDATE " . $this->tableName . " SET ";
        foreach ($data as $colName => $value) {
            if (!is_int($colName))
                $sql .= " " . $colName . " = :" . $colName . ",";
        }
        $sql = rtrim($sql, ",");
        $sql .= " WHERE " . $this->idName2 . " = :id;";
        //echo $sql;

        // Execute our statement.
        $this->Connect();
        try {
            $query = $this->pdo->prepare($sql);
            foreach ($data as $colName => &$value) {
                if (!is_int($colName))
                    $query->bindParam($colName, $value);
            }
            $query->bindParam(":id", $id);

            $query->execute();
            unset($pdo);
            unset($query);
            return true;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occurred: " . $error->getMessage();
            return false;
        }
    }

    function getRowCount_fo($id)
    {
        $sql = "SELECT COUNT(*) FROM " . $this->tableName . " WHERE Feedback_Question = " . $id . ";";
        //echo $sql;
        $this->Connect();
        // Execute our statement.
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute();
            $result = $query->fetch();
            unset($pdo);
            unset($query);
            return intval($result[0]);
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }
}

class ResponseText extends Table
{
    function ResponseText()
    {
        parent::init();
        $this->tableName = "response_text";
    }
}

class ResponseOption extends Table
{
    function ResponseOption()
    {
        parent::init();
        $this->tableName = "response_option";
        $this->idName = "Feedback_Option";
    }
}


class ConferenceSponsor extends Table
{
    function ConferenceSponsor()
    {
        parent::init();
        $this->tableName = "conference_sponsor";
        $this->idName = "Conference";
    }
	
	//Get conference total count from conference_sponsor table for Edit Conference in Conference page
    function getRowCount_cs($id)
    {
        $sql = "SELECT COUNT(*) FROM " . $this->tableName . " WHERE Conference = " . $id . ";";
        //echo $sql;
        $this->Connect();
        // Execute our statement.
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute();
			$query;
            $result = $query->fetch();
            unset($pdo);
            unset($query);
            return intval($result[0]);
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }
	
	//Before insert edited sponsor list to a conference_sponsor table, delete the existing sponsors list for the Conference
    function deleteRow_cs($value)
    {
		
        $sql = "DELETE FROM " . $this->tableName . " WHERE Conference = " .$value." ";
        $this->Connect();
        try {
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();
			unset($pdo);
            unset($query);
            return true;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occurred: " . $error->getMessage();
            return false;
        }
    }
	//Get each record belongs to the conference from conference_sponsor table for Editing Sponsor details of Conference in Conference page
    function getRowByMatch_cs($value)
    {

        $sql = "SELECT * FROM conference WHERE ID IN (SELECT Conference FROM conference_sponsor WHERE Sponsor = :value ) ORDER BY ID;";

        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                //die("<br><br>Get Row for $this->tableName: No Results Found!<br><br>");
                return NULL;
            }
            return $results;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }
	
}

class SessionQuestion extends Table
{
    function SessionQuestion()
    {
        parent::init();
        $this->tableName = "session_question";
    }
	
	
    function getRowByMatch_sq($value)
    {
		global $userid;
		
		if(($value != 'All')&&($userid != 1)) //To display feedback questions for normal user and selected session
		{
     	 $sql = "SELECT DISTINCT feedback_question.ID, Question_Number, Question_Text, Type FROM feedback_question WHERE Feedback_Section IN (select feedback_section.ID FROM feedback_section JOIN session ON session.Feedback = feedback_section.Feedback JOIN conference_section ON session.Conference_Section = conference_section.ID JOIN conference ON conference.ID = conference_section.Conference WHERE session.ID = ".$value." AND conference.Conference_Admin_Id = ".$userid.") ORDER BY " . $this->idName . ";";
		}
		else if (($value == 'All')&&($userid != 1))  //To display feedback questions for normal user and all session
		{
		  $sql = "SELECT DISTINCT feedback_question.ID, Question_Number, Question_Text, Type FROM feedback_question WHERE Feedback_Section IN (select feedback_section.ID FROM feedback_section JOIN session ON session.Feedback = feedback_section.Feedback JOIN conference_section ON session.Conference_Section = conference_section.ID JOIN conference ON conference.ID = conference_section.Conference WHERE conference.Conference_Admin_Id = ".$userid." ) ORDER BY " . $this->idName . ";";	
		}
		else if (($value != 'All')&&($userid == 1)) //To display feedback questions for admin user and selected session
		{
     	 $sql = "SELECT DISTINCT feedback_question.ID, Question_Number, Question_Text, Type FROM feedback_question WHERE Feedback_Section IN (select feedback_section.ID FROM feedback_section JOIN session ON session.Feedback = feedback_section.Feedback JOIN conference_section ON session.Conference_Section = conference_section.ID JOIN conference ON conference.ID = conference_section.Conference WHERE session.ID = ".$value." ) ORDER BY " . $this->idName . ";";
		}
		else if (($value == 'All')&&($userid == 1))  //To display feedback questions for admin user and all session
		{
		  $sql = "SELECT DISTINCT feedback_question.ID, Question_Number, Question_Text, Type FROM feedback_question WHERE Feedback_Section IN (select feedback_section.ID FROM feedback_section JOIN session ON session.Feedback = feedback_section.Feedback JOIN conference_section ON session.Conference_Section = conference_section.ID JOIN conference ON conference.ID = conference_section.Conference ) ORDER BY " . $this->idName . ";";	
		}
        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                //die("<br><br>Get Row for $this->tableName: No Results Found!<br><br>");
                return NULL;
            }
            return $results;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
	}

    function fetchSelectedSessionQuestions($selectedQuestions)
    {

        // Check to see if its a valid col name $colName, 

        // Write our statement.
        $sql = 'SELECT sq.ID, sq.Question, sq.Accepted FROM session_question sq';
        $sql .= ' WHERE ID IN (';
        $sql .= $selectedQuestions;
        $sql .= ');';


        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                //die("<br><br>Get Row for $this->tableName: No Results Found!<br><br>");
                return NULL;
            }
            return $results;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }

    function filterResponseQuestions($value, $status)
    {

        // Check to see if its a valid col name $colName, 

        // Write our statement.
        $sql = 'SELECT sq.ID, sq.Question, sq.Accepted FROM session_question sq';
        $sql .= ' WHERE';

        // check the filter for session.
        if ($value != 'all') {
            $sql .= ' sq.session = :value';
            if ($status != "all") {
                $sql .= ' AND';
            }
        }

        // check the filter for accepted status
        if ($status == "1") {
            $sql .= ' sq.Accepted =TRUE';
        } elseif ($status == "0") {
            $sql .= ' sq.Accepted =FALSE';
        }
        //echo $status.$sql;
        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                //die("<br><br>Get Row for $this->tableName: No Results Found!<br><br>");
                return NULL;
            }
            return $results;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }

}

class PollingQuestion extends Table
{
    function PollingQuestion()
    {
        parent::init();
        $this->tableName = "polling";
    }

    function getRow_MAX()
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE ID = (SELECT MAX(ID) FROM " . $this->tableName . ");";

        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":id", $id);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row;
            }
            //$results = $query->fetchAll();
            unset($pdo);
            unset($query);
            if (!isset($results[0])) {
                return null;
            }
            if ($type == "all")
                return $results;
            else
                return $results[0];
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occurred: " . $error->getMessage();
        }
    }


    function getRowCount_pq($id)
    {
        $sql = "SELECT COUNT(*) FROM " . $this->tableName . " WHERE Session = " . $id . ";";
        //echo $sql;
        $this->Connect();
        // Execute our statement.
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute();
            $result = $query->fetch();
            unset($pdo);
            unset($query);
            return intval($result[0]);
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }
}

class PollingOption extends Table
{
    function PollingOption()
    {
        parent::init();
        $this->tableName = "polling_option";
		$this->idName ="Polling";
    }
}

class PollingResponse extends Table
{
    function PollingResponse()
    {
        parent::init();
        $this->tableName = "polling_response";
    }

    function getRowCount_pr($id)
    {
        $sql = "SELECT COUNT(*) FROM " . $this->tableName . " WHERE Polling_Option = " . $id . ";";
        //echo $sql;
        $this->Connect();
        // Execute our statement.
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute();
            $result = $query->fetch();
            unset($pdo);
            unset($query);
            return intval($result[0]);
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }
}

class User extends Table
{
    function User()
    {
        parent::init();
        $this->tableName = "user";
    }
}

class Map extends Table
{
    function Map()
    {
        parent::init();
        $this->tableName = "map";
    }
}

class Equipment extends Table
{
    function Equipment()
    {
        parent::init();
        $this->tableName = "equipment";
    }
}

class reviewQuestion extends Table
{
    function reviewQuestion()
    {
        parent::init();
        $this->tableName = "Response_Text";
    }

    function getRowCount_pr($id)
    {
        /*$sql = "SELECT s.ID 'Current Session ID', rt.question_response 'Proposed Question'
                FROM Response_Text rt, Feedback_Question fq, Feedback_Section fs, feedback f, session s
                WHERE rt.Feedback_Question = fq.ID 
                AND fq.feedback_Section = fs.ID
                AND s.feedback_section = s.ID
                and s.ID = '1';"; 
                 //= ".$id.";";*/
        $sql = "SELECT * FROM Response_Text";
        //echo $sql;
        $this->Connect();
        // Execute our statement.
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            unset($pdo);
            unset($query);
            return $result;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }
}

/*
Table Object Template: (replace things in curly brackets)

class {TABLE NAME} extends Table {
	function {TABLE NAME}(){
		parent::init();
		$this->tableName = "{DB TABLE NAME}";
		$this->idName = "{DB ID COLUMN NAME}";
	}
}

*/

class Data
{
    function Data()
    {
        $this->conference = new Conference();
        $this->venue = new Venue();
        $this->section = new Section();
        $this->session = new Session();
        $this->presenter = new Presenter();
        $this->sessionPresenter = new SessionPresenter();
        $this->attendeeProfile = new AttendeeProfile();
        $this->feedbackSection = new FeedbackSection();
        $this->feedbackQuestion = new FeedbackQuestion();
        $this->feedbackOption = new FeedbackOption();
        $this->responseTxt = new ResponseText();
        $this->responseOpt = new ResponseOption();
        $this->sponsor = new Sponsor();
        $this->conferenceSponsor = new ConferenceSponsor();
        $this->sessionQuestion = new SessionQuestion();
        $this->pollingQuestion = new PollingQuestion();
        $this->polling = $this->pollingQuestion;
        $this->pollingOption = new PollingOption();
        $this->pollingResponse = new PollingResponse();
        $this->user = new User();
        $this->map = new Map();
        $this->equipment = new Equipment();
        $this->reviewQuestion = new ReviewQuestion();
		$this->feedback = new Feedback();
		//Rudhra- Table conference_fb_section
		$this->conferenceFbSection = new ConferenceFbSection();
    }
}

