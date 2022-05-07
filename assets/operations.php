<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require "PHPMailer\src/Exception.php";
	require "PHPMailer\src/PHPMailer.php";
	require "PHPMailer\src/SMTP.php";


include('ladUtilities.php');
include("AfricasTalkingGateway.php");
//attendance logic
if($buttonOption=="loginAttempt"){
	$sql=$con->query("SELECT * FROM USER WHERE USERNAME='$userName' AND PASSWORD='$password' ");
	if($row=qFetch($sql)){
		if($userName==$row['username']  && $password==$row['password']){
			generatePermissionID();
			$checkPermisionID=$con->query("SELECT * FROM USER WHERE permissionID='$permissionID' ");
			while(qFetch($sql)){//ensuring that the permissionID is unique
				generatePermissionID();
			}
			$con->query("UPDATE USER SET permissionID = '$permissionID' WHERE password= '$password'");
			$cData="localStorage.setItem('permissionID','$permissionID');";

			$sql=$con->query("select * from student where reg_no='$row[username]'");
			if($studentRow=qFetch($sql)){
				$studentId=$studentRow['student_id'];
				$sql=$con->query("select * from student_course where student_id='$studentId'");
				while($studentCourseRow=qFetch($sql)){
					$courseId=$studentCourseRow['course_id'];
					$sql=$con->query("select * from course_schedule where course_id='$courseId'");
					if($CourseScheduleRow=qFetch($sql)){
						$ladAlerts='malaulo';
						$courseScheduleId=$CourseScheduleRow['schedule_id'];
						$sql=$con->query("select * from schedule where schedule_id='$courseScheduleId' && start_time='".getScheduleStart()."' && end_time='".getScheduleEnd()."' ");
						if($Row=qFetch($sql)){
							$deleteReplications=$con->query("DELETE FROM attendance WHERE student_id='$studentId' && course_id='$courseId' && course_schedule_id='$courseScheduleId' && attendance_date='$currentDay-$currentMonth-$currentYear'");
							$attend=$con->query("INSERT INTO attendance(
							student_id,
							course_id,
							course_schedule_id,
							attendance_date,
							attendance_status
							)VALUES(
							'$studentId',
							'$courseId',
							'$courseScheduleId',
							'$currentDay-$currentMonth-$currentYear',
							'Present'
							)");
							$ladAlerts="Attending class successful!";

								$sql=$con->query("SELECT * ATTENDANCE INNER JOIN STUDENT ON ATTENDANCE.STUDENT_ID=STUDENT.STUDENT_ID
                                INNER JOIN COURSE ON ATTENDANCE.COURSE_ID=COURSE.COURSE_ID
                                INNER JOIN COURSE_SCHEDULE ON ATTENDANCE.COURSE_SCHEDULE_ID=COURSE_SCHEDULE.COURSE_SCHEDULE_ID");
                                while($row=qFetch($sql)){
                                   $table="<table class='table table-bordered'><tr><th>Student</th>
                                   <th>Course</th><th>Schedule</th><th>Date</th><th>Status</th><th>Action</th></tr>
                                   <tr><td>$row[firstname] $row[surname]</td>$row[course_code] $row[course_name]
                                   </td>$row[start_time] $row[end_time]</td>$row[attendance_date]</td>$row[attendance_status]</td></tr>
                                   </table>";
                                }
                                $table=filterTEXT("$table");
                                $cData.="navAll('showAttendance',\"$table\",'h')
                                ";
						}else{
							$ladAlerts="Failed to record attendance! Please try again.";
						}
						break;
					}else{
						$ladAlerts="what's up";
					}
				}
			}
		}else{
			$ladAlerts="Invalid login details! Please try again.";
		}
	}else{
		$ladAlerts=" $password  Invalid login details! Please try again.";
	}

}


if($buttonOption=="submitComplaint"){
	$username="elifemw";
	$apiKey="8db7b3b85ead46ee662000acfe4839d580d38ede93cfb3057fef38c598741fc1";


	$phoneNumber="+265997187520";
		$message=$_POST['clearParameters0'];
	$gateway=new AfricasTalkingGateway($username,$apiKey);
	try{
		$gateway->sendMessage($phoneNumber,$message);
		$ladAlerts="Complaint sent!!!";
	}catch(AfricasTalkingGatewayException $event){
		$ladAlerts="An error occured while submiting the complaint! Please try again.";
	}



}
if($buttonOption=="submitComplaintThroughEmail"){

	$mail=new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug=3;
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;// or 587
	$mail->SMTPSecure='tls';//ssl is deprecated
	$mail->SMTPAuth=true;
	$mail->Username="bomarad2019@gmail.com";
	$mail->Password="boma1995";
	$mail->setFrom("bomarad2019@gmail.com","mzuzu university");
	$mail->addAddress("bomarad2019@gmail.com","Radson Boma");
	$mail->Subject=$_POST['clearParameters0'];
	$mail->msgHTML($_POST['clearParameters1']);
	$mail->AltBody="HTML not supported";
	//$mail->addAttachment();
	$mail->send();

	$ladAlerts="email sent!!!";

}
if($buttonOption=="studentCourse"){
    $sql1=$con-query("SELECT * STUDENTS WHERE permissionID='$permissionID' ");
    while($row=qFetch($sql1)){
         $reg_no=$row[reg_no];
    }
   $acadyear=$_POST['acadYear'];
   $semester=$_POST['semester'];
   $course=$_POST['course'];
   if(!empty($acadyear&&$semester&&$dept&&$course)){
      $sql=$con->query("INSERT INTO STUDENT_COURSE(student_id,coure_id,sem_id,acadyear_id)VALUES('$reg_no','$course','$semester','$acadyear')");
      if($sql){
          $ladAlerts='data remarkably inserted';
      }else{
          $ladAlerts='there is a problem';
      }
   }else{
      $ladAlerts='the fields are empty,please fill';
   }
}
if($buttonOption=="logout"){


	$sql=$con->query("UPDATE USER SET permissionID = 'Denied' WHERE permissionID= '$permissionID'");

	$cData="localStorage.setItem('permissionID','');
	h('systemButtons',gC('loginButton'));
	h('cPane',gC('login'));
	h('serverStore','');



	";
}
  //head of department pane
if($buttonOption=="addLecture"){
	$fName=$_POST['firstName'];
	$sName=$_POST['surName'];
	$pNumber=$_POST['phoneNumber'];
	$email=$_POST['email'];
	$date=$_POST['dod'];
	$gender=$_POST['gender'];
    if(!empty($fName&&$sName&&$pNumber&&$email&&$date&&$gender)){
            	$letters="";
    $number="";
    foreach (range("A", "Z") as $chars) {
        $letters.=$chars;
    }
    for($i=0; $i < 10; $i++){
        $number.=$i;
    }

    $employ_no=substr(str_shuffle($letters),0,4).substr(str_shuffle($number),0,6);
	$password=substr(str_shuffle($letters),0,3).substr(str_shuffle($number),0,4);
	$sql3="SELECT * FROM role WHERE role='lecturer'";
	$results=$con->query($sql3);
	$roleId;
	while($row=$results->fetch_assoc()){
       $roleId=$row['role_id'];
	}
    $sql4 =$con->query("INSERT INTO user(username,password,role_id)VALUES('$employ_no','$password','$roleId')");
	$sql2="SELECT * FROM user WHERE role_id=2";
	$results=$con->query($sql2);
	$userId;
	while($row=$results->fetch_assoc()){
       $userId=$row['user_id'];
	}
	$sql= $con->query("INSERT INTO lecturer(emp_no,firstname,surname,email,phone,dod,sex,employ_status,user_id)
	VALUES('$employ_no','$fName','$sName','$email','$pNumber','$date','$gender','active','$userId')");
	if ($sql) {
		$ladAlerts='data successfully inserted';
	}else{
		$ladAlerts='there is a problem, please try again';
	}

     $sql=$con->query("select emp_no,firstname,surname,email,phone,dod,sex,employ_status from lecturer");
     while($row=qFetch($sql)){
	$table="<table id='example1' class='table table-striped'><tr><th>EmploymentNumber</th><th>FirstName</th>
    <th>Surname</th><th>Email</th><th>Phone</th><th>DateOfBirth</th><th>Sex</th><th>EmploymentStatus</th><th>Action</th></tr>
    <tr><td>$row[emp_no]</td><td>$row[firstname]</td><td>$row[surname]</td><td>$row[email]</td><td>$row[phone]</td><td>$row[dod]</td>
    <td>$row[sex]</td><td>$row[employ_status]</td></tr>
    </table>";
      }
      $table=filterTEXT("$table");
	$cData="
	navAll('addLecturePane',\"$table\",'h');
	";
    }else{
        $ladAlerts='empty fields';
    }

}

   if($buttonOption=="academicYear"){
        $year=$_POST['year'];
        if($year!=""){
        $yearData=$con->query("INSERT INTO ACADEMIC_YEAR(year)VALUES('$year')");
        if($yearData){
         $ladAlerts=" academic year added successfully";
       }else{
           $ladAlerts='sorry something went wrong';
       }
        }else{
          $ladAlerts="empty field";
        }
        $sql=$con->query("SELECT * FROM ACADEMIC_YEAR");
          while($row=qFetch($sql)){
            $table="<table class='table table-bordered'><tr><th>Year</th><th>Action</th></tr><tr><td>$row[year]</td><td>Edit</td></tr></table>";
          }
          $table=filterTEXT("$table");
          $cData="navAll('showAcademicYear',\"$table\",'h');
          ";
    }
 if($buttonOption=="addSem"){
   $semester=$_POST['semester'];
   $startDate=$_POST['startDate'];
   $endDate=$_POST['endDate'];
   $acadYear=$_POST['acadYear'];
   if(!empty($semester&&$startDate&&$endDate&& $acadYear)){
      $semesterData=$con->query("INSERT INTO SEMESTER(semester,start_date,end_date,acadyear_id)VALUES('$semester','$startDate','$endDate','$acadYear')");
    if($semesterData){
        $ladAlerts='semester data added successfully';
  }else{
      $ladAlerts='there is problem in inserting data';
  }
  $sql=$con->query("SELECT * FROM SEMESTER INNER JOIN ACADEMIC_YEAR ON semester.acadyear_id=academic_year.acadyear_id");
  WHILE($row=qFetch($sql)){
  $table="<table class='table table-bordered'><tr><th>Semester</th><th>StartDate</th><th>EndDate</th><th>AcademicYear</th><th>Action</th></tr>
  <tr><td>$row[semester]</td><td>$row[start_date]</td><td>$row[end_date]</td><td>$row[year]</td></tr>
  </table>";
  }
  $table=filterTEXT("$table");
  $cData.="navAll('showSemester',\"$table\",'h');
  ";
   }else{
       $ladAlerts='empty fields';
   }
 }
 if($buttonOption=="addDept"){
    $deptname=$_POST['deptname'];
    $headname=$_POST['headname'];
    if(!empty($deptname&&$headname)){
       $deptData=$con->query("INSERT INTO DEPARTMENT(dept_name,dept_head)VALUES('$deptname','$headname')");
    if( $deptData){
        $ladAlerts='dept data added successfully';
         $sql=$con->query("SELECT * FROM DEPARTMENT");
         WHILE($row=qFetch($sql)){
           $table="<table class='table'><tr><th>Department
          </th><th>HeadName</th><th>Action</th></tr><tr><td>$row[dept_name]</td><td>$row[dept_head]</td><td>edit</td></tr></table>";
         }

        $table=filterTEXT("$table");

        $cData.="navAll('showDeptData',\"$table\",'h');
        ";
    }else{
        $ladAlerts='there is problem in inserting data';
    }
    }else{
        $ladAlerts='empty fields';
    }
 }
 if($buttonOption=='assignCourse'){
    $lecturer=$_POST['lecturer'];
    $course= $_POST['course'];
    $semester=$_POST['semester'];
    $acadYear=$_POST['academicYear'];
    if(!empty($lecturer&&$course&&$semester&&$acadYear)){
      $assignLecturerData=$con->query("INSERT INTO LECTURER_COURSE(course_id,lecturer_id,sem_id,acadyear_id)VALUES('$course','$lecturer','$semester','$acadYear')");
      if($assignLecturerData){
         $ladAlerts='lecturerCourse data remarkably inserted';
         $sql=$con->query("SELECT * FROM lecturer_course INNER JOIN course ON lecturer_course.course_id=course.course_id
          INNER JOIN lecturer ON lecturer_course.lecturer_id=lecturer.lecturer_id INNER JOIN semester ON lecturer_course.sem_id=semester.sem_id
          INNER JOIN academic_year ON lecturer_course.acadyear_id=academic_year.acadyear_id");
         while($row=qFetch($sql)){
         $table="<table class='table table-striped'><tr><th>Course</th><th>Lecturer</th><th>Semester</th><th>Year</th><th>Action</th></tr>
         <tr><td>$row[course_code]$row[course_name]</td><td>$row[surname]</td><td>$row[semester]</td><td>$row[year]</td><td>edit</td></tr>
         </table>";
         }
         $table=filterTEXT("$table");
         $cData.="navAll('lecturerCoursePane',\"$table\",'h');
         ";
    }else{
       $ladAlerts='there is a problem in inserting data';
    }
    }else{
        $ladAlerts='empty fields';
    }
 }
  if($buttonOption=='programCourse'){
      $sudentID='';
     $sql= $con->query("SELECT * FROM STUDENT WHERE permissionID='$permissionID'");
     if($row=qFetch($sql)){
     $sudentID=$row['reg_no'];
     }
    $program=$_POST['program'];
    $semester=$_POST['semester'];
    $course= $_POST['course'];
    /*
    $assignLecturerData=$con->query("INSERT INTO program_course(reg_no,programId,sem_id,course_id)VALUES('$sudentID','$program','$semester','$course')");
    if($assignLecturerData){
         $ladAlerts='lecturerCourse data remarkably inserted';
    }else{
       $ladAlerts='there is a problem in inserting data';
    } */
 }
   if($buttonOption=="addCourse"){
    $courseCode=$_POST['courseCode'];
    $courseName=$_POST['courseName'];
    $dept= $_POST['department'];
    $semester= $_POST['semester'];
    if(!empty($courseCode&&$courseName&&$dept&&$semester)){
       $assignLecturerData=$con->query("INSERT INTO course(course_code,course_name,dept_id,sem_id)VALUES('$courseCode','$courseName','$dept','$semester')");
       if($assignLecturerData){
         $ladAlerts='Course data remarkably inserted';
          $sql=$con->query("SELECT * FROM COURSE INNER JOIN DEPARTMENT ON course.dept_id=department.dept_id
          INNER JOIN SEMESTER ON COURSE.SEM_ID=SEMESTER.SEM_ID");
          $table="<table class='table'>
          <th>courseName</th><th>Department</th><th>Semester</th>
          ";
          WHILE($row=qFetch($sql)){
            $table.="
            <tr><td>$row[course_code] $row[course_name]</td><td>$row[dept_name]</td><td>$row[semester]</td></tr>
            ";
         }
         $table.="</table>";

         $table=filterTEXT("$table");
         $cData.="navAll('addCoursePane',\"$table\",'hDESC');
         ";
    }else{
       $ladAlerts='there is a problem in inserting data';
    }
    }else{
        $ladAlerts='empty fields';
    }

 }
 if($buttonOption=="courseSchedule"){
    $course=$_POST['course'];
    $schedule= $_POST['schedule'];
    if(!empty($course&&$schedule)){
    $courseScheduleData=$con->query("INSERT INTO course_schedule(schedule_id,course_id)VALUES('$schedule','$course')");
    if($courseScheduleData){
         $ladAlerts='data successfully inserted';
    }else{
      $ladAlerts='there is problem';
    }
    $sql=$con->query("SELECT * FROM COURSE_SCHEDULE INNER JOIN SCHEDULE ON course_schedule.schedule_id=schedule.schedule_id
    INNER JOIN COURSE ON course_schedule.course_id=course.course_id");
    while($row=qFetch($sql)){
        $table="<table class='table table-bordered'><tr><th>Schedule</th><th>Course</th></tr>
        <tr><td>$row[start_time] $row[end_time]</td><td>$row[course_code] $row[course_name]</td></tr>
        </table>";
    }
    $table=filterTEXT("$table");
    $cData.="navAll('showCourseSchedule',\"$table\",'h');
    ";
 }else{
     $ladAlerts='empty fields';
 }
    }
 //change status of the student




if($buttonOption=='Activate'){
   $sql=$con->query("UPDATE student SET student_status = 'Activate' WHERE student_id = '$_POST[clearParameters0]'");
			if($sql){
				echo "navAll('oStatus$_POST[clearParameters0]','Not active','h');
                navAll('activate$_POST[clearParameters0]',true,'disabled');
                navAll('deactivate$_POST[clearParameters0]',false,'disabled');";
			}else{$ladAlerts="Activating student failed!";}
 }
 if($buttonOption=='Deactivate'){
       	$sql=$con->query("UPDATE student SET student_status = 'Not active' WHERE student_id = '$_POST[clearParameters0]'");
			if($sql){
				echo "navAll('oStatus$_POST[clearParameters0]','Not active','h');
                navAll('activate$_POST[clearParameters0]',false,'disabled');
                navAll('deactivate$_POST[clearParameters0]',true,'disabled');";
			}else{$ladAlerts="Deactivating student failed!";}
 }

if($buttonOption=="registerStudent"){
  if(!empty($_FILES['studentFile']['name'])){
     $ladAlerts='malaulo';
  } else{
      $ladAlerts='Gondwe';
  }


}

if($_POST['buttonOption']=="recordFingerPrint"){
    $data 		= explode(";",$_POST['RegTemp']);
    $vStamp 	= $data[0];
    $sn 		= $data[1];
    $user_id	= $data[2];
    $regTemp 	= $data[3];
    $sql=$con->query("update user set fingerData=' $regTemp' WHERE username='$user_id' ");
}

if($ladAlerts!=""){
	$cData.="ladAlerts(\"$ladAlerts\");";
}

if($cData!=""){
	echo "$cData";
}
?>