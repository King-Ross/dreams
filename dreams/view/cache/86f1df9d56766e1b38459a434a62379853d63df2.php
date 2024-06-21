<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Items To Your Order</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Add Items</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row g-2">
        <div class="col-sm-4">
            <div class="card p-2">
                <div class="card-title">Create Order Item</div>
                <div class="card-body">
                    <form action="" class="needs-validation" novalidate id="create-order-item-form">
                        <div class="form-group">
                            <label for="">Item Description</label><br>
                            <small class="text-success">Description of the item (e.g., shirt, pants, dress).</small>
                            <input type="hidden" value="<?php echo e($orderId); ?>" name="order-id">
                            <textarea class="form-control" name="item-description" required id=""></textarea>
                            <div class="invalid-feedback">This field is required</div>
                        </div>
                        <div class="form-group my-2">
                            <label for="">Quantity</label>
                            <input type="number" name="quantity" required class="form-control">
                            <div class="invalid-feedback">This field is required</div>
                        </div>

                        <div class="form-group">
                            <label for="">Order Notes</label><small class="text-danger ms-2">(Optional)</small><br>
                            <small class="text-success">Any specific instructions for handling the item</small>
                            <textarea class="form-control" name="order-notes" id=""></textarea>
                            <div class="invalid-feedback">This field is required</div>
                        </div>

                        <div class="text-start mt-2">
                            <button type="submit" class="btn btn-sm btn-primary">Save Item</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-sm-8">
            <div class="card p-2">
                <div class="card-title">Laundary Items for this order</div>
                <div class="card-body">
                    <table class="table table-boardered table-hover table-striped" id="order-items-table">
                        <thead>
                            <tr>
                                <th>SNo.</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item['item_description']); ?></td>
                                <td><?php echo e($item['quantity']); ?></td>
                                <td><?php echo e($item['notes'] =='' ? 'Not provided' : $item['notes']); ?></td>

                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline btn-sm dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Select Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="actionDropdown">
                                            <?php if($role == 'Customer'): ?>

                                            <a class="dropdown-item text-danger" id="remove-btn" href="/<?php echo e($appName); ?>/order/items/delete?id=<?php echo e($item['id']); ?>">Remove Item</a>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
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
                    <h6 class="text-dark">Are you sure you want remove this item from your order?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" id="cancel-btn" data-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger btn-sm">Yes, Remove Item</button>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
    $(document).ready(function() {

        $('#order-items-table').on('click', '#remove-btn', function(event) {
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


        $('#create-order-item-form').submit(function(e) {
            e.preventDefault();

            if (this.checkValidity() === true) {

                let formData = $(this).serialize();

                $.ajax({
                    method: 'post',
                    url: '/<?php echo e($appName); ?>/order/items/create/',
                    data: formData,
                    success: function(response) {

                        Toastify({
                            text: response.message || "Order item created successfully",
                            duration: 2000,
                            gravity: 'bottom',
                            backgroundColor: '#161b22',
                        }).showToast();

                        setTimeout(function() {
                            window.location.reload();
                        }, 2300)
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