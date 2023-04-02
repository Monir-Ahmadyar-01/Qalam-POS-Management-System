<?php 
include_once("session.php");
include("database.php");  

$emp_id = $_SESSION["employee_id"];

$sql_query_001 = mysqli_query($connection,"select id,full_name,image from staff where id='$emp_id'");
$fetch_001 = mysqli_fetch_assoc($sql_query_001);

if($_SESSION["authority"] == "Admin")
{
    echo "<style>
    .admin_authority{
        display:none;
    }
    </style>";

}



?>
<style>

    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');
    body,li a{
        font-family: 'Amiri', serif !important;
        font-weight: bold;
    }
</style>
<title>Qalam Mis</title>

<header id="topnav">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">

                        <li class="dropdown notification-list">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

            
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="stuff_documents/images/<?php echo $fetch_001["image"]; ?>" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ml-1">
                                    <?php echo $fetch_001["full_name"]; ?> <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h6 class="m-0">
                                        خوش آمدید !
                                    </h6>
                                </div>
    
                
    
                                <div class="dropdown-divider"></div>
    
                                <!-- item-->
                                <a href="logout.php" class="dropdown-item notify-item">
                                    <i class="dripicons-power"></i>
                                    <span>خـــروج</span>
                                </a>
    
                            </div>
                        </li>
                    </ul>
    
                    <ul class="list-unstyled menu-left mb-0">
                        <li class="float-left logo-box">
                            <a href="home.php" class="logo">
                                <span class="logo-lg">
                                    <img src="assets/images/logo-light.png" alt="" height="100">
                                </span>
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.png" alt="" height="100">
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end Topbar -->

            <div class="topbar-menu">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li class="has-submenu admin_authority">
                                <a href="home.php" class="lang" key="main-page">
                                    <i class="dripicons-meter"></i></a>
                            </li>
                            <li class="has-submenu">
                                <a href="#" class="lang" key="sales">
                                    <i class="mdi mdi-sale"></i><div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a class="lang" key="page-invoice" href="pages-invoice.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="selled_page" href="selled_page.php"></a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#" class="lang" key="purchase">
                                    <i class="mdi mdi-sale"></i><div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a class="lang" key="purchase_invoice" href="purchase_invoice.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="purchased_items" href="purchased_items.php"></a>
                                    </li>
                                    
                                </ul>
                            </li>

                            

                            <li class="has-submenu admin_authority">
                                <a href="#" class="lang" key="employees" >
                                    <i class="icon-user-following "></i><div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a class="lang" key="register_employee"  href="register_employee.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="registered_employees"  href="registered_employees.php"></a>
                                    </li>
                                    <hr>
                                    <li>
                                        <a class="lang" key="register_user"  href="register_user.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="registered_users"  href="registered_users.php"></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#" class="lang" key="suppliers">
                                    <i class="mdi mdi-account-badge-horizontal"></i><div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a class="lang" key="register_supplier" href="register_supplier.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="registered_suppliers" href="registered_suppliers.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="suppliers_billance" href="suppliers_billance.php"></a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#" class="lang" key="items" >
                                    <i class="mdi mdi-source-branch"></i><div class="arrow-down"></div></a>
                                <ul class="submenu">
                                 
                                    <li>
                                        <a class="lang" key="register_exist_good"  href="register_exist_good.php"></a>
                                    </li>
                                    <li>
                                        <a  class="lang" key="stock_minor_units" href="stock_minor_units.php"></a>
                                    </li>
                                    <hr>
                                    <!-- <li>
                                        <a  class="lang" key="alternat" href="alternat.php"></a>
                                    </li>
                                    <li>
                                        <a  class="lang" key="registered_alternats" href="registered_alterants.php"></a>
                                    </li> -->
                                    <!-- <hr> -->
                                    <li>
                                        <a  class="lang" key="register_good" href="register_good.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="registered_goods"  href="registered_goods.php"></a>
                                    </li>

                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#" class="lang" key="expenses">
                                    <i class="mdi mdi-home-currency-usd "></i><div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a class="lang" key="register_expense" href="register_expense.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="registered_expenses" href="registered_expenses.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="register_expense_category" href="register_expense_category.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="registered_expenses_category" href="registered_expenses_category.php"></a>
                                    </li>
                                    <!-- <li>
                                        <a class="lang" key="purchase_office_expenses" href="purchase_office_expenses.php"></a>
                                    </li> -->
                                    
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#" class="lang" key="customers">
                                    <i class="mdi mdi-account-badge-horizontal"></i><div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a class="lang" key="register_customer" href="register_customer.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="registered_customers" href="registered_customers.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="customers_billance" href="customers_billance.php"></a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#" class="lang" key="language">
                                    <i class="mdi mdi-account-badge-horizontal"></i>زبان<div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="#" class="translate lang" key="en-gb" id="en-gb">English</a> 
                                    </li>
                                   
                                    <li>
                                    <a href="#" class="translate lang"  key="fa" id="fa">persian</a> 
                                    </li>
                                   
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#" class="lang" key="orders">
                                </a>
                                <ul class="submenu">
                                    <li>
                                        <a class="lang" key="Add Order" href="order.php" ></a> 
                                    </li>
                                   
                                    <li>
                                    <a  class="lang"  key="Orders List"  href="orders_list.php"></a> 
                                    </li>
                                  
                                </ul>
                            </li>
                            <!-- <li class="has-submenu">
                                <a href="#">
                                    <i class="mdi mdi-cash "></i>نرخ<div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="register_rate.php">ثبت (نرخ)</a>
                                    </li>
                                    <li>
                                        <a href="registered_rates.php">نمایش (نرخ ها)</a>
                                    </li>
                                    
                                </ul>
                            </li> -->
                            <li class="has-submenu">
                                <a href="#" class="lang" key="units">
                                    <i class="mdi mdi-format-list-checkbox"></i><div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a class="lang" key="register_minor_unit" href="register_minor_unit.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="registered_minor_units" href="registered_minor_units.php"></a>
                                    </li>
                                    <hr>
                                    <li>
                                        <a class="lang" key="register_major_unit" href="register_major_unit.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="registered_major_units" href="registered_major_units.php"></a>
                                    </li>
                                    
                                </ul>
                            </li>

                            <!-- <li class="has-submenu">
                                <a href="#" class="lang" key="vagon"></a>
                                <ul class="submenu">
                                    <li>
                                        <a class="lang" key="register_vagon" href="register_vagon.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="registered_vagons" href="registered_vagons.php"></a>
                                    </li>
                                   
                                </ul>
                            </li> -->

                            <!-- <li class="has-submenu">
                                <a class="lang" key="shafaf" href="shafaf.php"></a>
                                <ul class="submenu">
                                    <li>
                                        <a class="lang" key="shafaf_register_reciept" href="shafaf.php"></a>
                                    </li>
                                    <li>
                                        <a class="lang" key="view_shafaf_reciepts" href="view_shafaf_reciepts.php"></a>
                                    </li>
                                   
                                </ul>
                            </li> -->
                            <li>
                                <a class="lang" key="backup" target="_blank" href="backup.php"></a>
                            </li>
                            
                           

                        </ul>
                        <!-- End navigation menu -->

                        <div class="clearfix"></div>
                    </div>
                    <!-- end #navigation -->
                </div>
                <!-- end container -->
            </div>
            <!-- end navbar-custom -->

        </header>

        