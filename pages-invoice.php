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
    <!-- <link href="assets/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/persian-datepicker.css" rel="stylesheet" type="text/css" />

    <style>
    table tr td,
    table tr th,
    input {
        border: 1px solid black !important;
        color: black !important;
        font-weight: bold;
    }

    .display_print
    {
        display: none;
    }
    td{
        padding: 2px !important;
    }
    .customer_th
    {
        column-span: 11 !important;
    }
    @media print {

        /* table tr td,
        table tr th,
        input,
        select {
            font-size: 40px;
            font-weight: bolder;
            text-align: center !important;
        }

        .bill_number {
            font-size: 40px;
            font-weight: bolder;
            color: black !important;
        }
  */
        .print-display {
            display: none !important;
        }
        .display_print{
            display: inline-block;
        }
        input
        {
           border:none !important;
           margin:none !important; 
        }
        select {
            border: none !important;
            color: black !important;
            font-weight: bold;
        }
        .header-table,.header-table tr,.header-table td ,.header-table th
        {
            border: none !important;
        }
        .header-table input
        {
            border: none !important;
        }
        .customer_th
        {
            column-span: 5 !important;
        }
/*      
        
        .form-control {
            border: none !important;
            font-size: 40px !important;
            font-weight: bolder;

        } */ 
    }
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');
    
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
                        <li class="breadcrumb-item active">صفحه بل فروش</li>
                    </ol>
                </div>
                <p class="page-title">صفحه بل فروش</pack>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">

                    <div class="row" style="display: flex;
        height: 200px;
        margin: auto;
        align-items:center;
        justify-content:center;">
                        <div class="cl-sm-3">
                        <img src="assets/images/logo-dark.png" alt="logo" style="height:200px; float:right;">
                                
                        </div>
                        <div class="col-sm-9" ><h1 style="font-family: 'Amiri', serif !important;
        font-weight: bold;">شرکت مواد تجهیزات دندان حسین خیل</h1>
                        <h1>Hussain Khil Dental Supply Company</h1>
                        <hr></div>
                    </div>
                        <hr>
                        

                            <table class="table table-bordered header-table">
                                <colgroup>
                                    <col width="25%;">
                                    <col width="25%;">
                                    <col width="25%;">
                                    <col width="25%;">
                                </colgroup>
                                <tr >
                                    <th colspan="3" style="font-size: 40px; text-align:center; border-bottom:1px solid black;">فاکتور فروش</th>
                                    <th style="font-size: 20px; text-align:center; border-bottom:1px solid black;">
                                    نمبر فاکتور : <?php
                                        $sql_query_02 = mysqli_query($connection,"SELECT MAX(sale_major.id) as max_id FROM sale_major");
                                        $fetch_002 = mysqli_fetch_assoc($sql_query_02);
                                        echo $fetch_002["max_id"]+1; ?>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="print-display">
                                    <div class="form-group" style="padding: 0 0 0 10px !important;">
                                        <label for="" class="col-form-label">جستجو اجناس</label>
                                        <!-- <input type="search" id="search_input_id" list="items_list" class="form-control"
                                            required placeholder="جستجو ..." /> -->
                                    

                                    <input type="search" id="search_input_id" list="search_list" name="search_input_id" class="form-control">
                                            
                                    <datalist id="search_list">
                                        <?php
                                            $sql_query_01 = mysqli_query($connection,"SELECT (SELECT stock_minor.item_name FROM stock_minor WHERE stock_minor.id = stock_major.item_id) as item_name,stock_major.id,(SELECT unit_minor.unit_name FROM unit_minor WHERE unit_minor.id = stock_major.minor_unit_id) as minor_unit_name FROM stock_major;");
                                            while ($row = mysqli_fetch_assoc($sql_query_01))
                                                {
                                            ?>

                                        <option value="<?php echo $row["id"]; ?>">
                                            <?php echo $row["item_name"].'  -  '.$row["minor_unit_name"] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </datalist>
                                    
                                    </div>
                                    </td>
                                    <td >
                                        <div class="form-group">
                                            <label for="sale_date" class="col-form-label">تاریخ فروش</label>
                                            <input type="text" name="sale_date" style="font-family:tahoma;" value="<?php echo jdate("Y-m-d",'','','','en'); ?>"
                                                class="form-control" id="sale_date">
                                            <h3 id="sale_date_td"></h3>
                                            
                                        </div>

                                    </td>
                                    <td>
                                    <div class="form-group">
                                        <div class="print-display">
                                            <label for="currency" class="col-form-label print-display"> واحد پولی رسید  </label>
                                            <br>
                                            <select id="currency" name="currency" class="select2 form-control print-display">
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
                                        </div>
                                    <label for="currency" class="col-form-label display_print"> واحد پولی رسید  </label>
                                    <h3 id="currency_td"></h3>
                                </div>
                                    </td>
                                    <td>
                                    <div class="form-group">
                                    <label for="rate" class="col-form-label">نرخ</label>
                                    <span class="text-danger">*</span>
                                    <input type="number" step="0.01" value="1" class="form-control border border-dark" name="rate" id="rate"  >
                                    <h3 id="rate_td"></h3>
                                </div>  
                                    </td>
                                 
                                </tr>
                                <tr>
                                    <th colspan="1" style="font-size:20px;">
                                    مشتری   
                                    </th>
                                    <th  colspan="1">
                                        <div class="print-display">                                
                                            <select id="customer_id" class="select2 form-control pt-4 print-display">
                                                <?php
                                                        $sql_query_01 = mysqli_query($connection,"select * from customers ");
                                                        while ($row = mysqli_fetch_assoc($sql_query_01))
                                                        {
                                                    ?>

                                                <option value="<?php echo $row["id"]; ?>">
                                                    <?php echo $row["full_name"]; ?></option>
                                                <?php
                                                        }
                                                    ?>
                                            </select>
                                        </div>
                                        <h3 id="customer_id_td"></h3>
                                    </th>
                                    

                                    </th>
                                </tr>
                            </table>
                       
                           
                            



                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table mt-4 table-sm table-centered table-sm table-striped">
                                        <thead>
                                            
                                            <tr>
                                                <th style="width: 5%">#</th>
                                                <th style="width: 15%">جنس</th>
                                                <!-- <th style="width: 7%" class="print-display"> پارتی نمبر</th> -->
                                                <th style="width: 7%" class="print-display">تاریخ خرید</th>
                                                <th style="width: 7%" class="print-display">مقدار موجود</th>
                                                <th style="width: 5%">واحد </th>
                                               
                                                <th style="width: 5%">مقدار</th>
                                                <th style="width: 10%" class="text-right print-display">قیمت خرید | 1</th>
                                                <th style="width: 10%" class="text-right">قیمت فروش | 1</th>
                                                <!-- <th style="width: 7%" class="text-right"> مصرف | 1</th> -->
                                                <!-- <th style="width: 5%" class="text-right print-display"> کمیشن فروشنده | 1</th> -->
                                                <th style="width: 10%" class="text-right">مجموع</th>
                                                <th style="width: 5%" class="text-right print-display">عمل</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bill_tbody">


                                        </tbody>
                                        <tfoot>
                                            <tr >
                                                <th>مجموع مقدار</th>
                                                <th><input type="text" id="total_price_final" readonly
                                                        name="total_price_final"
                                                        class="form-control total_reciept form-control-sm"></th>
                                            </tr>
                                            <tr>
                                                <th>مجموع رسید</th>
                                                <th><input type="text" id="total_reciept"
                                                        class="form-control total_reciept form-control-sm"></th>
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
                                <button type="button" onclick="print_func()"
                                    class="btn btn-danger waves-effect btn-sm waves-light"><i
                                        class="mdi mdi-printer mr-1"></i>چاپ</button>
                                <button type="button" class="btn btn-sm btn-success waves-effect waves-light"
                                    id="button_submit">ذخیره</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- end row -->

        </div> <!-- end container -->
    </div>

    <div class="row display_print" style="position:absolute; bottom:0px;">
        <div class="col-sm-12">
            <h3 style="font-family: 'Amiri', serif !important;
        font-weight: bold;">آدرس : هرات شهرنو مارکیت حضرت ها درب چهارم طبقه دوم دوکان نمبر 357 </h3>
            <h3>شماره تماس : 0794202090 </h3>
        </div>
    </div>

    <!-- end wrapper -->

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    <!-- Footer Start -->
    <?php include_once("footer.php"); ?>
      <!-- end Footer -->
    <!-- Button to Open the Modal -->
    <button type="button" style="display: none;" id="btn_modal" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">لیست خرید ها </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="modal_body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="purchase_list">انتخاب از لیست خرید</label>
                                <select name="purchase_list" class="form-control" id="purchase_list"></select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="add_purchased_item_btn" class="btn btn-primary" data-dismiss="modal">ذخیره</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>


    <!-- Vendor js -->
    <!-- <script src="assets/js/vendor.min.js"></script> -->
    <!-- <script src="assets/js/bootstrap.js"></script> -->
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
    <!-- persian datepicker js -->
    <script src="assets/js/persian-datepicker.js"></script>
    <script src="assets/js/languages.js"></script>
    <script src="assets/libs/select2/select2.min.js"></script>




    <!-- App js -->
    <!-- <script src="assets/js/app.min.js"></script> -->
    <script>
    var count_2 = 1;

    $(function() {
        $("#search_input_id").on("search", function() {

            var search_input_id = $("#search_input_id").val();

            $.ajax({
                type: "POST",
                data: {
                    major_stock_item_id_purchase_list: search_input_id,

                },
                url: "server.php",
                success: function(response) {
                    var options = "";
                    var responses = JSON.parse(response);
                    var num_of_rows = (Object.keys(responses).length);
                    var counter = 1;
                    for (let index = 0; index < num_of_rows; index++) {

                        var purchase_id = responses[index]['id'];
                        var purchase_date = new Date(responses[index]['purchase_date']).toLocaleDateString('fa-IR');
                        // var party_number = responses[index]['party_number'];
                        var purchase_quantity = responses[index]['amount'];
                        var sold_quantity = responses[index]['total_sold_amount'];
                        var purchase_price_per = Number(responses[index]['purchase_price']) + Number(responses[index]['office_expense']) + Number(responses[index]['commision_expense']);
                        var item_name = responses[index]['item_name'];
                        var unit_name = responses[index]['minor_unit_name'];
                        var remain_amount = Number(purchase_quantity) - Number(sold_quantity);

                        
                        if(remain_amount > 0)
                        {
                            options += '<option value="' + purchase_id + '">' + item_name +
                            " - " + unit_name + " -  :  تاریخ خرید  "  + purchase_date + " - باقی : " +
                            remain_amount.toFixed(2) + " " + unit_name + '</option>';
                        }


                        counter++;

                    }
                    $("#purchase_list").html(options);
                    $("#btn_modal").click();


                    // // var row =
                    // //     "<tr id='row_id_" + count_2 + "'>";
                    // // row += "<td class='idss'>" + count_2 + "</td>";
                    // // row +=
                    // //     "<td><input type='text' class='form-control' readonly name='purchase_item_name' value='" +
                    // //     responses_x1["item_name"] +
                    // //     "' /><input type='hidden' class='form-control' readonly name='major_stock_id' value='" +
                    // //     responses_x1["id"] + "' /></td>";
                    // // row +=
                    // //     "<td><input type='text' class='form-control' readonly name='unit_name' value='" +
                    // //     responses_x1["unit_name"] +
                    // //     "' /></td>";
                    // // row +=
                    // //     "<td><input type='text' class='form-control amount'  name='amount' id='amount_" +
                    // //     count_2 + "'  value='0' /></td>";
                    // // row +=
                    // //     "<td><input type='text' class='form-control purchase_price' id='purchase_price_" +
                    // //     count_2 + "' name='purchase_price' value='0' /></td>";
                    // // row +=
                    // //     "<td><input type='text' class='form-control extra_expense'  name='extra_expense' id='extra_expense_" +
                    // //     count_2 + "'  value='0' /></td>";
                    // // row +=
                    // //     "<td><input type='text' class='form-control row_total' readonly name='row_total' id='row_total_" +
                    // //     count_2 + "' value='0' /></td>";
                    // // row +=
                    // //     "<td class='text-right print-display'><textarea name='details'></textarea></td>";
                    // // row +=
                    // //     "<td class='text-center print-display'><span class='fa fa-trash text text-danger delete_btn' id='" +
                    // //     count_2 + "'></span></td>";
                    // // row += "</tr>";


                    // // $("#bill_tbody").append(row);
                    // total_cal(count_2);
                    
                    // $("#search_input_id").val("");
                }
            });






        });

    });

    $("#add_purchased_item_btn").on("click", function() {
        // var search_input_id = $("#search_input_id").val();
        var purchase_list_id = $("#purchase_list").val();

        $.ajax({
            type: "POST",
            data: {
                purchase_list_id: purchase_list_id,

            },
            url: "server.php",
            success: function(response_x1) {
                var responses_x1 = JSON.parse(response_x1);
                var purchase_id = responses_x1[0]['id'];
                var purchase_date = new Date(responses_x1[0]['purchase_date']).toLocaleDateString('fa-IR');;
                // var party_number = responses_x1[0]['party_number'];
                var purchase_quantity = responses_x1[0]['amount'];
                var sold_quantity = responses_x1[0]['total_sold_amount'];
                var purchase_price_per = Number(responses_x1[0]['purchase_price']);
                var sale_price = Number(responses_x1[0]['sale_price']);
                var item_name = responses_x1[0]['item_name'];
                var unit_name = responses_x1[0]['minor_unit_name']; 
                var remain_amount = Number(purchase_quantity) - Number(sold_quantity);

                var row =
                    "<tr id='row_id_" + count_2 + "'>";
                row += "<td class='idss'>" + count_2 + "</td>";
                row +=
                    "<td><input type='text' class='form-control' readonly name='purchase_item_name' value='" +
                    item_name +
                    "' /><input type='hidden' class='form-control' readonly name='purchase_id' value='" +
                    purchase_id + "' /></td>";
                // row +=
                // "<td class='print-display'><input type='text' class='form-control' readonly name='party_number' value='" +
                // party_number +
                // "' /></td>";
                row +=
                "<td class='print-display'><input type='text' class='form-control' readonly name='purchase_date' value='" +
                purchase_date +
                "' /></td>";
                row +=
                "<td class='print-display'><input type='text' class='form-control item_remain_amount' readonly name='remain_amount' id='item_remain_amount_" +
                    count_2 + "' value='" +
                remain_amount.toFixed(2) +
                "' /><input type='hidden' class='form-control item_remain_amount' readonly name='remain_amount' id='item_remain_amount_hidden_" +
                    count_2 + "' value='" +
                remain_amount +
                "' /></td>";
                row +=
                    "<td><input type='text' class='form-control' readonly name='unit_name' value='" +
                    unit_name +
                    "' /></td>";
                row +=
                    "<td><input type='text' class='form-control amount'  name='amount' id='amount_" +
                    count_2 + "'  value='1' /></td>";
                row +=
                    "<td class='print-display'><input type='text' class='form-control purchase_price' id='purchase_price_" +
                    count_2 + "' name='purchase_price' readonly value='"+purchase_price_per+"' /></td>";
                row +=
                "<td><input type='text' class='form-control sale_price' id='sale_price_" +
                count_2 + "' name='sale_price' value='"+sale_price+"' /></td>";
                
                // row +=
                // "<td><input type='text' class='form-control expense' id='expense_" +
                // count_2 + "' name='expense' value='0' /></td>";

                // row +=
                //     "<td class='print-display'><input type='text' class='form-control  commission'  name='commission' id='commission_" +
                //     count_2 + "' value='0' /></td>";

                row +=
                    "<td><input type='text' class='form-control row_total' readonly name='row_total' id='row_total_" +
                    count_2 + "' value='0' /></td>";
                row +=
                    "<td style='display:none;' class='text-right print-display'><textarea name='details' ></textarea></td>";
                row +=
                    "<td class='text-center print-display'><span class='fa fa-trash text text-danger delete_btn' id='" +
                    count_2 + "'></span></td>";
                row += "</tr>";

                $("#bill_tbody").append(row);
                total_cal(count_2);
                count_2++;

                
                $("#search_input_id").val("");
            }
        });


    });

    function total_cal(count)
    {

        var total_price = 0;
        for (var x = 1; x <= count; x++) {
            // alert($('#amount_' + x).val());
            var amount = Number($('#amount_' + x).val());
            var item_remain_amount = Number($('#item_remain_amount_hidden_' + x).val());
            if(Number(item_remain_amount - amount)>= 0)
            {

            }
            else
            {
                $('#amount_' + x).val(item_remain_amount)
            }


            var sale_price = Number($('#sale_price_' + x).val());

            if(isNaN(sale_price))
            {
                sale_price = 0;
                amount = 0;
                expense = 0;
            }
            else
            {
                var sale_price = Number($('#sale_price_' + x).val());
                // alert(row_id_price);
                var amount = Number($('#amount_' + x).val());
                var expense = Number($('#expense_' + x).val());
            }
            
            var item_remain_amount = Number($('#item_remain_amount_hidden_' + x).val());
            var actual_price = ((sale_price) * amount).toFixed(2);
            $('#row_total_' + x).val(actual_price);
            $('#item_remain_amount_' + x).val(item_remain_amount - amount);

            
            
            total_price = total_price + Number(actual_price);
            // $('#total_amount_' + x).val(actual_price.toFixed(0));

        }
        $('#total_price_final').val(total_price.toFixed(2));
        $('#total_reciept').val(total_price.toFixed(2));

        $("#total_remain").html(0);

    }


    // $(function() {
    //     $("#return_date").hide();
    // });
    
    $(document).on('keyup', '.amount', function() {
        
        total_cal(count_2);

    });
    $(document).on('keyup', '.expense', function() {
        
        total_cal(count_2);

    });

    $(document).on('keyup', '.sale_price', function() {
        total_cal(count_2);

    });
    $(document).on('change', '#rasid_type', function() {
        if (rasid_type == "from_account") 
        {
            total_cal(count_2);
        }
        else
        {
            $('#total_reciept').removeAttr('readonly');
            total_cal(count_2);
        } 

    });
    </script>

    <script>
    $(document).on('click', '.delete_btn', function() {
        var row_id = $(this).attr("id");
        $("#row_id_" + row_id).remove();

        total_cal(count_2);


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

    <script>
    $("#button_submit").on("click", function() {
        var currency = $("#currency").val();
        var rate = $("#rate").val();
        var sale_date = $("#sale_date").val();
        var customer_id = $("#customer_id").val();
        // var rasid_type = $("#rasid_type").val();

        var total_price_final = $("#total_price_final").val();
        var total_reciept = $("#total_reciept").val();

        // var purchase_item_name = $('input[name^=purchase_item_name]').map(function(idx, elem) {
        //     return $(elem).val();
        // }).get();


        var purchase_id = $('input[name^=purchase_id]').map(function(idx, elem) {
            return $(elem).val();
        }).get();

        var sale_price = $('input[name^=sale_price]').map(function(idx, elem) {
            return $(elem).val();
        }).get();

        var amount = $('input[name^=amount]').map(function(idx, elem) {
            return $(elem).val();
        }).get();

        // var expense = $('input[name^=expense]').map(function(idx, elem) {
        //     return $(elem).val();
        // }).get();
        // var commission = $('input[name^=commission]').map(function(idx, elem) {
        //     return $(elem).val();
        // }).get();

        // var party_number = $('input[name^=party_number]').map(function(idx, elem) {
        //     return $(elem).val();
        // }).get();


      


        $.ajax({
            type: "POST",
            data: {
                add_sale_purchase_id: purchase_id,
                amount: amount,
                sale_price: sale_price,
                currency: currency,
                rate: rate,
                sale_date: sale_date,
                total_price_final: total_price_final,
                total_reciept: total_reciept,
                customer_id: customer_id,
            },
            url: "server.php",
            success: function(response) {
                alert(response);
                setTimeout(() => {
                    location.reload();
                }, 100);
                // print_func();
                       
            }

        });

    });
    </script>
    <script>
    $(function() {
        $(".select2").select2();
    });
    </script>



    <script>
        function print_func(){
            $("#sale_date_td").html($("#sale_date").val());
            $("#sale_date").remove();

            $("#currency_td").html($("#currency option:selected").text());
      

            $("#customer_id_td").html($("#customer_id option:selected").text());
            $("#rasid_type_td").html($("#rasid_type option:selected").text());
            

            $("#rate_td").html($("#rate").val());
            $("#rate").remove();

            window.print();
            window.location.href = window.location.href;    
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