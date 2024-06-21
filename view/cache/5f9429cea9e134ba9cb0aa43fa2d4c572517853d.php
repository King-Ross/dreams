<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Orders In Process Today</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Reports</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="p-2">
                <button class="btn btn-sm btn-primary mb-3" id="export-pdf-btn">Export In Process Orders PDF</button>
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
    </section>

    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">PDF Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfIframe" width="100%" height="500px" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
    $(document).ready(function() {
        $("#export-pdf-btn").on("click", function() {

            $.ajax({
                url: '/<?php echo e($appName); ?>/dashboard/reports/orders/in-process/print/',
                method: 'POST',
                processData: false,
                contentType: false,
                success: function(response) {

                    var pdfData = response;

                    $("#pdfIframe").attr("src", "data:application/pdf;base64," + pdfData);

                    // Open the Bootstrap modal
                    $("#pdfModal").modal("show");
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        });

    })
</script>