<?php

// Data file routes
$app->get('/:id/conference.json', 'getConference');
$app->get('/:id/speaker.json', 'getSpeaker');
$app->get('/:id/schedule.json', 'getSchedule');
$app->get('/:id/conference-feedback.json', 'getConferenceFeedback');
$app->get('/:id/session-feedback.json', 'getSessionFeedback');
$app->get('/:id/sponsor.json', 'getSponsor');

// Other routes
$app->get('/image/:type/:id', 'getImage');
$app->get('/question-answer/:id', 'getQA');
$app->get('/:id/polling', 'getPolling');
$app->get('/:id/qa', 'getQASessions');

// Pages
$app->get('/view/polling/:id', 'showPolling');
$app->get('/data/polling/:id', 'getPollingResults')->name('polling-results');
$app->get('/view/qa/:id', 'showQA');

function getConference($id)
{
    global $app, $db;

    $sql = "SELECT c.id 'ID', c.title 'Title', c.Description 'Desc', c.Organiser 'Org', c.Start_Time 'Start', "
            . "End_Time 'End', v.Name 'VName', v.Street 'VStreet', v.Suburb 'VSuburb', v.Post_Code 'VPost'\n"
            . "FROM conference c, venue v\n"
            . "WHERE c.id=:id\n"
            . "AND c.Venue = v.ID";

    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Avoid unneeded queries
    if ($data) {

        $sql = "SELECT ID, Map_Directory 'Name', FilePath 'File' FROM map\n"
                . "WHERE Conference=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();

        $mapData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data['Maps'] = $mapData;
    }

    echo json_encode($data);
}

function getSpeaker($id)
{
    global $app, $db;

    // Prepare query for database
    $sql = "SELECT DISTINCT P.ID, concat(P.Title, ' ', P.First_Name, ' ', P.Last_Name, ' ', P.Qualification) 'Name', "
            . "P.Organisation 'Org', P.Medical_FIeld 'Field', P.Position, P.Qualification, P.Short_Bio 'Bio'\n"
            . "FROM presenter P, session_presenter SP, session S, conference_section CS, conference C\n"
            . "WHERE P.ID = SP.Presenter\n"
            . "AND SP.Session = S.ID\n"
            . "AND S.Conference_Section = CS.ID\n"
            . "AND CS.Conference = C.ID\n"
            . "AND C.ID=:id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Avoid unneeded queries
    if ($data) {

        $sql = "SELECT DISTINCT S.ID, S.Start_Time 'Time', S.Title 'Name', SP.Presenter\n"
                . "FROM session S, conference_section CS, session_presenter SP, conference C\n"
                . "WHERE S.Conference_Section = CS.ID\n"
                . "AND CS.Conference = :id\n"
                . "AND SP.Session = S.ID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();

        // Assign rows returned to data object
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            foreach ($data as $key => $item) {
                if ($item['ID'] == $row['Presenter']) {
                    if (!isset($item['Sessions'])) {
                        $data[$key]['Sessions'] = array();
                    }
                    array_push($data[$key]['Sessions'], $row);
                }
            }
        }
    }

    // Send json object
    echo json_encode($data);
}

function getSchedule($id)
{

    global $app, $db;

    //Prepare query for database
    $sql = "SELECT ID, Section_Title 'Name'\n"
            . "FROM conference_section CS\n"
            . "WHERE CS.Conference = :id\n"
            . "ORDER BY CS.Ordering";

    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();

    //Assign rows returned to data object
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Avoid unneeded queries
    if ($data) {

        $sql = "SELECT DISTINCT S.ID, S.Title 'Name', S.Description 'Desc', S.Room_Location 'Room', S.Start_Time 'Start', S.End_Time 'End', S.Conference_Section\n"
                . "FROM session S, conference_section CS\n"
                . "WHERE S.Conference_Section = CS.ID\n"
                . "AND CS.Conference = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            foreach ($data as $key => $item) {
                if ($item['ID'] == $row['Conference_Section']) {
                    if (!isset($item['Sessions'])) {
                        $data[$key]['Sessions'] = array();
                    }
                    unset($row['Conference_Section']);
                    array_push($data[$key]['Sessions'], $row);
                }
            }
        }

        //Prepare query for database
        $sql = "SELECT DISTINCT P.ID, concat(P.First_Name, ' ', P.Last_Name) 'Name', SP.Session\n"
                . "FROM session_presenter SP, presenter P, conference_section CS, session S\n"
                . "WHERE P.ID = SP.Presenter\n"
                . "AND S.Conference_Section = CS.ID\n"
                . "AND CS.Conference = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            foreach ($data as $key1 => $item1) {
                if ($item1['Sessions']) {
                    foreach ($item1['Sessions'] as $key2 => $item2) {
                        if ($item2['ID'] == $row['Session']) {
                            if (!isset($data[$key1]['Sessions'][$key2]['Speakers'])) {
                                $data[$key1]['Sessions'][$key2]['Speakers'] = array();
                            }
                            unset($row['Session']);
                            array_push($data[$key1]['Sessions'][$key2]['Speakers'], $row);
                        }
                    }
                }
            }
        }
    }

    //Send json object
    echo json_encode($data);
}

function getConferenceFeedback($id)
{
    global $app, $db;

    //Prepare query for database
    $sql = "SELECT FS.ID, FS.Type, FS.Section_Title 'Title'\n"
            . "FROM feedback_section FS, conference_fb_section CFS\n"
            . "WHERE FS.ID = CFS.feedback_section\n"
            . "AND CFS.Conference = :id;";

    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();

    //Assign rows returned to data object
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Avoid unneeded queries
    if ($data) {

        $sql = "SELECT DISTINCT FQ.ID, FQ.Question_Text 'Title', FQ.Type 'Type', FQ.feedback_section\n"
                . "FROM feedback_question FQ, feedback_section FS, conference_fb_section CFS\n"
                . "WHERE FQ.feedback_section = FS.ID\n"
                . "AND FS.ID = CFS.feedback_section\n"
                . "AND CFS.Conference = :id;";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            foreach ($data as $key => $item) {
                if ($item['ID'] == $row['feedback_section']) {
                    if (!isset($item['Questions'])) {
                        $data[$key]['Questions'] = array();
                    }
                    unset($row['feedback_section']);
                    array_push($data[$key]['Questions'], $row);
                }
            }
        }

        //Prepare query for database
        $sql = "SELECT DISTINCT FO.ID, FO.Option_Text 'Text', FO.feedback_question\n"
                . "FROM feedback_option FO, feedback_question FQ, feedback_section FS, conference_fb_section CFS\n"
                . "WHERE FO.feedback_question = FQ.ID\n"
                . "AND FQ.feedback_section = FS.ID\n"
                . "AND FS.ID = CFS.feedback_section\n"
                . "AND CFS.Conference = :id;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            foreach ($data as $key1 => $item1) {
                if (is_array($item1['Questions'])) {
                    foreach ($item1['Questions'] as $key2 => $item2) {
                        if ($item2['ID'] == $row['feedback_question']) {
                            if (!isset($data[$key1]['Questions'][$key2]['Options'])) {
                                $data[$key1]['Questions'][$key2]['Options'] = array();
                            }
                            unset($row['feedback_question']);
                            array_push($data[$key1]['Questions'][$key2]['Options'], $row);
                        }
                    }
                }
            }
        }
    }

    //Send json object
    echo json_encode($data);

    //echo '[{"ID":"27","Type":"Conference","Title":"Fb section demo conference feedback","Questions":[{"ID":"71","Title":"What colour are you hair?","Type":"1","Options":[{"ID":"119","Text":"black"},{"ID":"120","Text":"brown"},{"ID":"121","Text":"blond"}]},{"ID":"73","Title":"What\'s your hometown?","Type":"2","Options":[{"ID":"122","Text":"test1"},{"ID":"123","Text":"test2"}]},{"ID":"74","Title":"What\'s your mom\'s name?","Type":"2"}]},{"ID":"29","Type":"Conference","Title":"test"},{"ID":"30","Type":"Conference","Title":"test"}]';
}

function getSessionFeedback($id)
{
    global $app, $db;

    //Prepare query for database
    $sql = "SELECT DISTINCT FS.ID, FS.Type, FS.Section_Title\n"
            . "FROM feedback_section FS, session S, conference_section CS\n"
            . "WHERE FS.ID = S.feedback_section\n"
            . "AND CS.ID = S.conference_section\n"
            . "AND CS.Conference = :id;";

    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();

    //Assign rows returned to data object
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Avoid unneeded queries
    if ($data) {

        $sql = "SELECT DISTINCT FQ.ID, FQ.Question_Text 'Title', FQ.Type 'Type', FQ.feedback_section\n"
                . "FROM feedback_question FQ, feedback_section FS, session S, conference_section CS\n"
                . "WHERE FQ.feedback_section = FS.ID\n"
                . "AND FS.ID = S.feedback_section\n"
                . "AND CS.ID = S.conference_section\n"
                . "AND CS.Conference = :id;";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            foreach ($data as $key => $item) {
                if ($item['ID'] == $row['feedback_section']) {
                    if (!isset($item['Questions'])) {
                        $data[$key]['Questions'] = array();
                    }
                    unset($row['feedback_section']);
                    array_push($data[$key]['Questions'], $row);
                }
            }
        }

        //Prepare query for database
        $sql = "SELECT DISTINCT FO.ID, FO.Option_Text 'Text', FO.feedback_question\n"
                . "FROM feedback_option FO, feedback_question FQ, feedback_section FS, session S, conference_section CS\n"
                . "WHERE FO.feedback_question = FQ.ID\n"
                . "AND FQ.feedback_section = FS.ID\n"
                . "AND FS.ID = S.feedback_section\n"
                . "AND CS.ID = S.conference_section\n"
                . "AND CS.Conference = :id;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            foreach ($data as $key1 => $item1) {
                if (is_array($item1['Questions'])) {
                    foreach ($item1['Questions'] as $key2 => $item2) {
                        if ($item2['ID'] == $row['feedback_question']) {
                            if (!isset($data[$key1]['Questions'][$key2]['Options'])) {
                                $data[$key1]['Questions'][$key2]['Options'] = array();
                            }
                            unset($row['feedback_question']);
                            array_push($data[$key1]['Questions'][$key2]['Options'], $row);
                        }
                    }
                }
            }
        }
    }

    //Send json object
    echo json_encode($data);
}

function getSponsor($id)
{

    global $app, $db;

    //Prepare query for database
    $sql = "SELECT S.ID, S.Name, S.Short_Desc 'Desc', S.URL\n"
            . "FROM sponsor S, conference_sponsor CS, conference C\n"
            . "WHERE CS.Sponsor = S.ID\n"
            . "AND CS.Conference = C.ID\n"
            . "AND C.ID=:id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();
    //Assign rows returned to data object
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($row);
}

/**
 * Accepts an id of an images, which will be queried from a table
 * from the database and returned to the user.
 *
 * @param  $id - The ID of the image that is to be returned.
 *            $table - the table to which the query is to be performed.
 * @return $image - An image
 */
function getImage($type, $id)
{
    $app = \Slim\Slim::getInstance();

    switch ($type) {
        case 'sponsor':
            $dir = 'Sponsors';
            break;
        case 'speaker':
            $dir = 'Presenter';
            break;
        case 'venue':
            $dir = 'Venues';
            break;
        case 'map':
            $dir = 'Maps';
            break;
        case 'conference':
            $dir = 'Conference';
            break;

        default:
            die();
            break;
    }

    $fileName = preg_grep("/^" . $id . "\.((jpeg)|(jpg)|(png)|(gif))$/", scandir("../UPLOADED_FILES/" . $dir));
    $fileName = reset($fileName);
    if ($fileName == "") {
        $app->response->setStatus(404);
    }
    $file = "../UPLOADED_FILES/" . $dir . "/" . $fileName;


    if (exif_imagetype($file) == IMAGETYPE_JPEG) {
        $app->response()->header('Content-Type', 'image/jpeg');
    } else if (exif_imagetype($file) == IMAGETYPE_PNG) {
        $app->response()->header('Content-Type', 'image/png');
    } else if (exif_imagetype($file) == IMAGETYPE_GIF) {
        $app->response()->header('Content-Type', 'image/gif');
    }

    echo file_get_contents($file);
}

function getQA($id)
{
    global $app, $db;

    //Prepare query for database
    $sql = "SELECT Question FROM session_question WHERE session = :id AND Accepted = 1;";
    //$sql = "SELECT Question FROM session_question WHERE session = :id;";
    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

function getPolling($id)
{
    global $app, $db;

    //Prepare query for database
    $sql = "SELECT DISTINCT P.ID, P.Polling_Question 'Title', S.ID 'Session_ID', S.Title 'Session_Title'\n"
            . "FROM polling P, session S, conference_section CS\n"
            . "WHERE P.session = S.ID\n"
            . "AND CS.ID = S.conference_section\n"
            //. "AND P.Open = 1\n"
            . "AND CS.Conference = :id;";

    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();

    //Assign rows returned to data object
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Avoid unneeded queries
    if ($data) {

        $sql = "SELECT DISTINCT PO.ID, PO.Option_Text 'Text', PO.polling\n"
                . "FROM polling_option PO, polling P, session S, conference_section CS\n"
                . "WHERE PO.polling = P.ID\n"
                . "AND P.session = S.ID\n"
                . "AND CS.ID = S.conference_section\n"
                . "AND CS.Conference = :id;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            foreach ($data as $key => $item) {
                if ($item['ID'] == $row['polling']) {
                    if (!isset($item['Options'])) {
                        $data[$key]['Options'] = array();
                    }
                    unset($row['polling']);
                    array_push($data[$key]['Options'], $row);
                }
            }
        }
    }

    $app->response->headers->set('Content-Type', 'application/json');
    //Send json object
    echo json_encode($data);
}

function getQASessions($id)
{
    global $app, $db;

    //Prepare query for database
    $sql = "SELECT S.ID, S.Title\n"
            . "FROM session S, conference_section CS\n"
            . "WHERE CS.ID = S.conference_section\n"
            //. "AND S.QA_Open = 1\n"
            . "AND CS.Conference = :id;";

    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();

    //Send json object
    $app->response->headers->set('Content-Type', 'application/json');
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

function showPolling($id)
{
    global $app, $db;

    $sql = "SELECT P.Polling_Question 'Question'\n"
            . "FROM polling P\n"
            . "WHERE P.ID = :id;";

    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();

    $app->render('polling.php', Array('Question' => $stmt->fetch(PDO::FETCH_ASSOC)['Question'],
            'URL' => $app->urlFor('polling-results', array('id' => $id))));
}

function getPollingResults($id)
{
    global $app, $db;

    $sql = "SELECT P.Polling_Question 'Question', COUNT(*) 'Count', PO.Option_Text 'Label'\n"
            . "FROM polling_response PR, polling_option PO, polling P\n"
            . "WHERE PO.ID = PR.polling_option\n"
            . "AND P.ID = PO.polling\n"
            . "AND P.ID = :id\n"
            . "GROUP BY PR.polling_option";

    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();

    $app->response->headers->set('Content-Type', 'application/json');
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

function showQA($id)
{
    global $app, $db;

    //Prepare query for database
    $sql = "SELECT Question FROM session_question WHERE session = :id AND Accepted = 1;";
    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();

//    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    $app->render('qa.php', Array('QA' => $stmt->fetchAll(PDO::FETCH_ASSOC)));
}