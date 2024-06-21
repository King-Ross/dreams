<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <div class="col-sm-7">
        <div class="alert alert-light">
          <h2 class="fw-bold">Blue Spring Dry cleaners and Laundry Services </h2>
          <span class="text-success"><?php echo e($appName); ?></span>
          <hr>
          <h5>Welcome back, <?php echo e($username); ?></h5>
        </div>
        <?php if($role == 'Administrator'): ?>
        <div class="row">


          <div class="col-sm-4">
            <div class="card p-2">
              <div class="card-title">All Customers</div>
              <div class="card-body">
                <h3><?php echo e($customersCount); ?></h3>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="card p-2">
              <div class="card-title">All Employees</div>
              <div class="card-body">
                <h3><?php echo e($employeesCount); ?></h3>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="card p-2">
              <div class="card-title">All Pending Orders</div>
              <div class="card-body">
                <h3><?php echo e($pendingOrdersCount); ?></h3>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="card p-2">
              <div class="card-title">All Orders In Process</div>
              <div class="card-body">
                <h3><?php echo e($inProcessOrdersCount); ?></h3>
              </div>
            </div>
          </div>


          <div class="col-sm-4">
            <div class="card p-2">
              <div class="card-title">All Complete Orders</div>
              <div class="card-body">
                <h3><?php echo e($completeOrdersCount); ?></h3>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="card p-2">
              <div class="card-title">Un Paid Bills</div>
              <div class="card-body">
                <h3><?php echo e($unPaidCount); ?></h3>
              </div>
            </div>
          </div>


        </div>
        <?php endif; ?>
      </div>
      <div class="col-sm-5"></div>

    </div>
  </section>

</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>