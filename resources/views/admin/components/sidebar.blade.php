<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon">
            <img class="img-profile rounded-circle" src="{{ asset('assets/img/logo.png') }}" width="50px">
            {{-- <img class="img-profile rounded-circle" src="/assets/img/logo.png" width="50px"> --}}
            {{-- <img class="img-profile rounded-circle" src="{{ asset('/storage/images/products/Jeyym Santos_sandals.png') }}" width="50px"> --}}


        </div>
        <div class="sidebar-brand-text mx-3">Mine Ditse</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manage
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa-solid fa-truck-field"></i>
            <span>Suppliers</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Suppliers</h6>
                <a class="collapse-item" href="/admin/suppliers">View Suppliers</a>
                <a class="collapse-item" href="/admin/suppliers/add">Add Supplier</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Categories Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
            aria-expanded="true" aria-controls="collapseFive">
            <i class="fa-solid fa-fw fa-book-open-reader"></i>
            <span>Categories</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="collapseFive" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Categories</h6>
                <a class="collapse-item" href="/admin/category">View Categories</a>
                <a class="collapse-item" href="/admin/category/add">Add Category</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Bales Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fa-fw fa-solid fa-box"></i>
            <span>Bales</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="collapseThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Bales</h6>
                <a class="collapse-item" href="/admin/bales">View Bales</a>
                <a class="collapse-item" href="/admin/bales/add">Add Bale</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Products Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
            aria-expanded="true" aria-controls="collapseFour">
            <i class="fa-fw fa-solid fa-shirt"></i>
            <span>Products</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="collapseFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Products</h6>
                <a class="collapse-item" href="/admin/products">View Products</a>
                <a class="collapse-item" href="/admin/products/add">Add Product</a>
            </div>
        </div>
    </li>

    
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        ORDERS
    </div>

    <!-- Nav Item - Orders Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
            aria-expanded="true" aria-controls="collapseSix">
            <i class="fa-fw fa-solid fa-list"></i>
            <span>Invoices</span>
        </a>
        <div id="collapseSix" class="collapse" aria-labelledby="collapseSix" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Invoices</h6>
                <a class="collapse-item" href="/admin/orders">View Invoices</a>
                <a class="collapse-item" href="/admin/orders/add">Add Invoice</a>
                <a class="collapse-item" href="/admin/orders/cancelled">Cancelled Invoices</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Orders Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven"
            aria-expanded="true" aria-controls="collapseSeven">
            <i class="fa-fw fa-solid fa-money-bill"></i>
            <span>Receipts</span>
        </a>
        <div id="collapseSeven" class="collapse" aria-labelledby="collapseSeven" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Receipts</h6>
                <a class="collapse-item" href="/admin/orders/receipts">View Receipts</a>
            </div>
        </div>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Others
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fa-fw fa-solid fa-info"></i>
            <span>About</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
