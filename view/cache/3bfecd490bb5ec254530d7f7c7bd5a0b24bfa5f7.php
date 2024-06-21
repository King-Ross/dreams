<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php 
use Carbon\Carbon;
 ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>All Employee Schedules</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
        <li class="breadcrumb-item active">Schedules</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row p-2">

      <div class="">
        <div class="">
          <!-- Table with stripped rows -->
          <table class="table table-bordered table-hover table-striped datatable" id="schedules-table">
            <thead>
              <tr>
                <th>Employee Name</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($item['name']); ?></td>
                <td><?php echo e($item['phone']); ?></td>
                <td><?php echo e($item['created_at']); ?></td>
                <td><?php echo e(Carbon::parse($item['start_time'])->format('g:i:s A')); ?></td>
                <td><?php echo e(Carbon::parse($item['end_time'])->format('g:i:s A')); ?></td>
                <td>
                  <?php if($item['status'] == 'active'): ?>
                  <span class="badge bg-primary">Active</span>
                  <?php else: ?>
                  <span class="badge bg-danger">Closed</span>
                  <?php endif; ?>

                </td>

                <td>
                  <div class="dropdown">
                    <button class="btn btn-outline btn-sm dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Select Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="actionDropdown">
                      <?php if($role == 'Administrator'): ?>

                      <a id="close-schedule-btn" class="dropdown-item" href="/<?php echo e($appName); ?>/schedules/close/?id=<?php echo e($item['id']); ?>&status=closed">End Schedule</a> <!-- Replace "1" with the actual book ID -->
                      <a id="print-schedule-btn" class="dropdown-item" href="/<?php echo e($appName); ?>/schedules/print/?id=<?php echo e($item['employee_id']); ?>&order_id=<?php echo e($item['order_id']); ?>">Print Schedule</a> <!-- Replace "1" with the actual book ID -->

                      <a id="delete-schedule-btn" class="dropdown-item text-danger" href="/<?php echo e($appName); ?>/orders/schedules/delete/?id=<?php echo e($item['id']); ?>">Delete Schedule</a> <!-- Replace "1" with the actual book ID -->
                      <?php endif; ?>
                    </div>
                  </div>
                </td>
              </tr>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="confirmDeleteModalLabel">Confirm Your Action</h5>

        </div>
        <div class="modal-body">
          <h6 class="text-dark">Are you sure you want remove this order?</h6>
          <div class="alert alert-warning"><strong>Note that deleting a schedule means that the customer has recieved his or her items.</strong>.</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" id="cancel-btn" data-dismiss="modal">Cancel</button>
          <button type="button" id="confirmDeleteBtn" class="btn btn-danger btn-sm">Yes, Remove Schedule</button>
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
          <h6 class="text-dark">Are you sure you want to change the status of the schedule?</h6>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" id="cancel-update-status-btn" data-dismiss="modal">Cancel</button>
          <button type="button" id="confirmStatusBtn" class="btn btn-primary btn-sm">Yes, Update Status</button>
        </div>
      </div>
    </div>
  </div>

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

    $('#schedules-table').on('click', '#delete-schedule-btn', function(event) {
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


    $('#schedules-table').on('click', '#close-schedule-btn', function(event) {
      event.preventDefault();

      var statusUrl = $(this).attr('href');

      $('#confirmStatusModal').modal('show');
      $('#cancel-update-status-btn').click(function() {
        $('#confirmStatusModal').modal('hide');

      })

      $('#confirmStatusModal').on('click', '#confirmStatusBtn', function() {
        $.post(statusUrl, function(response) {
          Toastify({
            text: response.message || 'Schedule status updated successfully',
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

    $('#schedules-table').on('click', '#print-schedule-btn', function(event) {
      event.preventDefault();

      var printUrl = $(this).attr('href');

      $.ajax({
        url: printUrl,
        method: 'post',
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

    })
  })
</script>