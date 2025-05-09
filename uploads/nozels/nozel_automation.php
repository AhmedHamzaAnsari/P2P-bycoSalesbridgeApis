<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

<head>

    <meta charset="utf-8" />
    <title>
        Dealers |
        <?php echo $_SESSION['user_name']; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNyJWb04pByaU1CTmimoWNl3b86VV6qZ8&callback=initMap&libraries=places,drawing&v=weekly"
        defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link href="https://fonts.cdnfonts.com/css/digital-7-mono" rel="stylesheet">

    <!-- App favicon -->

    <?php include 'css_script.php'; ?>

    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            width: 320px;
            height: 40px;
            background: #B72322;
            border-radius: 10px 10px 10px 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 18px;
            font-weight: bold;
            box-shadow: inset 0px -4px 8px rgba(0, 0, 0, 0.5)
        }




        .fuel-dispenser {
            width: 300px;
            height: 400px;
            background: linear-gradient(to bottom, #d31f1f 55%, white 50%);
            position: relative;
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: inset -4px 0px 8px rgba(0, 0, 0, 0.5), inset 4px 0px 8px rgba(0, 0, 0, 0.5);

        }



        .screen {
            width: 90%;
            height: 180px;
            background: black;
            color: white;
            font-size: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px;
            font-weight: 500;
            margin: 10px 0;
            border-radius: 5px;
            font-family: 'Digital-7 Mono', sans-serif !important;
            border: 10px solid;
            border-image: linear-gradient(to bottom, white, #71797E)1;
            box-shadow: inset 0px -4px 4px rgba(0, 0, 0, 0.5)
        }

        .buttons {
            display: flex;
            justify-content: space-around;
            width: 90%;
            margin-bottom: 10px;
        }

        .button {
            width: 60px;
            height: 40px;
            background: #333;
            color: white;
            text-align: center;
            line-height: 40px;
            border-radius: 5px;
            cursor: pointer;
        }

        .pump-body {
            width: 90%;
            margin-top: 20px;
            height: 200px;
            background: #b71c1c;
            border-radius: 10px 10px 10px 10px;
            position: relative;
            background: #D02928;
        }

        /* .footer {
            width: 100%;
            height: 40px;
            background: #880e4f;
            border-radius: 0 0 10px 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 16px;
        } */
        .bottom {
            height: 40px;
            width: 320px;
            box-shadow: inset 0px -4px 8px rgba(0, 0, 0, 0.5);
            border-radius: 5px
        }

        .ready {
            width: 320px;
            height: 40px;
            background: #FFBF00;
            border-radius: 10px 10px 10px 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: red;
            font-size: 20px;
            font-weight: bold;
            box-shadow: inset 0px -4px 8px rgba(0, 0, 0, 0.5)
        }

        .pump-body1 {
            width: 90%;
            margin-top: 20px;
            height: 200px;
            background: #367c2b;
            border-radius: 10px 10px 10px 10px;
            position: relative;
        }

        .fuel-dispenser1 {
            width: 300px;
            height: 400px;
            background: linear-gradient(to bottom, #4CBB17 55%, white 50%);
            position: relative;
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: inset -4px 0px 8px rgba(0, 0, 0, 0.5), inset 4px 0px 8px rgba(0, 0, 0, 0.5);

        }

        .header1 {
            width: 320px;
            height: 40px;
            background: #018749;
            border-radius: 10px 10px 10px 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 20px;
            font-weight: bold;
            box-shadow: inset 0px -4px 8px rgba(0, 0, 0, 0.5)
        }


        .pump-body2 {
            width: 90%;
            margin-top: 20px;
            height: 200px;
            background: #BF40BF;
            border-radius: 10px 10px 10px 10px;
            position: relative;
        }

        .fuel-dispenser2 {
            width: 300px;
            height: 400px;
            background: linear-gradient(to bottom, #BF40BF 55%, white 50%);
            position: relative;
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: inset -4px 0px 8px rgba(0, 0, 0, 0.5), inset 4px 0px 8px rgba(0, 0, 0, 0.5);

        }

        .header2 {
            width: 320px;
            height: 40px;
            background: #702963;
            border-radius: 10px 10px 10px 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 20px;
            font-weight: bold;
            box-shadow: inset 0px -4px 8px rgba(0, 0, 0, 0.5)
        }

        .user-profile-img {
            background: none;
        }
    </style>
</head>


<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <?php include 'header.php'; ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php include 'sidebar.php'; ?>

        <!-- Left Sidebar End -->


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                <div>
                                <button class="btn btn-primary" id="price_changebtn">Change Price</button>
                            </div>
                    <div class="card">


                        <div class="user-profile-img">
                            <img src="image.webp" id="profile_img" class="profile-img profile-foreground-img rounded-top" alt="" style="background: none; object-fit: fill;">

                        </div>
                        <div class="row" id="parentrow">
                            
                            <!--  -->

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <img src="https://a0.anyrgb.com/pngimg/1388/460/loading-arm-oil-terminal-gantry-tank-truck-liquefied-petroleum-gas-storage-tank-petroleum-hose-rail-transport-cylinder.png" alt="" style="width: 300px; height: 200px;">

                                        </div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-md-6" style="font-size: 25px;">
                                                    Product :
                                                </div>
                                                <div class="col-md-6" style="font-size: 25px;">
                                                    <span>PMG</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6" style="font-size: 25px;">
                                                    Total Receipts :
                                                </div>
                                                <div class="col-md-6" style="font-size: 25px;">
                                                    <span>20000</span>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <img src="https://a0.anyrgb.com/pngimg/1388/460/loading-arm-oil-terminal-gantry-tank-truck-liquefied-petroleum-gas-storage-tank-petroleum-hose-rail-transport-cylinder.png" alt="" style="width: 300px; height: 200px;">

                                        </div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-md-6" style="font-size: 25px;">
                                                    Product :
                                                </div>
                                                <div class="col-md-6" style="font-size: 25px;">
                                                    <span>PMG</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6" style="font-size: 25px;">
                                                    Total Receipts :
                                                </div>
                                                <div class="col-md-6" style="font-size: 25px;">
                                                    <span>20000</span>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-3 card">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="pmg tank.PNG" alt="" style="width:400px;">

                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6" style="font-size: 25px;">
                                            Tank # :
                                        </div>
                                        <div class="col-md-6" style="font-size: 25px;">
                                            <span>PMG </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="font-size: 25px;">
                                            Product :
                                        </div>
                                        <div class="col-md-6" style="font-size: 25px;">
                                            <span>PMG</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="font-size: 25px;">
                                            Date :
                                        </div>
                                        <div class="col-md-6" style="font-size: 25px;">
                                            <span>2025-03-10 13:02:20</span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6" style="font-size: 25px;">
                                            Tank stock available:
                                        </div>
                                        <div class="col-md-6" style="font-size: 25px;">
                                            <span>5856</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-3 card">
                            <div class="row" >
                                <div class="col-md-4">
                                    <img src="hsd tank.PNG" alt="" style="width:320px;">

                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6" style="font-size: 25px;">
                                            Tank # :
                                        </div>
                                        <div class="col-md-6" style="font-size: 25px;">
                                            <span>HSD </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="font-size: 25px;">
                                            Product :
                                        </div>
                                        <div class="col-md-6" style="font-size: 25px;">
                                            <span>HSD</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="font-size: 25px;">
                                            Date :
                                        </div>
                                        <div class="col-md-6" style="font-size: 25px;">
                                            <span>2025-03-10 13:02:20</span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6" style="font-size: 25px;">
                                            Tank stock available:
                                        </div>
                                        <div class="col-md-6" style="font-size: 25px;">
                                            <span>5856</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                        <!-- <li class="nav-item">
                                            <a class="nav-link active test-dark" data-bs-toggle="tab" href="#overview"
                                                role="tab">
                                                <span>Facilities </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#products" role="tab">
                                                <span>Products</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tanks_panel" role="tab">
                                                <span>Tanks</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#dispenser_tab" role="tab">
                                                <span>Dispenser</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#nozel" role="tab">
                                                <span>Nozel</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#users_tab" role="tab">
                                                <span>Users</span>
                                            </a>
                                        </li> -->

                                        <!-- <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#nozel_tanks_panel"
                                                role="tab">
                                                <span>Nozel's Tanks</span>
                                            </a>
                                        </li> -->
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                                                <span>Reconcilation</span>
                                            </a>
                                        </li> -->
                                        <li class="nav-item ">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#post" role="tab">
                                                <span>Orders</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#complaint_tab" role="tab">
                                                <span>Complaint</span>
                                            </a>
                                        </li>


                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#lubes_order" role="tab">
                                                <span>Inspection</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#sale_performance"
                                                role="tab">
                                                <span>Sales Performance</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#rates"
                                                role="tab">
                                                <span>Rates</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <div class="tab-content">
                            <div class="tab-pane " id="overview" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <button id="add" class="btn btn-primary mb-3"> Add</button>
                                        <br>

                                        <table id="myTable2" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">S.No</th>
                                                    <th class="text-center">Facility</th>
                                                    <th class="text-center">Created At</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane " id="rates" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        

                                        <table id="ratestbl" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">S.No</th>
                                                    <th class="text-center">From</th>
                                                    <th class="text-center">To</th>
                                                    <th class="text-center">Price</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane " id="dispenser_tab" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">

                                        <button id="add_dispenser" class="btn btn-primary mb-3"> Add</button>
                                        <br>

                                        <table id="dispenser_table" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">S.No</th>
                                                    <th class="text-center">Despensor</th>
                                                    <th class="text-center">Description</th>
                                                    <th class="text-center">Created At</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>



                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane " id="nozel" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">

                                        <button id="addnozel" class="btn btn-primary mb-3"> Add</button>
                                        <br>

                                        <table id="myTable3" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">S.No</th>
                                                    <th class="text-center">Nozel</th>
                                                    <th class="text-center">Product</th>
                                                    <th class="text-center">Tank</th>
                                                    <th class="text-center">Dispenser</th>
                                                    <th class="text-center">Created At</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>



                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="nozel_tanks_panel" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">

                                        <button id="nozel_tanks_panel_add" class="btn btn-primary mb-3"> Add</button>
                                        <br>

                                        <table id="nozel_tanks_panel_table" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">S.No</th>
                                                    <th class="text-center">Nozel</th>
                                                    <th class="text-center">TanK</th>
                                                    <th class="text-center">Created At</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>



                                    </div>
                                </div>
                            </div>



                            <div class="tab-pane" id="messages" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="py-2">

                                            <div class="mx-n4 px-4" data-simplebar style="max-height: 360px;">

                                                <div class="row">
                                                    <div class="col-4">
                                                        <label for="">From Date</label>
                                                        <input type="date" class="form-control" name="" id="">
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="">To Date</label>
                                                        <input type="date" class="form-control" name="" id="">
                                                    </div>
                                                    <div class="col-4" style="display: flex;align-items: end;">
                                                        <input type="button" class="btn btn-primary " value="GET">
                                                    </div>
                                                </div>
                                                <div class="border-bottom py-3">
                                                    <div class="card-body">
                                                        <div id="chart" data-colors='["#1f58c7"]' class="apex-charts"
                                                            dir="ltr"></div>
                                                    </div>


                                                </div>

                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tanks_panel" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <button id="add_tanks" class="btn btn-primary mb-3"> Add</button>
                                        <br>

                                        <table id="tanks_table" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">S.No</th>
                                                    <th class="text-center">Tank #</th>
                                                    <th class="text-center">Product</th>
                                                    <th class="text-center">Min Limit</th>
                                                    <th class="text-center">Max Limit</th>
                                                    <th class="text-center">Current Dip</th>
                                                    <th class="text-center">Dip</th>
                                                    <th class="text-center">Dip Backlog</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>


                            </div>






                            <div class="tab-pane active" id="post" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mx-n3 px-3" data-simplebar style="max-height: 580px;">



                                            <div class="mt-4">
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-hover mb-1" id="myTable">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th class="text-center">S.No</th>
                                                                <th class="text-center">Date</th>
                                                                <th class="text-center">Site Name</th>
                                                                <th class="text-center">Mode</th>
                                                                <th class="text-center">Depot</th>
                                                                <th class="text-center">Total Amount</th>
                                                                <!-- <th class="text-center">Ledger Amount</th> -->
                                                                <th class="text-center">Sales Order</th>
                                                                <th class="text-center">Sap Status</th>
                                                                <th class="text-center">Execution Status</th>
                                                                <th class="text-center">View Orders</th>
                                                                <th class="text-center">Track</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                            </div>
                            <div class="tab-pane" id="complaint_tab" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mx-n3 px-3" data-simplebar style="max-height: 580px;">

                                            <button id="add_complaints" class="btn btn-primary mb-3"> Add</button>
                                            <br>

                                            <div class="mt-4">
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-hover mb-1"
                                                        id="complaint_table">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th class="text-center">Date</th>
                                                                <th class="text-center">Name</th>
                                                                <th class="text-center">Email</th>
                                                                <th class="text-center">Phone</th>
                                                                <th class="text-center">Priority</th>
                                                                <th class="text-center">Subject</th>
                                                                <th class="text-center">Message</th>
                                                                <th class="text-center">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                            </div>

                            <div class="tab-pane" id="users_tab" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mx-n3 px-3" data-simplebar style="max-height: 580px;">

                                            <button id="add_users" class="btn btn-primary mb-3"> Add</button>
                                            <br>

                                            <div class="mt-4">
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-hover mb-1" id="users_table">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th class="text-center">Date</th>
                                                                <th class="text-center">Name</th>
                                                                <th class="text-center">Email</th>
                                                                <th class="text-center">Password</th>
                                                                <th class="text-center">Phone</th>
                                                                <th class="text-center">Active/In-Active</th>
                                                                <th class="text-center">Edit</th>
                                                                <th class="text-center">Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                            </div>
                            <div class="tab-pane" id="products" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mx-n3 px-3" data-simplebar style="max-height: 580px;">

                                            <button id="add_products" class="btn btn-primary mb-3"> Add</button>
                                            <br>

                                            <div class="mt-4">
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-hover mb-1"
                                                        id="products_table">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th class="text-center">Date</th>
                                                                <th class="text-center">Name</th>
                                                                <th class="text-center">From</th>
                                                                <th class="text-center">To</th>
                                                                <th class="text-center">Indent Price</th>
                                                                <th class="text-center">Nozel Price</th>
                                                                <th class="text-center">Update Time</th>
                                                                <th class="text-center">Edit</th>
                                                                <th class="text-center">Log</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                            </div>
                            <div class="tab-pane" id="lubes_order" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mx-n3 px-3" data-simplebar style="max-height: 580px;">

                                            <div class="mt-4">
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-hover mb-1" id="lubes_table">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th class="text-center">S.No</th>
                                                                <th class="text-center">Date</th>
                                                                <th class="text-center">Complete Time</th>
                                                                <th class="text-center">Dealer Sign</th>
                                                                <th class="text-center">User</th>
                                                                <th class="text-center">Dealer</th>
                                                                <th class="text-center">Mode</th>
                                                                <th class="text-center">Status</th>
                                                                <th class="text-center">Inspection</th>
                                                                <th class="text-center">Sales Performance</th>
                                                                <th class="text-center">Measurement & Price</th>
                                                                <th class="text-center">Wet Stock Management</th>
                                                                <th class="text-center">Dispensing Unit Meter Reading
                                                                </th>
                                                                <th class="text-center">Stock Variaions</th>
                                                                <th class="text-center">Send Inspection Report on Email
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                            </div>

                            <div class="tab-pane" id="sale_performance" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mx-n3 px-3" data-simplebar style="max-height: 580px;">
                                            <button id="add_targets" class="btn btn-primary mb-3"> Add</button>
                                            <br>
                                            <div class="mt-4">
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-hover mb-1"
                                                        id="targeted_table">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th class="text-center">S.No</th>
                                                                <th class="text-center">Product Name</th>
                                                                <th class="text-center">Month</th>
                                                                <th class="text-center">Amount</th>
                                                                <th class="text-center">Descrition</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                            </div>

                        </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'footer.php'; ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->


    <!-- Right Sidebar -->

    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>


    <div id="price_changemodal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        data-bs-scroll="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="myModalLabel">Create Permit Type</h5> -->
                    <h5 class="modal-title" id="myModalLabel">
                        <h5 id="labelc">Change Price</h5>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="ins_orders_update" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> PMG Price</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">HSD Price</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div style="display: flex;align-items: center; justify-content: center;">
                                    <button class="btn btn-primary">SAVE</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- JAVASCRIPT -->

    <?php include 'script_tags.php'; ?>



</body>

<script>
    $(document).ready(() => {
        $('#price_changebtn').click(() => {
            $('#price_changemodal').modal('show');
        });
    });

    var nozzelsale,
        totalizer = 0;
    var json = [{
            nid: "1",
            did: "1",
            ltr: "1.2",
            status: "offline",
            product: "Pmg",
            rs: "300",
            price: "267",
            total_vol: "30000",
            nozzle: "2000"
        },
        {
            nid: "3",
            did: "3",
            ltr: "1.2",
            status: "ready",
            product: "Pmg",
            rs: "300",
            price: "267",
            total_vol: "30000",
            nozzle: "200"

        },
        {
            nid: "4",
            did: "4",
            ltr: "1.2",
            status: "ready",
            product: "Pmg",
            rs: "300",
            price: "267",
            total_vol: "30000",
            nozzle: "200"
        },
        {
            nid: "2",
            did: "2",
            ltr: "1.2",
            status: "ready",
            product: "Pmg",
            rs: "300",
            price: "267",
            total_vol: "30000",
            nozzle: "200"
        },
        {
            nid: "6",
            did: "6",
            ltr: "1.2",
            status: "ready",
            product: "Pmg",
            rs: "300",
            price: "267",
            total_vol: "30000",
            nozzle: "200"
        },
        {
            nid: "5",
            did: "5",
            ltr: "1.2",
            status: "offline",
            product: "Pmg",
            rs: "300",
            price: "267",
            total_vol: "30000",
            nozzle: "2000"
        },

        {
            nid: "8",
            did: "8",
            ltr: "1.2",
            status: "ready",
            product: "Pmg",
            rs: "300",
            price: "267",
            total_vol: "30000",
            nozzle: "200"
        }, {
            nid: "7",
            did: "7",
            ltr: "1.2",
            status: "ready",
            product: "Pmg",
            rs: "300",
            price: "267",
            total_vol: "30000",
            nozzle: "200"

        }
    ]
    table2 = $('#myTable2').DataTable({
    dom: 'Bfrtip',


    buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

});
table3 = $('#myTable3').DataTable({
    dom: 'Bfrtip',


    buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

});

table4 = $('#tanks_table').DataTable({
    dom: 'Bfrtip',


    buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

});

table = $('#myTable').DataTable({
    dom: 'Bfrtip',


    buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

});

nozel_tanks_table = $('#nozel_tanks_panel_table').DataTable({
    dom: 'Bfrtip',


    buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

});
complaint_table = $('#complaint_table').DataTable({
    dom: 'Bfrtip',


    buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

});

lubes_table = $('#lubes_table').DataTable({
    dom: 'Bfrtip',


    buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

});

users_table = $('#users_table').DataTable({
    dom: 'Bfrtip',


    buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

});
products_table = $('#products_table').DataTable({
    dom: 'Bfrtip',


    buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

});
targeted_table = $('#targeted_table').DataTable({
    dom: 'Bfrtip',


    buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

});
targeted_table = $('#ratestbl').DataTable({
    dom: 'Bfrtip',


    buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

});


    json.forEach(j => {
        $('#parentrow').append(`
        <div class="col-3" >
           
                
                    <div class="container" style="padding-top:20px;padding-bottom:20px;">
                        <div class="header" data-id="h${j.nid}_${j.did}">
                            <div data-id="t${j.nid}_${j.did}">OFFLINE</div>
                        </div>
                        <div class="fuel-dispenser" data-id="f${j.nid}_${j.did}">
                            <div class="screen">
                                <div>RS: <span>0.00</span></div>
                                <div>LTR: <span>0.00</span></div>
                                <div>PRICE: <span>0.00</span></div>
                                <div>NOZZLE: <span>0.00</span></div>
                                <div>TOTAL: <span>0.00</span></div>
                            </div>
                            <div class="pump-body" data-id="p${j.nid}_${j.did}" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <h5 style="color: white; font-size: 2em; margin-bottom: 10px;">PMG</h5>
                                <div>
                                    <img src="download.png"  alt="" style="height: 40px; width: 200px;">
                                </div>
                            </div>
                        </div>
                        <div class="bottom"></div>
                   
            </div>
        </div>
    `);
    });

    function checkdata() {
        json.forEach(j => {
            if (j.status == "ready") {
                let headerElement = $(`[data-id="h${j.nid}_${j.did}"]`);
                let fuelElement = $(`[data-id="f${j.nid}_${j.did}"]`);
                let pumpElement = $(`[data-id="p${j.nid}_${j.did}"]`);
                let screenElement = $(`[data-id="f${j.nid}_${j.did}"] .screen`);
                nozzelsale = parseInt(j.nozzle);
                totalizer = parseInt(j.total_vol);
                // Set initial READY state
                headerElement.attr("class", "ready").text("READY");
                setTimeout(() => {
                    // Set WORKING state
                    headerElement.attr("class", "header2").text("WORKING");
                    pumpElement.attr("class", "pump-body2");
                    fuelElement.attr("class", "fuel-dispenser2");
                    nozzelsale += parseFloat(j.rs)
                    totalizer += parseFloat(j.ltr)
                    // Animate RS and LTR values
                    animateCounter(screenElement.find("div:nth-child(1) span"), 0, parseFloat(j.rs), 1000); // RS Counter
                    animateCounter(screenElement.find("div:nth-child(2) span"), 0, parseFloat(j.ltr), 1000); // LTR
                    screenElement.find("div:nth-child(3) span").text(j.price); // PRICE
                    screenElement.find("div:nth-child(4) span").text(nozzelsale); // NOZZLE
                    screenElement.find("div:nth-child(5) span").text(totalizer); // TOTAL
                    // ✅ Reset after animation completes (after 2 seconds)
                    setTimeout(() => {
                        headerElement.attr("class", "header1").text("IDLE");
                        pumpElement.attr("class", "pump-body1");
                        fuelElement.attr("class", "fuel-dispenser1");
                        j.nozzle = nozzelsale;
                        j.total_vol = totalizer;
                        // Reset screen values
                        animateCounter(screenElement.find("div:nth-child(1) span"), parseFloat(j.rs), 0.00, 2000);
                        animateCounter(screenElement.find("div:nth-child(2) span"), parseFloat(j.ltr), 0.00, 2000);
                        // screenElement.find("div:nth-child(3) span").text(j.price);  // PRICE
                        // screenElement.find("div:nth-child(4) span").text(j.nozzle); // NOZZLE
                        // screenElement.find("div:nth-child(5) span").text(j.total_vol);  // TOTAL
                        nozzelsale = 0
                        totalizer = 0
                    }, 2000); // Reset after animation completes

                }, 1000); // WORKING state timeout
            }

        });
    }
    async function processJSON(json) {
        for (const j of json) {
            if (j.status === "ready") {
                let headerElement = $(`[data-id="h${j.nid}_${j.did}"]`);
                let fuelElement = $(`[data-id="f${j.nid}_${j.did}"]`);
                let pumpElement = $(`[data-id="p${j.nid}_${j.did}"]`);
                let screenElement = $(`[data-id="f${j.nid}_${j.did}"] .screen`);
                let nozzelsale = parseInt(j.nozzle);
                let totalizer = parseInt(j.total_vol);

                // Set initial READY state
                headerElement.attr("class", "ready").text("READY");

                await new Promise(resolve => setTimeout(resolve, 1000));

                // Set WORKING state
                headerElement.attr("class", "header2").text("WORKING");
                pumpElement.attr("class", "pump-body2");
                fuelElement.attr("class", "fuel-dispenser2");
                nozzelsale += parseFloat(j.rs);
                totalizer += parseFloat(j.ltr);

                // Animate RS and LTR values
                animateCounter(screenElement.find("div:nth-child(1) span"), 0, parseFloat(j.rs), 1000); // RS Counter
                animateCounter(screenElement.find("div:nth-child(2) span"), 0, parseFloat(j.ltr), 1000); // LTR
                screenElement.find("div:nth-child(3) span").text(j.price); // PRICE
                screenElement.find("div:nth-child(4) span").text(nozzelsale); // NOZZLE
                screenElement.find("div:nth-child(5) span").text(totalizer); // TOTAL

                // Wait for animation reset
                await new Promise(resolve => setTimeout(resolve, 2000));

                // Reset to IDLE state
                headerElement.attr("class", "header1").text("IDLE");
                pumpElement.attr("class", "pump-body1");
                fuelElement.attr("class", "fuel-dispenser1");
                j.nozzle = nozzelsale;
                j.total_vol = totalizer;

                // Reset screen values
                animateCounter(screenElement.find("div:nth-child(1) span"), parseFloat(j.rs), 0.00, 2000);
                animateCounter(screenElement.find("div:nth-child(2) span"), parseFloat(j.ltr), 0.00, 2000);

                await new Promise(resolve => setTimeout(resolve, 2000));

                nozzelsale = 0;
                totalizer = 0;
            }
        }
    }

    // Call the function with your JSON data
    processJSON(json);

    // Counter Animation Function
    function animateCounter(element, start, end, duration) {
        let range = end - start;
        let current = start;
        let increment = range / (duration / 50); // Updates every 50ms
        let interval = setInterval(() => {
            current += increment;
            element.text(current.toFixed(2)); // Show two decimal places
            if ((start < end && current >= end) || (start > end && current <= end)) {
                element.text(end.toFixed(2)); // Ensure final value is accurate
                clearInterval(interval);
            }
        }, 50);
    }


    // checkdata()
</script>
<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

</html>