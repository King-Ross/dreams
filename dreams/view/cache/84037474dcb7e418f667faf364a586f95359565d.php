<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Create Employee Schedule From Bill.</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
        <li class="breadcrumb-item active">Create Schedule</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row g-2 p-2">
        <div class="col-sm-4">
            <div class="card px-2">
                <div class="card-title">Order Items</div>
                <div class="card-body">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="alert alert-light p-2">
                    <p><?php echo e($item['quantity']); ?>  <?php echo e($item['item_description']); ?></p>
                    <p>Notes: <?php echo e($item['notes']); ?></p>
                 </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
                </div>
            </div>

        </div>
        <div class="col-sm-4">
            <div class="card px-2">
                <div class="card-title">Order Details</div>
                <div class="card-body">
                    <h5>Order Creation Date</h5>
                    <p><?php echo e($orderDetails['order_date']); ?></p><br>
    
                    <h5>Order Items Pickup Date</h5>
                    <p><?php echo e($orderDetails['pickup_date']); ?></p><br>
                    
                    <h5>Expected Delivery Date To Customer</h5>
                    <p><?php echo e($orderDetails['delivery_date']); ?></p><br>
                    
    
                </div>
            </div>

        </div>

        <div class="col-sm-4">
          <div class="card px-2">
            <div class="card-title">Create Work Schedule</div>
            <div class="card-body">
              <div class="alert alert-info">This is the time an employee is expected to work on the order items.</div>
              <form action="" novalidate class="needs-validation" id="create-schedule-form">
                <div class="form-group">
                  <label for="">Employee</label>
                  <input type="hidden" name="order-id" value="<?php echo e($orderDetails['id']); ?>">
                  <select name="employee-id" id="" class="form-control" required>
                    <option>Select Employee</option>
                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($employee['user_id']); ?>"><?php echo e($employee['name']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <div class="invalid-feedback">This value is required</div>
                </div>
                <div class="form-group">
                  <label for="">Start Time</label>
                  <input class="form-control" type="time" name="start-time" required>
                  <div class="invalid-feedback">This value is required</div>
                </div>
                <div class="form-group">
                  <label for="">End Time</label>
                  <input class="form-control" type="time" name="end-time" required>
                  <div class="invalid-feedback">This value is required</div>
                </div>

                <div class="text-start mt-3">
                  <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </section>

</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
  $(document).ready(function(){
    $('#create-schedule-form').submit(function(e) {
            e.preventDefault();

            if (this.checkValidity() === true) {

                let formData = $(this).serialize();

                $.ajax({
                    method: 'post',
                    url: '/<?php echo e($appName); ?>/orders/schedules/create/',
                    data: formData,
                    success: function(response) {

                        Toastify({
                            text: response.message || "Order created successfully",
                            duration: 2000,
                            gravity: 'bottom',
                            backgroundColor: '#161b22',
                        }).showToast();

                        setTimeout(function() {
                            window.location.reload();
                        }, 3000)
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status === 401) {

                            Toastify({
                                text: jqXHR.responseJSON.message || "An Error Occured, Failled to save user data...",
                                duration: 2000,
                                gravity: 'bottom',
                                backgroundColor: 'red',
                            }).showToast();

                        }
                    }
                })
            }

        })
  })
</script>