<?PHP
/*                                                            
         _____ _____ _____ _____    _____ _____ _____ _____ _____ _____ 
        |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
          | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
          |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
                                                                        
         * File: nav.php
         * Navigation bar for the dstc eConference web application.
         * Written by TEAM SPARTA 
         * Last updated: 06-06-14 by Caue Motta
        */

?>

<!-- Function to hide and show sub-menu items programatically -->
<script type="text/javascript">
    $(function () {
        $('li').has('ul').mouseover(function () {
            $(this).children('ul').show();
        }).mouseout(function () {
            $(this).children('ul').hide();
        })
    });
</script>
<ul id="menu">
<!-- Insert logo -->
<li style="padding-left:20px">
    <img src="ASSETS/TMPIMG/banner_eConference.png" height="50px"/>
</li>

<li style="padding-left:15px">
    <!-- HOME -->
    <?PHP
    if ($page == "home") {
        //If page is selected change link style
        echo "<a href='#'><span class='nav_selected_item'>Home</span></a>";
    } else {
        //If page is not selected leave menu link style
        echo "<a href='index.php?page=home' title='Home'>Home</a>";
    }
    ?>
</li>

<!-- CONFERENCE -->
<li>
    <?PHP
    if ($page == "conference") {
        //If page is selected change link style
        echo "<a href='#'><span class='nav_selected_item'>Conference</span></a>";
    } else {
        //If page is not selected leave menu link style
        echo "<a href='index.php?page=conference' title='Conference'>Conference</a>";
    }
    ?>
    <!-- Create sub-menu links -->
    <ul>
        <li>
            <a href='index.php?page=conference&action=view'> View All</a>
        <?PHP	if($accesslevel == "1"){ ?>
            <ul>
                <li>
                    <a href='index.php?page=conference&action=add'> Add New</a>
                </li>
                <li>
                    <a href='index.php?page=conference&action=cloneView'> Clone</a>
                </li>
            </ul>
            <?php } ?>
        </li>
    </ul>
</li>

<!-- SECTION -->
<li>
    <?PHP
    if ($page == "section") {
        //If page is selected change link style
        echo "<a href='#'><span class='nav_selected_item'>Section</span></a>";
    } else {
        //If page is not selected leave menu link style
        echo "<a href='index.php?page=section' title='Section'>Section</a>";
    }
    ?>
    <!-- Create sub-menu links -->
    <ul>
        <li>
            <a href='index.php?page=section&action=view'> View All</a>
            <ul>
                <li>
                    <a href='index.php?page=section&action=add'> Add New</a>
                </li>
            </ul>
        </li>
    </ul>
</li>

<!-- SESSION -->
<li>
    <?PHP
    if ($page == "session") {
        //If page is selected change link style
        echo "<a href='#'><span class='nav_selected_item'>Session</span></a>";
    } else {
        //If page is not selected leave menu link style
        echo "<a href='index.php?page=session' title='Session'>Session</a>";
    }
    ?>
    <!-- Create sub-menu links -->
    <ul>
        <li>
            <a href='index.php?page=session&action=view'> View All</a>
            <ul>
                <li>
                    <a href='index.php?page=session&action=add'> Add New</a>
                </li>
            </ul>
        </li>
    </ul>
</li>

<!-- PRESENTER -->
<li>
    <?PHP
    if ($page == "presenter") {
        //If page is selected change link style
        echo "<a href='#'><span class='nav_selected_item'>Presenter</span></a>";
    } else {
        //If page is not selected leave menu link style
        echo "<a href='index.php?page=presenter' title='Presenter'>Presenter</a>";
    }
    ?>
    <!-- Create sub-menu links -->
    <ul>
        <li>
            <a href='index.php?page=presenter&action=view'> View All</a>
            <ul>
                <li>
                    <a href='index.php?page=presenter&action=add'> Add New</a>
                </li>
            </ul>
        </li>
    </ul>
</li>

<!-- USER -->
<li>
    <?PHP
	if($accesslevel == "1"){
		if ($page == "user") {
			//If page is selected change link style
			echo "<a href='#'><span class='nav_selected_item'>User</span></a>";
		} else {
			//If page is not selected leave menu link style
			echo "<a href='index.php?page=user' title='User'>User</a>";
		}
	}
    ?>
    <!-- Create sub-menu links -->
    <ul>
        <li>
            <a href='index.php?page=user&action=view'> View All</a>
            <ul>
                <li>
                    <a href='index.php?page=user&action=add'> Add New</a>
                </li>
            </ul>
        </li>
    </ul>
</li>

<!-- FORMS -->
<li>
    <?PHP
    if ($page == "feedback_form") {
        //If page is selected change link style
        echo "<a href='#'><span class='nav_selected_item'>Forms</span></a>";
    } else {
        //If page is not selected leave menu link style
        echo "<a href='index.php?page=feedback_form' title='Feedback Form'>Forms</a>";
    }
    ?>
    <!-- Create sub-menu links -->
    <ul>
        <li>
            <a href='index.php?page=feedback_form&action=view'> View Forms</a>
            <ul>
               <li>
                    <a href='index.php?page=feedback_form&action=add_fb'> Add Feedback Form</a>
                </li>
                 <li>
                    <a href='index.php?page=feedback_form&action=add_s'> Add Feedback Section</a>
                </li>
            </ul>
        </li>
    </ul>
</li>

<!-- FEEDBACK -->
<li>
    <?PHP
    if ($page == "feedback_question") {
        //If page is selected change link style
        echo "<a href='#'><span class='nav_selected_item'>Feedback</span></a>";
    } else {
        //If page is not selected leave menu link style
        echo "<a href='index.php?page=feedback_question' title='Feedback Question'>Feedback</a>";
    }
    ?>
    <!-- Create sub-menu links -->
    <ul>
        <li>
            <a href='index.php?page=feedback_question&action=view'> View All</a>
            <ul>
                <li>
                    <a href='index.php?page=feedback_question&action=add'> Add New</a>
                </li>
            </ul>
        </li>
    </ul>
</li>

<!-- POLLING -->
<li style="padding-left:5px">
    <?PHP
    if ($page == "polling_question") {
        //If page is selected change link style
        echo "<a href='#'><span class='nav_selected_item'>Polling</span></a>";
    } else {
        //If page is not selected leave menu link style
        echo "<a href='index.php?page=polling_question' title='Polling'>Polling</a>";
    }
    ?>
    <!-- Create sub-menu links -->
    <ul>
        <li>
            <a href='index.php?page=polling_question&action=view'> View All</a>
            <ul>
                <li>
                    <a href='index.php?page=polling_question&action=add'> Add New</a>
                </li>
            </ul>
        </li>
    </ul>
</li>

<!-- QUESTIONS -->
<li>
    <?PHP
    if ($page == "review_question") {
        //If page is selected change link style
        echo "<a href='#'><span class='nav_selected_item'>Questions</span></a>";
    } else {
        //If page is not selected leave menu link style
        echo "<a href='index.php?page=review_question' title='Feedback Question'>Questions</a>";
    }
    ?>
    <!-- Create sub-menu links -->
    <ul>
        <li>
            <a href='index.php?page=review_question&action=view'> View All</a>
        </li>
    </ul>
</li>

<!-- SPONSOR -->
<li>

    <?PHP
    if ($page == "sponsors") {
        //If page is selected change link style
        echo "<a href='#'><span class='nav_selected_item'>Sponsors</span></a>";
    } else {
        //If page is not selected leave menu link style
        echo "<a href='index.php?page=sponsor' title='Sponsors'>Sponsors</a>";
    }
    ?>
    <!-- Create sub-menu links -->
    <ul>
        <li>
            <a href='index.php?page=sponsor&action=view'> View All</a>
            <ul>
                <li>
                    <a href='index.php?page=sponsor&action=add'> Add New</a>
                </li>
            </ul>
        </li>
    </ul>
</li>

<!-- VENUE -->
<li>

    <?PHP
    if ($page == "venue") {
        //If page is selected change link style
        echo "<a href='#'><span class='nav_selected_item'>Venues</span></a>";
    } else {
        //If page is not selected leave menu link style
        echo "<a href='index.php?page=venue' title='Venues'>Venues</a>";
    }
    ?>
    <!-- Create sub-menu links -->
    <ul>
        <li>
            <a href='index.php?page=venue&action=view'> View All</a>
            <ul>
                <li>
                    <a href='index.php?page=venue&action=add'> Add New</a>
                </li>
            </ul>
        </li>
    </ul>
</li>

<!-- REPORT -->
<li>

    <?PHP
    //New commit - hello
    if ($page == "report") {
        //If page is selected change link style
        echo "<a href='#'><span class='nav_selected_item'>Report</span></a>";
    } else {
        //If page is not selected leave menu link style
        echo "<a href='index.php?page=report' title='Report'>Report</a>";
    }
    ?>
    <!-- Create sub-menu links -->
    <ul>
        <li>
            <a href='index.php?page=report&action=conference'>Conference</a>
        </li>
        <li>
            <a href='index.php?page=report&action=section'>Section</a>
        </li>
        <li>
            <a href='index.php?page=report&action=session'>Session</a>
        </li>
        <li>
            <a href='index.php?page=report&action=question'>Question</a>
        </li>
        <li>
            <a href='index.php?page=report&action=polling'>Polling</a>
        </li>
        <li>
            <a href='index.php?page=report&action=feedback'>Feedback</a>
        </li>
    </ul>
</li>

<!-- LOGOUT -->
<li>
    <!-- Create user menu item -->
    <a href=""><span class="textUser" style="
    font-size:9px;"><b>
                <sulong><em><?= $headerUserName ?></em></sulong>
            </b></span>
        <img src="ASSETS/TMPIMG/user.ico" height="20"/></a>
    <ul>
        <!-- Create logout sub-menu item -->
        <li>
            <a href="PHP_LOGIN/logout.php" style="">
                <img src="ASSETS/TMPIMG/logout.png" height="30"/>
                Log out
            </a>
        </li>
    </ul>
</li>
</ul>
