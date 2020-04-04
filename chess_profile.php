<?php
/* form.php */
    session_start();
    $_SESSION['message'] = '';
    $mysqli = new mysqli("localhost", "root", "", "bu_sports_club");

    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
        //define other variables with submitted values from $_POST
        $username = $mysqli->real_escape_string($_POST['NAME']);
        $dept = $mysqli->real_escape_string($_POST['DEPARTMENT']);
        $session = $mysqli->real_escape_string($_POST['SESSION']);
        $roll = $mysqli->real_escape_string($_POST['ROLL']);
        $reg = $mysqli->real_escape_string($_POST['REGISTRATION']);
        $email = $mysqli->real_escape_string($_POST['EMAIL']);
        $mbno = $mysqli->real_escape_string($_POST['MOBILE']);
        $birth = $mysqli->real_escape_string($_POST['DATE_OF_BIRTH']);
		$sex = $mysqli->real_escape_string($_POST['GENDER']);
		$lvl = $mysqli->real_escape_string($_POST['LEVEL']);

        //path were our avatar image will be stored
        $photo_path = $mysqli->real_escape_string('image/'.$_FILES['PHOTO']['name']);
        
        //make sure the file type is image
        if (preg_match("!image!",$_FILES['PHOTO']['type'])) {
            
            //copy image to images/ folder 
            if (copy($_FILES['PHOTO']['tmp_name'], $photo_path)){
                
                //set session variables to display on welcome page
                $_SESSION['NAME'] = $username;
                $_SESSION['PHOTO'] = $photo_path;
                $_SESSION['DEPARTMENT'] = $dept;
                $_SESSION['SESSION'] = $session;
                $_SESSION['ROLL'] = $roll;
                $_SESSION['GENDER'] = $sex;
                $_SESSION['LEVEL'] = $lvl;
                $_SESSION['DATE_OF_BIRTH'] = $birth;
                $_SESSION['MOBILE'] = $mbno;
                $_SESSION['REGISTRATION'] = $reg;
                $_SESSION['EMAIL'] = $email;

                //insert user data into database
                $sql = 
                "INSERT INTO chess (NAME, DEPARTMENT, SESSION, ROLL, REGISTRATION, EMAIL, MOBILE, DATE_OF_BIRTH, GENDER, LEVEL, PHOTO ) "
                . "VALUES ('$username', '$dept', '$session', '$roll', '$reg', '$email', '$mbno', '$birth', '$sex', '$lvl', '$photo_path')";
                
                //check if mysql query is successful
                if ($mysqli->query($sql) === true){
                    $_SESSION['message'] = "Registration successful!"
                    . "Added $username to the database!";
                    //redirect the user to welcome.php
                    header("location: welcome5.php");
                }
				else {
                    $_SESSION['message'] = 'User could not be added to the database!';
                }
                $mysqli->close();          
            }
            else {
                $_SESSION['message'] = 'File upload failed!';
            }
        }
        else {
            $_SESSION['message'] = 'Please only upload GIF, JPG or PNG images!';
        }
    }

?>

<?php include 'include/header.php'; ?>

	
	<div class="contentsection templete clear">
		<div id="sportsbody" class="maincontent clear">
			<div class="navsports  clear">
				<ul>
					<li><a href="cricket.php">Cricket</a></li>
					<li><a href="football.php">Football</a></li>
					<li><a href="volley.php">Volley</a></li>
					<li><a href="badminton.php">Badminton</a></li>
					<li><a  href="table_tennis.php">Table Tennis</a></li>
					<li><a id="active1" href="chess.php">Chess</a></li>
					<li><a href="carrom.php">Carrom Board</a></li>
					<li><a href="ludu.php">Ludu</a></li>
				</ul>
			</div>
                    <div class="pr_body clear">
                        <center>
						<form class="form" action="chess_profile.php" method="post" enctype="multipart/form-data" autocomplete="off">                          
						<table id="cr_tb">
						<h1 id="th1" style="color:#6cc0cb">Create Your Player Profile.</h1>
                                <tr id="cr_tr">
                                    <td>Name </td>
                                    <td>
                                        : <input placeholder="Enter your Name" type="text" name="NAME">
                                    </td>
                                </tr>
                                <tr id="cr_tr">
                                    <td>Department </td>
                                    <td>
                                        : <select id="cr_sel" name="DEPARTMENT">
                                            <option value="">--   Choose your Department   --</option>
                                            <option value="CSE">Computer Science & Engineering</option>
                                            <option value="MATH">Mathematics</option>
                                            <option value="CHEMISTRY">Chemistry</option>
                                            <option value="PHYSICS">Physics</option>
                                            <option value="LAW">Law</option>
                                            <option value="BOTANY">Botany</option>
                                            <option value="GEOLOGY">Geology & Mining</option>
                                            <option value="SOIL SCIENCE">Soil & Environmental Science</option>
                                            <option value="BANGLA">Bangla</option>
                                            <option value="ENGLISH">English</option>
                                            <option value="SOCIOLOGY">Sociology</option>
                                            <option value="ACCOUNTING">Accounting & Information System</option>
                                            <option value="MARKETING">Marketing</option>
                                            <option value="PHILOSOPHY">Philosophy</option>
                                            <option value="FINANCE">Finance & Banking</option>
                                            <option value="DISASTER MANAGEMENT">Disaster Management</option>
                                            <option value="ECONOMICS">Economics</option>
                                            <option value="POLITICAL SCIENCE">Political Science</option>
                                            <option value="PUBLIC ADMINSTRATION">Public Administration</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr id="cr_tr">
                                    <td>Session </td>
                                    <td>
                                        : <input placeholder="Session" type="text" name="SESSION">
                                    </td>
                                </tr>
                                <tr id="cr_tr">
                                    <td>Roll No </td>
                                    <td>
                                        : <input placeholder="Class Roll" type="text" name="ROLL">
                                    </td>
                                </tr>
                                <tr id="cr_tr">
                                    <td>Registration No </td>
                                    <td>
                                        : <input placeholder="Registration No" type="text" name="REGISTRATION">
                                    </td>
                                </tr>
                                <tr id="cr_tr">
                                    <td>Email </td>
                                    <td>
                                       : <input placeholder="Enter your Email" type="email" name="EMAIL">
                                    </td>
                                </tr>
                                <tr id="cr_tr">
                                    <td>Mobile No </td>
                                    <td>
                                       : <input placeholder="Enter your Mobile No" type="text" name="MOBILE">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date of Birth </td>
                                    <td>
                                        : <input id="cr_sel" type="date" name="DATE_OF_BIRTH">
                                    </td>
                                </tr>
                                <tr id="cr_tr">
                                    <td>Gender</td>
                                    <td id="cr_td">
                                        : <input type="radio" name="GENDER" value="male"> Male
                                          <span><input type="radio" name="GENDER" value="female"> Female</span>
                                          <input type="radio" name="GENDER" value="other"> Others
                                    </td>
                                </tr>
                                 <tr id="cr_tr">
                                    <td>Level</td>
                                    <td class="action">
                                        : <select id="cr_sel" name="LEVEL">
                                            <option value="action">--Choose Your Level--</option>
                                            <option value="BEGINNER">Beginner</option>
                                            <option value="MEDIUM">Medium</option>
                                            <option value="INTERMIDIATE">Intermidiate</option>
                                            <option value="HARD">Hard</option>
                                            <option value="ADVANCE">Advance</option>
                                            
                                        </select>
                                    </td>
                                </tr>
                                 <tr id="cr_tr">
                                    <td id="cr_td">Upload Photo </td>
                                    <td>
                                        : <input  type="file" name="PHOTO" accept="images/*"value="Choose photo">
                                    </td>
                                </tr>
                            </table>
                           <br/>
                            <input type="checkbox" value="check" name="check"> I agree with all terms and condition.<br/><br/>
                            <input class="but" type="submit" name="button" value="Create Profile">
                        </form>
                        </center>
                    </div>
                    
		</div>
	<div class="sidebar clear">
		<div class="search">
			<input id="src" type="text" placeholder="Search Chess Player" name="search"/><span><button class="button2" type=button>Search</button></span>

		</div>
			<div id="side" class="samesidebar clear">
				<img src="images/chess_tshirt.jpg" style="width:253px"/>
				
			</div>
			<img src="images/Chess_logo1.jpg" style="width:253px; height:50px"/>
			<div id="side1" class="samesidebar clear">
					<div class="bd_jursey clear">
						<img src="images/chess_tshirt1.jpg" style="width:250px; height:200px" />
					</div>
					<img id="love_cr" src="images/chch.jpg" style="width:250px; height:80px"/
	
			</div>
			
		</div>
        </div>
<?php include 'include/footer.php'; ?>

