<?PHP

require "dbCondet.php";
require "dbTable.php";

class Conference extends Table {
	function Conference(){
		parent::init();
		$this->tableName = "conference";
		$this->idName = "ID";
	}

    function getRowWithVenueName($id) {
        $sql = "SELECT conference.ID, Title, Description, Start_Time, End_Time, Organiser, Location, Contact, Name FROM conference, venue WHERE Venue = venue.ID";
        if(isset($id))
            $sql = "SELECT conference.ID, Title, Description, Start_Time, End_Time, Organiser, Location, Contact, Name FROM conference, venue WHERE Venue = venue.ID AND conference.ID = :id";
        $this->Connect();
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute(["id" =>$id]);
            $results = $query->fetchAll();
            if($results == null) {
                echo $this->pdo->errorInfo()[2];
            }
            unset($pdo);
            unset($query);

            return $results;
        }
        catch(PDOException $error){
            // Display error message if applicable
            echo "An error occurred: ".$error->getMessage();
        }
    }

}

class Venue extends Table {
    function Venue(){
        parent::init();
        $this->tableName = "venue";
    }
}

class Section extends Table {
    function Section(){
        parent::init();
        $this->tableName = "conference_section";
    }
}

class Session extends Table {
    function Session(){
        parent::init();
        $this->tableName = "session";
    }
}

class SessionPresenter extends Table {
    function SessionPresenter(){
        parent::init();
        $this->tableName = "session_presenter";
        $this->idName = "Presenter";
    }
}

class Presenter extends Table {
    function Presenter(){
        parent::init();
        $this->tableName = "presenter";
    }
}

class AttendeeProfile extends Table {
    function AttendeeProfile(){
        parent::init();
        $this->tableName = "attendee_profile";
    }
}

class Feedback extends Table {
    function Feedback(){
        parent::init();
        $this->tableName = "feedback";
    }
}

class FeedbackSection extends Table {
    function FeedbackSection(){
        parent::init();
        $this->tableName = "feedback_section";
    }
}

class FeedbackQuestion extends Table {
    function FeedbackQuestion(){
        parent::init();
        $this->tableName = "feedback_question";
    }
}

class FeedbackOption extends Table {
    function FeedbackOption(){
        parent::init();
        $this->tableName = "feedback_option";
    }
}

class Sponsor extends Table {
    function Sponsor(){
        parent::init();
        $this->tableName = "sponsor";
    }
}

class ConferenceSponsor extends Table {
    function ConferenceSponsor(){
        parent::init();
        $this->tableName = "conference_sponsor";
        $this->idName = "Conference";
    }
}

class SessionQuestion extends Table {
    function SessionQuestion(){
        parent::init();
        $this->tableName = "session_question";
    }
}

class Polling extends Table {
    function Polling(){
        parent::init();
        $this->tableName = "polling";
    }
}

//================================ CHANGED ===================================//

class PollingQuestion extends Table {
    function PollingQuestion(){
        parent::init();
        $this->tableName = "polling";
    }
}

//================================ END CHANGED ===================================//

class PollingOption extends Table {
    function PollingOption(){
        parent::init();
        $this->tableName = "polling_option";
    }
}

class User extends Table {
    function User() {
        parent::init();
        $this->tableName = "user";
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
class Data {
	function Data() {
        $this->conference 		= new Conference();
        $this->venue 			= new Venue();
        $this->section			= new Section();
        $this->session 			= new Session();
        $this->presenter 		= new Presenter();
        $this->sessionPresenter	= new SessionPresenter();
        $this->attendeeProfile 	= new AttendeeProfile();
        $this->feedback 		= new Feedback();
        $this->feedbackSection	= new FeedbackSection();
        $this->feedbackQuestion	= new FeedbackQuestion();
        $this->feedbackOption	= new FeedbackOption();
        $this->sponsor			= new Sponsor();
        $this->conferenceSponsor= new ConferenceSponsor();
        $this->sessionQuestion  = new SessionQuestion();
		$this->polling			= new Polling();
		//================================ CHANGED ===================================//
        $this->pollingQuestion	= new PollingQuestion();
		//================================ END CHANGED ===================================//
        $this->pollingOption	= new PollingOption();
        $this->user             = new User();
	}
}
