<?php
    //Connection to the database

    function db_connection(){

        $con = new mysqli("localhost", "root", "", "cam2rescue_db");

        if($con->connect_error){
            echo $con->connect_error;
        }
        else{
            return $con;
        }
    }

    // uploading images to the database

    function upload_image() {
        $petLocation = $_POST["petlocation"];
		$choice = $_POST["choices"];
		$type = $_POST["animal_type"];
		$additional_info = $_POST["add_info"];

	    // Getting file name
	    $filename = $_FILES['image']['name'];
	         
	    // Valid extension
	    $valid_ext = array('jpeg','jpg');

				
		$photoExt1 = @end(explode('.', $filename)); // explode the image name to get the extension
		$phototest1 = strtolower($photoExt1);
				
		$new_profle_pic = time().'.'.$phototest1;
				
	    // Location
	    $location = "Uploaded_Images/".$new_profle_pic;

	    // file extension
	     $file_extension = pathinfo($location, PATHINFO_EXTENSION);
	    $file_extension = strtolower($file_extension);

	       // Check extension
	    if(in_array($file_extension,$valid_ext)){  

	        // Compress Image
	        compressedImage($_FILES['image']['tmp_name'],$location,60);
					
			//Here i am enter the insert code in the step ........
			  
			 $sql = "INSERT INTO upload_image(pet_location, midication, pet_classification, additional_info, image_url, rescue_status) VALUES ('$petLocation','$choice','$type','$additional_info','".$new_profle_pic."','Verifying')";
			if (mysqli_query($con, $sql)) 
				{
					echo "Posted successfully";
				}

	    }
		 else
	        {
	                echo "File format is not correct.";
	        }
	}

    //Compressed Image

    function compressedImage($source, $path, $quality) {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source);

        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source);

        imagejpeg($image, $path, $quality);

    }

    //login

    function login_user(){
        $username = $_POST["username"];
		$password = $_POST["password"];

            $con = db_connection(); 
        
			$sql ="SELECT * FROM `xample` WHERE username = '$username' AND password = '$password'";
			$record = mysqli_query($con, $sql);			
			
			if(mysqli_num_rows($record) > 0)
			{
				$row = mysqli_num_rows($record);
				if($row['type'] == "organization") {
					$_SESSION['username'] = $username;
					//header("Location: index1.php");
					echo '<script type="text/javascript"> alert("Hello Cam2Rescue wish for the best of your organization"); window.location="index.php"</script>';	
				}
				elseif($row['type'] == "admin") {
					$_SESSION['username'] = $username;
					//header("Location: index1.php");
					echo '<script type="text/javascript"> alert("welcome admin"); window.location="index.php"</script>';
				}
				else{
					$_SESSION['username'] = $username;
					//header("Location: index1.php");
					echo '<script type="text/javascript"> alert("welcome user"); window.location="index.php"</script>';
				}

			}
			else 
			{
				echo '<script type="text/javascript"> alert("Invalid username or password entered") </script>';
			}
			
    }

    //logout user 

    function logout_user(){   
        if(isset($_SESSION['username'])){
           $_SESSION = array(); //empty the array
		   session_destroy();
		   unset($_SESSION);
           echo '<script type="text/javascript"> alert("You have successfully logout"); window.location="index.php"</script>';	
		   //header("Location: index.php");
        }	   
    }

    //register or add user

    function register() {
        $con = db_connection();
        $username = mysqli_real_escape_string($con,$_POST["username"]);
        $password = mysqli_real_escape_string($con,$_POST["password"]);
        $password = md5($_POST["password"]);
        $match = md5($_POST["confirm"]);
        $Lastname = $_POST['Lastname'];
        $Firstname = $_POST['Firstname'];
        $Gender = $_POST['Gender'];
        $Age = $_POST['Age'];
        $Address = $_POST['Address'];
        if($password == $match) {
            $sql = "INSERT INTO `registration`(`lastname`, `firstname`, `gender`, `age`, `address`, `username`, `password`) 
                    VALUES ('$Lastname', '$Firstname', '$Gender', '$Age', '$Address', '$username', '$password')";
                        
            $con->query($sql) or die ($con->error);       
            echo "Registration Successfull";
            header("Location: index.php");
        }
        else{
            echo "<h6> <font color=red>Password don't match</h6>";
        }
    }

    //fetch data from db, to display pets need to be rescued

    function get_list(){
        $con = db_connection();
        $count = 0;
        $sql="SELECT * FROM `upload_image`";
        $record = mysqli_query($con, $sql);
        if(mysqli_num_rows($record) > 0)
        while($row = mysqli_fetch_assoc($record)) { 
            $count++;
        }


    }
    //update record for pet for rescue

    function update_record() {
        $id =$_GET['update'];
        $update_sql = "UPDATE `upload_image` SET `rescue_status`='Verified' WHERE id = $id";
          mysqli_query($con, $update_sql);
    }

//


?>
