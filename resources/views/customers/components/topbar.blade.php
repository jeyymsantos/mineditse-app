 <!-- Content Wrapper -->
 <div id="content-wrapper" class="d-flex flex-column">

     <!-- Main Content -->
     <div id="content">

         <!-- Topbar -->
         <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

             <!-- Sidebar Toggle (Topbar) -->
             <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                 <i class="fa fa-bars"></i>
             </button>

             <!-- Topbar Navbar -->
             <ul class="navbar-nav ml-auto">
                 <!-- Nav Item - Messages -->
                 <li class="nav-item dropdown no-arrow mx-1">
                     <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="bi bi-cart"></i>
                         <!-- Counter - Messages -->
                         <span class="badge badge-danger badge-counter">{{ $carts->count() }}</span>
                     </a>
                     <!-- Dropdown - Messages -->
                     <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="messagesDropdown">
                         <h6 class="dropdown-header">
                             Cart
                         </h6>

                         @php
                             $total = 0;
                         @endphp
                         @foreach ($carts as $cart)
                             <a class="dropdown-item d-flex align-items-center" href="#">
                                 <div class="dropdown-list-image mr-3">
                                     <img class="rounded-circle" src="{{ asset($cart->prod_img_path) }}" alt="...">
                                     <div class="status-indicator bg-success"></div>
                                 </div>
                                 <div class="font-weight-bold">
                                     <div class="text-truncate">{{ $cart->prod_name }}</div>
                                     <div class="small text-dark">₱{{ number_format($cart->prod_price, 2)}}</div>
                                 </div>
                             </a>

                             @php
                                 $total += $cart->prod_price;
                             @endphp
                         @endforeach
                         <a class="dropdown-item text-center" href="/customer/orders/checkout">Checkout</a>
                     </div>
                 </li>

                 <div class="topbar-divider d-none d-sm-block"></div>

                 <li class="nav-item"></li>
                 @guest
                     @if (Route::has('login'))
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                         </li>
                     @endif

                     @if (Route::has('register'))
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                         </li>
                     @endif
                 @else
                     <!-- Nav Item - User Information -->
                     <li class="nav-item dropdown no-arrow">
                         <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                 {{ Auth::user()->name }}
                             </span>
                             <img class="img-profile rounded-circle" src="{{ asset('backend/img/undraw_profile.svg') }}">
                         </a>
                         <!-- Dropdown - User Information -->
                         <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                             <a class="dropdown-item" href="#">
                                 <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                 Profile
                             </a>
                             <a class="dropdown-item" href="#">
                                 <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                 Settings
                             </a>
                             <div class="dropdown-divider"></div>
                             <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                 <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                 Logout
                             </a>
                         </div>
                     </li>
                 @endguest
             </ul>

         </nav>
         <!-- End of Topbar -->

         <!-- Begin Page Content -->
         <div class="container-fluid">

             <div class="column">
                 @yield('heading')
                 @yield('content')
             </div>

         </div>
         <!-- /.container-fluid -->

     </div>
     <!-- End of Main Content -->

     <!-- Footer -->
     <footer class="sticky-footer bg-white">
         <div class="container my-auto">
             <div class="copyright text-center my-auto">
                 <span>Copyright &copy; Mine Ditse 2023</span>
             </div>
         </div>
     </footer>
     <!-- End of Footer -->

 </div>
 <!-- End of Content Wrapper -->

 <!-- End of Page Wrapper -->

 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
     <i class="fas fa-angle-up"></i>
 </a>

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                 <a class="btn btn-primary" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>{{ __('Logout') }}
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
             </div>
         </div>
     </div>
 </div>

 </div>

 