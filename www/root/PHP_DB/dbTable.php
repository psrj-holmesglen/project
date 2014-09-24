<?PHP

class Table
{
    var $pdo;
    var $tableName;
    var $idName;

    function init()
    {
        $this->idName = "ID";
    }

    function Connect()
    {
        try {
            // Create a PDO connection with the configuration data
            $this->pdo = new PDO(ConDet::dsn(), ConDet::$user, ConDet::$password);
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An Error occured: " . $error->getMessage();
        }
    }

    function getRowCount()
    {
        $sql = "SELECT COUNT(*) FROM $this->tableName;";
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

    function getColCount()
    {
        $sql = "SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='"
                . ConDet::$db . "' AND TABLE_NAME='"
                . $this->tableName . "';";
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

    function getColumnName($index)
    {
        $sql = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='"
                . ConDet::$db . "' AND TABLE_NAME='"
                . $this->tableName . "' AND ORDINAL_POSITION ="
                . $index + 1 . ";";
        $this->Connect();
        // Execute our statement.
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute();
            $result = $query->fetch();
            unset($pdo);
            unset($query);
            return $result[0];
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }

    function getColumnNames()
    {
        $sql = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='"
                . ConDet::$db . "' AND TABLE_NAME='"
                . $this->tableName . "';";
        $this->Connect();
        // Execute our statement.
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->execute();
            for ($i = 0; $row = $query->fetch(); $i++) {
                $results[$i] = $row[0];
            }
            //$res = $query->fetch();
            unset($pdo);
            unset($query);
            return $results;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
        }
    }

    function getRowByMatch($colName, $value)
    {
		
		global $userid;
		//echo $userid;
        // Check to see if its a valid col name
        
        // Write our statement.
		//To display session's for a selected conference section id to logged in user
		if(($this->tableName == "session")&& ($userid != '1'))	{
			$sql = "SELECT session.Feedback, conference.ID, conference_section.ID, conference.Conference_Admin_Id, conference.ID, conference.Title, conference_section.Conference, conference_section.Section_Title, " . $this->tableName . ".Conference_Section, " . $this->tableName . ".ID , " . $this->tableName . ".Title, " . $this->tableName . ".Description, " . $this->tableName . ".Start_Time, " . $this->tableName . ".End_Time, " . $this->tableName . ".Room_Location, " . $this->tableName . ".Session_Chairperson FROM conference,conference_section LEFT JOIN " . $this->tableName . " ON " . $this->tableName . ".Conference_Section = conference_section.ID WHERE conference.ID = conference_section.Conference AND " . $colName . ".ID= '".$value."' AND " . $this->tableName . ".conference_section IS NOT NULL AND conference.Conference_Admin_Id = '".$userid."' ORDER BY conference.ID, " . $this->tableName . ".Conference_Section";
			//echo $sql;
		}
		//To display session's for a selected conference section id to admin user
		else if(($this->tableName == "session")&& ($userid == '1'))	{
			$sql = "SELECT conference.ID, conference_section.ID, conference.Conference_Admin_Id, conference.ID, conference.Title, conference_section.Conference, conference_section.Section_Title, " . $this->tableName . ".Conference_Section, " . $this->tableName . ".ID , " . $this->tableName . ".Title, " . $this->tableName . ".Description, " . $this->tableName . ".Start_Time, " . $this->tableName . ".End_Time, " . $this->tableName . ".Room_Location, " . $this->tableName . ".Session_Chairperson FROM conference,conference_section LEFT JOIN " . $this->tableName . " ON " . $this->tableName . ".Conference_Section = conference_section.ID WHERE conference.ID = conference_section.Conference AND " . $colName . ".ID= '".$value."' AND " . $this->tableName . ".conference_section IS NOT NULL ORDER BY conference.ID, " . $this->tableName . ".Conference_Section";
			//echo $sql;
		}
		//To display conference section 's for a selected conference id to logged in user
		else if(($this->tableName == "conference_section") && ($userid != '1'))	{
			$sql = "SELECT DISTINCT conference.Conference_Admin_Id, " . $this->tableName . ".ID, " . $this->tableName . ".Section_Title, " . $this->tableName . ".Ordering FROM " . $this->tableName . ", conference WHERE conference_section." . $colName . " = '".$value."' AND conference.ID = " . $this->tableName . ".Conference AND conference.Conference_Admin_Id = '".$userid."' ORDER BY " . $this->tableName . ".ID ";
			//echo $sql;
		}
		//To display conference section 's for a selected conference id to admin user
		else if(($this->tableName == "conference_section") && ($userid == '1'))	{
			$sql = "SELECT DISTINCT conference.Conference_Admin_Id, " . $this->tableName ." .ID, " . $this->tableName . ".Section_Title, " . $this->tableName . ".Ordering FROM " . $this->tableName . ", conference WHERE conference_section." . $colName . " = '".$value."' AND conference.ID = " . $this->tableName . ".Conference ORDER BY " . $this->tableName . ".ID ";
			//echo $sql;
		}
		else if(($this->tableName == "conference") && ($userid != '1')){
		$sql = "SELECT DISTINCT conference.ID, conference.Title, conference.Description, conference.Start_Time, conference.End_Time, conference.Organiser, conference.Location, conference.Contact, conference.Venue, conference.Token, venue.Name FROM " . $this->tableName . ", venue WHERE " . $this->tableName . ".Venue = venue.ID AND " . $this->tableName . ".Conference_Admin_Id = '".$userid."' ORDER BY " . $this->tableName . ".ID";	
		//echo $sql;
		}
		else if(($this->tableName == "conference") && ($userid == '1')){
		$sql = "SELECT DISTINCT conference.ID, conference.Title, conference.Description, conference.Start_Time, conference.End_Time, conference.Organiser, conference.Location, conference.Contact, conference.Venue, conference.Token, venue.Name FROM " . $this->tableName . ", venue WHERE " . $this->tableName . ".Venue = venue.ID ORDER BY " . $this->tableName . ".ID";	
		//echo $sql;
		}
		//To display feedback section's in feedback forms page all conference and normal user
		else if(($this->tableName == "feedback") && ($value == 'All')&& ($userid != 1)){			
			 $sql = "SELECT DISTINCT ID, Section_Title, Section_Desc, Type,Feedback FROM feedback_section WHERE Feedback IN (SELECT ID FROM feedback WHERE ID IN (SELECT Feedback FROM conference WHERE conference.Conference_Admin_Id =".$userid.") ORDER BY ID)";		
			//echo $sql;
		}
			//To display feedback section's in feedback forms page for particular conference  and normal user
		else if(($this->tableName == "feedback") && ($value != 'All')&& ($userid != 1)){			
			 $sql = "SELECT DISTINCT ID, Section_Title, Section_Desc, Type,Feedback  FROM feedback_section WHERE Feedback IN (SELECT ID FROM feedback WHERE ID IN (SELECT Feedback FROM conference WHERE ID =".$value." AND conference.Conference_Admin_Id =".$userid.") ORDER BY ID)";		
			//echo $sql;
		}
		//To display feedback section's in feedback forms page all conference and Admin user
		else if(($this->tableName == "feedback") && ($value == 'All')&& ($userid == 1)){			
			 $sql = "SELECT DISTINCT ID, Section_Title, Section_Desc, Type,Feedback FROM feedback_section WHERE Feedback IN (SELECT ID FROM feedback WHERE ID IN (SELECT Feedback FROM conference ) ORDER BY ID)";		
			$sql;
		}
			//To display feedback section's in feedback forms page for particular conference  and Admin user
		else if(($this->tableName == "feedback") && ($value != 'All')&& ($userid == 1)){			
			 $sql = "SELECT DISTINCT ID, Section_Title, Section_Desc, Type,Feedback  FROM feedback_section WHERE Feedback IN (SELECT ID FROM feedback WHERE ID IN (SELECT Feedback FROM conference WHERE ID =".$value." ) ORDER BY ID)";		
			 $sql;
		}
			//To display feedback section's in feedback forms page for all session and normal user
		else if(($this->tableName == "feedback_section") && ($value == 'All')&& ($userid != 1)){	
			$sql = "SELECT DISTINCT ID, Section_Title, Section_Desc, Type,Feedback FROM feedback_section WHERE Feedback IN (SELECT DISTINCT feedback.ID from feedback,session JOIN conference_section ON session.Conference_Section = conference_section.ID JOIN conference ON conference.ID = conference_section.Conference WHERE conference.Conference_Admin_Id =".$userid." AND feedback.ID = session.Feedback )";		
			//echo $sql;
			
		}
		//To display feedback section's in feedback forms page for particular session and normal user
		else if(($this->tableName == "feedback_section") && ($value != 'All')&& ($userid != 1)){			
			$sql = "SELECT DISTINCT ID, Section_Title, Section_Desc, Type,Feedback FROM feedback_section WHERE Feedback IN (SELECT DISTINCT feedback.ID from feedback,session JOIN conference_section ON session.Conference_Section = conference_section.ID JOIN conference ON conference.ID = conference_section.Conference WHERE conference.Conference_Admin_Id = ".$userid." AND feedback.ID = session.Feedback AND session.ID = ".$value.")";	
		}
			//To display feedback section's in feedback forms page for all session and Admin user
		else if(($this->tableName == "feedback_section") && ($value == 'All')&& ($userid == 1)){	
			$sql = "SELECT DISTINCT ID, Section_Title, Section_Desc, Type,Feedback FROM feedback_section WHERE Feedback IN (SELECT DISTINCT feedback.ID from feedback,session JOIN conference_section ON session.Conference_Section = conference_section.ID JOIN conference ON conference.ID = conference_section.Conference WHERE  feedback.ID = session.Feedback )";		
			//echo $sql;
			
		}
		//To display feedback section's in feedback forms page for particular session and Admin user
		else if(($this->tableName == "feedback_section") && ($value != 'All')&& ($userid == 1)){			
			$sql = "SELECT DISTINCT ID, Section_Title, Section_Desc, Type,Feedback FROM feedback_section WHERE Feedback IN (SELECT DISTINCT feedback.ID from feedback,session JOIN conference_section ON session.Conference_Section = conference_section.ID JOIN conference ON conference.ID = conference_section.Conference WHERE feedback.ID = session.Feedback AND session.ID = ".$value.")";	
			//echo $sql;
		}
	 	else{       
			if($value != "1"){
				 $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $colName . " = '".$value."' ORDER BY " . $this->idName . ";";
				 //echo $sql;
				
			}
			else {
				$sql = "SELECT * FROM " . $this->tableName . " ORDER BY " . $this->idName . ";";
				//echo $sql;
			}	
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
   
    function getRowByMatch_rq($value)
    {

        // Check to see if its a valid col name $colName,

        //TODO.

        // Write our statement.

        $sql = 'SELECT s.ID, rt.question_response';
        $sql .= ' FROM response_text rt, feedback_question fq, feedback_section fs, session s';
        $sql .= ' WHERE rt.Feedback_Question = fq.ID';
        $sql .= ' AND fq.feedback_Section = fs.ID';
        $sql .= ' AND s.feedback_section = s.ID';
        $sql .= ' AND s.ID =:value;';

        //echo "$value";


        // Execute our statement.
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":value", $value);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0, $row; $row = $query->fetch(); $i++) {
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


    function getRowByMatch_fq($colName, $value)
    {

        // Check to see if its a valid col name

        //TODO.

        // Write our statement.

        $sql = "SELECT * FROM " . $this->tableName . " WHERE section = (SELECT ID FROM section WHERE feedback = (SELECT feedback FROM conference where " . $colName . " = :value )) ORDER BY " . $this->idName . ";";

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

    function getRow($id)
    {
		global $userid;
        // Determine query type.  all = full table array.
        $type = "single";
        if ($id == "all" || !isset($id))
            $type = "all";
        // Write our statement.
     /*   if ($type == "all") {
            $sql = "SELECT * FROM " . $this->tableName . " ORDER BY " . $this->idName . ";";
			
        } else {
            $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $this->idName . " = :id;";
			
        }*/
		//conference delete row / user other than 1(admin)
		if(($this->tableName == "conference") && ($userid != '1')){
		$sql = "SELECT DISTINCT conference.ID, conference.Title, conference.Description, conference.Start_Time, conference.End_Time, conference.Organiser, conference.Location, conference.Contact, conference.Venue, conference.Token,venue.Name FROM " . $this->tableName . ", venue WHERE " . $this->tableName . ".Venue = venue.ID AND " . $this->tableName . ".Conference_Admin_Id = '".$userid."' AND " . $this->tableName . "." . $this->idName . "=".$id." ORDER BY " . $this->tableName . ".ID";	
		//echo $sql;
		}
		//conference delete row / user is 1(admin)  AND " . $this->tableName . ".Conference_Admin_Id = '".$userid."'
		else if(($this->tableName == "conference") && ($userid = '1')){
		$sql = "SELECT DISTINCT conference.ID, conference.Title, conference.Description, conference.Start_Time, conference.End_Time, conference.Organiser, conference.Location, conference.Contact, conference.Venue, conference.Token,venue.Name FROM " . $this->tableName . ", venue WHERE " . $this->tableName . ".Venue = venue.ID  AND " . $this->tableName . "." . $this->idName . "=".$id." ORDER BY " . $this->tableName . ".ID";	
		//echo $sql;
		}
		//section view page all user and administrator
		else if(($this->tableName == "conference_section") && ($userid != "1") && (isset($id) && ($id != "all"))){
			  $sql = "SELECT DISTINCT conference.Conference_Admin_Id, conference_section.ID, conference_section.Section_Title, conference_section.Ordering, conference_section.Last_Updated, conference_section.Conference FROM conference_section, conference WHERE conference.ID = " . $this->tableName . ".Conference AND conference.Conference_Admin_Id = '".$userid."' AND  " . $this->tableName . "." . $this->idName . "=".$id." ORDER BY conference_section.ID "; 
			// echo $sql;
		}
		else if(($this->tableName == "conference_section") && ($userid != "1")){
			  $sql = "SELECT DISTINCT conference.Conference_Admin_Id, conference_section.ID, conference_section.Section_Title, conference_section.Ordering, conference_section.Last_Updated, conference_section.Conference FROM conference_section, conference WHERE conference.ID = " . $this->tableName . ".Conference AND conference.Conference_Admin_Id = '".$userid."' ORDER BY conference_section.ID "; 
		} 
		//session normal user display all sessions for the logged users conference
		else if(($this->tableName == "session") && ($userid != "1") && (isset($id)) && ($id != "all")){
			
			$sql = "SELECT * FROM session Where session.ID = ".$id."";		
		
		}
		//session normal user display all sessions for the logged users conference
		else if(($this->tableName == "session") && ($userid != "1")){
			
			$sql = "SELECT ". $this->tableName . ".ID, ". $this->tableName . ".Title, ". $this->tableName . ".Description, ". $this->tableName . ".Start_Time, ". $this->tableName . ".End_Time, Room_Location, Session_Chairperson FROM session,conference_section,conference Where ". $this->tableName . ".Conference_Section = conference_section.ID AND conference_section.Conference = conference.ID AND conference.Conference_Admin_Id = '".$userid."'ORDER BY ". $this->tableName . ".ID";		
			//echo $sql;
		}
		else if ($type == "all") {
			 $sql = "SELECT * FROM " . $this->tableName . " ORDER BY " . $this->idName . ";";

		}
		else {
			$sql = "SELECT * FROM " . $this->tableName . " WHERE " . $this->idName . " = :id;";
			//echo $sql;	
		}


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

    function updateRow($id, $data)
    {
		
        $sql = "UPDATE " . $this->tableName . " SET ";
        foreach ($data as $colName => $value) {
            if (!is_int($colName))
                $sql .= " " . $colName . " = :" . $colName . ",";
        }
        $sql = rtrim($sql, ",");
        $sql .= " WHERE " . $this->idName . " = :id;";
       echo $sql;
	   echo "<br/>";
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

    function addRow($data)
    {
        // Making our SQL statement.
        $colList = array();
        foreach ($data as $colName => $value)
            if (!is_int($colName))
                array_push($colList, $colName);
        $colString = "" . implode(", ", $colList);
        $valString = ":" . implode(", :", $colList);
        $sql = "INSERT INTO " . $this->tableName . " (" . $colString . ") VALUES (" . $valString . ");";
		//echo $sql;
        // Execute our statement.
        $this->Connect();
        try {
            $query = $this->pdo->prepare($sql);
            foreach ($data as $colName => &$value) {
                if (!is_int($colName))
                    $query->bindParam($colName, $value);
            }
            if ($query->execute()) {
                //echo "<br/><br/>Record Added. <br/><br/>" . var_dump($data) . "<br/><br/>";

                $lastID = $this->pdo->lastInsertId();
                unset($pdo);
                unset($query);
                return $lastID;
            } else {
                $er = $query->errorInfo();
                echo "Record Not Added: " . $er[2] . "<br/><br/>Data info:<br/><br/>" . implode(" ", $data) . "<br/><br/> . $sql";
                unset($pdo);
                unset($query);
                return NULL;
            }
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occured: " . $error->getMessage();
            return false;
        }
    }

    // Optimised row clone code... To be looked at further.
    function cloneRow($id, $dataChange)
    {
        $sql = "CREATE TEMPORARY TABLE temp1234 ENGINE=MEMORY SELECT * FROM $this->tableName WHERE ID= $id;";
        $sql .= "UPDATE temp1234 SET ID = 0;";
        // Update data
        if (isset($dataChange)) {
            foreach ($dataChange as $colName => $value) {
                $sql .= "UPDATE temp1234 SET $colName = '$value';";
            }
        }
        $sql .= "INSERT INTO $this->tableName SELECT * FROM temp1234";
        $this->Connect();
        try {
            // Create new record
            $query = $this->pdo->prepare($sql);
            $query->execute();
            $lastID = $this->pdo->lastInsertId();
            unset($pdo);
            unset($query);

            // Return the new ID
            return $lastID;
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occurred: " . $error->getMessage();
            return false;
        }
    }

    function customQuery($sql)
    {
        $this->Connect();
        try {
            $query = $this->pdo->prepare($sql);
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

    function deleteRow($id)
    {
        if ($this->rowExistsById($id)) {
           echo $sql = "DELETE FROM " . $this->tableName . " WHERE " . $this->idName . " = :id;";
            $this->Connect();
            try {
                $query = $this->pdo->prepare($sql);
                $query->bindParam(":id", $id);
                $query->execute();
                unset($pdo);
                unset($query);
                return true;
            } catch (PDOException $error) {
                //Display error message if applicable
                echo "An error occurred: ".$error->getMessage();
                return false;
            }
        } else {
            echo "Can not delete Record. $id does not exist in the database.";
        }
    }

    function rowExistsById($id)
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $this->idName . " = :id;";
        $this->Connect();
        try {
            $results = array();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(":id", $id);
            $query->execute();
            if ($query->fetch()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $error) {
            //Display error message if applicable
            echo "An error occurred: " . $error->getMessage();
            return false;
        }
    }

    function printDebugTable($id)
    {
        $numRows = $this->getRowCount();
        $numCols = $this->getColCount();

        $colNames = $this->getColumnNames();

        echo "<table><tr>";
        for ($i = 0; $i < $numCols; $i++) {
            echo "<th>" . $colNames[$i] . "</th>";
        }
        echo "</tr>";
        $rows = $this->getRow("all");
        for ($i = 0; $i < $numRows; $i++) {
            $row = $rows[$i];
            if (isset($id) && $row[0] == $id) {
                echo "<tr>";
                for ($j = 0; $j < $numCols; $j++) {
                    echo "<td>" . $row[$j] . "</td>";
                }
                echo "</tr>";
            }
        }
        echo "</table>";
    }

    function printDropDownOptions()
    {
		global $userid;
        // Get function arguments.
        $selected = func_get_arg(0);
        for ($i = 1; $i < func_num_args(); $i++) {
            $extraColumns[$i - 1] = func_get_arg($i);
        }

        // Make sql string.
        $sql = "SELECT " . $this->idName;
        if (isset($extraColumns)) {
            foreach ($extraColumns as $value) {
                $sql .= " , " . $value;
            }
        }
       if(($this->tableName == "conference") && ($userid != "1")){
			$sql .= " FROM " . $this->tableName . " WHERE  " . $this->tableName . ".Conference_Admin_Id = '".$userid."' ORDER BY " . $this->idName . ";";
			//echo $sql;
		}
		else if(($this->tableName == "conference") && ($userid == "1")){
			$sql .= " FROM " . $this->tableName . " ORDER BY " . $this->idName . ";";
			//echo $sql;
		}		
		else{
        	$sql .= " FROM " . $this->tableName . " ORDER BY " . $this->idName . ";"; 				           
		}

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

    // This function takes three parameters. First one is the Id for an object in the table in question, if it matches an
    // existing object, this will be assigned as selected, if not just pass "All" or NULL to it. Second is the column you
    // want to find matches for and third is the match you are looking for. It then echoes the options for a drop down
    // menu with only the results of this query.
    function printDropDownOptionsByMatch($selected, $column, $match)
    {
        // Get function arguments.
        for ($i = 3; $i < func_num_args(); $i++) {
            $extraColumns[$i - 3] = func_get_arg($i);
        }

        // Make sql string.
       $sql = "SELECT " . $this->idName;
        if (isset($extraColumns)) {
            foreach ($extraColumns as $value) {
                $sql .= " , " . $value;
            }
        }
        $sql .= " FROM " . $this->tableName . " WHERE " . $column . " = " . $match . " ORDER BY " . $this->idName . ";";

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

    private function stripIndexedEntries($data)
    {
        foreach ($data as $rowNum => $row) {
            foreach ($row as $colName => $value) {
                if (is_int($colName)) {
                    unset($row["$colName"]);
                }
            }
        }
        return $data;
    }


}
