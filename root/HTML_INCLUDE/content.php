<?PHP
//
// This script switches the correct content into the content div depending on the $page variable.
//

if ($page == "conference") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/conferences/view.php';
            break;
        case "edit":
            require 'PHP_PRES/conferences/edit.php';
            break;
        case "add":
            require 'PHP_PRES/conferences/add.php';
            break;
        case "delete":
            require 'PHP_PRES/conferences/delete.php';
            break;
        case "cloneView":
            require 'PHP_PRES/conferences/cloneView.php';
            break;
        case "clone":
            require 'PHP_PRES/conferences/clone.php';
    }
} else if ($page == "section") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/sections/view.php';
            break;
        case "edit":
            require 'PHP_PRES/sections/edit.php';
            break;
        case "add":
            require 'PHP_PRES/sections/add.php';
            break;
        case "delete":
            require 'PHP_PRES/sections/delete.php';
            break;
    }
} else if ($page == "session") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/session/view.php';
            break;
        case "edit":
            require 'PHP_PRES/session/edit.php';
            break;
        case "add":
            require 'PHP_PRES/session/add.php';
            break;
        case "delete":
            require 'PHP_PRES/session/delete.php';
            break;
    }
} else if ($page == "presenter") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/presenters/view.php';
            break;
        case "edit":
            require 'PHP_PRES/presenters/edit.php';
            break;
        case "add":
            require 'PHP_PRES/presenters/add.php';
            break;
        case "delete":
            require 'PHP_PRES/presenters/delete.php';
            break;
    }
} else if ($page == "attendee_profile") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/attendee_profile/view.php';
            break;
        case "edit":
            require 'PHP_PRES/attendee_profile/edit.php';
            break;
        case "add":
            require 'PHP_PRES/attendee_profile/add.php';
            break;
        case "delete":
            require 'PHP_PRES/attendee_profile/delete.php';
            break;
    }
} else if ($page == "user") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/users/view.php';
            break;
        case "edit":
            require 'PHP_PRES/users/edit.php';
            break;
        case "add":
            require 'PHP_PRES/users/add.php';
            break;
        case "delete":
            require 'PHP_PRES/users/delete.php';
            break;
    }
} else if ($page == "feedback_question") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/feedback_question/view.php';
            break;
        case "edit":
            require 'PHP_PRES/feedback_question/edit.php';
            break;
        case "add":
            require 'PHP_PRES/feedback_question/add.php';
            break;
    }
} else if ($page == "feedback_form") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/feedback_form/view.php';
            break;
        case "edit_s":
            require 'PHP_PRES/feedback_form/edit_s.php';
            break;
        case "add_s":
            require 'PHP_PRES/feedback_form/add_s.php';
            break;
        case "delete_s":
            require 'PHP_PRES/feedback_form/delete_s.php';
            break;
    }
} else if ($page == "polling_question") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/polling_question/view.php';
            break;
        case "edit":
            require 'PHP_PRES/polling_question/edit.php';
            break;
        case "add":
            require 'PHP_PRES/polling_question/add.php';
            break;
        case "delete":
            require 'PHP_PRES/polling_question/delete.php';
            break;
        case "result":
            require 'PHP_PRES/polling_question/result.php';
            break;
        case "availability":
            require 'PHP_PRES/polling_question/avail.php';
            break;

    }
} else if ($page == "polling_result") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/polling_result/view.php';
            break;
        case "result":
            require 'PHP_PRES/polling_result/result.php';
            break;

    }
} else if ($page == "sponsor") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/sponsors/view.php';
            break;
        case "edit":
            require 'PHP_PRES/sponsors/edit.php';
            break;
        case "add":
            require 'PHP_PRES/sponsors/add.php';
            break;
        case "delete":
            require 'PHP_PRES/sponsors/delete.php';
            break;
    }
} else if ($page == "review_question") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/review_question/view.php';
            break;
        case "edit":
            require 'PHP_PRES/review_question/edit.php';
            break;
        case "add":
            require 'PHP_PRES/review_question/add.php';
            break;
        case "delete":
            require 'PHP_PRES/review_question/delete.php';
            break;
        case "displaySelected":
            require 'PHP_PRES/review_question/displaySelected.php';
            break;
    }
} else if ($page == "map") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/map/view.php';
            break;
        case "edit":
            require 'PHP_PRES/map/edit.php';
            break;
        case "add":
            require 'PHP_PRES/map/add.php';
            break;
        case "delete":
            require 'PHP_PRES/map/delete.php';
            break;
        case "map_g":
            require 'PHP_PRES/map/map_google.php';
            break;
        case "map_f":
            require 'PHP_PRES/map/map_fixed.php';
            break;
    }
} else if ($page == "home") {
    require 'PHP_PRES/home.php';
} else if ($page == "reset") {
    switch ($action) {
        case "reset":
            require 'PHP_LOGIN/reset.php';
            break;
    }
} else if ($page == "venue") {
    switch ($action) {
        case "view":
            require 'PHP_PRES/venue/view.php';
            break;
        case "edit":
            require 'PHP_PRES/venue/edit.php';
            break;
        case "add":
            require 'PHP_PRES/venue/add.php';
            break;
        case "delete":
            require 'PHP_PRES/venue/delete.php';
            break;
    }
}else if ($page == "report") {
    switch ($action) {
        case "conference":
            require 'PHP_PRES/conferences/conference_report.php';
            break;
        case "section":
            require 'PHP_PRES/sections/section_report.php';
            break;
        case "session":
            require 'PHP_PRES/session/session_report.php';
            break;
       case "question":
            require 'PHP_PRES/feedback_question/question_report.php';
            break;
       case "polling":
            require 'PHP_PRES/polling_question/polling_report.php';
            break;
       case "feedback":
            require 'PHP_PRES/feedback_form/feedback_report.php';
            break;
    } 
}
// else if ($page == "map") {
//     switch ($action) {
//         case "view":
//             require 'PHP_PRES/map/view.php';
//             break;
//         case "edit":
//             require 'PHP_PRES/map/edit.php';
//             break;
//         case "add":
//             require 'PHP_PRES/map/add.php';
//             break;
//         case "delete":
//             require 'PHP_PRES/map/delete.php';
//             break;
//     }
// }

?>
