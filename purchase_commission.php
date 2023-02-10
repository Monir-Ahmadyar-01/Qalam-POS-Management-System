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
        <link href="assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />


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
                            <li class="breadcrumb-item active"> نمایش کمیشن های خرید </li>
                        </ol>
                    </div>
                    <p class="page-title">نمایش کمیشن های خرید</pack>
                </div> 
                <!-- end page title -->


                
                <div class="row">

                                <div class="col-12">
                                    <a href="purchase_commissions_reciepts.php" class="btn btn-primary btn-sm">ثبت رسید</a>

                                    <div class="card-box table-responsive">
                                    <div class="row">
                                <div class="col-sm-4">
                                    <label for="commission_taker">انتخاب کمیشن گیرنده</label>

                                    <select name="commission_taker" onchange="load_commission_taker_rows();"  class="form-control select2" id="commission_taker">
                                        <?php 
                                        $sql_query_004 = mysqli_query($connection,"SELECT * FROM `commission_takers`");
                                        
                                        while($row2 = mysqli_fetch_assoc($sql_query_004))
                                        {
                                        ?>

                                        <option value="<?php echo $row2["id"] ?>"><?php echo $row2["full_name"] ?></option>

                                        <?php
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <table id="datatable-buttons" class="table table-striped table-bordered  nowrap">
                                
                                <thead>
                                    <?php 
                                        $sql_query_002 = mysqli_query($connection,"SELECT SUM(commissions.amount) as total_purchased_commission FROM commissions WHERE commissions.purchase_commission = 1");

                                        $fetch_002 = mysqli_fetch_assoc($sql_query_002);

                                        $sql_query_003 = mysqli_query($connection,"SELECT SUM(reciepts.amount / reciepts.rate) as total_purchased_commission_reciept FROM reciepts WHERE reciepts.purchase_commission = 1");

                                        $fetch_003 = mysqli_fetch_assoc($sql_query_003);
                                    ?>
                                    <tr class="bg bg-primary text text-white">
                                        <td class="lang" key="Total_Commissions"></td>
                                        <td id="total_commission"></td>
                                        <td class="lang" key="Total_Receipts"></td>
                                        <td id="total_reciept"></td>
                                        <td class="lang" key="Total_Remain"></td>
                                        <td id="total_remain"></td>
                                    </tr>
                                    <tr>

                                        <th class="lang" key="number"></th>
                                        <th class="lang" key="Amount"></th>
                                        <th class="lang" key="Details"></th>
                                        <th class="lang" key="party_number"></th>
                                        <th class="lang" key="Date"></th>
                                        <th class="lang" key="Operation"></th>
                                    </tr>
                                </thead>

                                <tbody id="commission_taker_tbody">
                                    
                                 
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

        
        <script src="assets/libs/select2/select2.min.js"></script>


        <!-- Datatables init -->
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
                    purchase_commission_id: id,
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
        <script>
    $(function() {
        $(".select2").select2();
        load_commission_taker_rows();
    });

    
    </script>

    <script>
        function load_commission_taker_rows()
        {
            $("#commission_taker_tbody").text("");
            var commission_taker_id = $("#commission_taker").val();

            $.ajax({
            type: "POST",
            data: {
                load_commission_taker_rows: commission_taker_id,

            },
            url: "server.php",
            success: function(response_x1) {
                var responses_x1 = JSON.parse(response_x1);
                $("#total_commission").text(responses_x1[0][0]);
                $("#total_reciept").text(responses_x1[0][1]);
                $("#total_remain").text(Number(responses_x1[0][0]) - Number(responses_x1[0][1]));

                var rows = "";
                for (let index = 1; index < responses_x1.length; index++) {
                    
                    var id  = responses_x1[index]["id"];
                    var amount = responses_x1[index]["amount"];
                    var details = responses_x1[index]["details"];
                    var party_number = responses_x1[index]["party_number"];
                    var date = responses_x1[index]["date"];
                    var purchase_commission = responses_x1[index]["purchase_commission"];
                    var commission_taker = responses_x1[index]["commission_taker"];

                    rows += '<tr>';
                    rows += '<td>'+(index)+'</td>';
                    rows += '<td>'+amount+'</td>';
                    rows += '<td>'+details+'</td>';
                    rows += '<td>'+party_number+'</td>';
                    rows += '<td>'+date+'</td>';
                    rows += '<td><i class="mdi mdi-delete-circle text text-danger" onclick="delete_func('+id+')" title="حذف" style="cursor:pointer;"></i></td>';
                            
                                  
                    
                }
                $("#commission_taker_tbody").append(rows);
            }

            });
        }
           
    </script>
    </body>
</html>