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

    <div class="row g-2">
        <div class="col-sm-9">
            <div class="card p-2">
                <div class="card-title">Your Orders</div>
                <div class="card-body">
                    <table class="table table-boardered table-hover table-striped" id="orders-table">
                        <thead>
                            <tr>
                                <th>SNo.</th>
                                <th>Order Date</th>
                                <th>Pickup Date</th>
                                <th>Delivery Date</th>
                                <th>Service Type</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($order['order_date']); ?></td>
                                <td><?php echo e($order['pickup_date']); ?></td>
                                <td><?php echo e($order['delivery_date']); ?></td>
                                <td><?php echo e($order['service_type']); ?></td>
                                <td>
                                    <?php if($order['order_status'] == 'placed'): ?>
                                        <span class="badge bg-warning">Placed</span>
                                        <?php elseif($order['order_status'] == 'processing'): ?>
                                        <span class="badge bg-info">Processing</span>
                                        <?php elseif($order['order_status'] == 'complete'): ?>
                                        <span class="badge bg-success">Complete</span>
                                        <?php else: ?>
                                        <span class="badge bg-danger">Cancelled</span>
                                    <?php endif; ?>
                                    <?php if($order['payment_status'] == 'paid'): ?>
                                     <span class="badge bg-success">Paid</span>
                                     <?php else: ?>
                                     <span class="badge bg-warning">Not Paid</span>
                                    <?php endif; ?>
                                </td>
                                
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline btn-sm dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Select Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="actionDropdown">
                                            <?php if($role == 'Customer' && $order['order_status'] == 'placed'): ?>
                                            <a class="dropdown-item" href="/<?php echo e($appName); ?>/dashboard/orders/add-items?id=<?php echo e($order['id']); ?>">Add Items To Order</a>
                            
                                            <?php endif; ?>
                                            
                                            <?php if($role == 'Administrator'): ?>
                                            <a id="remove-btn" class="dropdown-item text-danger" href="/<?php echo e($appName); ?>/orders/delete?id=<?php echo e($order['id']); ?>">Remove Order</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="confirmDeleteModalLabel">Confirm Your Action</h5>

                </div>
                <div class="modal-body">
                    <h6 class="text-dark">Are you sure you want remove this order?</h6>
                    <div class="alert alert-warning">This will delete this order and all laundary items related to this order.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" id="cancel-btn" data-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger btn-sm">Yes, Remove Order</button>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
    $(document).ready(function(){

        $('#orders-table').on('click', '#remove-btn', function(event) {
            event.preventDefault();

            var removeUrl = $(this).attr('href');

            $('#confirmDeleteModal').modal('show');
            $('#cancel-btn').click(function() {
                $('#confirmDeleteModal').modal('hide');

            })

            $('#confirmDeleteModal').on('click', '#confirmDeleteBtn', function() {
                $.post(removeUrl, function(response) {
                    Toastify({
                        text: response.message || 'Item removed successfully',
                        duration: 2000,
                        gravity: 'bottom',
                        backgroundColor: '#161b22',
                    }).showToast();

                    setTimeout(function() {
                        window.location.reload();

                    }, 2300)
                });
            });
        })

    })
</script>