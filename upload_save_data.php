<?php

include('session.php');

require("opener_db.php");
$errmsg_arr = array();

$errflag = false;

$uploaded_by_query = mysql_query("select * from tbluser where user_id = '$session_id'")or die(mysql_error());
$uploaded_by_query_row = mysql_fetch_array($uploaded_by_query);
$uploaded_by = $uploaded_by_query_row['firstname']."".$uploaded_by_query_row['lastname'];

$id_class=$_POST['id_class'];
$name=$_POST['name'];
$get_id = $_POST['id_class'];


function clean($str) {
    $str = @trim($str);
    if (get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }
    return mysql_real_escape_string($str);
}


$filedesc = clean($_POST['desc']);

if ($filedesc == '') {
    $errmsg_arr[] = ' file discription is missing';
    $errflag = true;
}

if ($_FILES['uploaded_file']['size'] >= 1048576 * 5) {
    $errmsg_arr[] = 'file selected exceeds 5MB size limit';
    $errflag = true;
}



if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
	?>

   <script>
   window.location = 'uploads.php<?php echo '?id='.$get_id;  ?>';
   </script>
   <?php exit();
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
               	   
                $qry2 = "INSERT INTO files (fdesc,floc,fdatein,user_id,fname,uploaded_by) VALUES ('$filedesc','$newname',NOW(),'$id_class','$name','$uploaded_by')";
                $result2 = $connector->query($qry2);
                if ($result2) {
                    $errmsg_arr[] = 'record was saved in the database and the file was uploaded';
                    $errflag = true;
                    if ($errflag) {
                        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                        session_write_close();
                        ?>

                     <script>
		
					</script>
                        <?php

                        exit();
                    }
                } else {
                    $errmsg_arr[] = 'record was not saved in the database but file was uploaded';
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


