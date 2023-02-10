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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">شفاف</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">صفحات</a></li>
                            <li class="breadcrumb-item active"> نمایش رسید های شفاف </li>
                        </ol>
                    </div>
                    <p class="page-title">نمایش رسید های شفاف</pack>
                </div> 
                <!-- end page title -->



                <div class="row">
                    <div class="col-12">

                        <div class="card-box table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered  nowrap">
                                
                                <thead>
                                    <?php 
                                        $sql_query_002 = mysqli_query($connection,"SELECT SUM(shafaf.amount/shafaf.rate) as total_grift_amount FROM shafaf WHERE shafaf.type = 1");

                                        $sql_query_003 = mysqli_query($connection,"SELECT SUM(shafaf.amount/shafaf.rate) as total_pardakht_amount FROM shafaf WHERE shafaf.type = 2");

                                        $fetch_002 = mysqli_fetch_assoc($sql_query_002);
                                        $fetch_003 = mysqli_fetch_assoc($sql_query_003);

                                    ?>
                                    <tr class="bg bg-primary text text-white">
                                        <td >مجموع گرفت</td>
                                        <td colspan="2"><?php echo $fetch_002["total_grift_amount"] . ' $'; ?></td>
                                        <td >مجموع پرداخت</td>
                                        <td colspan="2"><?php echo $fetch_003["total_pardakht_amount"]  . ' $'; ?></td>
                                        <td colspan="2">بیلانس</td>
                                        <td colspan="2"><?php echo $fetch_002["total_grift_amount"] - $fetch_003["total_pardakht_amount"]  . ' $'; ?></td>
                                    </tr>
                                    <tr>
                                        <th>شماره</th>
                                        <th>نام مکمل</th>
                                        <th>مقدار</th>
                                        <th>واحد پولی</th>
                                        <th>نوعیت</th>
                                        <th>نرخ</th>
                                        <th>کمیشن</th>
                                        <th>تاریخ</th>
                                        <th>توضیحات</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $count = 1;
                                        $sql_query_001 = mysqli_query($connection,"SELECT shafaf.*,(SELECT currencies.name  from currencies WHERE shafaf.currency_id = currencies.id) as currency_name,(SELECT shafaf_transaction_type.name FROM shafaf_transaction_type WHERE shafaf_transaction_type.id = shafaf.type) as transaction_type_name FROM shafaf order by shafaf.id desc");
                                        while ($row = mysqli_fetch_assoc($sql_query_001))
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row["full_name"]; ?></td>
                                            <td><?php echo $row["amount"]; ?></td>
                                            <td><?php echo $row["currency_name"]; ?></td>
                                            <td><?php echo $row["transaction_type_name"]; ?></td>
                                            <td><?php echo $row["rate"]; ?></td>
                                            <td><?php echo $row["commission"]; ?></td>
                                            <td><?php echo $row["date"]; ?></td>
                                            <td><?php echo $row["details"]; ?></td>
                                  
                                            <td>
                                                <a href="shafaf.php?edit_id=<?php echo $row['id'];  ?>">
                                                    <i class="fa fa-edit text text-success" style="cursor:pointer;"></i> 
                                                </a>
                                                <i class="mdi mdi-delete-circle text text-danger" onclick="delete_func(<?php echo $row['id']; ?>)" title="حذف" style="cursor:pointer;"></i> 
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
                shafaf_reciept_id:id,
                },
                url: "delete.php",
                success: function(msg) {
                    window.location.href = window.location.href;           
                
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