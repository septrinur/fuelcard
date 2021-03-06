<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>assets/images/favicon.ico">
    <title>FuelCardQR</title>
    <!-- Custom CSS -->
    <link href="<?=base_url();?>assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?=base_url();?>dist/css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="<?=base_url();?>product">
                        <!-- Logo text -->
                        <span class="logo-text">
                            <b>FuelCard QR 
                                <?php 
                                switch ($this->session->userdata('level')) {
                                    case '1':
                                        echo "Super Admin";
                                        break;
                                    case '2':
                                        echo "Admin QR";
                                        break;
                                    case '3':
                                        echo "Maker QR";
                                        break;
                                    case '4':
                                        echo "Admin Aplikasi";
                                        break;
                                    
                                    default:
                                        echo "";
                                        break;
                                }
                                 ?>
                            </b>
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                                <i class="sl-icon-menu font-20"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link" href="<?=base_url();?>admin/index"><i class="icon-Car-Wheel"></i><span class="hide-menu">Dashboard </span></a>
                        <?php if ($this->session->userdata('level') == '1') {  //Super Admin?>
                            </li><li class="sidebar-item"> <a class="sidebar-link" href="<?=base_url();?>user/index"><i class="icon-User"></i><span class="hide-menu">User</span></a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('level') == '3') {  //maker QR?>
                            </li><li class="sidebar-item"> <a class="sidebar-link" href="<?=base_url();?>admin/data"><i class="fas fa-qrcode"></i><span class="hide-menu">Data QR </span></a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('level') == '2') {  //signer QR?>
                            </li><li class="sidebar-item"> <a class="sidebar-link" href="<?=base_url();?>admin/approve_list"><i class="fas fa-qrcode"></i><span class="hide-menu">Approval Data QR </span></a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('level') == '4') {  //admin app?>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-User"></i><span class="hide-menu">User Aplikasi</span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="<?=base_url();?>user/aplikasi" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> List User Aplikasi </span></a></li>
                                    <li class="sidebar-item"><a href="<?=base_url();?>admin/spbu" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> List SPBU</span></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li class="sidebar-item"> <a class="sidebar-link" href="<?=base_url();?>user/logout"><i class="fas fa-sign-out-alt"></i><span class="hide-menu">Logout </span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <?php echo $main_content; ?>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                   All Rights Reserved 2020</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?=base_url();?>assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?=base_url();?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?=base_url();?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="<?=base_url();?>dist/js/app.min.js"></script>
    <!-- Theme settings -->
    <script src="<?=base_url();?>dist/js/app.init.horizontal-fullwidth.js"></script>
    <script src="<?=base_url();?>dist/js/app-style-switcher.horizontal.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?=base_url();?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?=base_url();?>assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?=base_url();?>dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?=base_url();?>dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?=base_url();?>dist/js/custom.min.js"></script>

    <script src="<?=base_url();?>assets/libs/jquery.repeater/jquery.repeater.min.js"></script>
    <script src="<?=base_url();?>assets/extra-libs/jquery.repeater/repeater-init.js"></script>
    <script src="<?=base_url();?>assets/extra-libs/jquery.repeater/dff.js"></script>
    <script src="<?=base_url();?>assets/libs/ckeditor/ckeditor.js"></script>
    <script src="<?=base_url();?>assets/libs/ckeditor/samples/js/sample.js"></script>
    <script src="<?=base_url();?>assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/libs/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="<?=base_url();?>dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script>
        //default
        initSample();

        //inline editor
        // We need to turn off the automatic editor creation first.
        CKEDITOR.disableAutoInline = true;

        CKEDITOR.inline('editor2', {
            extraPlugins: 'sourcedialog',
            removePlugins: 'sourcearea'
        });

        var editor1 = CKEDITOR.replace('editor1', {
            extraAllowedContent: 'div',
            height: 460
        });
        editor1.on('instanceReady', function () {
            // Output self-closing tags the HTML4 way, like <br>.
            this.dataProcessor.writer.selfClosingEnd = '>';

            // Use line breaks for block elements, tables, and lists.
            var dtd = CKEDITOR.dtd;
            for (var e in CKEDITOR.tools.extend({}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent)) {
                this.dataProcessor.writer.setRules(e, {
                    indent: true,
                    breakBeforeOpen: true,
                    breakAfterOpen: true,
                    breakBeforeClose: true,
                    breakAfterClose: true
                });
            }
            // Start in source mode.
            this.setMode('source');
        });
    </script>
    <script data-sample="1">
        CKEDITOR.replace('testedit', {
            height: 150
        });
    </script>
    <script data-sample="2">
        CKEDITOR.replace('testedit1', {
            height: 400
        });
    </script>
    <script data-sample="3">
        CKEDITOR.replace('testedit2', {
            height: 400
        });
    </script>
    <script data-sample="4">
        CKEDITOR.replace('tool-location', {
            toolbarLocation: 'bottom',
            // Remove some plugins that would conflict with the bottom
            // toolbar position.
            removePlugins: 'elementspath,resize'
        });
    </script>
    <script src="../../assets/libs/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script>

    //==================================================//
    //                 postfix Touchspin                //
    //==================================================//
    $("input[id='demo3']").TouchSpin({
        min: 0,
        max: 100,
        step: 1,
        decimals: 0,
        boostat: 5,
        maxboostedstep: 10,
        postfix: '%'
    });
    </script>

    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>
</body>

</html>