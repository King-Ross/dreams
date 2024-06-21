<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

    <div class="pagetitle">
        <h1>All Orders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
                <li class="breadcrumb-item active">All Orders</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row g-2">
        <div class="card pt-3">
            <div class="card-body">

                <!-- Default Tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="new-orders-tab" data-bs-toggle="tab" data-bs-target="#new-orders" type="button" role="tab" aria-controls="new-orders" aria-selected="true">New Orders</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="orders-in-process-tab" data-bs-toggle="tab" data-bs-target="#orders-in-process" type="button" role="tab" aria-controls="orders-in-process" aria-selected="false" tabindex="-1">Orders In Process</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cancelled-orders-tab" data-bs-toggle="tab" data-bs-target="#cancelled-orders" type="button" role="tab" aria-controls="cancelled-orders" aria-selected="false" tabindex="-1">Cancelled Orders</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="complete-orders-tab" data-bs-toggle="tab" data-bs-target="#complete-orders" type="button" role="tab" aria-controls="complete-orders" aria-selected="false" tabindex="-1">Complete Orders</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="myTabContent">
                    <div class="tab-pane fade show active" id="new-orders" role="tabpanel" aria-labelledby="new-orders-tab">


                        <div class="p-2">

                            <div class="card-body">
                                <table class="table table-bordered table-hover table-striped datatable" id="new-orders-table">
                                    <thead>
                                        <tr>
                                            <th>SNo.</th>
                                            <th>Customer</th>
                                            <th>Phone</th>
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
                                            <td><?php echo e($order['name']); ?></td>
                                            <td><?php echo e($order['phone']); ?></td>
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
                                                        <?php if($role == 'Customer'): ?>
                                                        <a class="dropdown-item" href="/<?php echo e($appName); ?>/dashboard/orders/add-items?id=<?php echo e($order['id']); ?>">Add Items To Order</a>
                                                        <a id="remove-btn" class="dropdown-item text-danger" href="/<?php echo e($appName); ?>/orders/delete?id=<?php echo e($order['id']); ?>">Remove Order</a>
                                                        <?php endif; ?>

                                                        <?php if($role == 'Administrator'): ?>
                                                        <a id="process-order-btn" class="dropdown-item text-success" href="/<?php echo e($appName); ?>/order/status/update?id=<?php echo e($order['id']); ?>&status=processing">Process Order</a>
                                                        <a id="cancel-order-btn" class="dropdown-item text-danger" href="/<?php echo e($appName); ?>/order/status/update?id=<?php echo e($order['id']); ?>&status=cancelled">Cancel Order</a>
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
                    <div class="tab-pane fade" id="orders-in-process" role="tabpanel" aria-labelledby="orders-in-process-tab">

                        <div class="p-2">

                            <div class="card-body">
                                <table class="table table-bordered table-hover table-striped datatable" id="orders-in-process-table">
                                    <thead>
                                        <tr>
                                            <th>SNo.</th>
                                            <th>Customer</th>
                                            <th>Phone</th>
                                            <th>Order Date</th>
                                            <th>Pickup Date</th>
                                            <th>Delivery Date</th>
                                            <th>Service Type</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $orders2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($order2['name']); ?></td>
                                            <td><?php echo e($order2['phone']); ?></td>
                                            <td><?php echo e($order2['order_date']); ?></td>
                                            <td><?php echo e($order2['pickup_date']); ?></td>
                                            <td><?php echo e($order2['delivery_date']); ?></td>
                                            <td><?php echo e($order2['service_type']); ?></td>
                                            <td>
                                                <?php if($order2['order_status'] == 'placed'): ?>
                                                <span class="badge bg-warning">Placed</span>
                                                <?php elseif($order2['order_status'] == 'processing'): ?>
                                                <span class="badge bg-info">Processing</span>
                                                <?php elseif($order2['order_status'] == 'complete'): ?>
                                                <span class="badge bg-success">Complete</span>
                                                <?php else: ?>
                                                <span class="badge bg-danger">Cancelled</span>
                                                <?php endif; ?>
                                                <?php if($order2['payment_status'] == 'paid'): ?>
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
                                                        <?php if($role == 'Customer'): ?>
                                                        <!-- <a class="dropdown-item" href="/<?php echo e($appName); ?>/dashboard/orders/add-items?id=<?php echo e($order2['id']); ?>">Add Items To Order</a> -->
                                                        <a id="remove-btn" class="dropdown-item text-danger" href="/<?php echo e($appName); ?>/orders/delete?id=<?php echo e($order2['id']); ?>">Remove Order</a>
                                                        <?php endif; ?>

                                                        <?php if($role == 'Administrator'): ?>
                                                        <?php if($order2['payment_status'] != 'paid'): ?>
                                                        <a class="dropdown-item" href="/<?php echo e($appName); ?>/dashboard/orders/billing?id=<?php echo e($order2['id']); ?>&ref=<?php echo e($order2['user_id']); ?>">Create Bill</a>
                                                        <?php endif; ?>
                                                        <a id="cancel-order-btn" class="dropdown-item text-danger" href="/<?php echo e($appName); ?>/order/status/update?id=<?php echo e($order2['id']); ?>&status=cancelled">Cancel Order</a>
                                                        <a id="complete-order-btn" class="dropdown-item text-success" href="/<?php echo e($appName); ?>/order/status/update?id=<?php echo e($order2['id']); ?>&status=complete">Complete Order</a>

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


                    <div class="tab-pane fade" id="cancelled-orders" role="tabpanel" aria-labelledby="cancelled-orders-tab">


                        <div class="p-2">

                            <div class="card-body">
                                <table class="table table-bordered table-hover table-striped datatable" id="cancelled-orders-table">
                                    <thead>
                                        <tr>
                                            <th>SNo.</th>
                                            <th>Customer</th>
                                            <th>Phone</th>
                                            <th>Order Date</th>
                                            <th>Pickup Date</th>
                                            <th>Delivery Date</th>
                                            <th>Service Type</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $orders3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($order3['name']); ?></td>
                                            <td><?php echo e($order3['phone']); ?></td>
                                            <td><?php echo e($order3['order_date']); ?></td>
                                            <td><?php echo e($order3['pickup_date']); ?></td>
                                            <td><?php echo e($order3['delivery_date']); ?></td>
                                            <td><?php echo e($order3['service_type']); ?></td>
                                            <td>
                                                <?php if($order3['order_status'] == 'placed'): ?>
                                                <span class="badge bg-warning">Placed</span>
                                                <?php elseif($order3['order_status'] == 'processing'): ?>
                                                <span class="badge bg-info">Processing</span>
                                                <?php elseif($order3['order_status'] == 'complete'): ?>
                                                <span class="badge bg-success">Complete</span>
                                                <?php else: ?>
                                                <span class="badge bg-danger">Cancelled</span>
                                                <?php endif; ?>
                                                <?php if($order3['payment_status'] == 'paid'): ?>
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
                                                        <?php if($role == 'Customer'): ?>
                                                        <a class="dropdown-item" href="/<?php echo e($appName); ?>/dashboard/orders/add-items?id=<?php echo e($order3['id']); ?>">Add Items To Order</a>
                                                        <a id="remove-btn" class="dropdown-item text-danger" href="/<?php echo e($appName); ?>/orders/delete?id=<?php echo e($order3['id']); ?>">Remove Order</a>
                                                        <?php endif; ?>

                                                        <?php if($role == 'Administrator'): ?>
                                                        <a id="remove-btn" class="dropdown-item text-danger" href="/<?php echo e($appName); ?>/orders/delete?id=<?php echo e($order3['id']); ?>">Remove Order</a>
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
                    <div class="tab-pane fade" id="complete-orders" role="tabpanel" aria-labelledby="complete-orders-tab">


                        <div class="p-2">

                            <div class="card-body">
                                <table class="table table-bordered table-hover table-striped datatable" id="complete-orders-table">
                                    <thead>
                                        <tr>
                                            <th>SNo.</th>
                                            <th>Customer</th>
                                            <th>Phone</th>
                                            <th>Order Date</th>
                                            <th>Pickup Date</th>
                                            <th>Delivery Date</th>
                                            <th>Service Type</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $orders4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($order4['name']); ?></td>
                                            <td><?php echo e($order4['phone']); ?></td>
                                            <td><?php echo e($order4['order_date']); ?></td>
                                            <td><?php echo e($order4['pickup_date']); ?></td>
                                            <td><?php echo e($order4['delivery_date']); ?></td>
                                            <td><?php echo e($order4['service_type']); ?></td>
                                            <td>
                                                <?php if($order4['order_status'] == 'placed'): ?>
                                                <span class="badge bg-warning">Placed</span>
                                                <?php elseif($order4['order_status'] == 'processing'): ?>
                                                <span class="badge bg-info">Processing</span>
                                                <?php elseif($order4['order_status'] == 'complete'): ?>
                                                <span class="badge bg-success">Complete</span>
                                                <?php else: ?>
                                                <span class="badge bg-danger">Cancelled</span>
                                                <?php endif; ?>
                                                <?php if($order4['payment_status'] == 'paid'): ?>
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
                                                        <?php if($role == 'Customer'): ?>
                                                        <a class="dropdown-item" href="/<?php echo e($appName); ?>/dashboard/orders/add-items?id=<?php echo e($order4['id']); ?>">Add Items To Order</a>
                                                        <a id="remove-btn" class="dropdown-item text-danger" href="/<?php echo e($appName); ?>/orders/delete?id=<?php echo e($order4['id']); ?>">Remove Order</a>
                                                        <?php endif; ?>

                                                        <?php if($role == 'Administrator'): ?>
                                                        <a id="remove-btn" class="dropdown-item text-danger" href="/<?php echo e($appName); ?>/orders/delete?id=<?php echo e($order4['id']); ?>">Remove Order</a>
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
                </div><!-- End Default Tabs -->

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



    <div class="modal fade" id="confirmStatusModal" tabindex="-1" role="dialog" aria-labelledby="confirmStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="confirmStatusModalLabel">Confirm Your Action</h5>

                </div>
                <div class="modal-body">
                    <h6 class="text-dark">Are you sure you want to change the status of the order?</h6>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" id="cancel-update-status-btn" data-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmStatusBtn" class="btn btn-primary btn-sm">Yes, Update Status</button>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
    $(document).ready(function() {

        $('#new-orders-table').on('click', '#process-order-btn', function(event) {
            event.preventDefault();

            var statusUrl = $(this).attr('href');

            $('#confirmStatusModal').modal('show');
            $('#cancel-update-status-btn').click(function() {
                $('#confirmStatusModal').modal('hide');

            })

            $('#confirmStatusModal').on('click', '#confirmStatusBtn', function() {
                $.post(statusUrl, function(response) {
                    Toastify({
                        text: response.message || 'Order status updated successfully',
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

        $('#new-orders-table').on('click', '#cancel-order-btn', function(event) {
            event.preventDefault();

            var statusUrl = $(this).attr('href');

            $('#confirmStatusModal').modal('show');
            $('#cancel-update-status-btn').click(function() {
                $('#confirmStatusModal').modal('hide');

            })

            $('#confirmStatusModal').on('click', '#confirmStatusBtn', function() {
                $.post(statusUrl, function(response) {
                    Toastify({
                        text: response.message || 'Order status updated successfully',
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

        $('#new-orders-table').on('click', '#remove-btn', function(event) {
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

        $('#orders-in-process-table').on('click', '#cancel-order-btn', function(event) {
            event.preventDefault();

            var statusUrl = $(this).attr('href');

            $('#confirmStatusModal').modal('show');
            $('#cancel-update-status-btn').click(function() {
                $('#confirmStatusModal').modal('hide');

            })

            $('#confirmStatusModal').on('click', '#confirmStatusBtn', function() {
                $.post(statusUrl, function(response) {
                    Toastify({
                        text: response.message || 'Order status updated successfully',
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

        $('#orders-in-process-table').on('click', '#complete-order-btn', function(event) {
            event.preventDefault();

            var statusUrl = $(this).attr('href');

            $('#confirmStatusModal').modal('show');
            $('#cancel-update-status-btn').click(function() {
                $('#confirmStatusModal').modal('hide');

            })

            $('#confirmStatusModal').on('click', '#confirmStatusBtn', function() {
                $.post(statusUrl, function(response) {
                    Toastify({
                        text: response.message || 'Order status updated successfully',
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

        $('#cancelled-orders-table').on('click', '#remove-btn', function(event) {
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

        $('#complete-orders-table').on('click', '#remove-btn', function(event) {
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