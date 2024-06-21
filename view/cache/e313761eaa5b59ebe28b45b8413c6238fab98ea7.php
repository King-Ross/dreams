<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  
  <?php if($role == 'Administrator'): ?>
  
  <li class="nav-item">
    <a class="nav-link " href="/<?php echo e($appName); ?>/dashboard/">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <li class="nav-heading mb-3">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/orders/">
      <i class="bi bi-card-list"></i>
      <span>All Orders</span>
    </a>
  </li>

 
  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/orders/bills/">
      <i class="bi bi-people"></i>
      <span>Pending Invoices</span>
    </a>
  </li>
 
  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/orders/bills/paid/">
      <i class="bi bi-people"></i>
      <span>Payed Invoices</span>
    </a>
  </li>

  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/schedules/">
      <i class="bi bi-card-list"></i>
      <span>Schedules</span>
    </a>
  </li>

  

  <li class="nav-item">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/customers/">
      <i class="bi bi-card-list"></i>
      <span>Customers</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/employees/">
      <i class="bi bi-card-list"></i>
      <span>Employees</span>
    </a>
  </li>
  
  <li class="nav-heading mb-3">Reports</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/reports/orders/complete/">
      <i class="bi bi-card-list"></i>
      <span>Complete Orders Today</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/reports/orders/in-process/">
      <i class="bi bi-card-list"></i>
      <span>In Process Orders Today</span>
    </a>
  </li>
  
  
  
  
  <?php endif; ?>

  <?php if($role == 'Customer'): ?>

  <li class="nav-item">
    <a class="nav-link " href="/<?php echo e($appName); ?>/dashboard/">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <li class="nav-heading mb-3">Pages</li>

  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/orders/add/">
      <i class="bi bi-shop-window"></i>
      <span>Create Orders</span>
    </a>
  </li>

  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/u/orders/">
      <i class="bi bi-shop-window"></i>
      <span>My Orders</span>
    </a>
  </li>

  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/orders/u/bills/">
      <i class="bi bi-people"></i>
      <span>My Invoices</span>
    </a>
  </li>

  <?php endif; ?>

</ul>

</aside><!-- End Sidebar-->