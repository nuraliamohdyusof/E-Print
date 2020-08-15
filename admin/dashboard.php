<?php
//This is my Final Year Project (E-Print System in UNIMAS)
//Made by Nur Alia Binti Mohd Yusof (57131)

//Initialize the session
session_start();

// Setup connection
require_once "data.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>E-Print System - Admin</title>

        <!-- CSS -->
        <link href="dist/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        
        <!-- Image -->
        <link rel="icon" type="image/png" href="../login/images/printer.png"/>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="dashboard.php"><img src="../login/images/print(1).png" style="margin-right:10px">
            E-Print System</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form> -->
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-50">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt" style="margin-right:5px;"></i> Log out </a>
                </li>
            </ul>
        </nav>
        <!-- Sidebar -->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard</a>
                            
                            <div class="sb-sidenav-menu-heading">Extra</div>
                            <a class="nav-link" href="ListUser.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                            List of Customer</a>
                            <a class="nav-link" href="UserOrder.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Customer Order</a>
                            <a class="nav-link" href="ListVendor.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-cog"></i></div>
                            List of Vendor</a>
                            <a class="nav-link" href="VendorInfo.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Vendor Info</a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        System Administrator
                    </div>
                </nav>
            </div>
            <!-- Content Row -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-4">Dashboard</h2>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <!-- Content Total -->
                        <div class="row">
                            <div class="col-xl-4 col-md-4">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Total of Printing Order</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a><?php echo $total_order;?></a>
                                        <div class="small text-white">
                                        <i class="fas fa-file-upload fa-2x"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Total Number of Customer</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a><?php echo $total_customer;?></a>
                                        <div class="small text-white">
                                        <i class="fas fa-users fa-2x"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">Total Number of Printing Vendor</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a><?php echo $total_vendor;?></a>
                                        <div class="small text-white">
                                        <i class="fas fa-users-cog fa-2x"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Content Charts -->  
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-chart-area mr-1"></i> Monthly Printing Order</div>
                            <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                            <div class="card-footer small text-muted"><?php echo "Updated on ". date('l d-m-Y H:i:s'); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i> Weekly Printing Order</div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="220"></canvas></div>
                                    <div class="card-footer small text-muted"><?php echo "Updated on ". date('l d-m-Y H:i:s'); ?></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-pie mr-1"></i> Total No. of Customer & Vendor</div>
                                    <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                                    <div class="card-footer small text-muted"><?php echo "Updated on ". date('l d-m-Y H:i:s'); ?></div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Alia Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="dist/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="dist/assets/demo/chart-bar-demo.js"></script>
        <script src="dist/assets/demo/chart-pie-demo.js"></script>
        <script src="dist/assets/demo/chart-area-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    </body>
</html>
