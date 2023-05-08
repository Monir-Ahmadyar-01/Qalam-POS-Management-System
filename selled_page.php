<?php
    include("database.php");
    include("jdf.php");
?>
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

        <!-- third party css -->
        <link href="assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />            

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app-rtl.min.css" rel="stylesheet" type="text/css" />

        <style>
            @media print{
                .print-display{
                    display: none !important;
                }
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
                <div class="page-title-alt-bg print-display"></div>
                <div class="page-title-box print-display">
                    <div class="page-title-right print-display">
                        <ol class="breadcrumb m-0">
                            
                            <li class="breadcrumb-item"><a href="javascript: void(0);">صفحات</a></li>
                            <li class="breadcrumb-item active"> نمایش  صفحه فروش</li>
                        </ol>
                    </div>
                    <p class="page-title">  نمایش   صفحه فروش</p>
                </div> 
                <!-- end page title -->
                
                <form method="post" action="">
                    <div class="row print-display">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="search" placeholder="جستجو .. " name="search_input" class="form-control" >
                                
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm" id="search_button" name="search_button">جستجو</button>
                                
                            </div>
                        </div>
                        <div class="col-sm-3 ">
                            <div class="form-group">
                                <span class="fa fa-eye btn btn-secondary" style="cursor:pointer ;" data-toggle="collapse" data-target="" onclick="show_all();"></span>
                                <span class="fa fa-print btn btn-success" style="cursor:pointer ;" onclick="window.print();"></span>
                                
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        
                        <div class="card-box table-responsive">
                        
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="lang" key="number"></th>
                                    <th class="lang" key="Bill_Number"></th>
                                    <th class="lang" key="Customer_Name"></th>
                                    <th class="lang" key="province"></th>
                                    <th class="lang" key="sale_date"></th>
                                    <th class="lang" key="T_Sales"></th>
                                    <!-- <th class="lang" key="T_Expense"></th> -->
                                    <!-- <th class="lang" key="Total_Receipts"></th>
                                    <th class="lang" key="Total_Remain"></th> -->
                                    <th class="lang print-display " key="Operation"></th>
                                    
                                </tr>
                            </thead>

                            <tbody id="myTable">
                            <div id="accordion">
                                <?php

                                $total_weights = 0;
                                $total_sold_amount = 0;
                                $total_expenses = 0;
                                $total_benifit = 0;


                                $count = 1;
                                if(isset($_POST["search_button"]))
                                {
                                    $search_input = $_POST["search_input"];
                                    $sql_query_001 = mysqli_query($connection,"select `qalam_mis_dental_version`.`sale_major`.`id` AS `bill_number`,`qalam_mis_dental_version`.`customers`.`full_name` AS `customer_name`,
                                    `qalam_mis_dental_version`.`customers`.`province_id`,`qalam_mis_dental_version`.`currencies`.`name` AS `currency_name`,`qalam_mis_dental_version`.`sale_major`.`date` AS `sale_date`,`qalam_mis_dental_version`.`sale_major`.`reciept` AS `total_reciept`,(select sum(`qalam_mis_dental_version`.`sale_minor`.`sale_rate` * `qalam_mis_dental_version`.`sale_minor`.`amount`) from `qalam_mis_dental_version`.`sale_minor` where `qalam_mis_dental_version`.`sale_minor`.`sale_major_id` = `qalam_mis_dental_version`.`sale_major`.`id`) AS `total_sold_price`,(select sum(`qalam_mis_dental_version`.`sale_minor`.`expense` * `qalam_mis_dental_version`.`sale_minor`.`amount`) from `qalam_mis_dental_version`.`sale_minor` where `qalam_mis_dental_version`.`sale_minor`.`sale_major_id` = `qalam_mis_dental_version`.`sale_major`.`id`) AS `total_expense_price`,(select sum(`qalam_mis_dental_version`.`reciepts`.`amount` / `qalam_mis_dental_version`.`reciepts`.`rate`) from `qalam_mis_dental_version`.`reciepts` where `qalam_mis_dental_version`.`reciepts`.`sale_id` = `qalam_mis_dental_version`.`sale_major`.`id`) AS `total_reciepts_price` from ((`qalam_mis_dental_version`.`sale_major` left join `qalam_mis_dental_version`.`currencies` on(`qalam_mis_dental_version`.`currencies`.`id` = `qalam_mis_dental_version`.`sale_major`.`currency_id`)) left join `qalam_mis_dental_version`.`customers` on(`qalam_mis_dental_version`.`customers`.`id` = `qalam_mis_dental_version`.`sale_major`.`customer_id`)) where qalam_mis_dental_version.sale_major.alterant_id IS NULL and (customers.full_name='$search_input' or (select provinces.name from provinces where provinces.id=customers.province_id)='$search_input' or sale_major.id like '$search_input' or sale_major.date like '$search_input')  order by `qalam_mis_dental_version`.`sale_major`.`id` desc");
                                }
                                else
                                {
                                    $sql_query_001 = mysqli_query($connection,"select `qalam_mis_dental_version`.`sale_major`.`id` AS `bill_number`,`qalam_mis_dental_version`.`customers`.`full_name` AS `customer_name`,
                                    `qalam_mis_dental_version`.`customers`.`province_id`,`qalam_mis_dental_version`.`currencies`.`name` AS `currency_name`,`qalam_mis_dental_version`.`sale_major`.`date` AS `sale_date`,`qalam_mis_dental_version`.`sale_major`.`reciept` AS `total_reciept`,(select sum(`qalam_mis_dental_version`.`sale_minor`.`sale_rate` * `qalam_mis_dental_version`.`sale_minor`.`amount`) from `qalam_mis_dental_version`.`sale_minor` where `qalam_mis_dental_version`.`sale_minor`.`sale_major_id` = `qalam_mis_dental_version`.`sale_major`.`id`) AS `total_sold_price`,(select sum(`qalam_mis_dental_version`.`sale_minor`.`expense` * `qalam_mis_dental_version`.`sale_minor`.`amount`) from `qalam_mis_dental_version`.`sale_minor` where `qalam_mis_dental_version`.`sale_minor`.`sale_major_id` = `qalam_mis_dental_version`.`sale_major`.`id`) AS `total_expense_price`,(select sum(`qalam_mis_dental_version`.`reciepts`.`amount` / `qalam_mis_dental_version`.`reciepts`.`rate`) from `qalam_mis_dental_version`.`reciepts` where `qalam_mis_dental_version`.`reciepts`.`sale_id` = `qalam_mis_dental_version`.`sale_major`.`id`) AS `total_reciepts_price` from ((`qalam_mis_dental_version`.`sale_major` left join `qalam_mis_dental_version`.`currencies` on(`qalam_mis_dental_version`.`currencies`.`id` = `qalam_mis_dental_version`.`sale_major`.`currency_id`)) left join `qalam_mis_dental_version`.`customers` on(`qalam_mis_dental_version`.`customers`.`id` = `qalam_mis_dental_version`.`sale_major`.`customer_id`)) where qalam_mis_dental_version.sale_major.alterant_id IS NULL  order by `qalam_mis_dental_version`.`sale_major`.`id` desc");
                                }
                                    
                                    
                                    while ($row = mysqli_fetch_assoc($sql_query_001))
                                    {
                                        
                                ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row["bill_number"]; ?></td>
                                        <td><?php echo $row["customer_name"]; ?></td>
                                        <td>
                                            <?php 
                                                $province_id = $row["province_id"];
                                                $sql_query_005 = mysqli_query($connection,"select name from provinces where id='$province_id'");

                                                $fetch_005 = mysqli_fetch_assoc($sql_query_005);
                                                echo $fetch_005["name"];
                                            ?>
                                        </td>
                                        <td><?php
                                        $date_m = explode("-",$row["sale_date"]);
                                        $date_sh =  gregorian_to_jalali($date_m[0],$date_m[1],$date_m[2],'/');
                                        echo $date_sh;?></td>
                                        
                                        <td><?php echo round($row["total_sold_price"],2); ?></td>
                                        <!-- <td><?php echo round($row["total_expense_price"],2); ?></td> -->
                                        
                                        <td class="print-display"><span class="fa fa-edit text text-success admin_authority" id="btn_modal" class="btn btn-primary" onclick="set_row_data_edit_func(<?php echo $row['bill_number']; ?>)" data-toggle="modal"
        data-target="#exampleModal"></span> | <a class="collapsed card-link" data-toggle="collapse" href="#collapse_<?php echo $count; ?>"><span class="fa fa-eye"></span></a> | <span class="fa fa-trash text text-danger admin_authority" onclick="delete_func(<?php echo $row['bill_number']; ?>)"></span>
         <!-- | <a href="sales_reciepts.php?sale_id=<?php echo $row['bill_number']; ?>"><span class="fa fa-plus text text-success" ></span></a> -->
         <a href="pages-invoice.php?invoiceId=<?php echo $row['bill_number']; ?>"><span class="fa fa-print text text-success" ></span></a>
                                        </td>
                                    </tr>
                                                
                                            
                                    <tr>
                                        <td colspan="7">

                                            <div id="collapse_<?php echo $count; ?>" class="collapse view_all" data-parent="#accordion">
                                                <div class="card-body">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th colspan='10' class="lang text text-center" key="Sale_Details"></th>
                                                            </tr>
                                                            <tr>

                                                                <th class="lang" key="number"></th>
                                                                <th class="lang" key="Item_Name"></th>
                                                                <th class="lang" key="Unit"></th>
                                                                <th class="lang" key="Amount"></th>
                                                                <th class="lang" key="Purchase_Price_1"></th>
                                                                <th class="lang" key="Sale_Price_1"></th>
                                                                <th class="lang" key="Profit"></th>
                                                                <th class="lang" key="T_Sales"></th>
                                                                <th class="lang" key="Details"></th>
                                                                <th class="lang print-display admin_authority" key="Operation"></th>
                      
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $parent_id = $row["bill_number"];
                                                                $count_2 = 1;
                                                                $sql_query_004 = mysqli_query($connection,"select (select (select `qalam_mis_dental_version`.`stock_minor`.`item_name` from `qalam_mis_dental_version`.`stock_minor` where `qalam_mis_dental_version`.`stock_minor`.`id` = `qalam_mis_dental_version`.`stock_major`.`item_id`) from `qalam_mis_dental_version`.`stock_major` where `qalam_mis_dental_version`.`stock_major`.`id` = `qalam_mis_dental_version`.`purchase_minor`.`item_id_stock_major`) AS `item_name`,(select `qalam_mis_dental_version`.`purchase_major`.`party_number` from `qalam_mis_dental_version`.`purchase_major` where `qalam_mis_dental_version`.`purchase_major`.`id` = `qalam_mis_dental_version`.`purchase_minor`.`purchase_major_id`) AS `party_number`,(select `qalam_mis_dental_version`.`unit_minor`.`unit_name` from `qalam_mis_dental_version`.`unit_minor` where `qalam_mis_dental_version`.`unit_minor`.`id` = (select `qalam_mis_dental_version`.`stock_major`.`minor_unit_id` from `qalam_mis_dental_version`.`stock_major` where `qalam_mis_dental_version`.`stock_major`.`id` = `qalam_mis_dental_version`.`purchase_minor`.`item_id_stock_major`)) AS `unit_name`,`qalam_mis_dental_version`.`purchase_minor`.`purchase_price` + `qalam_mis_dental_version`.`purchase_minor`.`commision_expense` + `qalam_mis_dental_version`.`purchase_minor`.`office_expense` AS `purchase_price_t`,`qalam_mis_dental_version`.`sale_minor`.`id` AS `id`,`qalam_mis_dental_version`.`sale_minor`.`sale_major_id` AS `sale_major_id`,`qalam_mis_dental_version`.`sale_minor`.`amount` AS `amount`,`qalam_mis_dental_version`.`sale_minor`.`details` AS `details`,`qalam_mis_dental_version`.`sale_minor`.`sale_rate` AS `sale_rate` ,`qalam_mis_dental_version`.`sale_minor`.`expense` AS `expense` from (`qalam_mis_dental_version`.`sale_minor` left join `qalam_mis_dental_version`.`purchase_minor` on(`qalam_mis_dental_version`.`sale_minor`.`purchase_minor_id` = `qalam_mis_dental_version`.`purchase_minor`.`id`))  where sale_major_id='$parent_id'");

                                                            while ($fetch_004 = mysqli_fetch_assoc($sql_query_004))
                                                                {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $count_2; ?></td>
                                                                <td><?php echo $fetch_004["item_name"]; ?></td>
                                                                <td><?php echo $fetch_004["unit_name"]; ?></td>
                                                                <td><?php
                                                                $total_weights = $total_weights + $fetch_004["amount"];
                                                                echo $fetch_004["amount"]; ?></td>
                                                                <td><?php echo round($fetch_004["purchase_price_t"],2); ?></td>
                                                                <td><?php
                                                                

                                                                echo round($fetch_004["sale_rate"],2); ?></td>
                                                                <td><?php
                                                                
                                                                $total_benifit = $total_benifit + (($fetch_004["sale_rate"] - $fetch_004["purchase_price_t"]) * $fetch_004["amount"]);
                                                                echo round($fetch_004["sale_rate"] - $fetch_004["purchase_price_t"],2); ?></td>
                                                                <td class="text text-success"><?php
                                                                $total_sold_amount = $total_sold_amount + (($fetch_004["sale_rate"]) * $fetch_004["amount"]);

                                                                echo round(($fetch_004["sale_rate"]) * $fetch_004["amount"],2); ?></td>
                                                               
                                                                <td><?php echo $fetch_004["details"]; ?></td>
                                                                <td class="print-display admin_authority">
                                                                <span class="fa fa-edit text text-success" id="btn_modal_2" class="btn btn-primary" onclick="set_child_row_data_edit_func(<?php echo $fetch_004['id']; ?>)" data-toggle="modal" data-target="#exampleModal_2"></span></td>
                                                            </tr>

                                                            <?php
                                                            
                                                            $count_2++;

                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                <?php
                                $count++;

                                    }
                                ?>
                                
                            </div>

                            </tbody>
                            <tfoot>
                                <tr class="bg bg-primary text text-white">
                                    <th colspan="3"><span class="lang" key="Total Quantity"></span> : <?php echo round($total_weights,2); ?></th>
                                    <th colspan="2"><span class="lang" key="Total Sale Price"></span> : <?php echo round($total_sold_amount,2); ?> </th>
                                    <th colspan="2"><span class="lang" key="Total Profit"></span> : <?php echo round($total_benifit,2); ?> </th>

                                </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        <!-- Footer Start -->
        <?php include("footer.php"); ?>
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
                        <img src="assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
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
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-1.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Chadengle</a></p>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <p class="inbox-item-date">13:40 PM</p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Tomaslau</a></p>
                            <p class="inbox-item-text">I've finished it! See you so...</p>
                            <p class="inbox-item-date">13:34 PM</p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-3.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Stillnotdavid</a></p>
                            <p class="inbox-item-text">This theme is awesome!</p>
                            <p class="inbox-item-date">13:17 PM</p>
                        </div>

                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-4.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kurafire</a></p>
                            <p class="inbox-item-text">Nice to meet you</p>
                            <p class="inbox-item-date">12:20 PM</p>

                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-5.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Shahedk</a></p>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <p class="inbox-item-date">10:15 AM</p>

                        </div>
                    </div> <!-- end inbox-widget -->
                </div> <!-- end .p-3-->

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->


        <!-- Modal 01 -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ادیت صفحه فروش</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="server.php" id="uploadForm" enctype="multipart/form-data">
                <div class="modal-body" id="modal_body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bill_number">نمبر بل</label>
                                    <input type="text" class="form-control" id="sales_edit_bill_number" name="sales_edit_bill_number" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bill_number">نام مشتری</label>
                                    <select type="text" class="form-control" id="sales_edit_customer_name" name="sales_edit_customer_name">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bill_number">تاریخ فروش</label>
                                    <input type="text" class="form-control" id="edit_sale_date" name="edit_sale_date">
                                </div>
                            </div>
                        </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="submit" id="add_purchased_item_btn" class="btn btn-primary" >ذخیره</button>
                </div>
                </form>
            </div>
        </div>
    </div>

     <!-- Modal sales minor child-->
     <div class="modal fade" id="exampleModal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ادیت جزیات صفحه فروش</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="server.php" id="uploadForm_child" enctype="multipart/form-data">
                <div class="modal-body" id="modal_body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="sales_minor_edit_amount">تعداد</label>
                                    <input type="hidden" class="form-control" id="sales_minor_edit_id" name="sales_minor_edit_id">
                                    <input type="text" class="form-control" id="sales_minor_edit_amount" name="sales_minor_edit_amount">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="sales_minor_edit_sale_rate">قیمت فروش | 1</label>
                                    <input type="text" class="form-control" id="sales_minor_edit_sale_rate" name="sales_minor_edit_sale_rate" />
                                    
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="sales_minor_edit_details">توضیحات</label>
                                    <textarea class="form-control" id="sales_minor_edit_details" name="sales_minor_edit_details">
                                    </textarea>
                                </div>
                            </div>

                           
                        </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="submit" id="add_purchased_item_btn" class="btn btn-primary" >ذخیره</button>
                </div>
                </form>
            </div>
        </div>
    </div>



        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- datatable js -->
        <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
        
        <script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables/buttons.flash.min.js"></script>
        <script src="assets/libs/datatables/buttons.print.min.js"></script>

        <script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
        <script src="assets/libs/datatables/dataTables.select.min.js"></script>
        <script src="assets/js/languages.js"></script>

        <!-- Datatables init -->
        <script src="assets/js/pages/datatables.init.js"></script>        

        <!-- App js -->
        <script src="assets/js/app-rtl.min.js"></script>
        <script>
            function delete_func(id){
                var confirm  = window.confirm("اطلاعات حذف خواهد شد برای لغو cancel را بزنید");
                if(confirm == true)
                {
                    $.ajax({
                    type: "GET",
                    data: {
                    sale_id:id,
                    },
                    url: "delete.php",
                    success: function(msg) {
                    window.open("selled_page.php",'_self');            
                    
                    }
                });
                }
                else
                {
                    
                }
            }
            function set_row_data_edit_func(id){

                    $.ajax({
                    type: "POST",
                    data: {
                    load_sales_major_id_for_edit:id,
                    },
                    url: "server.php",
                    success: function(response_x1) {
                        var responses_x1 = JSON.parse(response_x1);

                        var sale_id = responses_x1[0]['id'];
                        var customer_id = responses_x1[0]['customer_id'];
                        var date = responses_x1[0]['date'];

                        var options = '';
                        for (let index = 1; index < responses_x1.length; index++) 
                        {
                            if(customer_id == responses_x1[index][0])
                            {
                                options += '<option selected value='+responses_x1[index][0]+'>'+responses_x1[index][1]+'</option>';
                            }
                            else
                            {
                                options += '<option value='+responses_x1[index][0]+'>'+responses_x1[index][1]+'</option>';
                            }
                            
                        }
                        
                            
                        $("#sales_edit_bill_number").val(sale_id);
                        $("#sales_edit_customer_name").html(options);
                        $("#edit_sale_date").val(new Date(date).toLocaleDateString('fa-IR-u-nu-latn'));
                    
                    }
                });
            }


            function set_child_row_data_edit_func(id){

                    $.ajax({
                    type: "POST",
                    data: {
                    load_sales_minor_id_for_edit:id,
                    },
                    url: "server.php",
                    success: function(response_x1) {
                        var responses_x1 = JSON.parse(response_x1);
                        
                        var id  = responses_x1[0]['id'];
                        var amount = responses_x1[0]['amount'];
                        var sale_rate = responses_x1[0]['sale_rate'];
                        var details = responses_x1[0]['details'];
                        var expense = responses_x1[0]['expense'];
                        
                        
                            
                        $("#sales_minor_edit_id").val(id);
                        $("#sales_minor_edit_amount").val(amount);
                        $("#sales_minor_edit_sale_rate").val(sale_rate);
                        $("#sales_minor_edit_details").val(details);
                        $("#sales_minor_edit_expense").val(expense);
                    
                    }
                });
            }
        </script>
        <script>
    function show_all(){
      $(".view_all").toggle(200);
    }
  </script>

<script type="text/javascript">
    $(document).ready(function(e) {
        $("#uploadForm").on('submit', (function(e) {
            e.preventDefault();


            $.ajax({
                url: "server.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    
                   if(data.trim() == "success")
                    {
                        window.location.href = window.location.href;
                    }
                    else
                    {

                    }

                },
                error: function() {

                }
            });

        }));

    });
    </script>


<script type="text/javascript">
    $(document).ready(function(e) {
        $("#uploadForm_child").on('submit', (function(e) {
            e.preventDefault();


            $.ajax({
                url: "server.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    
                   if(data.trim() == "success")
                    {
                        window.location.href = window.location.href;
                    }
                    else
                    {

                    }

                },
                error: function() {

                }
            });

        }));

    });
    </script>

   
    </body>
</html>