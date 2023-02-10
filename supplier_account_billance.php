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

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/persian-datepicker.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
    <!-- Jquery Toast css -->
    <link href="assets/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />


<style>
    td,th
    {
        text-align: center !important;
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
                        <li class="breadcrumb-item active"> حساب تمویل کننده ها </li>
                    </ol>
                </div>
                <p class="page-title">صفحه حساب تمویل کننده</pack>
            </div>
            <!-- end page title -->
            <?php
            $supplier_id = $_GET["supplier_id"];
            
            ?>

            <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <table id="myTable" class="table table-striped table-bordered  nowrap">
                                
                                <thead>
                                    <tr>
                                        <th colspan="10" style="font-weight:bolder;">صفحه حساب : <?php echo $_GET["supplier_name"]; ?></th>
                                    </tr>
                                    <tr>
                                        <th>شماره</th>
                                        <th>توضیحات</th>
                                        <th>واحد پولی</th>
                                        <th>نرخ</th>
                                        <th>مقدار آمد</th>
                                        <th>مقدار رفت</th>
                                        <th>بیلانس</th>
                                        <th>تاریخ</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $total_credit = 0;
                                        $total_debit = 0;
                                        $count = 1;
                                        $sql_query_001 = mysqli_query($connection,"SELECT supplier_billance.*,(SELECT currencies.name FROM currencies WHERE currencies.id = supplier_billance.currency_id) as currency_name FROM supplier_billance WHERE supplier_billance.supplier_id='$supplier_id' order by id ASC");
                                        while ($row = mysqli_fetch_assoc($sql_query_001))
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row["description"]; ?></td>
                                            <td><?php echo $row["currency_name"]; ?></td>
                                            <td><?php echo $row["rate"]; ?></td>
                                            <td><?php
                                            $total_credit = $total_credit + ($row["credit_amount"]/$row["rate"]);
                                            echo $row["credit_amount"]; ?></td>

                                            <td><?php
                                            $total_debit = $total_debit + $row["debit_amount"];
                                            echo $row["debit_amount"]; ?></td>
                                            <?php
                                            if(($total_credit - $total_debit) >= 0)
                                            {
                                            ?>
                                            <td class="bg bg-success text text-white">
                                                <?php  echo $total_credit - $total_debit; ?>
                                            </td>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <td class="bg bg-danger text text-white">
                                                <?php  echo $total_credit - $total_debit; ?>
                                            </td>
                                            <?php
                                            }
                                            ?>
                                            
                                            <td><?php
                                            $date_m = explode("-",$row["date"]);
                                            $date_sh =  gregorian_to_jalali($date_m[0],$date_m[1],$date_m[2],'/');
                                            echo $date_sh;?></td>
                                            
                                            <td>
                                                <a href="supplier_reciepts.php?supplier_id=<?php echo $supplier_id;  ?>&supplier_account_id=<?php echo $row['id'];  ?>&supplier_name=<?php echo $_GET['supplier_name'];  ?>">
                                                    <i class="fa fa-edit text text-success" style="cursor:pointer;"></i> 
                                                </a> | 
                                                <i class="mdi mdi-delete-circle text text-danger" onclick="delete_func(<?php echo $row['id']; ?>)" title="حذف" style="cursor:pointer;"></i>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;
                                        }
                                    
                                    ?>
                                 
                                </tbody>
                                <tfoot>
                                    <tr class="bg bg-primary text text-white">
                                        <th colspan="3">مجموع آمد   : <?php echo $total_credit; ?></th>
                                        <th colspan="3">مجموع رفت  : <?php echo $total_debit; ?></th>
                                        <th colspan="4">مجموع بیلانس  : <?php echo $total_credit - $total_debit; ?></th>
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
                    <img src="assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme"
                        class="rounded-circle img-fluid">
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
                        <div class="inbox-item-img"><img src="assets/images/users/avatar-1.jpg" class="rounded-circle"
                                alt=""></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Chadengle</a></p>
                        <p class="inbox-item-text">Hey! there I'm available...</p>
                        <p class="inbox-item-date">13:40 PM</p>
                    </div>
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="rounded-circle"
                                alt=""></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Tomaslau</a></p>
                        <p class="inbox-item-text">I've finished it! See you so...</p>
                        <p class="inbox-item-date">13:34 PM</p>
                    </div>
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/avatar-3.jpg" class="rounded-circle"
                                alt=""></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Stillnotdavid</a>
                        </p>
                        <p class="inbox-item-text">This theme is awesome!</p>
                        <p class="inbox-item-date">13:17 PM</p>
                    </div>

                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/avatar-4.jpg" class="rounded-circle"
                                alt=""></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kurafire</a></p>
                        <p class="inbox-item-text">Nice to meet you</p>
                        <p class="inbox-item-date">12:20 PM</p>

                    </div>
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/avatar-5.jpg" class="rounded-circle"
                                alt=""></div>
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

    <script src="assets/libs/jquery-toast/jquery.toast.min.js"></script>

    <!-- toastr init js-->
    <script src="assets/js/pages/toastr.init.js"></script>
    <script src="assets/js/languages.js"></script>



    <!-- persian datepicker js -->
    <script src="assets/js/persian-datepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <!-- Plugins js -->
    <script src="assets/libs/dropzone/dropzone.min.js"></script>


    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

    <script>
    $('.card-box').on('show', function() {
        $('input:text:visible:first').focus();
    });
    </script>
    <script>
    $(document).ready(() => {

        $('#input_date').datepicker({
            changeMonth: true,
            changeYear: true
        });

    });
    </script>
    <script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    $(document).ready( function () {
        $('#myTable').DataTable(
            {
                "language": {
                    "search": "جستجو : "
                }
            }
        );
    } );
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
                    if (data.trim() == 'success') {
                        document.getElementById("uploadForm").reset();

                        $.toast({
                            heading: ' پاسخ ',
                            text: 'اطلاعات شما موفقانه در سیستم ذخیره گردید ',
                            icon: 'success',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600',
                            bgColor: '#34A853',
                            textColor: 'white' // To change the background
                        });
                    } else {
                        $.toast({
                            heading: ' پاسخ ',
                            text: 'اطلاعات شما موفقانه در سیستم ذخیره گردید ',
                            icon: 'success',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600',
                            bgColor: '#34A853',
                            textColor: 'white' // To change the background
                        });
                    }

                    setTimeout(() => {
                        window.location.href = window.location.href;     
                    }, 2000);
                },
                error: function() {

                }
            });

        }));

    });
    </script>
 <script>
    $(function() {
        $(".select2").select2();
    });
    </script>
    <script>
            function delete_func(id){
            var confirm  = window.confirm("اطلاعات حذف خواهد شد برای لغو cancel را بزنید");
            if(confirm == true)
            {
                $.ajax({
                type: "GET",
                data: {
                supplier_acc_id:id,
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