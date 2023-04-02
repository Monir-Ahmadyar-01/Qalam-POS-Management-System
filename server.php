<?php
    include("database.php");
    include("jdf.php");
    session_start();

    if(isset($_POST["login_username"]))
    {
        $login_username = $_POST["login_username"];
        $password = base64_encode($_POST["password"]);
        
        $sql_query_001 = mysqli_query($connection,"select * from user_account where user_name='$login_username' and password = '$password'");
        
        if (mysqli_num_rows($sql_query_001) > 0)
        {   
            $fetch_001 = mysqli_fetch_assoc($sql_query_001);
            $_SESSION["username"] = $fetch_001["user_name"];
            $_SESSION["authority"] = $fetch_001["authority"];
            $_SESSION["password"] = base64_decode($fetch_001["password"]);
        
           
            $_SESSION["employee_id"] = $fetch_001["employee_id"];

            if($fetch_001["authority"] == "Admin")
            {
                echo "success~pages-invoice.php";
            }
            else
            {
                echo "success~home.php";
            }

            
        }
        else
        {
            echo "failed~";
        }
        

        exit();
        
    }

    // $user_id = $_SESSION["user_id"];

    if(isset($_POST["barcode_stock_major_id"]))
    {
        $barcode_update = $_POST["barcode_update"];
        $barcode_stock_major_id = $_POST["barcode_stock_major_id"];

        $sql_query_001 = mysqli_query($connection,"update stock_major set barcode='$barcode_update' where id='$barcode_stock_major_id'");
        
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
    
    if(isset($_POST["units_list"]))
    {
        $sql_query_001 = mysqli_query($connection,"SELECT * FROM minor_units");
        
        $array_tb = array();
        $counter = 0;
        while ($rows = mysqli_fetch_array($sql_query_001)) {
            
            array_push($array_tb,$rows);

            $counter++;
        }

        print_r(json_encode($array_tb));

        exit();
        

    }

    


    if(isset($_POST["major_stock_item_id"]))
    {
        $major_stock_item_id = $_POST["major_stock_item_id"];

        $sql_query_001 = mysqli_query($connection,"SELECT stock_major.id,stock_minor.item_name,stock_major.amount,unit_major.unit_name  FROM `stock_major` LEFT JOIN stock_minor ON stock_major.item_id = stock_minor.id LEFT JOIN  unit_major on unit_major.id = stock_major.unit_id where stock_major.id='$major_stock_item_id'");
        
        
       
        print_r(json_encode(mysqli_fetch_array($sql_query_001)));

        exit();
        
    }
    if(isset($_POST["major_stock_item_id_purchase_list"]))
    {
        $major_stock_item_id_purchase_list = $_POST["major_stock_item_id_purchase_list"];

        $sql_query_001 = mysqli_query($connection,"SELECT purchase_minor.*,purchase_major.date as purchase_date,purchase_major.party_number as party_number,(SELECT stock_minor.item_name FROM stock_minor WHERE stock_minor.id = (SELECT stock_major.item_id FROM stock_major WHERE stock_major.id = purchase_minor.item_id_stock_major)) as item_name,(SELECT sum(sale_minor.amount) FROM sale_minor WHERE sale_minor.purchase_minor_id = purchase_minor.id) as total_sold_amount,(SELECT unit_minor.unit_name from unit_minor WHERE unit_minor.id = (SELECT stock_major.minor_unit_id FROM stock_major WHERE stock_major.id = purchase_minor.item_id_stock_major)) as minor_unit_name FROM `purchase_minor` LEFT JOIN purchase_major ON purchase_minor.purchase_major_id = purchase_major.id where purchase_minor.item_id_stock_major = '$major_stock_item_id_purchase_list' or purchase_minor.item_id_stock_major = (SELECT stock_major.id FROM stock_major WHERE stock_major.barcode='$major_stock_item_id_purchase_list') and purchase_minor.amount > 0;");
        
        
       
        $array_tb = array();
        $counter = 0;
        while ($rows = mysqli_fetch_array($sql_query_001)) {
            
            array_push($array_tb,$rows);

            $counter++;
        }

        print_r(json_encode($array_tb));

        exit();
        
    }
    if(isset($_POST["load_sales_major_id_for_edit"]))
    {
        $load_sales_major_id_for_edit = $_POST["load_sales_major_id_for_edit"];

        $sql_query_001 = mysqli_query($connection,"SELECT id,customer_id,date FROM `sale_major` where id='$load_sales_major_id_for_edit'");

        $sql_query_002 = mysqli_query($connection,"SELECT id,full_name,date FROM `customers`");
        
        
       
        $array_tb = array();
        $counter = 0;
        array_push($array_tb,mysqli_fetch_array($sql_query_001));

        while ($rows = mysqli_fetch_array($sql_query_002)) {
            
            array_push($array_tb,$rows);

            $counter++;
        }

        print_r(json_encode($array_tb));

        exit();
        
    }

    if(isset($_POST["barcode_edit"]))
    {
        $barcode_edit = $_POST["barcode_edit"];

        $sql_query_001 = mysqli_query($connection,"SELECT id,barcode FROM `stock_major` where id='$barcode_edit'");

       
        $array_tb = array();

        array_push($array_tb,mysqli_fetch_array($sql_query_001));


        print_r(json_encode($array_tb));

        exit();
        
    }


    if(isset($_POST["load_purchase_major_id_for_edit"]))
    {
        $load_purchase_major_id_for_edit = $_POST["load_purchase_major_id_for_edit"];

        $sql_query_001 = mysqli_query($connection,"SELECT purchase_status,id,supplier_id,party_number,date FROM `purchase_major` where id='$load_purchase_major_id_for_edit'");

        $sql_query_002 = mysqli_query($connection,"SELECT id,full_name,phone_number,date FROM `suppliers`");
        
        
       
        $array_tb = array();
        $counter = 0;
        array_push($array_tb,mysqli_fetch_array($sql_query_001));
        while ($rows = mysqli_fetch_array($sql_query_002)) {
            
            array_push($array_tb,$rows);

            $counter++;
        }

        print_r(json_encode($array_tb));

        exit();
        
    }


    if(isset($_POST["load_sales_minor_id_for_edit"]))
    {
        $load_sales_minor_id_for_edit = $_POST["load_sales_minor_id_for_edit"];

    
        $sql_query_002 = mysqli_query($connection,"SELECT id,amount,sale_rate,details,expense FROM `sale_minor` where id='$load_sales_minor_id_for_edit'");
        
        
       
        $array_tb = array();
        $counter = 0;

        while ($rows = mysqli_fetch_array($sql_query_002)) {
            
            array_push($array_tb,$rows);

            $counter++;
        }

        print_r(json_encode($array_tb));

        exit();
        
    }

    if(isset($_POST["load_purchase_minor_id_for_edit"]))
    {

        $load_purchase_minor_id_for_edit = $_POST["load_purchase_minor_id_for_edit"];

        $sql_query_002 = mysqli_query($connection,"SELECT id,amount,purchase_price,sale_price,office_expense,commision_expense FROM `purchase_minor` where id='$load_purchase_minor_id_for_edit'");
        
        $array_tb = array();
        $counter = 0;

        while ($rows = mysqli_fetch_array($sql_query_002)) {
            
            array_push($array_tb,$rows);

            $counter++;
        }

        print_r(json_encode($array_tb));

        exit();
        
    }

    if(isset($_POST["purchase_list_id"]))
    {
        $purchase_list_id = $_POST["purchase_list_id"];

        $sql_query_001 = mysqli_query($connection,"SELECT purchase_minor.*,purchase_major.date as purchase_date,purchase_major.party_number as party_number,(SELECT stock_minor.item_name FROM stock_minor WHERE stock_minor.id = (SELECT stock_major.item_id FROM stock_major WHERE stock_major.id = purchase_minor.item_id_stock_major)) as item_name,(SELECT sum(sale_minor.amount) FROM sale_minor WHERE sale_minor.purchase_minor_id = purchase_minor.id) as total_sold_amount,(SELECT unit_minor.unit_name from unit_minor WHERE unit_minor.id = (SELECT stock_major.minor_unit_id FROM stock_major WHERE stock_major.id = purchase_minor.item_id_stock_major)) as minor_unit_name FROM `purchase_minor` LEFT JOIN purchase_major ON purchase_minor.purchase_major_id = purchase_major.id WHERE purchase_minor.id ='$purchase_list_id'");
        
        
       
        $array_tb = array();
        $counter = 0;
        while ($rows = mysqli_fetch_array($sql_query_001)) {
            
            array_push($array_tb,$rows);

            $counter++;
        }

        print_r(json_encode($array_tb));

        exit();
        
    }


    if(isset($_POST["minor_unit_id"]))
    {
        $minor_unit_id = $_POST["minor_unit_id"];
        $sql_query_001 = mysqli_query($connection,"SELECT pack_quantity,kg_factor FROM minor_units where id='$minor_unit_id'");
        
        $array_tb = array();
            array_push($array_tb,mysqli_fetch_array($sql_query_001));

        print_r(json_encode($array_tb));

        exit();
        
    }

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
        $date =  $input_date;

        

        $sql_query_001 = mysqli_query($connection,"INSERT INTO `staff` (`id`, `full_name`, `phone_number`, `address`, `image`, `date`) VALUES (NULL, '$stuff_full_name', '$phone_number', '$address', '$picUpload', '$date')");
        
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

    if(isset($_POST["customer_reciept_full_name"]))
    {
        $full_name = $_POST["customer_reciept_full_name"];
        $customer_id_reciept = $_POST["customer_id_reciept"];
        $amount = $_POST["amount"];
        $currency = $_POST["currency"];
        $rate = $_POST["rate"];
        $date = $_POST["date"];
        $details = $_POST["details"];
        $commission = $_POST["commission"];

        $sql_query_01 = mysqli_query($connection,"INSERT INTO `reciepts` (`id`, `full_name`, `amount`,`commission`, `currency_id`,`rate`, `purchase_id`, `sale_id`, `date`, `details`,`customer_id`) VALUES (NULL, '$full_name', '$amount','$commission', '$currency','$rate', NULL, NULL, '$date', '$details','$customer_id_reciept')");

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
    


    if(isset($_POST["user_name_employee"]))
    {
        $user_name_employee = $_POST["user_name_employee"];
        $employee_id = $_POST["employee_id"];
        $password_employee = base64_encode($_POST["password_employee"]);
        $authority = $_POST["authority"];
        $edit_id = $_POST["edit"];


        
        if($edit_id == "")
        {
            $sql_query_001 = mysqli_query($connection,"INSERT INTO `user_account` (`id`, `employee_id`, `user_name`, `password`, `authority`) VALUES (NULL, '$employee_id', '$user_name_employee', '$password_employee', '$authority')");
            if ($sql_query_001)
            {
                echo "success-";
            }
            else
            {
                echo "failed-";
            }
        }
        else
        {
            $sql_query_02 = mysqli_query($connection,"UPDATE `user_account` SET `employee_id`='$employee_id',`user_name`='$user_name_employee',`password`='$password_employee',`authority`='$authority' WHERE id='$edit_id'");
            if ($sql_query_02)
            {
                echo "success-registered_users.php";
            }
            else
            {
                echo "failed-registered_users.php";
            }
        }

        exit();
        
    }

   

    

    

    if(isset($_POST["sales_edit_bill_number"]))
    {
        $sales_edit_bill_number = $_POST["sales_edit_bill_number"];
        $sales_edit_customer_name = $_POST["sales_edit_customer_name"];   
        $date_sh = explode("/",$_POST["edit_sale_date"]);
        $edit_sale_date =  jalali_to_gregorian($date_sh[0],$date_sh[1],$date_sh[2],'/');  

        $sql_query_001 = mysqli_query($connection,"update sale_major set customer_id='$sales_edit_customer_name',date='$edit_sale_date' where id='$sales_edit_bill_number'");
        
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

    if(isset($_POST["purchase_edit_bill_number"]))
    {
        $purchase_edit_bill_number = $_POST["purchase_edit_bill_number"];
        $purchase_edit_supplier_name = $_POST["purchase_edit_supplier_name"];   
        $edit_purchase_status = $_POST["edit_purchase_status"];   
        $date_sh = explode("/",$_POST["edit_purchase_date"]);
        $edit_purchase_date =  jalali_to_gregorian($date_sh[0],$date_sh[1],$date_sh[2],'/'); 
        // $edit_party_number = $_POST["edit_party_number"];   

        // upload the document 
        $picUpload = $_FILES['edit_file']['name'];
        
        $sql_query_001;
        
        if($picUpload == "")
        {
            $sql_query_001 = mysqli_query($connection,"update purchase_major set supplier_id ='$purchase_edit_supplier_name',purchase_status='$edit_purchase_status',date='$edit_purchase_date'  where id='$purchase_edit_bill_number'");
        }
        else
        {
            $picSource = $_FILES['edit_file']['tmp_name'];
            $picTarget = 'purchase_documents/'.$_FILES['edit_file']['name'];
            move_uploaded_file($picSource, $picTarget);


            $sql_query_001 = mysqli_query($connection,"update purchase_major set supplier_id ='$purchase_edit_supplier_name',date='$edit_purchase_date',purchase_status='$edit_purchase_status',file='$picUpload'  where id='$purchase_edit_bill_number'");

        }

        
        
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


    if(isset($_POST["sales_minor_edit_id"]))
    {
        $sales_minor_edit_id = $_POST["sales_minor_edit_id"];
        $sales_minor_edit_amount = $_POST["sales_minor_edit_amount"];   
        $sales_minor_edit_sale_rate = $_POST["sales_minor_edit_sale_rate"];   
        $sales_minor_edit_details = $_POST["sales_minor_edit_details"];   
        // $sales_minor_edit_expense = $_POST["sales_minor_edit_expense"];   

        $sql_query_001 = mysqli_query($connection,"update sale_minor set amount='$sales_minor_edit_amount',sale_rate='$sales_minor_edit_sale_rate',details='$sales_minor_edit_details' where id='$sales_minor_edit_id'");
        

        $sql_query_002 = mysqli_query($connection,"SELECT sale_minor.sale_major_id  from sale_minor WHERE sale_minor.id ='$sales_minor_edit_id'");
        $fetch_002 = mysqli_fetch_assoc($sql_query_002);

        $sale_major_id = $fetch_002["sale_major_id"];


        if ($sql_query_001)
        {

            $sql_query_003 = mysqli_query($connection,"SELECT SUM(sale_minor.amount * sale_minor.sale_rate) as total_sold_price FROM sale_minor WHERE sale_minor.sale_major_id  ='$sale_major_id'");
            $fetch_003 = mysqli_fetch_assoc($sql_query_003);
            $total_sold_price = $fetch_003["total_sold_price"];

            $sql_query_004 = mysqli_query($connection,"update customer_billance set debit_amount='$total_sold_price' where sale_id ='$sale_major_id' order by id asc limit 1");


            echo "success";
        }
        else
        {
            echo "failed";
        }

        exit();
        
    }
    if(isset($_POST["purchase_minor_edit_id"]))
    {
        $purchase_minor_edit_id = $_POST["purchase_minor_edit_id"];
        $purchase_minor_edit_amount = $_POST["purchase_minor_edit_amount"];   
        $purchase_minor_edit_purchase_rate = $_POST["purchase_minor_edit_purchase_rate"];   
        $purchase_minor_edit_sale_rate = $_POST["purchase_minor_edit_sale_rate"];   
        // $purchase_minor_edit_commission = $_POST["purchase_minor_edit_commission"];   
        // $purchase_minor_edit_office_expense = $_POST["purchase_minor_edit_office_expense"]; 
          
        

        $sql_query_001 = mysqli_query($connection,"update purchase_minor set amount='$purchase_minor_edit_amount',purchase_price='$purchase_minor_edit_purchase_rate',sale_price='$purchase_minor_edit_sale_rate' where id='$purchase_minor_edit_id'");
        
        $sql_query_002 = mysqli_query($connection,"SELECT purchase_minor.purchase_major_id from purchase_minor WHERE purchase_minor.id ='$purchase_minor_edit_id'");
        $fetch_002 = mysqli_fetch_assoc($sql_query_002);

        $purchase_major_id = $fetch_002["purchase_major_id"];

        


        if ($sql_query_001)
        {
            $sql_query_003 = mysqli_query($connection,"SELECT SUM(purchase_minor.amount * purchase_minor.purchase_price) as total_purchase_price FROM purchase_minor WHERE purchase_minor.purchase_major_id ='$purchase_major_id'");
            $fetch_003 = mysqli_fetch_assoc($sql_query_003);
            $total_purchase_price = $fetch_003["total_purchase_price"];

            $sql_query_004 = mysqli_query($connection,"update supplier_billance set debit_amount='$total_purchase_price' where purchase_id ='$purchase_major_id' order by id asc limit 1");


            echo "success";
        }
        else
        {
            echo "failed";
        }

        exit();
        
    }


    if(isset($_POST["shafaf_full_name"]))
    {
        $full_name = $_POST["shafaf_full_name"];
        $amount = $_POST["amount"];
        $currency = $_POST["currency"];
        $type = $_POST["type"];
        $rate = $_POST["rate"];
        $date = $_POST["date"];
        $details = $_POST["details"];
        $commission = $_POST["commission"];

        $edit_id = $_POST["edit_id"];

        if($edit_id == "")
        {
            $sql_query_02 = mysqli_query($connection,"INSERT INTO `shafaf` (`id`, `full_name`, `amount`,`type`,`commission`, `currency_id`, `rate`, `date`, `details`) VALUES (NULL, '$full_name', '$amount','$type','$commission', '$currency', '$rate', '$date', '$details')");
            if ($sql_query_02)
            {
                echo "success-";
            }
            else
            {
                echo "failed-";
            }
        }
        else
        {
            $sql_query_02 = mysqli_query($connection,"UPDATE `shafaf` SET `full_name`='$full_name',`amount`='$amount',`type`='$type',`commission`='$commission',`currency_id`='$currency',`rate`='$rate',`date`='$date',`details`='$details' WHERE id='$edit_id'");
            if ($sql_query_02)
            {
                echo "success-view_shafaf_reciepts.php";
            }
            else
            {
                echo "failed-view_shafaf_reciepts.php";
            }
        }


        

        exit();
        
    }


    if(isset($_POST["orderer"]))
    {
        $orderer = $_POST["orderer"];
        $details = $_POST["details"];
        $currency = $_POST["currency_id"];
        $price = $_POST["price"];
        $rate = $_POST["rate"];
        $register_date = $_POST["register_date"];
        $return_date = $_POST["return_date"];

        $edit_id = $_POST["edit"];

        if($edit_id == "")
        {
            $sql_query_02 = mysqli_query($connection,"INSERT INTO `orders` (`id`, `orderer`, `details`, `price`, `currency_id`, `rate`, `register_date`, `return_date`) VALUES (NULL, '$orderer', '$details', '$price', '$currency', '$rate', '$register_date', '$return_date')");

            if ($sql_query_02)
            {
                echo "success-";
            }
            else
            {
                echo "failed-";
            }
        }
        else
        {

            $order_status = $_POST["order_status"];

            $sql_query_02 = mysqli_query($connection,"UPDATE `orders` SET `orderer`='$orderer',`details`='$details',`price`='$price',`currency_id`='$currency',`rate`='$rate',`register_date`='$register_date',`return_date`='$return_date',`status`='$order_status' WHERE id='$edit_id'");

            if ($sql_query_02)
            {
                echo "success-orders_list.php";
            }
            else
            {
                echo "failed-orders_list.php";
            }
        }


        

        exit();
        
    }



    if(isset($_POST["alterant_main_product"]))
    {


        $alterant_main_product = $_POST["alterant_main_product"];
        $party_number_arr = explode("~",$_POST["party_number"]);  

        $party_number = $party_number_arr[0]; 
        $purchase_reference_id = $party_number_arr[1]; 

        $main_product_amount = $_POST["main_product_amount"];   
        $first_catched_product = $_POST["first_catched_product"];   
        $first_catched_product_amount = $_POST["first_catched_product_amount"];   
        $second_catched_product = $_POST["second_catched_product"];   
        $second_catched_product_amount = $_POST["second_catched_product_amount"];   
        $losses = $_POST["losses"];   
        $expense_per_ton = $_POST["expense_per_ton"];   
        $date = $_POST["date"]; 



        $sql_query_001 = mysqli_query($connection,"INSERT INTO `alterant` (`id`, `main_product`, `purchase_id`, `main_product_amount`, `first_catched_product`, `first_catched_product_amount`, `second_catched_product`, `second_catched_product_amount`, `expense_per_ton`, `losses_amount`, `date`) VALUES (NULL, '$alterant_main_product', '$purchase_reference_id', '$main_product_amount', '$first_catched_product', '$first_catched_product_amount', '$second_catched_product', '$second_catched_product_amount', '$expense_per_ton', '$losses', '$date')");

        $sql_query_003_x = mysqli_query($connection,"SELECT id from alterant ORDER by id DESC LIMIT 1");
        $fetch_003_x = mysqli_fetch_assoc($sql_query_003_x);

        $alterant_id = $fetch_003_x["id"];



        $sql_query_002 = mysqli_query($connection,"INSERT INTO `purchase_major` (`id`, `supplier_id`, `reciept`, `currency_id`, `date`, `file`, `party_number`, `alterant`) VALUES (NULL, NULL, '', '1', '$date', '', '$party_number', '$alterant_id')");


        $sql_query_003 = mysqli_query($connection,"SELECT id from purchase_major ORDER by id DESC LIMIT 1");
        $fetch_003 = mysqli_fetch_assoc($sql_query_003);

        $purchase_major_id = $fetch_003["id"];


     

        // first product 
        $sql_query_004 = mysqli_query($connection,"SELECT * FROM `purchase_minor` WHERE id='$purchase_reference_id'");
        $fetch_004 = mysqli_fetch_assoc($sql_query_004);

        
        $purchase_price = $fetch_004["purchase_price"];
        $office_expense = $fetch_004["office_expense"];
        $commision_expense = $fetch_004["commision_expense"];

        $final_office_expense = $office_expense + $expense_per_ton;

        // first product queries
        $sql_query_005 = mysqli_query($connection,"INSERT INTO `purchase_minor` (`id`, `purchase_major_id`, `item_id_stock_major`, `amount`, `purchase_price`, `vagon_quantity`, `per_vagon_weight`, `office_expense`, `commision_expense`) VALUES (NULL, '$purchase_major_id', '$first_catched_product', '$first_catched_product_amount', '$purchase_price', '', '', '$final_office_expense', '$commision_expense')");



        // second product queries
        $sql_query_006 = mysqli_query($connection,"INSERT INTO `purchase_minor` (`id`, `purchase_major_id`, `item_id_stock_major`, `amount`, `purchase_price`, `vagon_quantity`, `per_vagon_weight`, `office_expense`, `commision_expense`) VALUES (NULL, '$purchase_major_id', '$second_catched_product', '$second_catched_product_amount', '$purchase_price', '', '', '$final_office_expense', '$commision_expense')");


        // insert into sale main-purchased-product

        $sql_query_007 = mysqli_query($connection,"INSERT INTO `sale_major` (`id`, `customer_id`, `reciept`, `currency_id`, `date`, `alterant_id`) VALUES (NULL, NULL, '', '1', '$date', '$alterant_id')");

        $sql_query_008 = mysqli_query($connection,"SELECT id from sale_major ORDER by id DESC LIMIT 1");
        $fetch_008 = mysqli_fetch_assoc($sql_query_008);

        $sale_major_id = $fetch_008["id"];


        $sql_query_009 = mysqli_query($connection,"INSERT INTO `sale_minor` (`id`, `amount`, `sale_rate`, `details`, `purchase_minor_id`, `sale_major_id`, `expense`) VALUES (NULL, '$main_product_amount', '', '', '$purchase_reference_id', '$sale_major_id', '')");


        
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




    if(isset($_POST["good_name"]))
    {
        $good_name = $_POST["good_name"];
        $edit = $_POST["edit"];
        
        
      
        if($edit == "")
        {
            $sql_query_001 = mysqli_query($connection,"INSERT INTO `stock_minor` (`id`, `item_name`) VALUES (NULL, '$good_name')");


            if ($sql_query_001)
            {
                echo "success-";
            }
            else
            {
                echo "failed-";
            }
        }
        else
        {
            $barcode = $_POST["barcode"];

            $sql_query_001 = mysqli_query($connection,"UPDATE stock_minor SET item_name='$good_name' WHERE id='$edit'");
            if ($sql_query_001)
            {
                $sql_query_002 = mysqli_query($connection,"UPDATE stock_major SET barcode='$barcode' WHERE item_id='$edit'");

                echo "success - registered_goods.php";
            }
            else
            {
                echo "failed - registered_goods.php";
            }
        }

        exit();
        
    }

    if(isset($_POST["add_exist_good_id"]))
    {
        $add_exist_good_id = $_POST["add_exist_good_id"];
        $amount = $_POST["amount"];
        $major_unit_id = $_POST["major_unit_id"];
        $add_minor_unit_id = $_POST["add_minor_unit_id"];
        $barcode = $_POST["barcode"];
        $less_then = $_POST["less_then"];
        
        $sql_query_001 = mysqli_query($connection,"INSERT INTO `stock_major` (`id`, `item_id`, `amount`, `unit_id`, `minor_unit_id`,`barcode`,`less_then`) VALUES (NULL, '$add_exist_good_id', '$amount', '$major_unit_id', '$add_minor_unit_id','$barcode','$less_then')");
        
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

    if(isset($_POST["customer_full_name"]))
    {
        $customer_full_name = $_POST["customer_full_name"];
        $customer_province = $_POST["customer_province"];
        $phone_number = $_POST["phone_number"];
        $address = $_POST["address"];
        $date = date("Y-m-d");
        $edit = $_POST["edit"];
        
        
        if($edit == "")
        {
            $sql_query_001 = mysqli_query($connection,"INSERT INTO `customers` (`id`, `full_name`,`province_id`, `phone_number`, `address`, `date`) VALUES (NULL, '$customer_full_name','$customer_province', '$phone_number', '$address', '$date')");

            if ($sql_query_001)
            {
                echo "success-";
            }
            else
            {
                echo "failed-";
            }
        }
        else
        {
            $sql_query_001 = mysqli_query($connection,"UPDATE customers set full_name='$customer_full_name',customer_id='$customer_province',phone_number='$phone_number',address='$address' WHERE id='$edit'");
            if ($sql_query_001)
            {
                echo "success - registered_customers.php";
            }
            else
            {
                echo "failed - registered_customers.php";
            }
        }
        

        exit();
        
    }


    if(isset($_POST["commission_taker_full_name"]))
    {
        $commission_taker_full_name = $_POST["commission_taker_full_name"];
        $phone_number = $_POST["phone_number"];
        $address = $_POST["address"];
        $date = date("Y-m-d");
        $edit = $_POST["edit"];
        
        
        if($edit == "")
        {
            $sql_query_001 = mysqli_query($connection,"INSERT INTO `commission_takers` (`id`, `full_name`, `phone_number`, `address`, `date`) VALUES (NULL, '$commission_taker_full_name', '$phone_number', '$address', '$date')");

            if ($sql_query_001)
            {
                echo "success-";
            }
            else
            {
                echo "failed-";
            }
        }
        else
        {
            $sql_query_001 = mysqli_query($connection,"UPDATE commission_takers set full_name='$commission_taker_full_name',phone_number='$phone_number',address='$address' WHERE id='$edit'");
            if ($sql_query_001)
            {
                echo "success - registered_commission_taker.php";
            }
            else
            {
                echo "failed - registered_commission_taker.php";
            }
        }
        

        exit();
        
    }

    if(isset($_POST["supplier_full_name"]))
    {
        $supplier_full_name = $_POST["supplier_full_name"];
        $phone_number = $_POST["phone_number"];
        $address = $_POST["address"];
        $date = date("Y-m-d");
        
       
        $edit = $_POST["edit"];
        
        
        if($edit == "")
        {
            $sql_query_001 = mysqli_query($connection,"INSERT INTO `suppliers` (`id`, `full_name`, `phone_number`, `address`, `date`) VALUES (NULL, '$supplier_full_name', '$phone_number', '$address', '$date')");
        
            if ($sql_query_001)
            {
                echo "success-";
            }
            else
            {
                echo "failed-";
            }
        }
        else
        {
            $sql_query_001 = mysqli_query($connection,"UPDATE suppliers SET full_name='$supplier_full_name',phone_number='$phone_number',address='$address' WHERE id='$edit'");
        
            if ($sql_query_001)
            {
                echo "success - registered_suppliers.php";
            }
            else
            {
                echo "failed - registered_suppliers.php";
            }
        }
        


        exit();
        
    }

    if(isset($_POST["vagon_number"]))
    {
        $vagon_number = $_POST["vagon_number"];
        $vagon_weight = $_POST["vagon_weight"];
        
       
        $edit = $_POST["edit"];
        
        
        if($edit == "")
        {
            $sql_query_001 = mysqli_query($connection,"INSERT INTO `vagons` (`id`, `vagon_number`, `vagon_weight`) VALUES (NULL, '$vagon_number', '$vagon_weight')");
        
            if ($sql_query_001)
            {
                echo "success-";
            }
            else
            {
                echo "failed-";
            }
        }
        else
        {
            $sql_query_001 = mysqli_query($connection,"UPDATE vagons SET vagon_number='$vagon_number',vagon_weight='$vagon_weight'  WHERE id='$edit'");
        
            if ($sql_query_001)
            {
                echo "success - registered_vagons.php";
            }
            else
            {
                echo "failed - registered_vagons.php";
            }
        }
        


        exit();
        
    }


    if(isset($_POST["add_minor_unit_major_id"]))
    {
        $add_minor_unit_major_id = $_POST["add_minor_unit_major_id"];
        $unit_name = $_POST["unit_name"];
        $unit_pack_qantity = $_POST["unit_pack_qantity"];
        $kg_factor = $_POST["kg_factor"];
        $edit = $_POST["edit"];
        
        
        if($edit == "")
        {
            $sql_query_001 = mysqli_query($connection,"INSERT INTO `unit_minor` (`id`, `unit_major_id`, `unit_name`, `pack_quantity`, `major_factor`) VALUES (NULL, '$add_minor_unit_major_id', '$unit_name', '$unit_pack_qantity', '$kg_factor')");
            if ($sql_query_001)
            {
                echo "success-";
            }
            else
            {
                echo "failed-";
            }
        }
        else
        {
            $sql_query_001 = mysqli_query($connection,"UPDATE unit_minor SET unit_major_id='$add_minor_unit_major_id',unit_name='$unit_name',pack_quantity='$unit_pack_qantity',major_factor='$kg_factor' WHERE id='$edit'");
            if ($sql_query_001)
            {
                echo "success - registered_minor_units.php";
            }
            else
            {
                echo "failed - registered_minor_units.php";
            }
        }

        exit();
        
    }
    if(isset($_POST["major_unit_name"]))
    {
        $major_unit_name = $_POST["major_unit_name"];
        $edit = $_POST["edit"];
        
        if($edit == "")
        {
            $sql_query_001 = mysqli_query($connection,"INSERT INTO `unit_major` (`id`, `unit_name`) VALUES (NULL, '$major_unit_name')");
            if ($sql_query_001)
            {
                echo "success-";
            }
            else
            {
                echo "failed-";
            }
        }
        else
        {
            $sql_query_001 = mysqli_query($connection,"UPDATE unit_major SET unit_name='$major_unit_name' WHERE id ='$edit'");
            if ($sql_query_001)
            {
                echo "success-registered_major_units.php";
            }
            else
            {
                echo "failed-registered_major_units.php";
            }
        }
        

        exit();
        
    }
    if(isset($_POST["expenses_category"]))
    {
        $expenses_category = $_POST["expenses_category"];
        
        
        $sql_query_001 = mysqli_query($connection,"INSERT INTO `expenses_categories` (`id`, `name`) VALUES (NULL, '$expenses_category')");
        
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

    if(isset($_POST["expense_category_id"]))
    {
        $expense_category_id = $_POST["expense_category_id"];
        $details = $_POST["details"];
        $amount = $_POST["amount"];
        $rate = $_POST["rate"];
        $expense_currency_id = $_POST["expense_currency_id"];
        $edit = $_POST["edit"];
        $date_sh = explode("-",$_POST["input_date"]);
        $date =  jalali_to_gregorian($date_sh[0],$date_sh[1],$date_sh[2],'/');
       

        

        if($edit == "")
        {
            $sql_query_001 = mysqli_query($connection,"INSERT INTO `expenses` (`id`, `ex_cate_id`, `details`, `amount`,`rate`, `currenycy_id`, `date`) VALUES (NULL, '$expense_category_id', '$details', '$amount','$rate', '$expense_currency_id', '$date')");

            if ($sql_query_001)
            {
                echo "success-";
            }
            else
            {
                echo "failed-";
            }
        }
        else
        {
            
            $sql_query_001 = mysqli_query($connection,"UPDATE expenses SET ex_cate_id='$expense_category_id',details='$details',amount='$amount',rate='$rate',currenycy_id='$expense_currency_id',date='$date' WHERE id='$edit'");

            if ($sql_query_001)
            {
                echo "success - registered_expenses.php";
            }
            else
            {
                echo "failed - registered_expenses.php";
            }
        }
        

        exit();
        
    }

    if(isset($_POST["rate_agency_admin_id"]))
    {
        $rate_agency_admin_id = $_POST["rate_agency_admin_id"];
        $good_id = $_POST["good_id"];
        $purchase_rate = $_POST["purchase_rate"];
        $sale_rate = $_POST["sale_rate"];
        $date = date("Y-m-d");
        
        $sql_query_001 = mysqli_query($connection,"INSERT INTO `rates_tb` (`id`, `agency_id`, `item_stock_minor_id`, `purchase_rate`, `sale_rate`,`date`) VALUES (NULL, '$rate_agency_admin_id', '$good_id', '$purchase_rate', '$sale_rate','$date')");
        
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

    if(isset($_POST["supplier_reciept_details"]))
    {
        $supplier_reciept_details = $_POST["supplier_reciept_details"];
        $supplier_id_reciept = $_POST["supplier_id_reciept"];
        $amount = $_POST["amount"];
        $currency = $_POST["currency"];
        $rate = $_POST["rate"];
        $date = $_POST["date"];
        $commission = $_POST["commission"];
        $debit_amount = $_POST["debit_amount"];


        $edit_id = $_POST["edit_id"];
        
        if($edit_id == "")
        {
            $sql_query_02 = mysqli_query($connection,"INSERT INTO `supplier_billance` (`id`, `description`, `credit_amount`, `debit_amount`, `date`, `supplier_id`, `purchase_id`, `currency_id`, `rate`, `commission`) VALUES (NULL, '$supplier_reciept_details', '$amount', '$debit_amount', '$date', '$supplier_id_reciept', NULL, '$currency', '$rate', '$commission')");


            if ($sql_query_02)
            {
                echo "success-";
            }
            else
            {
                echo "failed-";
            }
        }
        else
        {
            $supplier_name = $_POST["supplier_name"];

            $sql_query_02 = mysqli_query($connection,"UPDATE `supplier_billance` SET `description`='$supplier_reciept_details',`credit_amount`='$amount',`debit_amount`='$debit_amount',`date`='$date',`supplier_id`='$supplier_id_reciept',`currency_id`='$currency',`rate`='$rate',`commission`='$commission' WHERE id='$edit_id'");

            if ($sql_query_02)
            {
                echo "success-supplier_account_billance.php?supplier_id=$supplier_id_reciept&supplier_name=$supplier_name";
            }
            else
            {
                echo "failed-supplier_account_billance.php?supplier_id=$supplier_id_reciept&supplier_name=$supplier_name";
            }
        }

        exit();
    }

    if(isset($_POST["customer_reciept_details"]))
    {
        $customer_reciept_details = $_POST["customer_reciept_details"];
        $customer_id_reciept = $_POST["customer_id_reciept"];
        $amount = $_POST["amount"];
        $currency = $_POST["currency"];
        $rate = $_POST["rate"];
        $date = $_POST["date"];
        $commission = $_POST["commission"];
        $debit_amount = $_POST["debit_amount"];


        $edit_id = $_POST["edit_id"];
        
        if($edit_id == "")
        {
            $sql_query_02 = mysqli_query($connection,"INSERT INTO `customer_billance` (`id`, `description`, `credit_amount`, `debit_amount`, `date`, `customer_id`, `sale_id`, `currency_id`, `rate`, `commission`) VALUES (NULL, '$customer_reciept_details', '$amount', '$debit_amount', '$date', '$customer_id_reciept', NULL, '$currency', '$rate', '$commission')");

            if ($sql_query_02)
            {
                echo "success-";
            }
            else
            {
                echo "failed-";
            }
        }
        else
        {
            $customer_name = $_POST["customer_name"];

            $sql_query_02 = mysqli_query($connection,"UPDATE `customer_billance` SET `description`='$customer_reciept_details',`credit_amount`='$amount',`debit_amount`='$debit_amount',`date`='$date',`customer_id`='$customer_id_reciept',`currency_id`='$currency',`rate`='$rate',`commission`='$commission' WHERE id='$edit_id'");

            if ($sql_query_02)
            {
                echo "success-customer_account_billance.php?customer_id=$customer_id_reciept&customer_name=$customer_name";
            }
            else
            {
                echo "failed-customer_account_billance.php?customer_id=$customer_id_reciept&customer_name=$customer_name";
            }
        }


        

        exit();
    }



    if(isset($_POST["add_purchase_major_stock_id"]))
    {
        
        $currency = $_POST["currency"];
        $purchase_status = $_POST["purchase_status"];
        $rate = $_POST["rate"];
        $total_price_final = $_POST["total_price_final"];
        $total_reciept = $_POST["total_reciept"];
        $supplier_major_id = $_POST["supplier_major_id"];

        $date_sh = explode("-",$_POST["purchase_date"]);
        $purchase_date =  jalali_to_gregorian($date_sh[0],$date_sh[1],$date_sh[2],'/');
        // $party_number =  $_POST["party_number"];
        // $commission_taker =  $_POST["commission_taker"];
        $total_price_final = $_POST["total_price_final"];
        

        // upload the document 
        $picUpload = $_FILES['attached_file']['name'];
        $picSource = $_FILES['attached_file']['tmp_name'];
        $picTarget = 'purchase_documents/'.$_FILES['attached_file']['name'];
        move_uploaded_file($picSource, $picTarget);
     
        
            $sql_query_001 = mysqli_query($connection,"INSERT INTO `purchase_major` (`id`, `supplier_id`, `reciept`, `currency_id`, `date`,`file`,`party_number`,`purchase_status`) VALUES (NULL, '$supplier_major_id', '$total_reciept', '$currency', '$purchase_date', '$picUpload','','$purchase_status')");
       

        if($sql_query_001)
        {
            
            $sql_query_003 = mysqli_query($connection,"SELECT purchase_major.id FROM `purchase_major`  ORDER BY id DESC LIMIT 1");
            $fetch_003 = mysqli_fetch_assoc($sql_query_003);
           
            // map
            $add_purchase_major_stock_id_arr = $_POST["add_purchase_major_stock_id"];
            
            $product_quantity_arr = $_POST["product_quantity"];
            // $vagon_weight_arr = $_POST["vagon_weight"];
            $purchase_price_arr = $_POST["purchase_price"];
            $sale_price_arr = $_POST["sale_price"];
            $expiration_date_arr = $_POST["expiration_date"];
            
            // $commision_expense_arr = $_POST["commision_expense"];
            // $office_expense_arr = $_POST["office_expense"];
            // $vagon_numbers_inputs_arr = $_POST["vagon_numbers_inputs"]; 



            $purchase_major_id = $fetch_003["id"];
            
            $reciept_details = " خرید - بل نمبر " . $purchase_major_id;
            $sql_query_0011 = mysqli_query($connection,"INSERT INTO `supplier_billance` (`id`, `description`, `credit_amount`, `debit_amount`, `date`, `supplier_id`, `purchase_id`, `currency_id`, `rate`, `commission`) VALUES (NULL, '$reciept_details', '0', '$total_price_final', '$purchase_date', '$supplier_major_id', '$purchase_major_id', '$currency', '1', '0')");

            if($total_reciept > 0)
            {
                
                $sql_query_0011 = mysqli_query($connection,"INSERT INTO `supplier_billance` (`id`, `description`, `credit_amount`, `debit_amount`, `date`, `supplier_id`, `purchase_id`, `currency_id`, `rate`, `commission`) VALUES (NULL, '$reciept_details', '$total_reciept', '0', '$purchase_date', '$supplier_major_id', '$purchase_major_id', '$currency', '$rate', '0')");

            }
            else
            {
                
            }

       
            

            for ($i=0; $i < sizeof($add_purchase_major_stock_id_arr); $i++)
            {
                
                $add_purchase_major_stock_id = $add_purchase_major_stock_id_arr[$i];


                $product_quantity = $product_quantity_arr[$i];
                // $vagon_weight = $vagon_weight_arr[$i];

                $amount = $product_quantity;


                $purchase_price = $purchase_price_arr[$i];
                $sale_price = $sale_price_arr[$i];
                $expiration_date = $expiration_date_arr[$i];
                // $commision_expense = $commision_expense_arr[$i];

                // $office_expense = $office_expense_arr[$i];

                // $vagon_numbers_input = $vagon_numbers_inputs_arr[$i];

                
                $sql_query_002 = mysqli_query($connection,"INSERT INTO `purchase_minor` (`id`, `purchase_major_id`, `item_id_stock_major`, `amount`, `purchase_price`,`sale_price`, `vagon_quantity`, `per_vagon_weight`,`vagon_number`, `office_expense`, `commision_expense`,`expiration_date`) VALUES (NULL, '$purchase_major_id', '$add_purchase_major_stock_id', '$amount', '$purchase_price','$sale_price', '', '','', '', '','$expiration_date')");

                // $commission_amount = $amount * $commision_expense;
                // $commission_text = 'کمیشم بابت پارتی نمبر ' . $party_number;

                // $office_expense_amount = $amount * $office_expense;
                // $office_expense_text = 'مصرف دفتر بابت پارتی نمبر ' . $party_number;

                // if($commission_amount > 0)
                // {
                //     $sql_query_003 = mysqli_query($connection,"INSERT INTO `commissions` (`id`, `amount`, `details`, `party_number`, `date`, `purchase_commission`,`commission_taker`) VALUES (NULL, '$commission_amount', '$commission_text', '$party_number', '$purchase_date', '1','$commission_taker')");
                // }
                // else
                // {

                // }

                // if($office_expense_amount > 0)
                // {
                //     $sql_query_003 = mysqli_query($connection,"INSERT INTO `commissions` (`id`, `amount`, `details`, `party_number`, `date`, `purchase_commission`,`purchase_office_expense`) VALUES (NULL, '$office_expense_amount', '$office_expense_text', '$party_number', '$purchase_date', '0','1')");
                // }
                // else
                // {

                // }
            }

            


        }
        if ($sql_query_001)
            {
                echo "اطلاعات موفقانه ذخیره شد";
            }
            else
            {
                echo "خطا در ذخیره سازی اطلاعات";
            }
        

        exit();
        
    }

    if(isset($_POST["sales_reciept_full_name"]))
            {
                $full_name = $_POST["sales_reciept_full_name"];
                $sale_reciept_id = $_POST["sale_reciept_id"];
                $amount = $_POST["amount"];
                $currency = $_POST["currency"];
                $rate = $_POST["rate"];
                $date = $_POST["date"];
                $details = $_POST["details"];

                $rasid_type = $_POST["rasid_type"];

                if($rasid_type == "from_account")
            {

                $sql_query_02 = mysqli_query($connection,"INSERT INTO `reciepts` (`id`, `full_name`, `amount`, `currency_id`,`rate`, `purchase_id`, `sale_id`, `date`, `details`) VALUES (NULL, '$full_name', '$amount', '$currency','$rate', NULL, '$sale_reciept_id', '$date', '$details')");


                $sql_query_001xx = mysqli_query($connection,"select customer_id  from sale_major where id='$sale_reciept_id'");
                $fetch_001xx = mysqli_fetch_assoc($sql_query_001xx);

                $customer_id = $fetch_001xx["customer_id"];
                $reciept_details = "برداخت بخاطر فروش بل نمبر " . $sale_reciept_id;
                
                $sql_query_001_xx = mysqli_query($connection,"INSERT INTO `reciepts` (`id`,`full_name`, `amount`, `currency_id`,`rate`, `purchase_id`, `sale_id`, `date`,`details`,`supplier_id`,`customer_id`,`cus_sale_id `) VALUES (NULL,'$full_name', '-$amount', '$currency','$rate',  NULL,NULL, '$date','$reciept_details',NULL,'$customer_id','$sale_reciept_id')");

            }
            else
            {
                $sql_query_02 = mysqli_query($connection,"INSERT INTO `reciepts` (`id`, `full_name`, `amount`, `currency_id`,`rate`, `purchase_id`, `sale_id`, `date`, `details`) VALUES (NULL, '$full_name', '$amount', '$currency','$rate', NULL, '$sale_reciept_id', '$date', '$details')");    
            }


                if($sql_query_02)
                {
                    echo "<script>alert('موفقانه ذخیره شده');</script>";
                }else
                {
                    echo "<script>alert('خطا در ذخیره سازی اطلاعات');</script>";
                }
                exit();
            }

            if(isset($_POST["purchase_reciept_full_name"]))
            {
                $full_name = $_POST["purchase_reciept_full_name"];
                $purchase_reciept_id = $_POST["purchase_reciept_id"];
                $amount = $_POST["amount"];
                $currency = $_POST["currency"];
                $rate = $_POST["rate"];
                $date = $_POST["date"];
                $details = $_POST["details"];
                $rasid_type = $_POST["rasid_type"];

                if($rasid_type == "from_account")
            {

                $sql_query_02 = mysqli_query($connection,"INSERT INTO `reciepts` (`id`, `full_name`, `amount`, `currency_id`,`rate`, `purchase_id`, `sale_id`, `date`, `details`) VALUES (NULL, '$full_name', '$amount', '$currency','$rate', '$purchase_reciept_id', NULL, '$date', '$details')");

                $sql_query_001xx = mysqli_query($connection,"select supplier_id from purchase_major where id='$purchase_reciept_id'");
                $fetch_001xx = mysqli_fetch_assoc($sql_query_001xx);

                $supplier_major_id = $fetch_001xx["supplier_id"];
                $reciept_details = "برداخت بخاطر خرید بل نمبر " . $purchase_reciept_id;
                
                $sql_query_001_xx = mysqli_query($connection,"INSERT INTO `reciepts` (`id`,`full_name`, `amount`, `currency_id`,`rate`, `purchase_id`, `sale_id`, `date`,`details`,`supplier_id`) VALUES (NULL,'$full_name', '-$amount', '$currency','$rate',  NULL,NULL, '$date','$reciept_details','$supplier_major_id')");

                }
                else
                {
                    $sql_query_02 = mysqli_query($connection,"INSERT INTO `reciepts` (`id`, `full_name`, `amount`, `currency_id`,`rate`, `purchase_id`, `sale_id`, `date`, `details`) VALUES (NULL, '$full_name', '$amount', '$currency','$rate', '$purchase_reciept_id', NULL, '$date', '$details')");
                }

                if($sql_query_02)
                {
                    echo "<script>alert('موفقانه ذخیره شده');</script>";
                }else
                {
                    echo "<script>alert('خطا در ذخیره سازی اطلاعات');</script>";
                }
                exit();
            }


    if(isset($_POST["add_sale_purchase_id"]))
    {
        
        $currency = $_POST["currency"];
        $rate = $_POST["rate"];
        $date_sh = explode("-",$_POST["sale_date"]);
        $sale_date =  jalali_to_gregorian($date_sh[0],$date_sh[1],$date_sh[2],'/');

        // $sale_date =  $_POST["sale_date"];
        
        $total_reciept = $_POST["total_reciept"];
        $customer_id = $_POST["customer_id"];
        $total_price_final = $_POST["total_price_final"];

   
            $sql_query_001 = mysqli_query($connection,"INSERT INTO `sale_major` (`id`, `customer_id`, `reciept`, `currency_id`, `date`) VALUES (NULL, '$customer_id', '$total_reciept', '$currency', '$sale_date')");


        if($sql_query_001)
        {

            $sql_query_003 = mysqli_query($connection,"SELECT sale_major.id FROM `sale_major`  ORDER BY id DESC LIMIT 1");
            $fetch_003 = mysqli_fetch_assoc($sql_query_003);

            // map
            $add_sale_purchase_id_arr = $_POST["add_sale_purchase_id"];
            $amount_arr = $_POST["amount"];
            $sale_price_arr = $_POST["sale_price"];
            // $commission_arr = $_POST["commission"];
            // $party_number_arr = $_POST["party_number"];
            // $expense_arr = $_POST["expense"];
            $sale_major_id = $fetch_003["id"];

            $purchase_major_id = $fetch_003["id"];
            
            $reciept_details = " فروش - بل نمبر " . $purchase_major_id;
            $sql_query_0011 = mysqli_query($connection,"INSERT INTO `customer_billance` (`id`, `description`, `credit_amount`, `debit_amount`, `date`, `customer_id`, `sale_id`, `currency_id`, `rate`, `commission`) VALUES (NULL, '$reciept_details', '0', '$total_price_final', '$sale_date', '$customer_id', '$purchase_major_id', '$currency', '1', '0')");

            if($total_reciept > 0)
            {
                
                $sql_query_0011 = mysqli_query($connection,"INSERT INTO `customer_billance` (`id`, `description`, `credit_amount`, `debit_amount`, `date`, `customer_id`, `sale_id`, `currency_id`, `rate`, `commission`) VALUES (NULL, '$reciept_details', '$total_reciept', '0', '$sale_date', '$customer_id', '$sale_major_id', '$currency', '$rate', '0')");

            }
            else
            {
                
            }
         

            
            

    
            for ($i=0; $i < count($add_sale_purchase_id_arr); $i++)
            {
                
                $add_sale_purchase_id = $add_sale_purchase_id_arr[$i];
                $amount = $amount_arr[$i];
                $sale_price = $sale_price_arr[$i];
                // $commission = $commission_arr[$i];
                // $party_number = $party_number_arr[$i];
                // $expense = $expense_arr[$i];
                
                $sql_query_002 = mysqli_query($connection,"INSERT INTO `sale_minor` (`id`, `amount`, `sale_rate`, `details`, `purchase_minor_id`,`sale_major_id`,`expense`,`commission`) VALUES (NULL, '$amount', '$sale_price', '', '$add_sale_purchase_id','$sale_major_id','','')
                ");
                
                    if ($sql_query_002)
                    {
                        echo "اطلاعات موفقانه ذخیره شد";
                    }
                    else
                    {
                        echo "خطا در ذخیره سازی اطلاعات";
                    }



                // }
            
            }


        }
        

        exit();
        
    }

    if(isset($_POST["load_major_unit_id"]))
    {
        $load_major_unit_id = $_POST["load_major_unit_id"];

        $sql_query_001 = mysqli_query($connection,"SELECT * FROM `unit_minor` where unit_major_id='$load_major_unit_id'");
        
        $array_tb = array();
        $counter = 0;
        while ($rows = mysqli_fetch_array($sql_query_001)) {
            
            array_push($array_tb,$rows);

            $counter++;
        }

        print_r(json_encode($array_tb));

        exit();
        
    }

    if(isset($_POST["main_product_id_alternat"]))
    {
        $main_product_id_alternat = $_POST["main_product_id_alternat"];

        $sql_query_001 = mysqli_query($connection,"SELECT purchase_minor.*,purchase_major.date as purchase_date,purchase_major.party_number as party_number,stock_minor.item_name,(SELECT sum(sale_minor.amount) FROM sale_minor WHERE sale_minor.purchase_minor_id = purchase_minor.id) as total_sold_amount,(SELECT unit_minor.unit_name from unit_minor WHERE unit_minor.id = (SELECT stock_major.minor_unit_id FROM stock_major WHERE stock_major.id = purchase_minor.item_id_stock_major)) as minor_unit_name FROM `purchase_minor` LEFT JOIN purchase_major ON purchase_minor.purchase_major_id = purchase_major.id LEFT JOIN stock_minor ON stock_minor.id = purchase_minor.item_id_stock_major where purchase_minor.item_id_stock_major = '$main_product_id_alternat' or and purchase_minor.amount > 0;");
        
        $array_tb = array();
        $counter = 0;
        while ($rows = mysqli_fetch_array($sql_query_001)) {
            
            array_push($array_tb,$rows);

            $counter++;
        }

        print_r(json_encode($array_tb));

        exit();
        
    }


    if(isset($_POST["return_supplier_ballance"]))
    {
        $return_supplier_ballance = $_POST["return_supplier_ballance"];

        $sql_query_001 = mysqli_query($connection,"SELECT SUM(reciepts.amount/reciepts.rate) as total_remained_amount FROM reciepts WHERE supplier_id ='$return_supplier_ballance'");
        
        $array_tb = array();
        $counter = 0;
        while ($rows = mysqli_fetch_array($sql_query_001)) {
            
            array_push($array_tb,$rows);

            $counter++;
        }

        print_r(json_encode($array_tb));

        exit();
        
    }
    if(isset($_POST["return_customer_ballance"]))
    {
        $return_customer_ballance = $_POST["return_customer_ballance"];

        $sql_query_001 = mysqli_query($connection,"SELECT SUM(reciepts.amount/reciepts.rate) as total_remained_amount FROM reciepts WHERE customer_id ='$return_customer_ballance'");
        
        $array_tb = array();
        $counter = 0;
        while ($rows = mysqli_fetch_array($sql_query_001)) {
            
            array_push($array_tb,$rows);

            $counter++;
        }

        print_r(json_encode($array_tb));

        exit();
        
    }

    if(isset($_POST["load_commission_takers"]))
    {

        $sql_query_001 = mysqli_query($connection,"SELECT * FROM `commission_takers`");
        
        $array_tb = array();
        $counter = 0;
        while ($rows = mysqli_fetch_array($sql_query_001)) {
            
            array_push($array_tb,$rows);

            $counter++;
        }

        print_r(json_encode($array_tb));

        exit();
        
    }

    if(isset($_POST["load_commission_taker_rows"]))
    {   
        $commission_taker_id = $_POST["load_commission_taker_rows"];

        $sql_query_001 = mysqli_query($connection,"SELECT * FROM `commissions` where purchase_commission = '1' and commission_taker = '$commission_taker_id'");

        
        
        $array_tb_last_row = array();

        $sql_query_002 = mysqli_query($connection,"SELECT SUM(commissions.amount) as total_purchased_commission FROM commissions WHERE commissions.purchase_commission = 1 and commissions.commission_taker ='$commission_taker_id'");

        $fetch_002 = mysqli_fetch_assoc($sql_query_002);

        $sql_query_003 = mysqli_query($connection,"SELECT SUM(reciepts.amount / reciepts.rate) as total_purchased_commission_reciept FROM reciepts WHERE reciepts.purchase_commission = 1 and reciepts.commission_taker_id ='$commission_taker_id'");
        $fetch_003 = mysqli_fetch_assoc($sql_query_003);


        $array_tb_last_row[0] = $fetch_002["total_purchased_commission"];
        $array_tb_last_row[1] = $fetch_003["total_purchased_commission_reciept"];
        $array_tb_last_row[2] = '';
        $array_tb_last_row[3] = '';
        $array_tb_last_row[4] = '';
        $array_tb_last_row[5] = '';
        $array_tb_last_row[6] = '';
        $array_tb_last_row[7] = '';

        $array_tb = array();
        
        array_push($array_tb,$array_tb_last_row);


        
        $counter = 0;
        while ($rows = mysqli_fetch_array($sql_query_001)) {
            
            array_push($array_tb,$rows);

            $counter++;
        }

        

        print_r(json_encode($array_tb));

        exit();
        
    }

    if(isset($_POST["cammission_taker_id"]))
    {
        $cammission_taker_id = $_POST["cammission_taker_id"];
        $amount = $_POST["amount"];
        $currency = $_POST["currency"];
        $rate = $_POST["rate"];
        $date = $_POST["date"];
        $details = $_POST["details"];

        $sql_query_02 = mysqli_query($connection,"INSERT INTO `reciepts` (`id`, `full_name`, `amount`, `currency_id`,`rate`, `purchase_id`, `sale_id`, `date`, `details`,`purchase_commission`,`commission_taker_id`) VALUES (NULL, '$cammission_taker_id', '$amount', '$currency','$rate', NULL, NULL, '$date', '$details','1','$cammission_taker_id')");

        if($sql_query_02)
        {
            echo "success";
        }else
        {
            echo "failed";
        }

        exit();
    }

    if(isset($_POST["sale_commission_full_name"]))
    {
        $full_name = $_POST["sale_commission_full_name"];
        $amount = $_POST["amount"];
        $currency = $_POST["currency"];
        $rate = $_POST["rate"];
        $date = $_POST["date"];
        $details = $_POST["details"];

        $sql_query_02 = mysqli_query($connection,"INSERT INTO `reciepts` (`id`, `full_name`, `amount`, `currency_id`,`rate`, `purchase_id`, `sale_id`, `date`, `details`,`purchase_commission`) VALUES (NULL, '$full_name', '$amount', '$currency','$rate', NULL, NULL, '$date', '$details','2')");

        if($sql_query_02)
        {
            echo "success";
        }else
        {
            echo "failed";
        }
        
    }
    if(isset($_POST["t_customer_id"]))
    {
        $customer_id = $_POST["t_customer_id"];
        $sql_query_0012 = mysqli_query($connection,"update customers set status=1 where id='$customer_id'");

        if($sql_query_0012)
        {
            echo "success";
        }else
        {
            echo "failed";
        }
    }

    if(isset($_POST["t_supplier_id"]))
    {
        $supplier_id = $_POST["t_supplier_id"];
        $sql_query_0012 = mysqli_query($connection,"update suppliers set status=1 where id='$supplier_id'");

        if($sql_query_0012)
        {
            echo "success";
        }else
        {
            echo "failed";
        }
    }

    
    
?>