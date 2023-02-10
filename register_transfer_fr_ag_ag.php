<?php
    include_once("database.php");
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
        <link href="assets/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/persian-datepicker.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


        

        <style>
            table tr td,table tr th,input,select{
                border:1px solid black !important;
                color:black !important;
                font-weight: bold;
            }
            @media print{
                table tr td,table tr th,input,select{
                    font-size:40px;
                    font-weight: bolder;
                    text-align: center !important;
                }
                .bill_number{
                    font-size:40px;
                    font-weight: bolder;
                    color:black !important;
                }
                .print-display{
                    display: none !important;
                }
                .form-control{
                    border: none !important;
                    font-size:40px !important;
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">وزین</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">صفحات</a></li>
                            <li class="breadcrumb-item active">صفحه ثبت انتقال از نمایندگی به نمایندگی</li>
                        </ol>
                    </div>
                    <p class="page-title">صفحه ثبت انتقال از نمایندگی به نمایندگی</pack>
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
                                <div class="float-right">
                                    <p class="m-0 bill_number">نمبر بل : 125</p>
                                </div>
                            </div>

                            

                            <div class="row mt-3" >
                                <div class="col-md-4 print-display">
                                    <div class="form-group " >
                                        <input type="search" id="search_input_id" list="items_list" class="form-control"  required
                                                placeholder="جستجو اجناس"/>
                                    </div>

                                    <datalist id="items_list">
                                        <?php
                                            $sql_query_01 = mysqli_query($connection,"select * from stock_minor");
                                            while ($row = mysqli_fetch_assoc($sql_query_01))
                                            {
                                        ?>

                                            <option value="<?php echo $row["id"]; ?>"><?php echo $row["item_name"]; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </datalist>
                                </div> <!-- end col -->
                                
                               
                                
                            </div> 
                            <!-- end row -->

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table mt-4 table-sm table-centered">
                                            <thead>
                                                <tr>
                                                   
                                                    <th>
                                                        <p style="text-align:center; font-size:25px;" for="search_input_id">از نمایندگی : </p>
                                                    
                                                    </th>
                                                    <th colspan="3">
                                                    <select class="form-control js-example-basic-single" id="from_agency_admin_id" name="from_agency_admin_id">
                                                        <?php 
                                                        $sql_query_001 = mysqli_query($connection,"select id,agency_name from agencies");
                                                        while ($row = mysqli_fetch_assoc($sql_query_001)) 
                                                        {
                                                        
                                                        ?>
                                                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["agency_name"]; ?></option>

                                                        <?php
                                                            
                                                        }
                                                        ?>
                                                    </select> 
                                                    </th>
                                                    <th>
                                                        <p style="text-align:center; font-size:25px;" for="search_input_id">به نمایندگی : </p>
                                                    
                                                    </th>
                                                    <th colspan="3">
                                                    <select class="form-control js-example-basic-single" id="to_agency_admin_id" name="to_agency_admin_id">
                                                        <?php 
                                                        $sql_query_001 = mysqli_query($connection,"select id,agency_name from agencies");
                                                        while ($row = mysqli_fetch_assoc($sql_query_001)) 
                                                        {
                                                        
                                                        ?>
                                                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["agency_name"]; ?></option>

                                                        <?php
                                                            
                                                        }
                                                        ?>
                                                    </select> 
                                                    </th>
                                                </tr>
                                            <tr>
                                                <th style="width: 10%">#</th>
                                                <th style="width: 15%">کالا</th>
                                                <th style="width: 10%">تعداد</th>
                                                <th style="width: 20%">واحد انتقال</th>
                                                <th style="width: 10%" class="text-right">فی واحد به کیلو</th>
                                                <th style="width: 10%" class="text-right">مجموع به کیلو</th>
                                                <th style="width: 10%" class="text-right print-display">توضیحات</th>
                                                <th style="width: 5%" class="text-right print-display">عمل</th>
                                            </tr></thead>
                                            <tbody id="bill_tbody">
                                            
                                            
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>مجموع مقدار به کیلو</th>
                                                    <th ><input type="number" id="total_amount" readonly name="total_price" class="form-control total_reciept form-control-sm"></th>
                                                </tr>
                                              
                                            </tfoot>
                                        </table>
                                    </div> <!-- end table-responsive -->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->


                            <div class="mt-4 mb-1">
                                <div class="text-right d-print-none">
                                    <a href="javascript:window.print()" class="btn btn-danger waves-effect btn-sm waves-light"><i class="mdi mdi-printer mr-1"></i>چاپ</a>
                                    <button type="button" class="btn btn-sm btn-success waves-effect waves-light" id="button_submit">ذخیره</button>
                                </div>
                            </div>
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
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center">
                        2018 - 2019 &copy;   <a href="">ساخته شده در شرکت عصر پویا</a> 
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

       

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
        <!-- persian datepicker js -->
        <script src="assets/js/persian-datepicker.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="assets/js/languages.js"></script>





        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        <script>
            var count = 1;
            $(function(){
                set_cus_type();
                var units_list_2 = "request";

                
                
                $("#search_input_id").on("search",function(){

                    var search_input_id = $("#search_input_id").val();
                    $.ajax({
                    type: "POST",
                    data: {
                    sale_item_id: search_input_id,
                    agency_id:"3",
                                
                    },
                    url: "server.php",
                    success: function(response_x1) 
                    {
                        var responses_x1 = JSON.parse(response_x1);
                        
                    $.ajax({
                    type: "POST",
                    data: {
                    units_list: units_list_2,
                                
                    },
                    url: "server.php",
                    success: function(response) {
                        
                        var options = "";
                        var responses = JSON.parse(response);
                        var num_of_rows = (Object.keys(responses).length);

                        for (let index = 0; index < num_of_rows; index++) {

                            // for (let index_2 = 0; index_2 < 4; index_2++) {
                            //     alert(responses[index][index_2]);
                            // }

                            var unit_id = responses[index][0];
                            var unit_name = responses[index][1];
                            
                            options += "<option value='"+unit_id+"'>"+unit_name+"</option>";

                            
                        }

                        var row = 
                        "<tr id='row_id_" + count + "'>";
                        row += "<td class='idss'>" + count + "</td>";
                        row += "<td><input type='text' class='form-control' readonly name='item_name' value='" + responses_x1["item_name"] + "' /><input type='hidden' class='form-control' readonly name='tr_fr_ag_to_ag_supply_id' value='" + responses_x1["item_stock_minor_id"] + "' /></td>";
                        row += "<td><input type='text' class='form-control input-sm quantity' name='quantity' id='quantity_" + count + "' value='1' /></td>";
                        row += "<td><select name='minor_units' class='form-control price_fi_unit_xx' onchange='get_data_from_units(this.id)' id='minor_units_" + count + "' data-style='btn-danger' >"+options+"</select></td>";
                        row += "<td class='text-right ' ><input type='text'readonly  id='per_item_kg_" + count + "' name='per_item_kg' class='form-control  input-sm' value='0' /></td>";
                        row += "<td class='text-right ' ><input type='text' readonly id='total_item_kg_" + count + "' name='total_item_kg' class='form-control  input-sm' value='0' /></td>";
                        row += "<td class='text-right print-display'><textarea name='details'></textarea></td>";
                        row += "<td class='text-center print-display'><span class='fa fa-trash text text-danger delete_btn' id='" + count + "'></span></td>";
                        row += "</tr>";
                                                    
                                                
                        $("#bill_tbody").append(row);

                        var minor_unit_id_2 = "minor_units_"+count;
                        get_data_from_units(minor_unit_id_2);

                        set_ids_front();
                        total_cal(count);
                        
                        count++;
                    }
                });



                    $("#search_input_id").val("");
                    }
                    });




                   

                });

                $("#customer_type").on("change",function(){
                    set_cus_type();
                });
            });

            function total_cal(count) {

                var idd = "minor_units_"+count;
                get_data_from_units(idd);

            // alert(count);
            var total_price = 0;
            for (var x = 1; x <= count; x++) {
                var quantity = parseFloat($('#quantity_' + x).val());
                // alert(row_id_price);
                if (quantity > 0) {
                    var per_item_kg = parseFloat($('#per_item_kg_' + x).val());

                    var actual_kg = quantity * per_item_kg;
                    
                    $('#total_item_kg_' + x).val(actual_kg.toFixed(0));
                    // $('#total_price').val(total_price.toFixed(2));
                    
                }
            }
            
        }

        $(document).ready(function() {
                $('.js-example-basic-single').select2();
                $('#to_agency_admin_id').select2();
            });

        $(function(){
            $("#return_date").hide();
        });
        $(document).on('keyup', '.total_reciept', function() {
           
            var total_price = parseFloat($('#total_price').val());
            var total_reciept = parseFloat($('#total_reciept').val());
            $("#total_remain").html(total_price-total_reciept);

            if(total_price <= total_reciept)
            {
                $("#return_date").hide();
            }
            else
            {
                $("#return_date").show();
            }
            
        });
        $(document).on('keyup', '.discount', function() {
           
           total_cal(count);
           
       });
        $(document).on('keyup', '.quantity', function() {
           
           total_cal(count);
           
       });

            // function set customer type regarding input
            function set_cus_type()
            {
                var customer_type = $("#customer_type").val();
                if(customer_type == "temp_client")
                {
                    $("#major_customer_id").hide();
                    $("#major_customer_id").val("");
                    $("#minor_customer").show();

                }
                else
                {
                    $("#minor_customer").hide();
                    $("#minor_customer").val("");
                    $("#major_customer_id").show();

                }
            }

            function get_data_from_units(select_id) {
                var minor_unit_id  = $("#"+select_id).val();
                $.ajax({
                    type: "POST",
                    data: {
                        minor_unit_id: minor_unit_id,
                    },
                    url: "server.php",
                    success: function(response) {
                        var responses = JSON.parse(response);
                        var pack_quantity = parseFloat(responses[0]["pack_quantity"]);
                        var kg_factor = parseFloat(responses[0]["kg_factor"]);

                        var total_kg = pack_quantity * kg_factor;
                        var select_id_arr = select_id.split("_");
                        $("#per_item_kg_"+select_id_arr[2]).val(total_kg);

                        var quantity  = parseFloat($("#quantity_"+select_id_arr[2]).val());
                        $("#total_item_kg_"+select_id_arr[2]).val(quantity*total_kg);
                    }
                });


            }
        </script>

        <script>
            
            $(document).ready(function(){
                setInterval(function () {total_calc();}, 50);
            });

            function total_calc()
            {
                var quantity_arr = $('input[name^=total_item_kg]').map(function(idx, elem) {
                    return $(elem).val();
                }).get();
                

                
                var total_value = 0;

                for (let index = 0; index < quantity_arr.length; index++) {
                    total_value = total_value + parseFloat(quantity_arr[index]);
                }

                $("#total_amount").val(total_value);
            }
        </script>

        <script>
            $(document).on('click', '.delete_btn', function() {
                var row_id = $(this).attr("id");
                $("#row_id_" + row_id).remove();
                total_calc();
                set_ids_front();

                

                
            });
            function set_ids_front()
            {
                var num_ids = $('.idss').length;

                // $('.idss').index(0).text("wqd");
                for (var x = 1; x <= num_ids; x++) {
                    document.getElementsByClassName("idss")[x-1].innerHTML = x;
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
            $("#button_submit").on("click",function(){
                
                var from_agency_admin_id = $("#from_agency_admin_id").val();
                var to_agency_admin_id = $("#to_agency_admin_id").val();

                var tr_fr_ag_to_ag_supply_id = $('input[name^=tr_fr_ag_to_ag_supply_id]').map(function(idx, elem) {
                    return $(elem).val();
                }).get();

                var minor_units = $('select[name^=minor_units]').map(function(idx, elem) {
                    return $(elem).val();
                }).get();
                
                var quantity = $('input[name^=quantity]').map(function(idx, elem) {
                    return $(elem).val();
                }).get();

                var details = $('textarea[name^=details]').map(function(idx, elem) {
                    return $(elem).val();
                }).get();

                $.ajax({
                    type: "POST",
                    data: {
                        from_agency_admin_id: from_agency_admin_id,
                        tr_fr_ag_to_ag_supply_id: tr_fr_ag_to_ag_supply_id,
                        to_agency_admin_id: to_agency_admin_id,
                        minor_units: minor_units,
                        details: details,
                        quantity: quantity,
                    },
                    url: "server.php",
                    success: function(response) {
                        alert(response);
                    }
                
                });
                
            });
        </script>

    
    </body>
</html>