<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Create New Invoice</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
        <li class="breadcrumb-item active">Create New Invoice</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="row g-2">
    <div class="col-sm-6">
        <div class="card p-2">
            <div class="card-title">Customer Details</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <img src="<?php echo e($userDetails['image_url']); ?>" width="250px" height="250px" style="object-fit: contain;" alt="">
                    </div>
                    <div class="col-sm-6 ps-3 ms-3">
                        <h5 class="fw-bold">Customer Name</h5>
                        <p><?php echo e($userDetails['name']); ?></p>

                        <h5 class="fw-bold">Customer Contact</h5>
                        <p><?php echo e($userDetails['phone']); ?></p>

                        <h5 class="fw-bold">District</h5>
                        <p><?php echo e($userDetails['district']); ?></p>
                        
                        <h5 class="fw-bold">Village</h5>
                        <p><?php echo e($userDetails['village']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card p-2">
            <div class="card-title">Billing Information</div>
            <div class="card-body">
                <h5>Order Items</h5>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="alert alert-light p-2">
                    <p><?php echo e($item['item_description']); ?></p>
                    <p>Notes: <?php echo e($item['notes']); ?></p>
                 </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <hr>
                <form action="" class="form needs-validation" novalidate id="billing-form">
                    <div class="h5">Billing Amount</div>
                    <div class="form-group">
                        <label for="">Supplies Required</label>
                        <input type="hidden" name="user-id" value="<?php echo e($userDetails['user_id']); ?>">
                        <input type="hidden" name="order-id" value="<?php echo e($orderId); ?>">
                        <textarea class="form-control" required name="supplies" id=""></textarea>
                        <div class="invalid-feedback">This field is required</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Overall Amount in Uganda Shillings</label>
                        <input class="form-control" type="number" name="amount" required>
                        <div class="invalid-feedback">This field is required</div>
                    </div>

                    <div class="text-start mt-2">
                        <button type="submit" class="btn btn-sm btn-primary">Save Bill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
 

</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
    $(document).ready(function(){
        $('#billing-form').submit(function(e) {
            e.preventDefault();

            if (this.checkValidity() === true) {

                let formData = $(this).serialize();

                $.ajax({
                    method: 'post',
                    url: '/<?php echo e($appName); ?>/orders/bills/create/',
                    data: formData,
                    success: function(response) {

                        Toastify({
                            text: response.message || "Bill created successfully",
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