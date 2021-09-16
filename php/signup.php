<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //let check email already exit in the database or not
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){//if emailalready exist
                echo "$email - This email already exist";
            } else{
                //check user upload file or not
                if(isset($_FILES['image'])){ //if file upload
                    $img_name = $_FILES['image']['name'];//get name user uploaded
                    $tmp_name = $_FILES['image']['tmp_name'];//temp name is used to save/move file in our folder
                    
                    //let's explode img and get the last extension like jpg png
                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);//get the extension of user upload file

                    $extensions = ['png', 'jpg', 'jpeg'];//array store the valid value

                    if(in_array($img_ext, $extensions) === true){//if the file user upload match with array
                        $time = time();//this is return us current time 
                                        // because when we will rename this file with current in our folder
                        //let's move the user uploaded img to our particular folder
                        $new_img_name = $time.$img_name;
                        if (move_uploaded_file($tmp_name, "images/".$new_img_name)){//if user upload img move to our folder sucessfully
                            $status = "Active now";//once user sign up his status wil be actived now 
                            $random_id = rand(time(), 10000000); // create ID random for user

                            //let's insert all user data inside table
                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                                VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
                            
                            if($sql2){//if data inserted
                                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id'];//using this session we used user unique_id in another php file 
                                    echo "success"; 
                                }
                            } else{
                                echo "Something went wrong";
                            }
                        }
                    } else{
                        echo "Please select an image file - PNG, JPG, JPEG";
                    }

                } else{
                    echo "Please upload a file";
                }
            }
        } else{
            echo "$email - This is not a valid email";
        }
    } else{
        echo "All input are required";
    }
?>