<?php
    

    // delete major_unit_id
    if(isset($_GET["major_unit_id"]))
    {
        $major_unit_id = $_GET["major_unit_id"];
        delete_func($major_unit_id,"unit_major");
    }
    // delete minor_unit_id
    if(isset($_GET["minor_unit_id"]))
    {
        $minor_unit_id = $_GET["minor_unit_id"];
        delete_func($minor_unit_id,"unit_minor");
    }
    // delete order_id
    if(isset($_GET["order_id"]))
    {
        $order_id = $_GET["order_id"];
        delete_func($order_id,"orders");
    }
  
    // delete customer_id
    if(isset($_GET["customer_id"]))
    {
        $customer_id = $_GET["customer_id"];
        delete_func($customer_id,"customers");
    }

    // delete expense_id
    if(isset($_GET["expense_id"]))
    {
        $expense_id = $_GET["expense_id"];
        delete_func($expense_id,"expenses");
    }
    // delete good_id
    if(isset($_GET["good_id"]))
    {
        $good_id = $_GET["good_id"];
        delete_func($good_id,"stock_minor");
    }
    // delete supplier_id
    if(isset($_GET["supplier_id"]))
    {
        $supplier_id = $_GET["supplier_id"];
        delete_func($supplier_id,"suppliers");
    }
 
    // delete employee_id
    if(isset($_GET["employee_id"]))
    {
        $employee_id = $_GET["employee_id"];
        delete_func($employee_id,"staff");
    }
 
    // delete user_id
    if(isset($_GET["user_id"]))
    {
        $user_id = $_GET["user_id"];
        delete_func($user_id,"user_account");
    }
    // delete purchased_items
    if(isset($_GET["purchase_id"]))
    {
        $purchase_id = $_GET["purchase_id"];
        delete_func($purchase_id,"purchase_major");
    }
    // delete purchased_item_id
    if(isset($_GET["purchased_item_id"]))
    {
        $purchased_item_id = $_GET["purchased_item_id"];
        delete_func($purchased_item_id,"purchase_minor");
    }
    // delete purchase_commission_id
    if(isset($_GET["purchase_commission_id"]))
    {
        $purchase_commission_id = $_GET["purchase_commission_id"];
        delete_func($purchase_commission_id,"commissions");
    }
    // delete sales_commission_id
    if(isset($_GET["sales_commission_id"]))
    {
        $sales_commission_id = $_GET["sales_commission_id"];
        delete_func($sales_commission_id,"commissions");
    }
    // delete sales_commission_reciept_id
    if(isset($_GET["sales_commission_reciept_id"]))
    {
        $sales_commission_reciept_id = $_GET["sales_commission_reciept_id"];
        delete_func($sales_commission_reciept_id,"reciepts");
    }
    // delete purchase_commission_reciept_id
    if(isset($_GET["purchase_commission_reciept_id"]))
    {
        $purchase_commission_reciept_id = $_GET["purchase_commission_reciept_id"];
        delete_func($purchase_commission_reciept_id,"reciepts");
    }
    // delete shafaf_reciept_id
    if(isset($_GET["shafaf_reciept_id"]))
    {
        $shafaf_reciept_id = $_GET["shafaf_reciept_id"];
        delete_func($shafaf_reciept_id,"shafaf");
    }
    // delete sale_id
    if(isset($_GET["sale_id"]))
    {
        $sale_id = $_GET["sale_id"];
        delete_func($sale_id,"sale_major");
    }
    // delete commission_taker
    if(isset($_GET["commission_taker_id"]))
    {
        $commission_taker_id = $_GET["commission_taker_id"];
        delete_func($commission_taker_id,"commission_takers");
    }
    // delete supplier_billance
    if(isset($_GET["supplier_acc_id"]))
    {
        $supplier_acc_id = $_GET["supplier_acc_id"];
        delete_func($supplier_acc_id,"supplier_billance");
    }

    // delete customer_billance
    if(isset($_GET["customer_acc_id"]))
    {
        $customer_acc_id = $_GET["customer_acc_id"];
        delete_func($customer_acc_id,"customer_billance");
    }
    
    // delete reciept_id
    if(isset($_GET["reciept_id"]))
    {
        $reciept_id = $_GET["reciept_id"];
        delete_func($reciept_id,"reciepts");
    }
 
    // delete sales_reciept_id
    if(isset($_GET["sales_reciept_id"]))
    {
        include("database.php");
        $sales_reciept_id = $_GET["sales_reciept_id"];
        $sql_query_001 = mysqli_query($connection,"select sale_id,amount  from reciepts where id='$sales_reciept_id'");
        $fetch_001 = mysqli_fetch_assoc($sql_query_001);
        $sale_id = $fetch_001["sale_id"];
        $amount = $fetch_001["amount"];

        $sql_query_002 = mysqli_query($connection,"select customer_id from sale_major where id='$sale_id'");
        $fetch_002 = mysqli_fetch_assoc($sql_query_002);
        $customer_id = $fetch_002["customer_id"];

        $sql_query_003 = mysqli_query($connection,"select id from reciepts where customer_id='$customer_id' and amount='-$amount' order by id desc limit 1");
        $fetch_003 = mysqli_fetch_assoc($sql_query_003);

        $customer_reciept_id = $fetch_003["id"];

        if($sql_query_003)
        {

            delete_func($sales_reciept_id,"reciepts");

            delete_func($customer_reciept_id,"reciepts");
        }
        else
        {

        }
    }
 

    // delete purchase_reciept_id
    if(isset($_GET["purchase_reciept_id"]))
    {
        include("database.php");
        $purchase_reciept_id = $_GET["purchase_reciept_id"];
        $sql_query_001 = mysqli_query($connection,"select purchase_id,amount  from reciepts where id='$purchase_reciept_id'");
        $fetch_001 = mysqli_fetch_assoc($sql_query_001);
        $purchase_id = $fetch_001["purchase_id"];
        $amount = $fetch_001["amount"];

        $sql_query_002 = mysqli_query($connection,"select supplier_id from purchase_major where id='$purchase_id'");
        $fetch_002 = mysqli_fetch_assoc($sql_query_002);
        $supplier_id = $fetch_002["supplier_id"];

        $sql_query_003 = mysqli_query($connection,"select id from reciepts where supplier_id='$supplier_id' and amount='-$amount' order by id desc limit 1");
        $fetch_003 = mysqli_fetch_assoc($sql_query_003);

        $supplier_reciept_id = $fetch_003["id"];

        if($sql_query_003)
        {

            delete_func($purchase_reciept_id,"reciepts");

            delete_func($supplier_reciept_id,"reciepts");
        }
        else
        {

        }
    }
 


    function delete_func($id,$table)
    {
        include("database.php");
        $sql_query_01 = mysqli_query($connection,"delete from $table where id='$id'");
        if($sql_query_01)
        {
            echo $id;
        }
        else {
            echo $id;
        }

    }
?>