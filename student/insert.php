<?php
include('../config.php');
session_start();
if(isset($_POST['submit']))
{
    $cname="";
    $prefs="";
    for($i=1;$i<$_SESSION['no_of_preferences'];$i++)
        {
        $cname.="'".$_POST['cname'.$i.'']."',";    
        $prefs.="`pref".$i."`,";
        }
        // $cname.="'";    
        // $cname.=$_POST['cname'.$i.''];
        // $cname.="'";
        $cname.="'".$_POST['cname'.$i.'']."'";    
        $prefs.="`pref".$i."`";
        // echo $cname;
        date_default_timezone_set('Asia/Kolkata');
        $timestamp=date("Y-m-d H:i:s");
        // echo $cname;
        // echo $prefs."<br>";
        $sql3="INSERT INTO student_preference_audit (`email_id`,`sem`,`year`,`timestamp`,`allocate_status`,".$prefs.") VALUES('{$_SESSION['email']}','{$_SESSION['sem']}','{$_SESSION['year']}','{$timestamp}',0,".$cname.");";
        mysqli_query($conn, $sql3);
        echo $sql3;
        // $sql4="UPDATE student SET form_filled=1 WHERE email_id='{$_SESSION['email']}';";
        $sql4="INSERT INTO student_form(`sem`,`year`,`no`,`form_type`,`email_id`,`timestamp`) VALUES 
              ('{$_SESSION['sem']}','{$_SESSION['year']}','0','audit','{$_SESSION['email']}','$timestamp')";
        mysqli_query($conn,$sql4);
        unset($_SESSION['no_of_preferences']);
        unset($_SESSION['sem']);
        unset($_SESSION['year']);
        header('location: form.php');
        //header('Location: '.$_SERVER['REQUEST_URI']);
        // echo "<script>
        //     alert('submitted!!!!!!');
        //     window.href.location(form.php);
        // </script";
}
?>