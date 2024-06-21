<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

    <div class="pagetitle">
        <h1>All Pending Bills</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
                <li class="breadcrumb-item active">bills</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row g-2 p-2">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped datatable" id="bills-table">
                    <thead>
                        <tr>
                            <th>SNo.</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>District</th>
                            <th>Village</th>
                            <th>Order Date</th>
                            <th>Service Type</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($bill['name']); ?></td>
                            <td><?php echo e($bill['phone']); ?></td>
                            <td><?php echo e($bill['district']); ?></td>
                            <td><?php echo e($bill['village']); ?></td>
                            <td><?php echo e($bill['order_date']); ?></td>
                            <td><?php echo e($bill['service_type']); ?></td>
                            <td>
                                <?php if($bill['status'] == 'paid'): ?>
                                <span class="badge bg-success">Ugx <?php echo e($bill['amount']); ?> Paid</span>
                                <?php else: ?>
                                <span class="badge bg-warning">Ugx <?php echo e($bill['amount']); ?> Not Paid</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline btn-sm dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Select Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actionDropdown">
                                        <a id="delete-bill-btn" class="dropdown-item text-danger" href="/<?php echo e($appName); ?>/bills/delete/?id=<?php echo e($bill['id']); ?>">Remove Bill</a>
                                        <?php if($role == 'Administrator' && $bill['status'] == 'paid'): ?>
                                        <a class="dropdown-item" href="/<?php echo e($appName); ?>/dashboard/schedules/create/?id=<?php echo e($bill['id']); ?>&order_id=<?php echo e($bill['order_id']); ?>">Create Schedule</a>
                                        <?php endif; ?>

                                        <?php if($role == 'Customer' && $bill['status'] == 'not-paid'): ?>
                                        <a class="dropdown-item" href="/<?php echo e($appName); ?>/dashboard/orders/bills/pay/?id=<?php echo e($bill['id']); ?>&amount=<?php echo e($bill['amount']); ?>" id="pay-btn">Pay Out Bill</a>
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

    <!-- Pay Confirmation Modal -->
    <div class="modal fade" id="payConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="payConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="payConfirmationModalLabel">Proceed To Payment</h5>

                </div>
                <div class="modal-body">
                    <p class="alert alert-warning text-dark">Are you sure you want to proceed with the payment? The money will not be refunded after payment.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancel-btn" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="confirmPayBtn">Yes</button>
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
                    <h6 class="text-dark">Are you sure you want remove this bill?</h6>
                    <div class="alert alert-warning"><strong>Note that you will create a new one if the customer has not yet payed the order.</strong>.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" id="cancel-remove-bill-btn" data-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger btn-sm">Yes, Remove Bill</button>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
    $(document).ready(function() {
        var payUrl = '';

        $(document).on('click', '#pay-btn', function(event) {
            event.preventDefault();
            payUrl = $(this).attr('href');
            $('#payConfirmationModal').modal('show');
        });

        $('#confirmPayBtn').click(function() {
            window.location.href = payUrl;
        });

        $('#cancel-btn').click(function() {
            $('#payConfirmationModal').modal('hide');

        })

        $('#bills-table').on('click', '#delete-bill-btn', function(event) {
            event.preventDefault();

            var removeUrl = $(this).attr('href');

            $('#confirmDeleteModal').modal('show');
            $('#cancel-remove-bill-btn').click(function() {
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