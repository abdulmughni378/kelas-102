<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=Yii::getAlias('@web')?>/admin_lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->username?></p>
                
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
       <!--  <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <!-- <li> -->
            <li>
                <a href="/"> <!-- <i class="fa fa-home"></i> --> <span>Dashboard</span> </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <!-- <i class="fa fa-dashboard"></i> --> <span>Guide</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Add New Guide</a></li> -->
                    <li><a href="/guide"><i class="fa fa-circle-o"></i> Manage Guide</a></li>
                    <li><a href="/category"><i class="fa fa-circle-o"></i> Manage Category Guide</a></li>
                </ul>
            </li>
           <!--  <li class="treeview">
                <a href="#">
                    <span>Catalog</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Add New Catalog</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Manage Catalog</a></li>
                </ul>
            </li> -->
           <!--  <li class="treeview">
                <a href="/">
                    <span>Invoice</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> New Invoice</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Manage Invoice</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> POS Invoice</a></li>
                </ul>
            </li> -->
            <li class="treeview">
                <a href="/">
                    <span>Product</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Add Product</a></li> -->
                    <li><a href="/product"><i class="fa fa-circle-o"></i> Manage Product</a></li>
                    <li><a href="/product-category"><i class="fa fa-circle-o"></i> Manage Product Category</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Import to Document</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="/">
                    <span>Brand</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Add Product</a></li> -->
                    <li><a href="/brand"><i class="fa fa-circle-o"></i> Manage Brand</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="/">
                    <span>Variant</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Add Product</a></li> -->
                    <li><a href="/variant"><i class="fa fa-circle-o"></i> Manage Variant</a></li>
                </ul>
            </li>
            <!-- <li class="treeview">
                <a href="/">
                    <span>Customer</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Add Customer</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Manage Customer</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Credit Customer</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Paid Customer</a></li>
                </ul>
            </li> -->
            <!-- <li class="treeview">
                <a href="/">
                    <span>Agent</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Add Agent</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Manage Agent</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Leads</a></li>
                </ul>
            </li> -->
            <!-- <li class="treeview">
                <a href="/">
                    <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/category"><i class="fa fa-circle-o"></i> Manage Category</a></li>
                </ul>
            </li> -->
            <!-- <li class="treeview">
                <a href="/">
                    <span>Supplier</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Add Supplier</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Manage Supplier</a></li>
                </ul>
            </li> -->
            <!-- <li class="treeview">
                <a href="/">
                    <span>Purchase</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Add Purchase</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Manage Purchase</a></li>
                </ul>
            </li> -->
            <!-- <li class="treeview">
                <a href="/">
                    <span>Stock</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Stock Report</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Stock Report - Supplier</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Stock Report - Product</a></li>
                </ul>
            </li> -->
            <!-- <li class="treeview">
                <a href="/">
                    <span>Seacrh</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Product</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Customer</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Purchase</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Banner</a></li>
                </ul>
            </li> -->
            <!-- <li class="treeview">
                <a href="/">
                    <span>Accounts</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Create Account</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Manage Account</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Income</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Expense</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Add Tax</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Manage Tax</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Account Summary</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Cheque Manager</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Closing</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Closing Report</a></li>
                </ul>
            </li> -->
           <!--  <li class="treeview">
                <a href="/">
                    <span>Bank</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Add Bank</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Manage Bank</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="/">
                    <span>Report</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Today Report</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Sales Report</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Purchase Report</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Sales Report - Product</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Profit Report - Invoice</a></li>
                </ul>
            </li> -->
            <li class="treeview">
                <a href="/">
                    <span>Website Setting</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Manage Company</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Add User</a></li>
                    <li><a href="/manage-user"><i class="fa fa-circle-o"></i> Manage Users</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Settings</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="/">
                    <span>Subscriber</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/subscriber/list"><i class="fa fa-circle-o"></i> Manage Subscriber</a></li>
                    <li class="active"><a href="/subscriber/setting"><i class="fa fa-circle-o"></i> Settings</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="/">
                    <span>System Log</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/system/log/login"><i class="fa fa-circle-o"></i> Login Log</a></li>
                </ul>
            </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>