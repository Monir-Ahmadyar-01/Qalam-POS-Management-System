<?php 

include("database.php");
include("jdf.php");

    if(isset($_POST["stuff_full_name"]))
    {
        $stuff_full_name = $_POST["stuff_full_name"];
        $phone_number = $_POST["phone_number"];
        $address = $_POST["address"];

        // upload the image 
        $picUpload = $_FILES['image']['name'];
        $picSource = $_FILES['image']['tmp_name'];
        $picTarget = 'stuff_documents/images/'.$_FILES['image']['name'];
        move_uploaded_file($picSource, $picTarget);


        $input_date = $_POST["input_date"];
        $date_sh_exp = explode("/",$input_date);
        $date =  jalali_to_gregorian($date_sh_exp[2],$date_sh_exp[1],$date_sh_exp[0],'/');

        $sql_query_001 = mysqli_query($connection,"INSERT INTO `stuff` (`id`, `full_name`, `phone_number`, `agency_id`, `address`, `image`, `user_id`, `date`) VALUES (NULL, '$stuff_full_name', '$phone_number', NULL, '$address', '$picUpload', NULL, '$date')");
        
        if ($sql_query_001)
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }

        exit();
        
    }
?>