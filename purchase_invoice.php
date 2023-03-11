<?php
    include_once("database.php");
?>

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

    <!-- App css -->
    <link href="assets/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/persian-datepicker.css" rel="stylesheet" type="text/css" />
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />



    <style>
    table tr td,
    table tr th,
    input,
    select {
        border: 1px solid black !important;
        color: black !important;
        font-weight: bold;
    }

    @media print {

        table tr td,
        table tr th,
        input,
        select {
            font-size: 12px;
            font-weight: bolder;
            text-align: center !important;
        }

        .bill_number {
            font-size: 12px;
            font-weight: bolder;
            color: black !important;
        }

        .print-display {
            display: none !important;
        }
        
        .form-control {
            border: none !important;
            font-size: 12px !important;
            font-weight: bolder;

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
                        <li class="breadcrumb-item active">صفحه بل خرید</li>
                    </ol>
                </div>
                <p class="page-title">صفحه بل خرید</p>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">

                        <!-- Logo & title -->
                        <div class="clearfix">
                            <div class="float-left">
                                <img src="assets/images/logo-dark.png" alt="" height="20">
                            </div>
                        </div>


                        <form method="post" action="server.php" id="uploadForm" enctype="multipart/form-data">
                            <br>
                            <br>
                            <table class="table table-bordered table-sm ">
                                <colgroup>
                                    <col style="width:20%;">
                                    <col style="width:20%;">
                                    <col style="width:20%;">
                                    <col style="width:10%;">
                                    <col style="width:20%;">
                                    <col style="width:20%;">
                                </colgroup>

                                <tr>
                                    <td class="print-display">
                                        <label for="search">جستجو</label>
                                        <select name="search_input_id" id="search_input_id" class="select2 form-control">
                                            <option value="انتخاب جنس">انتخاب جنس</option>
                                            <?php
                                                    $sql_query_01 = mysqli_query($connection,"SELECT stock_major.id,(SELECT stock_minor.item_name FROM stock_minor WHERE stock_minor.id = stock_major.item_id) as item_name,stock_major.amount,(SELECT unit_major.unit_name FROM unit_major WHERE unit_major.id = stock_major.unit_id) as unit_name  FROM `stock_major` ");
                                                    while ($row = mysqli_fetch_assoc($sql_query_01))
                                                    {
                                                ?>

                                            <option value="<?php echo $row["id"]; ?>">
                                                <?php echo $row["item_name"].' - '. $row["unit_name"]; ?></option>
                                            <?php
                                                    }
                                                ?>
                                        </select>
                                    </td>
                                    <td>
                                        <label for="purchase_date">تاریخ خرید</label>
                                        <input type="text" value="<?php echo jdate("Y-m-d",'','','','en'); ?>" name="purchase_date" 
                                            class="form-control" id="purchase_date">
                                    </td>
                                    <td>
                                        <label for="currency">واحد پولی</label>
                                        <select id="currency" name="currency" class="select2 form-control">
                                            <?php
                                                $sql_query_01 = mysqli_query($connection,"select * from currencies");
                                                while ($row = mysqli_fetch_assoc($sql_query_01))
                                                {
                                            ?>

                                            <option value="<?php echo $row["id"]; ?>">
                                                <?php echo $row["name"]; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <label for="rate" class="col-form-label">نرخ</label>
                                        <span class="text-danger">*</span>
                                        <input type="number" step="0.01" value="1" class="form-control border border-dark" name="rate" id="rate"  >
                                    </td>
                                    <td class="print-display">
                                        <label for="rate" class="col-form-label">آپلود فایل</label>
                                        <span class="text-danger">*</span>
                                        <input type="file" class="form-control border border-dark" name="attached_file" id="attached_file"  >
                                    </td>
                                    <td class="print-display">
                                        <label for="rate" class="col-form-label">وضعیت خرید</label>
                                        <span class="text-danger">*</span>
                                        <select id="purchase_status" name="purchase_status" class="form-control">
                                            <option selected value="arrived">رسیده</option>
                                            <option value="OnTheWay">در راه</option>
                                        </select>
                                    </td>
                                </tr>
                                <!-- <tr>
                                        <td class="print-display"> 
                                            <label for=rasid_type">نوعیت رسید</label>
                                            <select name="rasid_type" class="form-control" id="rasid_type">
                                                <option value="from_account">از حساب</option>
                                                <option value="cash">نقده</option>
                                            </select>
                                        </td>
                                </tr> -->
                                
                            </table>
                       
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table mt-4 table-sm table-centered">
                                   
                                        <thead>
                                            <tr>
                                                <th colspan="4">
                                                    <p style="text-align:center; font-size:25px;" for="search_input_id">
                                                        تمویل کننده : </p>

                                                </th>
                                                <th colspan="7">

                                                    <select id="supplier_major_id" name="supplier_major_id" class="select2 form-control">
                                                        <?php
                                                                $sql_query_01 = mysqli_query($connection,"select * from suppliers");
                                                                while ($row = mysqli_fetch_assoc($sql_query_01))
                                                                {
                                                            ?>

                                                        <option value="<?php echo $row["id"]; ?>">
                                                            <?php echo $row["full_name"]; ?></option>
                                                        <?php
                                                                }
                                                            ?>
                                                    </select>

                                                </th>
                                                <!-- <th colspan="2">
                                                    <p style="text-align:center; font-size:25px;">
                                                        پارتی نمبر  </p>

                                                </th> -->
                                                <!-- <th colspan="2">

                                                    <input type="text" class="form-control" name="party_number" id="party_number" required>

                                                </th> -->
                                                <!-- <th >گیرنده کمیشن</th>
                                                <th colspan="2">
                                                <select  class='form-control input-sm'  name='commission_taker' id='commission_taker_'>
                                                    <?php
                                                        $sql_query_001 = mysqli_query($connection,"SELECT * FROM `commission_takers`");
                                                        while ($row_001 = mysqli_fetch_assoc($sql_query_001))
                                                         {
                                                           ?>
                                                            <option value="<?php echo $row_001["id"]; ?>"><?php echo $row_001["full_name"]; ?></option>

                                                            <?php 
                                                        }
                                                    ?>

                                                </select></th> -->

                                            </tr>
                                            <tr>
                                                <th style="width: 5%">#</th>
                                                <th style="width: 20%">جنس</th>
                                                <th style="width: 5%">واحد</th>
                                                <th style="width: 10%">تعداد</th>
                                                <!-- <th style="width: 7%">مجموع وزن واگون</th> -->
                                                <!-- <th style="width: 7%">نمبر واگون ها - وزن واگون</th>
                                                <th style="width: 7%">مصرف دفتر | 1 دالر</th>
                                                <th style="width: 10%">مصرف کمیشن خریدار</th> -->
                                                
                                                <th style="width: 10%" class="text-right">قیمت خرید | 1</th>
                                                <th style="width: 10%" class="text-right">قیمت فروش | 1</th>
                                                <th style="width: 10%" class="text-right">مجموع</th>
                                                <th style="width: 10%" class="text-right">تاریخ انقضاء</th>
                                                <th style="width: 5%" class="text-right print-display">عمل</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bill_tbody">


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>مجموع مقدار</th>
                                                <th><input type="number" id="total_price_final" readonly
                                                        name="total_price_final"
                                                        class="form-control form-control-sm"></th>
                                            </tr>
                                            <tr>
                                                <th>مجموع رسید</th>
                                                <th><input type="number" step="0.05" id="total_reciept"
                                                       name="total_reciept"  class="form-control form-control-sm total_reciept"></th>
                                            </tr>
                                            <tr>
                                                <th>مجموع باقی</th>
                                                <th id="total_remain">0</th>
                                            </tr>

                                        </tfoot>
                                    </table>
                                </div> <!-- end table-responsive -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->


                        <div class="mt-4 mb-1">
                            <div class="text-right d-print-none">
                               
                                <button type="submit" class="btn btn-sm btn-success waves-effect waves-light"
                                    id="">ذخیره</button>
                                    <!-- button_submit -->
                            </div>
                        </div>
                        </form>
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
    
      <button type="button" style="display: none;" id="btn_modal" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="modal_body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-striped table-sm" id="myTable">  
                                <thead>
                                    <tr>
                                        <th>نمبر واگون</th>
                                        <th>وزن واگون</th>
                                        <th>عمل</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <tr>
                                        <td style="display:none ;"><input type="text" class="form-control"></td>
                                        <td><input type="number" class="form-control" id="vagon_number"></td>
                                        <td><input type="number" step="0.01" class="form-control" id="vagon_weight_td"></td>
       
                                        <td>
                                            <span class="btn btn-success fa fa-plus text text-white" onclick="add_vagon_number_to_major_row()"></span>
                                        </td>
                                    </tr>
                                  
                                
                                </tbody>
                            </table>
                            <input type="hidden" id="major_row_id" />

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>


    <!-- Vendor js -->
    <!-- <script src="assets/js/vendor.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
    <!-- persian datepicker js -->
    <script src="assets/js/persian-datepicker.js"></script>
    <script src="assets/js/languages.js"></script>
    <script src="assets/libs/select2/select2.min.js"></script>
    
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    




    <!-- App js -->
    <!-- <script src="assets/js/app.min.js"></script> -->
    <script>
    var count_2 = 1;

    $(function() {
        $("#search_input_id").on("change", function() {

            var search_input_id = $("#search_input_id").val();

            $.ajax({
                type: "POST",
                data: {
                    major_stock_item_id: search_input_id,
                },
                url: "server.php",
                success: function(response_x1)
                {
                    var responses_x1 = JSON.parse(response_x1);
                    
                    

                    $.ajax({
                        type: "POST",
                        data: {
                            load_commission_takers: '1234',
                        },
                        url: "server.php",
                        success: function(response_x1)
                        {
                            var option = "";

                            var responses_x2 = JSON.parse(response_x1);
                            for (let index = 0; index < responses_x2.length; index++) {
                                option += "<option value='"+responses_x2[index]["id"]+"'>"+responses_x2[index]["full_name"]+"</option>";
                                
                            }


                            var row =
                        "<tr id='row_id_" + count_2 + "'>";
                    row += "<td class='idss'>" + count_2 + "</td>";
                    row +=
                        "<td><input type='text' class='form-control' readonly name='purchase_item_name[]' value='" +
                        responses_x1["item_name"] +
                        "' /><input type='hidden' class='form-control' readonly name='add_purchase_major_stock_id[]' value='" +
                        responses_x1["id"] + "' /></td>";
                    row +=
                        "<td><input type='text' class='form-control' readonly name='unit_name[]' value='" +
                        responses_x1["unit_name"] +
                        "' /></td>";
                    row +=
                        "<td><input type='text' class='form-control product_quantity'  name='product_quantity[]' id='product_quantity_" +
                        count_2 + "'  value='1' /></td>";
                    row +=
                        "<td><input type='text' class='form-control purchase_price' id='purchase_price_" +
                        count_2 + "' name='purchase_price[]' value='0' /></td>";

                    row +=
                        "<td><input type='text' class='form-control sale_price' id='sale_price_" +
                        count_2 + "' name='sale_price[]' value='0' /></td>";
                    
                    row +=
                        "<td><input type='text' class='form-control row_total' readonly name='row_total[]' id='row_total_" +
                        count_2 + "' value='0' /></td>";

                    row +=
                        "<td><input type='date' class='form-control expiration_date' id='expiration_date_" +
                        count_2 + "' name='expiration_date[]'  /></td>";
                    
                    
                    
                    row +=
                        "<td class='text-center print-display'><span class='fa fa-trash text text-danger delete_btn' id='" +
                        count_2 + "'></span></td>";
                    row += "</tr>";




                    $("#bill_tbody").append(row);
                    total_cal(count_2);
                    count_2++;





                        }
                    });
                        

                   


                    $("#search_input_id").val("");
                }
            });
        });
    });

    function total_cal(count) {
        var total_price = 0;

        for (var x = 1; x <= count; x++) {
            // alert($('#product_quantity_' + x).val());

            var purchase_price = Number($('#purchase_price_' + x).val());
            // var office_expense = Number($('#office_expense_' + x).val());
            // var commision_expense = Number($('#commision_expense_' + x).val());
            var product_quantity = Number($('#product_quantity_' + x).val());
            // var vagon_weight = Number($('#vagon_weight_' + x).val());

            if(isNaN(purchase_price))
            {
                purchase_price = 0;
                // commision_expense = 0;
                product_quantity = 0;
                // vagon_weight = 0;
                // office_expense = 0;
            }
            else
            {
                var purchase_price = Number($('#purchase_price_' + x).val());
                // var commision_expense = Number($('#commision_expense_' + x).val());
                var product_quantity = Number($('#product_quantity_' + x).val());
                // var vagon_weight = Number($('#vagon_weight_' + x).val());
                // var office_expense = Number($('#office_expense_' + x).val());

            }
            
            

            var actual_price = ((purchase_price) * (product_quantity)).toFixed(2);
            $('#row_total_' + x).val(actual_price);
            total_price = total_price + Number(actual_price);
            // $('#total_product_quantity_' + x).val(actual_price.toFixed(0));



        }


        // alert(total_price);
        $('#total_price_final').val(total_price.toFixed(2));
        $('#total_reciept').val(total_price.toFixed(2));

        var total_price = Number($('#total_price_final').val());

        var supplier_id = $("#supplier_major_id").val();

        var rasid_type = $("#rasid_type").val();

        if (rasid_type == "from_account") 
        {
        $.ajax({
            type: "POST",
            data: {
                return_supplier_ballance: supplier_id,
            },
            url: "server.php",
            success: function(response) {

                var responses_x1 = JSON.parse(response);
                var total_remained_amount = responses_x1[0]["total_remained_amount"];
                // alert(total_remained_amount);

                

                if(total_remained_amount >= total_price)
                {
                    $('#total_reciept').val(total_price);
                    $("#total_remain").html(0);
                }
                else if(total_remained_amount < 0)
                {
                    $('#total_reciept').val(0);
                    $("#total_remain").html(total_price);
                }
                else
                {
                    $('#total_reciept').val(total_remained_amount);
                    $("#total_remain").html(total_price - total_remained_amount);
                }
            }

        });
    }
        else
        {
            $('#total_reciept').removeAttr('readonly');
            $('#total_reciept').val(0);
        } 



        

    }


    // $(function() {
    //     $("#return_date").hide();
    // });
    
    $(document).on('keyup', '.product_quantity', function() {
        total_cal(count_2 - 1);

    });
    $(document).on('keyup', '.purchase_price', function() {
        total_cal(count_2 - 1);

    });

    // $(document).on('keyup', '.commision_expense', function() {
    //     total_cal(count_2 - 1);
    // });
    
    $(document).on('change', '#rasid_type', function() {
        if (rasid_type == "from_account") 
        {

        }
        else
        {
            $('#total_reciept').removeAttr('readonly');
        } 

    });
    </script>

    <script>
    $(document).on('click', '.delete_btn', function() {
        var row_id = $(this).attr("id");
        $("#row_id_" + row_id).remove();

        total_cal(count_2 - 1);


        set_ids_front();




    });

    function set_ids_front() {
        var num_ids = $('.idss').length;

        // $('.idss').index(0).text("wqd");
        for (var x = 1; x <= num_ids; x++) {
            document.getElementsByClassName("idss")[x - 1].innerHTML = x;
        }
    }
    </script>
    <script>
    $(document).ready(() => {

        $('#input_date').datepicker({
            changeMonth: true,
            changeYear: true
        });

    });
    </script>

    <!-- <script>
    $("#button_submit").on("click", function() {
        var currency = $("#currency").val();
        var rate = $("#rate").val();
        var purchase_date = $("#purchase_date").val();;

        var total_price_final = $("#total_price_final").val();
        var total_reciept = $("#total_reciept").val();
        var supplier_major_id = $("#supplier_major_id").val();
        var file = document.getElementById("file").files[0];
        

        // var purchase_item_name = $('input[name^=purchase_item_name]').map(function(idx, elem) {
        //     return $(elem).val();
        // }).get();


        var add_purchase_major_stock_id = $('input[name^=major_stock_id]').map(function(idx, elem) {
            return $(elem).val();
        }).get();

        var product_quantity = $('input[name^=product_quantity]').map(function(idx, elem) {
            return $(elem).val();
        }).get();

        var purchase_price = $('input[name^=purchase_price]').map(function(idx, elem) {
            return $(elem).val();
        }).get();

        var commision_expense = $('input[name^=commision_expense]').map(function(idx, elem) {
            return $(elem).val();
        }).get();


        var details = $('textarea[name^=details]').map(function(idx, elem) {
            return $(elem).val();
        }).get();


        $.ajax({
            type: "POST",
            data: {
                add_purchase_major_stock_id: add_purchase_major_stock_id,
                product_quantity: product_quantity,
                purchase_price: purchase_price,
                commision_expense: commision_expense,
                details: details,
                currency: currency,
                rate: rate,
                file: file,
                purchase_date: purchase_date,
                total_price_final: total_price_final,
                total_reciept: total_reciept,
                supplier_major_id: supplier_major_id,
            },
            url: "server.php",
            success: function(response) {
                alert(response);
            }

        });

    });
    </script> -->

    <script>
        $(document).ready( function () {
        $('#myTable').DataTable(
            {
                language: { search: "جستجو" },
            }
            );
        } );
        function function_add_vagon(row_id)
        {   
            $("#major_row_id").val(row_id);
            $("#btn_modal").click();

        }   


        function add_vagon_number_to_major_row()
        {
            var major_row_id = $("#major_row_id").val();


            var row_vagon_number = $("#vagon_number").val();
            var row_vagon_weight = Number($("#vagon_weight_td").val());
            
            var major_row_quantity = Number($("#product_quantity_"+major_row_id).val());
            $("#product_quantity_"+major_row_id).val(major_row_quantity + 1);
            
            var vagon_id = $("#vagon_number").val();

            var major_vagon_weight = Number($("#vagon_weight_"+major_row_id).val());
            $("#vagon_weight_"+major_row_id).val(major_vagon_weight + row_vagon_weight);
            

           $("#vagon_numbers_tbody_" + major_row_id).append("<tr><td style='display:none;' class='vagon_ids_class_"+major_row_id+"'>"+row_vagon_number +"-"+ row_vagon_weight + "</td><td >"+row_vagon_number+ "</td><td >"+row_vagon_weight+ "</td><td onclick='$(this).parent().remove();delete_child_td_row(this.id)' id='"+row_vagon_weight+"'><span class='fa fa-trash text text-danger' ></span></td></tr>"); 

           var vagon_ids_class = $('td[class^=vagon_ids_class_'+major_row_id+']').map(function(idx, elem) {
                return $(elem).text();
            }).get();
            
            $("#vagon_numbers_input_" + major_row_id).val(vagon_ids_class);

            $("#vagon_number").val("");
            $("#vagon_weight_td").val("");

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
                    
                   alert(data);

                   window.location.href = window.location.href;
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
        function delete_child_td_row(row_vagon_weight)
        {   
            
            var major_row_id = $("#major_row_id").val();
            var vagon_ids_class = $('td[class^=vagon_ids_class_'+major_row_id+']').map(function(idx, elem) {
                return $(elem).text();
            }).get();

            var major_row_quantity = Number($("#product_quantity_"+major_row_id).val());
            $("#product_quantity_"+major_row_id).val(major_row_quantity - 1);

            var major_row_weight = Number($("#vagon_weight_"+major_row_id).val());
            $("#vagon_weight_"+major_row_id).val(major_row_weight - row_vagon_weight);

            $("#vagon_numbers_input_" + major_row_id).val(vagon_ids_class);
            

        }
        
    </script>
    <script>
        $(document).on('keyup', '.total_reciept', function() {
            
            var total_price = Number($('#total_price_final').val());
            var total_reciept = Number($('#total_reciept').val());
            var rate = Number($('#rate').val());
            $("#total_remain").html((total_price - (total_reciept/rate)).toFixed(2));

        });
    </script>

</body>

</html>
