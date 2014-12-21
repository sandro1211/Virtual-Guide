<?php
include('session.php');
require("opener_db.php");
$errmsg_arr = array();

$errflag = false;
$id = $session_id;
$name = $_POST['name'];
if ($_FILES['uploaded_file']['size'] >= 1048576 * 5) {
    $errmsg_arr[] = 'file selected exceeds 5MB size limit';
    $errflag = true;
}


$rd2 = mt_rand(1000, 9999) . "_File";


if ((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
    
    $filename = basename($_FILES['uploaded_file']['name']);

    $ext = substr($filename, strrpos($filename, '.') + 1);

    if (($ext != "exe") && ($_FILES["uploaded_file"]["type"] != "application/x-msdownload")) {
        
        $newname = "admin/uploads/" . $rd2 . "_" . $filename;
		$name_notification  = 'Add uploads Materials file name'." ".'<b>'.$name.'</b>';
        
        if (!file_exists($newname)) {
            
            if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $newname))) {
               
				if (isset($_POST['add'])){
					$user_id  = $_POST['id'];
//					$name  = mysql_real_escape_string($_POST['name']);
					$number   = $_POST['number'];
					$mobile   = $_POST['mobile'];
					$email  = mysql_real_escape_string($_POST['email']);
					$work  = $_POST['work'];
					$address  = mysql_real_escape_string($_POST['address']);
					$school  = $_POST['school'];
//					$pix  = $_POST['pix'];
					$group  = $_POST['group'];
					$note = mysql_real_escape_string($_POST['note']);
				}
				echo $time = date("Y-m_d : h:i");
				$qry2 = "INSERT INTO `contact` (`id`, `user_id`, `name`, `number`, `mobile`, `email`, `work`, `address`, `school`, `pix`, `group`, `note`,`time_add`) VALUES (NULL, $user_id, '$name', '$number', '$mobile', '$email', '$work', '$address', '$school', '$newname', '$group','$note','$time')";
                $result2 = $connector->query($qry2);
                if ($result2) {
					echo "inserted";
                    $errmsg_arr[] = 'record was saved in the database and the file was uploaded';
                    $errflag = true;
                    if ($errflag) {
                        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                        session_write_close();
                        ?>

                        <?php

                        exit();
                    }
                } else {
                    $errmsg_arr[] = 'record was not saved in the database but file was uploaded';
                    $errflag = true;
                    if ($errflag) {
                        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                        session_write_close(); 
						echo "uploaded";
						?>
						
                           <script>
   window.location = 'uploads.php<?php echo '?id='.$id;  ?>';
   </script>
   <?php
                        exit();
                    }
                }
            } else {
                
                $errmsg_arr[] = 'upload of file ' . $filename . ' was unsuccessful';
                $errflag = true;
                if ($errflag) {
                    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                    session_write_close(); ?>
       <script>
   window.location = 'uploads.php<?php echo '?id='.$get_id;  ?>';
   </script>
   
   
   <?php
                    exit();
                }
            }
        } else {
          
            $errmsg_arr[] = 'Error: File >>' . $_FILES["uploaded_file"]["name"] . '<< already exists';
            $errflag = true;
            if ($errflag) {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                session_write_close(); ?>
       <script>
   window.location = 'uploads.php<?php echo '?id='.$get_id;  ?>';
   </script>
   <?php
   
                exit();
            }
        }
    } else {
        
        $errmsg_arr[] = 'Error: All file types except .exe file under 5 Mb are not accepted for upload';
        $errflag = true;
        if ($errflag) {
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            session_write_close(); ?>
            <script>
   window.location = 'uploads.php<?php echo '?id='.$get_id;  ?>';
   </script>
   <?php
            exit();
        }
    }
} else {
    

    $errmsg_arr[] = 'Error: No file uploaded';
    $errflag = true;
    if ($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close(); ?>
       <script>
   window.location = 'uploads.php<?php echo '?id='.$get_id;  ?>';
   </script>
   <?php
        exit();
    }
}

mysql_close();
?>
