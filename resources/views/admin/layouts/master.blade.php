<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!-- Meta, title, CSS, favicons, etc. -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="icon" href="/assets/images/favicon.ico" type="image/ico" />
      <title>@yield('title')</title>
      {{-- <script src=
      "https://code.jquery.com/jquery-3.3.1.min.js">
          </script>
          <script type="text/javascript">
              $(document).ready(function () {
                  $("button").click(function () {
                      location.reload(true);
                     //  alert('Reloading Page');
                  });
              });
          </script> --}}
      <!-- Bootstrap -->
      <link href="/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Font Awesome -->
      <link href="/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <!-- NProgress -->
      <link href="/assets/vendors/nprogress/nprogress.css" rel="stylesheet">
      <!-- iCheck -->
      <link href="/assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
      <!-- bootstrap-progressbar -->
      <link href="/assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
      <!-- JQVMap -->
      <link href="/assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
      <!-- bootstrap-daterangepicker -->
      <link href="/assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
      <!-- Custom Theme Style -->
      <link href="/assets/build/css/custom.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.x.x/dist/alpine.js" defer></script>
      <style>
          #imageContainer {
        display: flex;
        flex-wrap: wrap;
    }

    .selected-image {
        max-width: 200px;
        max-height: 100px;
        margin: 5px;
        position: relative;
    }

    .remove-image {
        position: absolute;
        top: 5px;
        right: 5px;
        cursor: pointer;
        background-color: red;
        color: white; /* Add text color to the button */
        z-index: 1;
        padding: 5px;
        border-radius: 50%; /* Makes it circular */
    }

     </style>
   </head>
   <body class="nav-md">
      <div class="container body">
         <div class="main_container">
            <div class="col-md-3 left_col">
               <div class="left_col scroll-view">
                  <div class="navbar nav_title" style="border: 0;">
                     <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Jalal Store!</span></a>
                  </div>
                  <div class="clearfix"></div>
                  <!-- menu profile quick info -->
                  <div class="profile clearfix">
                     <div class="profile_pic">
                        <img src="/assets/images/user.png" alt="..." class="img-circle profile_img">
                     </div>
                     <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{Auth::user()->name}}</h2>
                     </div>
                  </div>
                  <!-- /menu profile quick info -->
                  <br />
                  <!-- sidebar menu -->
                  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                     <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                           <li>
                              <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a href="{{route('adminDashboard')}}">Dashboard</a></li>
                              </ul>
                           </li>
                           <li>
                              <a><i class="fa fa-certificate"></i> Category <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a href="{{route('adminCategory')}}">Add  Category</a></li>
                                 <li><a href="{{route('adminCategory.all')}}">All Categories</a></li>
                                 {{-- <li><a href="{{route('adminCategory.edit')}}">Edit Categories</a></li> --}}
                              </ul>
                           </li>
                           <li>
                              <a><i class="fa fa-product-hunt"></i> Product <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a href="{{route('adminProduct.add')}}">Add Product</a></li>
                                 <li><a href="{{route('adminProduct.all')}}">All Products</a></li>
                                 
                              </ul>
                           </li>
                           <li>
                              <a><i class="fa fa-product-hunt"></i> Banner Images <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a href="{{route('adminBanner.add')}}">Add Images</a></li>
                                 <li><a href="">Banner</a></li>
                                 
                              </ul>
                           </li>
                           <li>
                              <a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a href="tables.html">Tables</a></li>
                                 <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                              </ul>
                           </li>
                           <li>
                              <a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a href="chartjs.html">Chart JS</a></li>
                                 <li><a href="chartjs2.html">Chart JS2</a></li>
                                 <li><a href="morisjs.html">Moris JS</a></li>
                                 <li><a href="echarts.html">ECharts</a></li>
                                 <li><a href="other_charts.html">Other Charts</a></li>
                              </ul>
                           </li>
                           <li>
                              <a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                                 <li><a href="fixed_footer.html">Fixed Footer</a></li>
                              </ul>
                           </li>
                        </ul>
                     </div>
                     <div class="menu_section">
                        <h3>Live On</h3>
                        <ul class="nav side-menu">
                           <li>
                              <a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a href="e_commerce.html">E-commerce</a></li>
                                 <li><a href="projects.html">Projects</a></li>
                                 <li><a href="project_detail.html">Project Detail</a></li>
                                 <li><a href="contacts.html">Contacts</a></li>
                                 <li><a href="profile.html">Profile</a></li>
                              </ul>
                           </li>
                           <li>
                              <a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a href="page_403.html">403 Error</a></li>
                                 <li><a href="page_404.html">404 Error</a></li>
                                 <li><a href="page_500.html">500 Error</a></li>
                                 <li><a href="plain_page.html">Plain Page</a></li>
                                 <li><a href="login.html">Login Page</a></li>
                                 <li><a href="pricing_tables.html">Pricing Tables</a></li>
                              </ul>
                           </li>
                           <li>
                              <a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a href="#level1_1">Level One</a>
                                 <li>
                                    <a>Level One<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                       <li class="sub_menu"><a href="level2.html">Level Two</a>
                                       </li>
                                       <li><a href="#level2_1">Level Two</a>
                                       </li>
                                       <li><a href="#level2_2">Level Two</a></li>
                                    </ul>
                                 </li>
                                 <li><a href="#level1_2">Level One</a></li>
                              </ul>
                           </li>
                           <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                        </ul>
                     </div>
                  </div>
                  <!-- /sidebar menu -->
                  <!-- /menu footer buttons -->
                  <div class="sidebar-footer hidden-small">
                     {{-- <a data-toggle="tooltip" data-placement="top" title="Settings">
                     <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                     </a>
                     <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                     <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                     </a>
                     <a data-toggle="tooltip" data-placement="top" title="Lock">
                     <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                     </a> --}}
                     <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{route('logout')}}">
                     <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                     </a>
                  </div>
                  <!-- /menu footer buttons -->
               </div>
            </div>
            <!-- top navigation -->
            <div class="top_nav">
               <div class="nav_menu">
                  <div class="nav toggle">
                     <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                  </div>
                  <nav class="nav navbar-nav">
                     <ul class=" navbar-right">
                        <li class="nav-item dropdown open" style="padding-left: 15px;">
                           <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                           <img src="/assets/images/user.png" alt="">{{Auth::user()->name}}
                           </a>
                           <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item"  href="{{route('profile.edit')}}"> Profile</a>
                              {{-- //this logout we use from AuthenticateSessionController  --}}
                              <form method="POST" action="{{ route('logout') }}">
                                @csrf
            
                                    <a class="dropdown-item"  href="{{route('logout')}}"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
            
                            </form>
                           </div>
                        </li>
                        {{-- <li role="presentation" class="nav-item dropdown open">
                           <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                           <i class="fa fa-envelope-o"></i>
                           <span class="badge bg-green">6</span>
                           </a>
                           <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                              <li class="nav-item">
                                 <a class="dropdown-item">
                                 <span class="image"><img src="/assets/images/img.jpg" alt="Profile Image" /></span>
                                 <span>
                                 <span>John Smith</span>
                                 <span class="time">3 mins ago</span>
                                 </span>
                                 <span class="message">
                                 Film festivals used to be do-or-die moments for movie makers. They were where...
                                 </span>
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a class="dropdown-item">
                                 <span class="image"><img src="/assets/images/img.jpg" alt="Profile Image" /></span>
                                 <span>
                                 <span>John Smith</span>
                                 <span class="time">3 mins ago</span>
                                 </span>
                                 <span class="message">
                                 Film festivals used to be do-or-die moments for movie makers. They were where...
                                 </span>
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a class="dropdown-item">
                                 <span class="image"><img src="/assets/images/img.jpg" alt="Profile Image" /></span>
                                 <span>
                                 <span>John Smith</span>
                                 <span class="time">3 mins ago</span>
                                 </span>
                                 <span class="message">
                                 Film festivals used to be do-or-die moments for movie makers. They were where...
                                 </span>
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a class="dropdown-item">
                                 <span class="image"><img src="/assets/images/img.jpg" alt="Profile Image" /></span>
                                 <span>
                                 <span>John Smith</span>
                                 <span class="time">3 mins ago</span>
                                 </span>
                                 <span class="message">
                                 Film festivals used to be do-or-die moments for movie makers. They were where...
                                 </span>
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <div class="text-center">
                                    <a class="dropdown-item">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                    </a>
                                 </div>
                              </li>
                           </ul>
                        </li> --}}
                     </ul>
                  </nav>
               </div>
            </div>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
               <!-- top tiles -->
               @yield('main-content')
            </div>
            <!-- /page content -->
            <!-- footer content -->
            <footer>
               <div class="pull-right">
                  © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
               </div>
               <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
         </div>
      </div>
      
      <!-- jQuery -->
      <script src="/assets/vendors/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="/assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <!-- FastClick -->
      <script src="/assets/vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="/assets/vendors/nprogress/nprogress.js"></script>
      <!-- Chart.js -->
      <script src="/assets/vendors/Chart.js/dist/Chart.min.js"></script>
      <!-- gauge.js -->
      <script src="/assets/vendors/gauge.js/dist/gauge.min.js"></script>
      <!-- bootstrap-progressbar -->
      <script src="/assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
      <!-- iCheck -->
      <script src="/assets/vendors/iCheck/icheck.min.js"></script>
      <!-- Skycons -->
      <script src="/assets/vendors/skycons/skycons.js"></script>
      <!-- Flot -->
      <script src="/assets/vendors/Flot/jquery.flot.js"></script>
      <script src="/assets/vendors/Flot/jquery.flot.pie.js"></script>
      <script src="/assets/vendors/Flot/jquery.flot.time.js"></script>
      <script src="/assets/vendors/Flot/jquery.flot.stack.js"></script>
      <script src="/assets/vendors/Flot/jquery.flot.resize.js"></script>
      <!-- Flot plugins -->
      <script src="/assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
      <script src="/assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
      <script src="/assets/vendors/flot.curvedlines/curvedLines.js"></script>
      <!-- DateJS -->
      <script src="/assets/vendors/DateJS/build/date.js"></script>
      <!-- JQVMap -->
      <script src="/assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
      <script src="/assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
      <script src="/assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
      <!-- bootstrap-daterangepicker -->
      <script src="/assets/vendors/moment/min/moment.min.js"></script>
      <script src="/assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
      <!-- Custom Theme Scripts -->
      <script src="/assets/build/js/custom.min.js"></script>
      
   </body>
</html>