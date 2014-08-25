<table>
<tr>
    <td style="padding-left:20px" class='navBarTd'>
        <img src="ASSETS/TMPIMG/navbarTextLogo.png" height="40px"/>
    </td>

    <td style="padding-left:15px" class='navBarTd'>
    	<?PHP    
            if($page == "home") {
                echo "<span class='nav_selected_item'>Home</span>";
            }
            else {
                echo "<a href='index.php?page=home' title='Home'>Home</a>";
            }
        ?>
    </td>
    
    <td style="padding-left:5px" class='navBarTd'>
		<?PHP    
            if($page == "conference") {
                echo "<span class='nav_selected_item'>Conference</span>";
            }
            else {
                echo "<a href='index.php?page=conference' title='Conference'>Conference</a>";
            }
        ?>
    </td>
    
    <td style="padding-left:5px" class='navBarTd'>
		<?PHP    
            if($page == "section") {
                echo "<span class='nav_selected_item'>Section</span>";
            }
            else {
                echo "<a href='index.php?page=section' title='Section'>Section</a>";
            }
        ?>
    </td>
    
    <td style="padding-left:5px" class='navBarTd'>
		<?PHP    
            if($page == "session") {
                echo "<span class='nav_selected_item'>Session</span>";
            }
            else {
                echo "<a href='index.php?page=session' title='Session'>Session</a>";
            }
        ?>
    </td>
    <td style="padding-left:5px" class='navBarTd'>
        <?PHP    
            if($page == "presenter") {
                echo "<span class='nav_selected_item'>Presenter</span>";
            }
            else {
                echo "<a href='index.php?page=presenter' title='Presenter'>Presenter</a>";
            }
        ?>
    </td>
    <td style="padding-left:5px" class='navBarTd'>
        <?PHP    
            if($page == "user") {
                echo "<span class='nav_selected_item'>User</span>";
            }
            else {
                echo "<a href='index.php?page=user' title='User'>User</a>";
            }
        ?>
    </td>
    
    <td style="padding-left:5px" class='navBarTd'>
    	<?PHP
			if($page == "feedback_question") {
				echo "<span class='nav_selected_item'>Feedback</span>";
			}
			else {
				echo"<a href='index.php?page=feedback_question' title='Feedback Question'>Feedback</a>";
			}
		?>
    </td>
    <!--//================================ CHANGED ===================================// -->
    <td style="padding-left:5px" class='navBarTd'>
    	<?PHP
			if($page == "polling_question")
			{
				echo "<span class='nav_selected_item'>Polling</span>";
			}
			else
			{
				echo"<a href='index.php?page=polling_question' title='Polling'>Polling</a>";
			}
		?>
    </td>
    <!--//================================ END CHANGED ===================================// -->
    <td style="padding-left:5px" class='navBarTd'>
    	<?PHP
			if($page == "attendee_profile") {
				echo "<span class='nav_selected_item'>Attendees</span>";
			}
			else {
				echo"<a href='index.php?page=attendee_profile' title='Attendee Profile'>Attendees</a>";
			}
		?>
    </td>
    <td style="padding-top:3px;">

    </td>
</tr>
</table>
<div id="navUserIcon"><img src="ASSETS/TMPIMG/iconmonstr-user-6-icon.svg" height="35px" style="fill:#FFFFFF;"/></div>

<div id="divUserInfo" class="userInfoPane">
    <p>Welcome, <strong><em><?=$headerUserName?></em></strong></p>
    <a href="PHP_LOGIN/logout.php" style="">
        <img src="ASSETS/TMPIMG/iconmonstr-logout-icon.svg" height="30"/>
        Log out
    </a>
</div>

<script>
    $(function() {
        $("#divUserInfo").hide();
        $("#navUserIcon").mouseenter(function(event) {
            //$("#divUserInfo").show();
            $( "#divUserInfo" ).fadeIn( "fast", null);
        })
        $("#divUserInfo").mouseleave(function(event) {
            //$("#divUserInfo").hide();
            $( "#divUserInfo" ).fadeOut( "fast", null);
        })
        $( window ).resize(function() {

        });
    })



</script>
