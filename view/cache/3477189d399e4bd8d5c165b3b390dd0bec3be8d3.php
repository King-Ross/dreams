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
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <div class="h4 card-title">All Participants</div>
            <hr>
            <h1><?php echo e($partcipantsCount); ?></h1>
            <a href="/<?php echo e($appName); ?>/dashboard/participant/register/">View Participants</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <div class="h4 card-title">All Lessons</div>
            <hr>
            <h1><?php echo e($lessonsCount); ?></h1>
            <a href="/<?php echo e($appName); ?>/dashboard/lessons/">View Lessons</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <div class="h4 card-title">All Events</div>
            <hr>
            <h1><?php echo e($eventsCount); ?></h1>
            <a href="/<?php echo e($appName); ?>/dashboard/events/">View Events</a>
          </div>
        </div>
      </div>
      
      
    </div>
  </section>

</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>