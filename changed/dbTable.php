<?PHP

class Table {
	var $pdo;
	var $tableName;
	var $idName;
	
	function init() {
        $this->idName = "ID";
	}
	
	function Connect() {
		try {
			// Create a PDO connection with the configuration data
			$this->pdo = new PDO(ConDet::dsn(), ConDet::$user, ConDet::$password);
		}
		catch(PDOException $error) {
			//Display error message if applicable
			echo "An Error occured: " . $error->getMessage();
		}
	}
	
	function getRowCount() {
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
		}
		catch(PDOException $error){
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}
	}
	
	function getColCount() {
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
		}
		catch(PDOException $error){
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}
	}
	
	function getColumnName($index) {
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
		}
		catch(PDOException $error){
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}
	}
	
	function getColumnNames() {
		$sql = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='" 
		. ConDet::$db . "' AND TABLE_NAME='" 
		. $this->tableName . "';";
		$this->Connect();
		// Execute our statement.
		try {
			$results = array();
			$query = $this->pdo->prepare($sql);
			$query->execute();
			for($i=0; $row = $query->fetch(); $i++){
				$results[$i] = $row[0];
			}
			//$res = $query->fetch();
			unset($pdo); 
			unset($query);
			return $results;
		}
		catch(PDOException $error){
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}
	}
	
	function getRowByMatch($colName, $value) {
		
		// Check to see if its a valid col name
		
		//TODO.
		
		// Write our statement.
		
		$sql = "SELECT * FROM " . $this->tableName . " WHERE " . $colName . " = :value ORDER BY " . $this->idName . ";";
		
		// Execute our statement.
		$this->Connect();
		try {
			$results = array();
			$query = $this->pdo->prepare($sql);
			$query->bindParam(":value", $value);
			$query->execute();
			for($i=0; $row = $query->fetch(); $i++){
				$results[$i] = $row;
			}
			unset($pdo); 
			unset($query);
			if(!isset($results[0])) {
				return NULL;
			}
			return $results;
		}
		catch(PDOException $error){
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}
	}
	
	
	
	
	function getRowByMatch_fq($colName, $value) {
		
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
			for($i=0; $row = $query->fetch(); $i++){
				$results[$i] = $row;
			}
			unset($pdo); 
			unset($query);
			if(!isset($results[0])) {
				//die("<br><br>Get Row for $this->tableName: No Results Found!<br><br>");
				return NULL;
			}
			return $results;
		}
		catch(PDOException $error){
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}
	}
	
	function getRow($id) {
		// Determine query type.  all = full table array.
		$type = "single";
		if($id == "all" || !isset($id) ) $type = "all";
		// Write our statement.
		if($type == "all") {
			$sql = "SELECT * FROM " . $this->tableName . " ORDER BY " . $this->idName . ";";
		}
		else {
			$sql = "SELECT * FROM " . $this->tableName . " WHERE " . $this->idName . " = :id;";
		}
		// Execute our statement.
		$this->Connect();
		try {
			$results = array();
			$query = $this->pdo->prepare($sql);
			$query->bindParam(":id", $id);
			$query->execute();
			for($i=0; $row = $query->fetch(); $i++) {
				$results[$i] = $row;
			}
            //$results = $query->fetchAll();
			unset($pdo); 
			unset($query);
			if(!isset($results[0])) {
				return null;
			}
			if($type == "all")
				return $results;
			else
				return $results[0];
		}
		catch(PDOException $error){
			//Display error message if applicable
			echo "An error occurred: ".$error->getMessage();
		}
	}
	
	function updateRow($id, $data) {
		$sql = "UPDATE " . $this->tableName . " SET ";
		foreach($data as $colName => $value) {
			if(!is_int($colName)) 
				$sql .= " " . $colName . " = :" . $colName . ",";
		}
		$sql = rtrim($sql, ",");
		$sql .= " WHERE " . $this->idName . " = :id;";
		//echo $sql;
		
		// Execute our statement.
		$this->Connect();
		try {
			$query = $this->pdo->prepare($sql);
			foreach($data as $colName => &$value) {
				if(!is_int($colName)) 
					$query->bindParam($colName, $value);
			}
			$query->bindParam(":id", $id);
			
			$query->execute();
			unset($pdo); 
			unset($query);
			return true;
		}
		catch(PDOException $error){
			//Display error message if applicable
			echo "An error occurred: ".$error->getMessage();
			return false;
		}
	}

    function addRow($data) {
        // Making our SQL statement.
        $colList = array();
        foreach($data as $colName => $value)
            if(!is_int($colName))
                array_push($colList, $colName);
        $colString = ""  . implode(", ",  $colList);
        $valString = ":" . implode(", :", $colList);
        $sql = "INSERT INTO " . $this->tableName . " (" . $colString . ") VALUES (" . $valString . ");";
        // Execute our statement.
        $this->Connect();
        try {
            $query = $this->pdo->prepare($sql);
            foreach($data as $colName => &$value) {
                if(!is_int($colName))
                    $query->bindParam($colName, $value);
            }
            if($query->execute()) {
                //echo "<br/><br/>Record Added. <br/><br/>" . var_dump($data) . "<br/><br/>";
                $lastID = $this->pdo->lastInsertId();
                unset($pdo);
                unset($query);
                return $lastID;
            }
            else {
                $er = $query->errorInfo();
                echo "Record Not Added: " . $er[2] . "<br/><br/>Data info:<br/><br/>" . implode(" ", $data) . "<br/><br/> . $sql";
                unset($pdo);
                unset($query);
                return NULL;
            }
        }
        catch(PDOException $error){
            //Display error message if applicable
            echo "An error occured: ".$error->getMessage();
            return false;
        }
    }

    /*
     * Optimised row clone code... To be looked at further.
    function cloneRow($id, $dataChange) {
        $databaseName = "epworth_ec";
        $sql  = "CREATE TEMPORARY TABLE temp1234 ENGINE=MEMORY SELECT * FROM $this->tableName WHERE ID= $id;";
        $sql .= "UPDATE temp1234 SET ID = (SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$databaseName' AND TABLE_NAME = '$this->tableName');";
        // Update data
        if(isset($dataChange)) {
            foreach($dataChange as $colName => $value) {
                $sql .= "UPDATE temp1234 SET $colName = '$value';";
            }
        }
        $sql .= "INSERT INTO $this->tableName SELECT * FROM temp1234";
        $this->Connect();
        try {
            // Create new record
            $query = $this->pdo->prepare($sql);
            $query->execute();

            // Get the new ID
            $query = $this->pdo->prepare("SELECT ID FROM temp1234");
            $query->execute();
            $newID = $query->fetch()[0];

            unset($pdo);
            unset($query);

            // Return the new ID
            return $newID;
        }
        catch(PDOException $error){
            //Display error message if applicable
            echo "An error occurred: ".$error->getMessage();
            return false;
        }
    }
    */

	function deleteRow($id) {
		if($this->rowExistsById($id) ) {
			$sql = "DELETE FROM " . $this->tableName . " WHERE " . $this->idName . " = :id;";
			$this->Connect();
			try {
				$query = $this->pdo->prepare($sql);
				$query->bindParam(":id", $id);
				$query->execute();
				unset($pdo); 
				unset($query);
				return true;
			}
			catch(PDOException $error){
				//Display error message if applicable
				echo "An error occurred: ".$error->getMessage();
				return false;
			}
		}
		else {
			echo "Can not delete Record. $id does not exist in the database.";
		}
	}
	
	function rowExistsById($id) {
		$sql = "SELECT * FROM " . $this->tableName . " WHERE " . $this->idName . " = :id;";
		$this->Connect();
		try {
			$results = array();
			$query = $this->pdo->prepare($sql);
			$query->bindParam(":id", $id);
			$query->execute();
			if($query->fetch()) {
				return true;
			}
			else{
				return false;
			}
		}
		catch(PDOException $error){
			//Display error message if applicable
			echo "An error occurred: ".$error->getMessage();
			return false;
		}
	}
	
	function printDebugTable($id) {
		$numRows = $this->getRowCount();
		$numCols = $this->getColCount();
		
		$colNames = $this->getColumnNames();
		
		echo "<table><tr>";
		for($i = 0; $i < $numCols; $i++) {
			echo "<th>" . $colNames[$i] . "</th>";
		}
		echo "</tr>";
		$rows = $this->getRow("all");
		for($i = 0; $i < $numRows; $i++) {
			$row = $rows[$i];
			if(isset($id) && $row[0] == $id)
			{
				echo "<tr>";
				for($j = 0; $j < $numCols; $j++) {
					echo "<td>" . $row[$j] . "</td>";
				}
				echo "</tr>";
			}
		}
		echo "</table>";
	}
	
	function printDropDownOptions() {
		// Get function arguments.
		$selected = func_get_arg(0);
		for ($i = 1; $i < func_num_args(); $i++) {
			$extraColumns[$i - 1] = func_get_arg($i);
		}
		
		// Make sql string.
		$sql = "SELECT " . $this->idName;
		if(isset($extraColumns)) {
			foreach($extraColumns as $value) {
				$sql .= " , " . $value; 
			}
		}
		$sql .=  " FROM " . $this->tableName . " ORDER BY " . $this->idName . ";";
		
		// Execute our statement.
		$this->Connect();
		try {
			$query = $this->pdo->prepare($sql);
			$query->execute();
			for($i=0; $row = $query->fetch(); $i++){
				$str = "";
				foreach($row as $colName => $value) {
					if(!is_int($colName)) 
						$str .= $value . " ";
				}
				if($row[$this->idName] == $selected) {
					echo "<option value='" . $row[$this->idName] . "' selected >$str</option>\n";
				}
				else {
					echo "<option value='" . $row[$this->idName] . "'>$str</option>\n";
				}
			}
			unset($pdo); 
			unset($query);
		}
		catch(PDOException $error){
			//Display error message if applicable
			echo "An error occurred: ".$error->getMessage();
		}
	}
	
	//================================ CHANGED ===================================//
	
	//This function takes three parameters. First one is the Id for an object in the table in question, if it matches an existing object, this will be assigned as selected, if not just pass "All" or NULL to it. Second is the column you want to find matches for and third is the match you are looking for. It then echoes the options for a drop down menu with only the results of this query.
	function printDropDownOptionsByMatch($selected, $column, $match) {
		// Get function arguments.
		for ($i = 3; $i < func_num_args(); $i++) {
			$extraColumns[$i - 3] = func_get_arg($i);
		}
		
		// Make sql string.
		$sql = "SELECT " . $this->idName;
		if(isset($extraColumns)) {
			foreach($extraColumns as $value) {
				$sql .= " , " . $value; 
			}
		}
		$sql .=  " FROM " . $this->tableName . " WHERE " . $column . " = " . $match . " ORDER BY " . $this->idName . ";";
		
		// Execute our statement.
		$this->Connect();
		try {
			$query = $this->pdo->prepare($sql);
			$query->execute();
			for($i=0; $row = $query->fetch(); $i++){
				$str = "";
				foreach($row as $colName => $value) {
					if(!is_int($colName)) 
						$str .= $value . " ";
				}
				
				if($row[$this->idName] == $selected) {
					echo "<option value='" . $row[$this->idName] . "' selected >$str</option>\n";
				}
				else {
					echo "<option value='" . $row[$this->idName] . "'>$str</option>\n";
				}
			}
			unset($pdo); 
			unset($query);
		}
		catch(PDOException $error){
			//Display error message if applicable
			echo "An error occurred: ".$error->getMessage();
		}
	}
	
	//================================ END CHANGED ===================================//
	
	private function stripIndexedEntries($data) {
		foreach($data as $rowNum => $row) {
			foreach($row as $colName => $value) {
				if(is_int($colName)) {
					unset($row["$colName"]);
				}
			}
		}
		return $data;
	}
}
