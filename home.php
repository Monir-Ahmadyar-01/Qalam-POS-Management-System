
<?php include("database.php"); ?>
<?php include("jdf.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- jvectormap -->
        <link href="assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

        <!-- DataTables -->
        <link href="assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>        

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/persian-datepicker.css" rel="stylesheet" type="text/css" />


        <style>
            th{
                color: black;
            }
        </style>

    </head>

    <body>

        <!-- Navigation Bar-->
        <?php include("header.php"); ?>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="wrapper">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="page-title-alt-bg"></div>
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            
                            <li class="breadcrumb-item active">صفحه گزارشات</li>
                        </ol>
                    </div>
                    <h4 class="page-title">صفحه گزارشات</h4>
                </div> 
                <!-- end page title -->

                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="from_date">از تاریخ</label>
                            <input type="text" id="from_date" name="from_date" value="<?php echo jdate("Y-m-d",'','','','en'); ?>" class="form-control" >
                        </div>
                        <div class="col-sm-4">
                            <label for="to_date">تا تاریخ</label>
                            <input type="text" id="to_date" name="to_date" value="<?php echo jdate("Y-m-d",'','','','en'); ?>" class="form-control" >
                        </div>
                        <div class="col-sm-4">
                            <label for="submit_btn">.</label>
                            <input type="submit" id="submit_btn" value="جستجو" name="btn_search_submit" class="form-control btn btn-primary" >
                        </div>
                    </div>
                </form>
                <br>
                <?php

                $total_talabat = 0;
                if(isset($_POST["btn_search_submit"])){
                
                    $from_sh = $_POST["from_date"];
                    $from_sh_exp = explode("-",$from_sh);
                    $from_m =  jalali_to_gregorian($from_sh_exp[0],$from_sh_exp[1],$from_sh_exp[2],'/');
                    
                    $to_sh = $_POST["to_date"];
                    $to_sh_exp = explode("-",$to_sh);
                    $to_m =  jalali_to_gregorian($to_sh_exp[0],$to_sh_exp[1],$to_sh_exp[2],'/');





                    $total_talabat = 0;
                    $total_tadiat = 0;
                    $total_customer_exist_amount = 0;
                    $total_supplier_exist_amount = 0;

                    echo '<h3 style="text-align:center;">گزارشات ('.$from_sh.' - '.$to_sh.')</h3>';

                    $sql_query_002 = mysqli_query($connection,"SELECT SUM(sale_minor.sale_rate * sale_minor.amount) as total_sold_price,SUM(sale_minor.expense * sale_minor.amount) as total_sold_expense_price,SUM(sale_minor.commission * sale_minor.amount) as total_sold_commission_price,(SELECT SUM(reciepts.amount/reciepts.rate) FROM reciepts WHERE reciepts.sale_id IS NOT NULL ) as total_reciepts, SUM((sale_minor.sale_rate - (purchase_minor.purchase_price + purchase_minor.office_expense + purchase_minor.commision_expense))  * sale_minor.amount) as total_profit FROM sale_minor LEFT JOIN purchase_minor ON purchase_minor.id = sale_minor.purchase_minor_id WHERE (SELECT sale_major.alterant_id FROM sale_major WHERE sale_major.id = sale_minor.sale_major_id) IS NULL and (SELECT sale_major.date FROM sale_major WHERE sale_major.id = sale_minor.sale_major_id) between '$from_m' and '$to_m'");

                    $sql_query_004 = mysqli_query($connection,"SELECT SUM((purchase_minor.purchase_price) * purchase_minor.amount) as total_purchase_price,SUM((purchase_minor.office_expense) * purchase_minor.amount) as total_office_expenses,SUM((purchase_minor.commision_expense) * purchase_minor.amount) as total_commission_expenses,(SELECT SUM(reciepts.amount/reciepts.rate) FROM reciepts WHERE reciepts.purchase_id IS NOT NULL ) as total_reciepts,SUM((purchase_minor.amount - (SELECT SUM(sale_minor.amount) FROM sale_minor WHERE sale_minor.purchase_minor_id = purchase_minor.id)) * (purchase_minor.purchase_price)) as total_remain_purchase_budgets FROM purchase_minor WHERE (SELECT purchase_major.alterant FROM purchase_major WHERE purchase_major.id = purchase_minor.purchase_major_id) IS NULL and (SELECT purchase_major.date FROM purchase_major WHERE purchase_major.id = purchase_minor.purchase_major_id) between '$from_m' and '$to_m'");

                    $sql_query_005 = mysqli_query($connection,"SELECT SUM(expenses.amount/expenses.rate) as total_expenses FROM expenses where expenses.date between '$from_m' and '$to_m'");

                    $sql_query_006 = mysqli_query($connection,"SELECT SUM(reciepts.amount/reciepts.rate) as total_supplier_remain_amount FROM reciepts WHERE supplier_id IS NOT NULL and reciepts.date between '$from_m' and '$to_m'");

                    $sql_query_007 = mysqli_query($connection,"SELECT SUM(reciepts.amount/reciepts.rate) as total_purchased_paid_commission FROM reciepts WHERE purchase_commission = 1 and reciepts.date between '$from_m' and '$to_m'");

                    $sql_query_008 = mysqli_query($connection,"SELECT SUM(reciepts.amount/reciepts.rate) as total_sold_paid_commission FROM reciepts WHERE purchase_commission = 2 and reciepts.date between '$from_m' and '$to_m'");

                    $sql_query_009 = mysqli_query($connection,"SELECT SUM(alterant.losses_amount * (purchase_minor.purchase_price + purchase_minor.office_expense + purchase_minor.commision_expense)) as total_losses_price FROM alterant LEFT JOIN purchase_minor ON purchase_minor.id = alterant.purchase_id  where alterant.date between '$from_m' and '$to_m'");

                    $sql_query_010 = mysqli_query($connection,"SELECT SUM(shafaf.amount/shafaf.rate) as shafaf_grift_bilance,SUM(shafaf.commission/shafaf.rate) as shafaf_grift_commissions FROM shafaf where shafaf.type=1  and shafaf.date between '$from_m' and '$to_m'");
                    $sql_query_011 = mysqli_query($connection,"SELECT SUM(shafaf.amount/shafaf.rate) as shafaf_pardakht_bilance,SUM(shafaf.commission/shafaf.rate) as shafaf_pardakht_commissions FROM shafaf where shafaf.type=2 and shafaf.date between '$from_m' and '$to_m'");

                    $sql_query_012 = mysqli_query($connection,"SELECT SUM(reciepts.amount/reciepts.rate) as total_customer_remain_amount FROM reciepts WHERE customer_id IS NOT NULL and reciepts.date between '$from_m' and '$to_m'");

                    $total_talabat = 0;
                    $total_customer_exist_amount = 0;
                    $sql_query_013 = mysqli_query($connection,"SELECT * FROM `customers`");
                    while ($row = mysqli_fetch_assoc($sql_query_013)) 
                    {   
                        $customer_id = $row["id"];
                        $sql_query_003 = mysqli_query($connection,"SELECT SUM(customer_billance.credit_amount/ customer_billance.rate) as total_customer_credits,SUM(customer_billance.debit_amount/ customer_billance.rate) as total_customer_debits from customer_billance where customer_billance.customer_id = '$customer_id' and customer_billance.date between '$from_m' and '$to_m'");

                        $fetch_003 = mysqli_fetch_assoc($sql_query_003);

                        $customer_billance = $fetch_003['total_customer_credits'] - $fetch_003['total_customer_debits'];
                        if(($customer_billance)>0)
                        {
                            $total_customer_exist_amount = $total_customer_exist_amount + $customer_billance;
                        }
                        else
                        {

                            $total_talabat = $total_talabat  + (-$customer_billance);
                        }
                    }

                    // tadiat section

                    $total_tadiat = 0;
                    $total_supplier_exist_amount = 0;
                    $sql_query_013 = mysqli_query($connection,"SELECT * FROM `suppliers`");
                    while ($row = mysqli_fetch_assoc($sql_query_013)) 
                    {
                        $supplier_id = $row["id"];
                        $sql_query_003x = mysqli_query($connection,"SELECT SUM(supplier_billance.credit_amount/ supplier_billance.rate) as total_customer_credits,SUM(supplier_billance.debit_amount/ supplier_billance.rate) as total_customer_debits from supplier_billance where supplier_billance.supplier_id = '$supplier_id' and supplier_billance.date between '$from_m' and '$to_m'");

                        $fetch_003x = mysqli_fetch_assoc($sql_query_003x);

                        $supplier_billance = $fetch_003x['total_customer_credits'] - $fetch_003x['total_customer_debits'];
                        if($supplier_billance>0)
                        {
                            $total_supplier_exist_amount = $total_supplier_exist_amount + $supplier_billance;
                        }
                        else
                        {

                            $total_tadiat = $total_tadiat  + (-$supplier_billance);
                        }
                    }

                }
                else
                {
                    $sql_query_002 = mysqli_query($connection,"SELECT SUM(sale_minor.sale_rate * sale_minor.amount) as total_sold_price,SUM(sale_minor.expense * sale_minor.amount) as total_sold_expense_price,SUM(sale_minor.commission * sale_minor.amount) as total_sold_commission_price,(SELECT SUM(reciepts.amount/reciepts.rate) FROM reciepts WHERE reciepts.sale_id IS NOT NULL ) as total_reciepts, SUM((sale_minor.sale_rate - (purchase_minor.purchase_price + purchase_minor.office_expense + purchase_minor.commision_expense))  * sale_minor.amount) as total_profit FROM sale_minor LEFT JOIN purchase_minor ON purchase_minor.id = sale_minor.purchase_minor_id WHERE (SELECT sale_major.alterant_id FROM sale_major WHERE sale_major.id = sale_minor.sale_major_id) IS NULL");

                    $sql_query_004 = mysqli_query($connection,"SELECT SUM((purchase_minor.purchase_price) * purchase_minor.amount) as total_purchase_price,SUM((purchase_minor.office_expense) * purchase_minor.amount) as total_office_expenses,SUM((purchase_minor.commision_expense) * purchase_minor.amount) as total_commission_expenses,(SELECT SUM(reciepts.amount/reciepts.rate) FROM reciepts WHERE reciepts.purchase_id IS NOT NULL ) as total_reciepts,SUM((purchase_minor.amount - (SELECT SUM(sale_minor.amount) FROM sale_minor WHERE sale_minor.purchase_minor_id = purchase_minor.id)) * (purchase_minor.purchase_price)) as total_remain_purchase_budgets FROM purchase_minor WHERE (SELECT purchase_major.alterant FROM purchase_major WHERE purchase_major.id = purchase_minor.purchase_major_id) IS NULL");

                    $sql_query_005 = mysqli_query($connection,"SELECT SUM(expenses.amount/expenses.rate) as total_expenses FROM expenses");

                    $sql_query_006 = mysqli_query($connection,"SELECT SUM(reciepts.amount/reciepts.rate) as total_supplier_remain_amount FROM reciepts WHERE supplier_id IS NOT NULL");

                    $sql_query_007 = mysqli_query($connection,"SELECT SUM(reciepts.amount/reciepts.rate) as total_purchased_paid_commission FROM reciepts WHERE purchase_commission = 1");

                    $sql_query_008 = mysqli_query($connection,"SELECT SUM(reciepts.amount/reciepts.rate) as total_sold_paid_commission FROM reciepts WHERE purchase_commission = 2");

                    $sql_query_009 = mysqli_query($connection,"SELECT SUM(alterant.losses_amount * (purchase_minor.purchase_price + purchase_minor.office_expense + purchase_minor.commision_expense)) as total_losses_price FROM alterant LEFT JOIN purchase_minor ON purchase_minor.id = alterant.purchase_id");

                    $sql_query_010 = mysqli_query($connection,"SELECT SUM(shafaf.amount/shafaf.rate) as shafaf_grift_bilance,SUM(shafaf.commission/shafaf.rate) as shafaf_grift_commissions FROM shafaf where shafaf.type=1");
                    $sql_query_011 = mysqli_query($connection,"SELECT SUM(shafaf.amount/shafaf.rate) as shafaf_pardakht_bilance,SUM(shafaf.commission/shafaf.rate) as shafaf_pardakht_commissions FROM shafaf where shafaf.type=2");

                    $sql_query_012 = mysqli_query($connection,"SELECT SUM(reciepts.amount/reciepts.rate) as total_customer_remain_amount FROM reciepts WHERE customer_id IS NOT NULL");


                    $total_talabat = 0;
                    $total_customer_exist_amount = 0;
                    $sql_query_013 = mysqli_query($connection,"SELECT * FROM `customers`");
                    while ($row = mysqli_fetch_assoc($sql_query_013)) 
                    {
                        $customer_id = $row["id"];
                        $sql_query_003x = mysqli_query($connection,"SELECT SUM(customer_billance.credit_amount/ customer_billance.rate) as total_customer_credits,SUM(customer_billance.debit_amount/ customer_billance.rate) as total_customer_debits from customer_billance where customer_billance.customer_id = '$customer_id'");

                        $fetch_003x = mysqli_fetch_assoc($sql_query_003x);

                        $customer_billance = $fetch_003x['total_customer_credits'] - $fetch_003x['total_customer_debits'];
                        if($customer_billance>0)
                        {
                            $total_customer_exist_amount = $total_customer_exist_amount + $customer_billance;
                        }
                        else
                        {

                            $total_talabat = $total_talabat  + (-$customer_billance);
                        }
                    }


                    // tadiat section

                    $total_tadiat = 0;
                    $total_supplier_exist_amount = 0;
                    $sql_query_013 = mysqli_query($connection,"SELECT * FROM `suppliers`");
                    while ($row = mysqli_fetch_assoc($sql_query_013)) 
                    {
                        $supplier_id = $row["id"];
                        $sql_query_003x = mysqli_query($connection,"SELECT SUM(supplier_billance.credit_amount/ supplier_billance.rate) as total_customer_credits,SUM(supplier_billance.debit_amount/ supplier_billance.rate) as total_customer_debits from supplier_billance where supplier_billance.supplier_id = '$supplier_id'");

                        $fetch_003x = mysqli_fetch_assoc($sql_query_003x);

                        $supplier_billance = $fetch_003x['total_customer_credits'] - $fetch_003x['total_customer_debits'];
                        if($supplier_billance>0)
                        {
                            $total_supplier_exist_amount = $total_supplier_exist_amount + $supplier_billance;
                        }
                        else
                        {

                            $total_tadiat = $total_tadiat  + (-$supplier_billance);
                        }
                    }

                }
                ?>
                <div class="row">
                    <div class="col-xl-3">

                        <div class="card-box widget-chart-one  bx-shadow-lg " style="color:black !important; border:1px solid green">
                        
                            <div class="widget-chart-one-content text-right" style="text-align:center !important;">
                                <p class="text-black mb-0 mt-2">بخش فروش</p>
                                <table class="table table-bordered table-striped">
                                    <?php 
                                    

                                    $fetch_002 = mysqli_fetch_assoc($sql_query_002);
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>مجموع فروش</th>
                                            <th><?php echo round($fetch_002["total_sold_price"],2); ?> </th>
                                        </tr>
                                        <!-- <tr>
                                            <th>مجموع رسید</th>
                                            <th><?php echo round($fetch_002["total_reciepts"],2); ?> </th>
                                        </tr> -->
                                        <tr>
                                            <th>مجموع طلبات </th>
                                            <th><?php echo round($total_talabat,2); ?> </th>
                                        </tr>
                                        <tr  class="bg bg-success">
                                            <th>مجموع فایده</th>
                                            <th ><?php echo round($fetch_002["total_profit"],2); ?> </th>
                                        </tr>
                                        <!-- <tr>
                                            <th>مجموع مصرف فروش</th>
                                            <th><?php echo round($fetch_002["total_sold_expense_price"],2); ?> </th>
                                        </tr>
                                        <tr>
                                            <th>مجموع کمیشن فروش</th>
                                            <th><?php echo round($fetch_002["total_sold_commission_price"],2); ?> </th>
                                        </tr> -->
                                    </thead>
                                </table>
                            </div>
                        </div> <!-- end card-box-->

                    </div> <!-- end col -->

                    <div class="col-xl-3">

                        <div class="card-box widget-chart-one  bx-shadow-lg " style="color:black !important; border:1px solid green">
                        
                            <div class="widget-chart-one-content text-right" style="text-align:center !important;">
                                <p class="text-black mb-0 mt-2">بخش خرید</p>
                                <table class="table table-bordered table-striped">
                                <?php 
                                   

                                    $fetch_004 = mysqli_fetch_assoc($sql_query_004);
                                    $fetch_006 = mysqli_fetch_assoc($sql_query_006);
                                ?>
                                    <thead>
                                        <tr>
                                            <th>مجموع خرید</th>
                                            <th><?php echo round($fetch_004["total_purchase_price"],2); ?> </th>
                                        </tr>
                                      
                                        <tr>    
                                            <th>مجموع تادیات</th>
                                            <th><?php echo round($total_tadiat,2); ?> </th>
                                        </tr>
                                        <!-- <tr>
                                            <th>مجموع مصارف دفتر در خرید</th>
                                            <th class="text text-danger"><?php echo round($fetch_004["total_office_expenses"],2); ?> </th>
                                        </tr>
                                        <tr>
                                            <th>مجموع کمیش های خرید</th>
                                            <th class="text text-danger"><?php echo round($fetch_004["total_commission_expenses"],2); ?> </th>
                                        </tr> -->
                                    </thead>
                                </table>
                            </div>
                        </div> <!-- end card-box-->

                    </div> <!-- end col -->
                    <div class="col-xl-3">

                        <div class="card-box widget-chart-one  bx-shadow-lg " style="color:black !important; border:1px solid green">
                        
                            <div class="widget-chart-one-content text-right" style="text-align:center !important;">
                                <p class="text-black mb-0 mt-2">بخش مصارفات</p>
                                <table class="table table-bordered table-striped">
                                <?php 
                                    
                                    $fetch_005 = mysqli_fetch_assoc($sql_query_005);
                                    $fetch_007 = mysqli_fetch_assoc($sql_query_007);
                                    $fetch_008 = mysqli_fetch_assoc($sql_query_008);
                                    $fetch_009 = mysqli_fetch_assoc($sql_query_009);
                                    $fetch_010 = mysqli_fetch_assoc($sql_query_010);
                                    $fetch_011 = mysqli_fetch_assoc($sql_query_011);
                                ?>
                                    <thead>
                                        <tr>
                                            <th>مجموع مصارف دفتر</th>
                                            <th><?php echo round($fetch_005["total_expenses"],2); ?> </th>
                                        </tr>
                                        
                                       
                                    </thead>
                                </table>
                            </div>
                        </div> <!-- end card-box-->

                    </div> <!-- end col -->
                    <div class="col-xl-3">

                        <div class="card-box widget-chart-one  bx-shadow-lg " style="color:black !important; border:1px solid green">
                        
                            <div class="widget-chart-one-content text-right" style="text-align:center !important;">
                                <p class="text-black mb-0 mt-2">بخش بیلانس</p>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>مجموع باقی مفاد  </th>
                                            <th><?php
                                            $total_net_profit = round($fetch_002["total_profit"]  - $fetch_005["total_expenses"],2);
                                            echo $total_net_profit; ?> </th>
                                        </tr>
                                    
                                        <tr>
                                            <th> مجموع  پول باقی مشتریان  </th>
                                            <th><?php 
                                            $fetch_012 = mysqli_fetch_assoc($sql_query_012);
                                            echo round($total_customer_exist_amount,2); ?> </th>
                                        </tr>
                                        <tr>
                                            <th>بالای تمویل کننده ها</th>
                                            <th><?php echo round($total_supplier_exist_amount,2); ?> </th>
                                        </tr>
                                        <tr>
                                            <th>مجموع  پول دخل  </th>
                                            <th><?php
                                            $total_cash_amount = ($fetch_002["total_profit"]) - $fetch_005["total_expenses"];
                                            echo round($total_cash_amount ,2); ?> </th>
                                        </tr>

                                        
                                       
                                    </thead>
                                </table>
                            </div>
                        </div> <!-- end card-box-->

                    </div> <!-- end col -->

                  

                </div>
                <!-- end row -->


                
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        <!-- Footer Start -->
        <?php include_once("footer.php"); ?>
      <!-- end Footer -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="mdi mdi-close"></i>
                </a>
                <h4 class="m-0 text-white">Settings</h4>
            </div>
            <div class="slimscroll-menu">
                <!-- User box -->
                <div class="user-box">
                    <div class="user-img">
                        <img src="assets/images/users/avatar.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                        <a href="javascript:void(0);" class="user-edit"><i class="mdi mdi-pencil"></i></a>
                    </div>
            
                    <h5><a href="javascript: void(0);">Agnes Kennedy</a> </h5>
                    <p class="text-muted mb-0"><small>Admin Head</small></p>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h5 class="pl-3">Basic Settings</h5>
                <hr class="mb-0" />


                <div class="p-3">
                    <div class="checkbox checkbox-primary mb-2">
                        <input id="checkbox1" type="checkbox" checked>
                        <label for="checkbox1">
                            Notifications
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary mb-2">
                        <input id="checkbox2" type="checkbox" checked>
                        <label for="checkbox2">
                            API Access
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary mb-2">
                        <input id="checkbox3" type="checkbox">
                        <label for="checkbox3">
                            Auto Updates
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary mb-2">
                        <input id="checkbox4" type="checkbox" checked>
                        <label for="checkbox4">
                            Online Status
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary mb-0">
                        <input id="checkbox5" type="checkbox" checked>
                        <label for="checkbox5">
                            Auto Payout
                        </label>
                    </div>
                </div>

                <!-- Timeline -->
                <hr class="mt-0" />
                <h5 class="pl-3 pr-3">Messages <span class="float-right badge badge-pill badge-danger">25</span></h5>
                <hr class="mb-0" />
                <div class="p-3">
                    <div class="inbox-widget">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Chadengle</a></p>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <p class="inbox-item-date">13:40 PM</p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Tomaslau</a></p>
                            <p class="inbox-item-text">I've finished it! See you so...</p>
                            <p class="inbox-item-date">13:34 PM</p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Stillnotdavid</a></p>
                            <p class="inbox-item-text">This theme is awesome!</p>
                            <p class="inbox-item-date">13:17 PM</p>
                        </div>

                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kurafire</a></p>
                            <p class="inbox-item-text">Nice to meet you</p>
                            <p class="inbox-item-date">12:20 PM</p>

                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Shahedk</a></p>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <p class="inbox-item-date">10:15 AM</p>

                        </div>
                    </div> <!-- end inbox-widget -->
                </div> <!-- end .p-3-->

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- KNOB JS -->
        <script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
        <!-- Chart JS -->
        <script src="assets/libs/chart-js/Chart.bundle.min.js"></script>

        <!-- Jvector map -->
        <script src="assets/libs/jqvmap/jquery.vmap.min.js"></script>
        <script src="assets/libs/jqvmap/jquery.vmap.usa.js"></script>
        
        <!-- Datatable js -->
        <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
        
        <!-- Dashboard Init JS -->
        <script src="assets/js/pages/dashboard.init.js"></script>
        <script src="assets/js/persian-datepicker.js"></script>

        
        <!-- App js -->
        <script src="assets/js/app-rtl.min.js"></script>
        <script src="assets/js/languages.js"></script>

     
    </body>
</html>