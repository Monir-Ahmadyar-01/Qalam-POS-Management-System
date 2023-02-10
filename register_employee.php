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
                            <li class="breadcrumb-item active"> ثبت کارمند</li>
                        </ol>
                    </div>
                    <p class="page-title">صفحه ثبت کارمند</pack>
                </div> 
                <!-- end page title -->

                <!-- Form row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                        
                            
                            <form   method="post" action="server.php" id="uploadForm" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="full_name" class="col-form-label">نام مکمل</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control  border border-dark" name="stuff_full_name" oninvalid="this.setCustomValidity('این بخش الزامی میباشد')" oninput="this.setCustomValidity('')" required id="full_name" placeholder="بنویسید .. ">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="phone_number" class="col-form-label">شماره تماس</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control border border-dark" data-toggle="input-mask" name="phone_number" oninvalid="this.setCustomValidity('این بخش الزامی میباشد')" oninput="this.setCustomValidity('')" required id="phone_number" data-mask-format="(00) 0000-0000" placeholder="بنویسید .. " maxlength="10">                                    </div>
                                    
                                    <div class="form-group col-md-2">
                                        <label for="address" class="col-form-label">آدرس</label>
                                        <textarea class="form-control border border-dark" name="address" id="address" placeholder="بنویسید .. "></textarea>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="image" class="col-form-label">عکس</label>
                                        <input type="file" class="form-control border border-dark" name="image" id="image" placeholder="بنویسید .. ">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="input_date" class="col-form-label">تاریخ</label>
                                        <span class="text-danger">*</span>
                                        <input type="date" required class="form-control border border-dark" name="input_date" id="input_date"  placeholder="انتخاب کنید .. ">
                                    </div>
                                 
                                </div>
                                <button type="submit" class="btn btn-success waves-effect waves-light btn-sm">ثبت اطلاعات</button>
                                


                            </form>
                        </div> <!-- end card-box -->
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

        <script src="assets/libs/jquery-toast/jquery.toast.min.js"></script>

        <!-- toastr init js-->
        <script src="assets/js/pages/toastr.init.js"></script>


        <!-- persian datepicker js -->
        <script src="assets/js/persian-datepicker.js"></script>

        <!-- Plugins js -->
        <script src="assets/libs/dropzone/dropzone.min.js"></script>


        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        <script src="assets/js/languages.js"></script>

        <script>
            $('.card-box').on('show', function () {
                $('input:text:visible:first').focus();
            });
        </script>
      
      
        <script type="text/javascript">
        $(document).ready(function (e) {
            $("#uploadForm").on('submit',(function(e) {
                        e.preventDefault();
                    
                        
                        $.ajax({
                            url: "server.php",
                            type: "POST",
                            data:  new FormData(this),
                            contentType: false,
                            cache: false,
                            processData:false,
                            success: function(data)
                            {
                            if(data.trim() == 'success')
                            {
                                document.getElementById("uploadForm").reset();

                                $.toast({
                                    heading: ' پاسخ ',
                                    text: 'اطلاعات شما موفقانه در سیستم ذخیره گردید ',
                                    icon: 'success',
                                    loader: true,  
                                    position: 'top-right',      // Change it to false to disable loader
                                    loaderBg: '#9EC600',
                                    bgColor: '#34A853',
                                    textColor: 'white' // To change the background
                                });
                            }
                            else
                            {
                                $.toast({
                                    heading: ' پاسخ ',
                                    text: 'اطلاعات شما موفقانه در سیستم ذخیره گردید ',
                                    icon: 'success',
                                    loader: true,  
                                    position: 'top-right',      // Change it to false to disable loader
                                    loaderBg: '#9EC600',
                                    bgColor: '#34A853',
                                    textColor: 'white' // To change the background
                                });
                            }	
                            },
                            error: function() 
                            {

                            } 	        
                        });
                    
                }));
            
        });
        </script>


    </body>
</html>