<!DOCTYPE html>
<html>

<head>
    <title>Student Management System</title>
    <link rel="stylesheet" href="adminDashboard.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <?php
    session_start();
    $x=" ";
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "sims");
    ?>

</head>
<body>
    <div id="header"><br>
        <center>
            <div class="logo">
                Student Management System
            </div>
            <div class="info">
                <b><i class="fa fa-user" aria-hidden="true"></i> UserID:&nbsp;</b><?php echo $_SESSION['userid']; ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <b>Name:&nbsp;</b><?php echo $_SESSION['name']; ?>
            </div>
            <div class="logout">
                <a href="logout.php" onclick="logout()"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout<a>
            </div>
        </center>
    </div>
    <span id="topSpan">
        <marquee behavior="" direction="">This portal is available from Dec 28 </marquee>
    </span>
    <!---------------------------------------buttons----------------------------------------->
    <div id=leftSide>
        <form action="" method="post">
            <table>
                <tr>
                    <td>
                        <input type="submit" name="searchStudent" value="Search">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="editStudent" value="Edit">
                    </td>
                </tr>
               
                <tr>
                    <td>
                        <input type="submit" name="addStudent" value="Add">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="deleteStudent" value="Delete" class="button">
                    </td>
                </tr>
            </table>
        </form>
    </div>
<!--   -->



    <!----------------------------------------------------search student--------------------------------------------------->
        <div id="rightSide"><br><br>
        <div id="demo">
        <?php
    if (isset($_POST['searchStudent'])) {
    ?>
        <center>
            <form action="" method="post" id="search-modify">
                <b>Enter USN to search:</b>
                <input type="text" name="USN" id="usn-placeholder" placeholder="Enter your USN" required>
                <input type="submit" name="searchStudentByUSN" value="Search" id="search-placeholder">
            </form><br><br>
        </center>
        <?php
    }
    ?>
    <?php
    if (isset($_POST['searchStudentByUSN'])) 
    {
        $query = "select * from student where USN='$_POST[USN]'";
        $query_run = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query_run))
         {
        ?>
            <!---------details table--------->
                <table class="data">
                    <h1 class="details">Details:</h1>
                    <tr>
                        <td>
                            <b>USN:</b>
                        </td>
                        <td>
                            <input type="text" name="USN" value="<?php echo $row['USN'] ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>First Name:</b>
                        </td>
                        <td>
                            <input type="text" name="firstName" value="<?php echo $row['firstName'] ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Last Name:</b>
                        </td>
                        <td>
                            <input type="text" name="lastName" value="<?php echo $row['lastName'] ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Phone No:</b>
                        </td>
                        <td>
                            <input type="text" name=" phoneNumber" value="<?php echo $row['phoneNumber'] ?>"disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Email:</b>
                        </td>
                        <td>
                            <input type="text" name="email" value="<?php echo $row['email'] ?>"disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DOB:</b>
                        </td>
                        <td>
                            <input type="text" name="DOB" value="<?php echo $row['DOB'] ?>"disabled>
                        </td>
                    </tr>
                    <?php
                  
                   $query = "SELECT department.departmentName
                   FROM department
                   INNER JOIN student ON 
                   department.departmentID = student.departmentID
                   where USN='$_POST[USN]'";
                   $query_run = mysqli_query($connection, $query);
           
                   while ($row = mysqli_fetch_assoc($query_run)){
                   ?>
                   <tr>
                        <td>
                            <b>sem:</b>
                        </td>
                        <td>
                            <input type="text" name="department" 
                            value="<?php echo $row['departmentName']?>">
                        </td>
                    </tr>
                    <?php
                   }
                   ?>

                   
           
                </table>
            <?php
        }
            ?>
            <!---------attendance table--------->
            <?php
        $query = "select * from attendance where USN='$_POST[USN]'";
        $query_run = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query_run))
        {
            ?>
                <table class="edit-data">
                    <h1 class="attendance">Attendance:</h1>
                    <tr>
                        <td>
                            <b>semester 1:</b>
                        </td>
                        <td>
                            <input type="text" name="semester1" value="<?php echo $row['semester1'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 2:</b>
                        </td>
                        <td>
                            <input type="text" name="semester2" value="<?php echo $row['semester2'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 3:</b>
                        </td>
                        <td>
                            <input type="text" name="semester3" value="<?php echo $row['semester3'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 4:</b>
                        </td>
                        <td>
                            <input type="text" name=" semester4" value="<?php echo $row['semester4'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 5:</b>
                        </td>
                        <td>
                            <input type="text" name="semester5" value="<?php echo $row['semester5'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 6:</b>
                        </td>
                        <td>
                            <input type="text" name="semester6" value="<?php echo $row['semester6'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 7:</b>
                        </td>
                        <td>
                            <input type="text" name="semester7" value="<?php echo $row['semester7'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 8:</b>
                        </td>
                        <td>
                            <input type="text" name="semester8" value="<?php echo $row['semester8'] ?>">
                        </td>
                    </tr>
                </table>
                <?php
                }
                ?>
            <!---------result table--------->
            <?php
        $query = "select * from result where USN='$_POST[USN]'";
        $query_run = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query_run))
        {
            ?>
                <table class="edit-data">
                    <h1 class="result">Result:</h1>
                    <tr>
                        <td>
                            <b>semester 1:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa1" value="<?php echo $row['sgpa1'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 2:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa2" value="<?php echo $row['sgpa2'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 3:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa3" value="<?php echo $row['sgpa3'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 4:</b>
                        </td>
                        <td>
                            <input type="text" name=" sgpa4" value="<?php echo $row['sgpa4'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 5:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa5" value="<?php echo $row['sgpa5'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 6:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa6" value="<?php echo $row['sgpa6'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 7:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa7" value="<?php echo $row['sgpa7'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 8:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa8" value="<?php echo $row['sgpa8'] ?>">
                        </td>
                    </tr>
                </table>
                <input type="submit" name="add" value="save">
        </form>
                <?php
                }
        
    }
        ?>
    <!---------------------------------------edit student------------------------------------------------------------>
    <?php
    if (isset($_POST['editStudent'])) 
    {
    ?>
        <center>
            <form action="" method="post" id="search-modify">
                <b>Enter USN to edit:</b>
                <input type="text" name="USN" id="usn-placeholder" placeholder="Enter your USN" required>
                <input type="submit" name="editStudentByUSN" value="Search" id="search-placeholder">
            </form><br><br>
        </center>
        <?php
    }
    
    if (isset($_POST['editStudentByUSN'])) 
    { 
          $query = "select * from student  where USN='$_POST[USN]'";
        $query_run = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query_run))
         {
        ?>
        <form action="editStudent.php" method="post">
            <!---------details table--------->
                <table class="edit-data">
                    <h1 class="details">Details:</h1>
                    <tr>
                        <td>
                            <b>USN:</b>
                        </td>
                        <td>
                            <input type="text" name="USN" value="<?php echo $row['USN'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>First Name:</b>
                        </td>
                        <td>
                            <input type="text" name="firstName" value="<?php echo $row['firstName'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Last Name:</b>
                        </td>
                        <td>
                            <input type="text" name="lastName" value="<?php echo $row['lastName'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Phone No:</b>
                        </td>
                        <td>
                            <input type="text" name=" phoneNumber" value="<?php echo $row['phoneNumber'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Email:</b>
                        </td>
                        <td>
                            <input type="text" name="email" value="<?php echo $row['email'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DOB:</b>
                        </td>
                        <td>
                            <input type="text" name="DOB" value="<?php echo $row['DOB'] ?>">
                        </td>
                    </tr>
                    <?php
                    $query2 = "SELECT department.departmentName
                   FROM department
                   INNER JOIN student ON 
                   department.departmentID = student.departmentID
                   where USN='$_POST[USN]'";
                   $query_run2 = mysqli_query($connection, $query2);
           
                   while ($row2 = mysqli_fetch_assoc($query_run2))
                   {
                   ?>
                   <tr>
                        <td>
                            <b>sem:</b>
                        </td>
                        <td>
                            <input type="text" name="department" 
                            value="<?php echo $row2['departmentName']?>">
                        </td>
                    </tr>
                    <?php
                   }
                   ?>
            <?php
        }
            ?>
            <!---------attendance table--------->
            <?php
        $query = "select * from attendance where USN='$_POST[USN]'";
        $query_run = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query_run))
        {
            ?>
                <table class="edit-data">
                    <h1 class="attendance">Attendance:</h1>
                    <tr>
                        <td>
                            <b>semester 1:</b>
                        </td>
                        <td>
                            <input type="text" name="semester1" value="<?php echo $row['semester1'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 2:</b>
                        </td>
                        <td>
                            <input type="text" name="semester2" value="<?php echo $row['semester2'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 3:</b>
                        </td>
                        <td>
                            <input type="text" name="semester3" value="<?php echo $row['semester3'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 4:</b>
                        </td>
                        <td>
                            <input type="text" name=" semester4" value="<?php echo $row['semester4'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 5:</b>
                        </td>
                        <td>
                            <input type="text" name="semester5" value="<?php echo $row['semester5'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 6:</b>
                        </td>
                        <td>
                            <input type="text" name="semester6" value="<?php echo $row['semester6'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 7:</b>
                        </td>
                        <td>
                            <input type="text" name="semester7" value="<?php echo $row['semester7'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 8:</b>
                        </td>
                        <td>
                            <input type="text" name="semester8" value="<?php echo $row['semester8'] ?>">
                        </td>
                    </tr>
                </table>
                
                <?php
                }
                ?>
            <!---------result table--------->
            <?php
        $query = "select * from result where USN='$_POST[USN]'";
        $query_run = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query_run))
        {
            ?>
                <table class="edit-data">
                    <h1 class="result">Result:</h1>
                    <tr>
                        <td>
                            <b>semester 1:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa1" value="<?php echo $row['sgpa1'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 2:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa2" value="<?php echo $row['sgpa2'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 3:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa3" value="<?php echo $row['sgpa3'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 4:</b>
                        </td>
                        <td>
                            <input type="text" name=" sgpa4" value="<?php echo $row['sgpa4'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 5:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa5" value="<?php echo $row['sgpa5'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 6:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa6" value="<?php echo $row['sgpa6'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 7:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa7" value="<?php echo $row['sgpa7'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 8:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa8" value="<?php echo $row['sgpa8'] ?>">
                        </td>
                    </tr>
                </table>
                <input type="submit" name="add" value="save">
        </form>
                <?php
                }
     
            }?>
       
<!-- -----------------------------------add student------------------------------------------------------------- -->

<?php
            if(isset($_POST['addStudent']))
           {
         ?>
                <center><h4>Fill the details</h4></center>
               <form action="addStudent.php" method="post">
               <table class="data">
               <tr>
                   <td>student LoginID</td>
                   <td><input type="text" name="studentLoginID" ></td>
               </tr>
               <tr>
                   <td>password</td>
                   <td><input type="text" name="password" ></td>
               </tr>
               <tr>
                   <td>USN</td>
                   <td><input type="text" name="USN" ></td>
               </tr>
               <tr>
                   <td>First name</td>
                   <td><input type="text" name="firstName"></td>
               </tr>
               <tr>
                   <td>Last name</td>
                   <td><input type="text" name="lastName" ></td>
               </tr>
               <tr>
                   <td>Phone no</td>
                   <td><input type="text" name="phoneNumber" ></td>
               </tr>
               <tr>
                   <td>DOB</td>
                   <td><input type="text" name="DOB" ></td>
               </tr>
               <tr>
                   <td>Email</td>
                   <td><input type="text" name="email" ></td>
               </tr>
               </tr>
               <tr>
                   <td>semester</td>
                   <td><input type="text" name="semester" ></td>
               </tr>
               </tr>
               <tr>
                   <td>Department ID</td>
                   <td><input type="text" name="departmentID" ></td>
               </tr>
               <tr>
               </table>
               <table class="edit-data">
                    <h1 class="attendance">Attendance:</h1>
                    <tr>
                        <td>
                            <b>semester 1:</b>
                        </td>
                        <td>
                            <input type="text" name="semester1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 2:</b>
                        </td>
                        <td>
                            <input type="text" name="semester2" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 3:</b>
                        </td>
                        <td>
                            <input type="text" name="semester3" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 4:</b>
                        </td>
                        <td>
                            <input type="text" name=" semester4" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 5:</b>
                        </td>
                        <td>
                            <input type="text" name="semester5" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 6:</b>
                        </td>
                        <td>
                            <input type="text" name="semester6">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 7:</b>
                        </td>
                        <td>
                            <input type="text" name="semester7">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 8:</b>
                        </td>
                        <td>
                            <input type="text" name="semester8" >
                        </td>
                    </tr>
                </table>
                <table class="edit-data">
                    <h1 class="result">Result:</h1>
                    <tr>
                        <td>
                            <b>semester 1:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa1" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 2:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa2" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 3:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa3" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 4:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa4">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 5:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa5">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 6:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa6">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 7:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa7" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>semester 8:</b>
                        </td>
                        <td>
                            <input type="text" name="sgpa8" ">
                        </td>
                    </tr>
                </table>


                  
                
                <input type="submit" name="add" value="add">
               </form>
          
               <?php
           }
           ?>
<!-- -----------------delete----------------------------------------------- -->
<?php
			if(isset($_POST['deleteStudent']))
			{
                ?>
                <table class="data">
				<center>
				<form action="deleteStudent.php" method="post">
                <tr>
                        <td>
                        Enter USN:
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <input type="text" name="USN"
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <input type="submit" name="deleteByUSN" value="Delete">
                        </td>
                    </tr>
>
				
				</form><br><br>
                </center>
                </table>
                <?php
                
			}
			?>
        </div>
    </div>
</body>

</html>