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
                            <li class="breadcrumb-item active"> نمایش بیلانس تمویل کنندگان  </li>
                        </ol>
                    </div>
                    <p class="page-title">نمایش بیلانس تمویل کنندگان  </pack>
                </div> 
                <!-- end page title -->

               


                <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered  nowrap">
                                <thead>
                                    <tr>
                                        <th>شماره</th>
                                        <th>نام مکمل</th>
                                        <th>شماره تماس</th>
                                        <th>آدرس</th>
                                        <th>مجموع خرید</th>
                                        <!-- <th>مجموع رسید</th> -->
                                        <!-- <th>مجموع باقی</th> -->
                                        <th>بیلانس حساب</th>
                                        <th>عمل</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $count = 1;
                                        $sql_query_001 = mysqli_query($connection,"select `qalam_mis_dental_version`.`suppliers`.`id` AS `id`,`qalam_mis_dental_version`.`suppliers`.`full_name` AS `full_name`,`qalam_mis_dental_version`.`suppliers`.`phone_number` AS `phone_number`,`qalam_mis_dental_version`.`suppliers`.`address` AS `address`,`qalam_mis_dental_version`.`suppliers`.`date` AS `date`,sum(`qalam_mis_dental_version`.`purchase_minor`.`purchase_price` * `qalam_mis_dental_version`.`purchase_minor`.`amount`) AS `total_purchase_price`,(select sum(`qalam_mis_dental_version`.`purchase_major`.`reciept`) from `qalam_mis_dental_version`.`purchase_major` where `qalam_mis_dental_version`.`purchase_major`.`supplier_id` = `qalam_mis_dental_version`.`suppliers`.`id`) AS `total_reciept` from ((`qalam_mis_dental_version`.`suppliers` left join `qalam_mis_dental_version`.`purchase_major` on(`qalam_mis_dental_version`.`suppliers`.`id` = `qalam_mis_dental_version`.`purchase_major`.`supplier_id`)) left join `qalam_mis_dental_version`.`purchase_minor` on(`qalam_mis_dental_version`.`purchase_minor`.`purchase_major_id` = `qalam_mis_dental_version`.`purchase_major`.`id`)) group by `qalam_mis_dental_version`.`suppliers`.`id`");
                                        while ($row = mysqli_fetch_assoc($sql_query_001))
                                        {

                                            $supplier_id = $row["id"];
                                            $sql_query_002 = mysqli_query($connection,"SELECT SUM(reciepts.amount/ reciepts.rate) as total_reciepts from reciepts LEFT JOIN purchase_major ON reciepts.purchase_id = purchase_major.id  WHERE purchase_major.supplier_id = '$supplier_id'");
                                            $fetch_002 = mysqli_fetch_assoc($sql_query_002);

                                            $sql_query_003 = mysqli_query($connection,"SELECT SUM(supplier_billance.credit_amount/ supplier_billance.rate) as total_supplier_credits,SUM(supplier_billance.debit_amount/ supplier_billance.rate) as total_supplier_debits from supplier_billance where supplier_billance.supplier_id = '$supplier_id'");
                                            $fetch_003 = mysqli_fetch_assoc($sql_query_003);
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row["full_name"]; ?>  </td>
                                            <td><?php echo $row["phone_number"]; ?></td>
                                            <td><?php echo $row["address"]; ?></td>
                                            <td class="text text-success"><?php echo round($row["total_purchase_price"],2); ?></td>
                                            <!-- <td class="text text-primary"><?php echo round($fetch_002["total_reciepts"],2); ?></td> -->
                                            <!-- <td class="text text-danger"><?php echo round($row["total_purchase_price"] - round($fetch_002["total_reciepts"],2),2); ?></td> -->
                                            <td class=""><?php echo round($fetch_003["total_supplier_credits"] - $fetch_003["total_supplier_debits"],2); ?></td>
                                            <td>
                                                <a title="افزودن رسید" href="supplier_reciepts.php?supplier_id=<?php echo $row['id']; ?>"><span class="fa fa-plus text text-success" ></span></a>
                                                <?php
                                                // if(($fetch_003["total_supplier_credits"] - $fetch_003["total_supplier_debits"]) > 0)
                                                // {
                                                    ?>
                                                  <!-- <a title="انتقال پول" href="supplier_to_supplier_transfer.php?supplier_id=<?php echo $row['id']; ?>&supplier_name=<?php echo $row["full_name"]; ?>"><span class="fa fa-share text text-danger" ></span></a> -->
                                                <?php
                                                // }
                                                ?>
                                                | <a title="نمایش" href="supplier_account_billance.php?supplier_id=<?php echo $row['id']; ?>&supplier_name=<?php echo $row["full_name"]; ?>"><span class="fa fa-eye text text-primary" ></span></a>

                                            </td>
                                            
                                        </tr>
                                        <?php
                                        $count++;
                                        }
                                    
                                    ?>
                                 
                                </tbody>
                                
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

        <!-- Datatables init -->
        <script src="assets/js/pages/datatables.init.js"></script>        
        <script src="assets/js/languages.js"></script>

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
                agency_id:id,
                },
                url: "delete.php",
                success: function(msg) {
                window.open("registered_agencies.php",'_self');            
                
                }
            });
            }
            else
            {
                
            }
            

            }
        </script>
    </body>
</html>