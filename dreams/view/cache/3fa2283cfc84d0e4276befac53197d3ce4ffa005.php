<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Add Progress For Participant.</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
        <li class="breadcrumb-item active">Add Progress</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row g-1">
      <div class="col-sm-4">
        <div class="card p-2">
          <form action="/<?php echo e($appName); ?>/participants/progress/add" class="form needs-validation" id="create-progress-form">
            <div class="form-group my-2">
              <input class="d-none" type="text" name="participant-id" value="<?php echo e($participantId); ?>">
              <label for="event">Event Attended</label>
              <select name="event" id="event" required class="form-control">
                <option value="">Select Event</option>
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($event['id']); ?>"><?php echo e($event['title']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <div class="invalid-feedback">This value is required</div>
            </div>

            <div class="form-group my-2">
              <label for="lesson">Lessons Attended</label>
              <select name="lesson" id="lesson" required class="form-control">
                <option value="">Select Lesson</option>
                <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($lesson['id']); ?>"><?php echo e($lesson['lesson_name']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <div class="invalid-feedback">This value is required</div>
            </div>

            <div class="form-group my-2">
              <label for="skills">Skills Attained</label>
              <div style="height: 200px;" id="skills"></div>
              <textarea name="skills" id="skills-textarea" class="form-control d-none"></textarea>

            </div>

            <div class="form-group my-2">
              <label for="hiv-status">HIV Status</label>
              <select name="hiv-status" id="hiv-status" class="form-control" required>
                <option value="">Select Status</option>
                <option value="negative">Negative</option>
                <option value="positive">Positive</option>
              </select>
              <div class="invalid-feedback">This value is required</div>
            </div>

            <div class="form-group my-2">
              <label for="eligibility">Eligibility Check</label>
              <select name="eligibility" id="eligibility" class="form-control" required>
                <option value="">Select Status</option>
                <option value="allowed">Allowed to continue</option>
                <option value="not-allowed">Not allowed to continue</option>
              </select>
              <div class="invalid-feedback">This value is required</div>
            </div>

            <div class="text-start mt-3">
              <button type="submit" class="btn btn-sm btn-primary">Save</button>
            </div>

          </form>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="alert alert-warning">Note that this data is only for the current participant, its shows all progresses for this participant.</div>
        <div class="card p-2">
          <div class="card-title">Participants Attendence</div>
          <div class="card-body">
            <table class="table table-stripped datatable" id="participants-table">
              <thead>
                <tr>
                  <th>SNo.</th>
                  <th>Participant</th>
                  <th>Attendence and Skills Details</th>
                  <th>Status</th>


                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $progress; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($loop->iteration); ?></td>
                  <td><?php echo e($row['name']); ?></td>
                  <td>Attended <?php echo e($row['title']); ?> on <?php echo e($row['date_attended']); ?>,
                    participant attended <strong><?php echo e($row['lesson_name']); ?> lesson</strong> and got the following skills <br>
                    <?php echo $row['skills_attained']; ?>

                  </td>
                  <td>
                    <strong>HIV Status: </strong>
                    <?php if($row['hiv_status_check'] == 'positive'): ?>
                    <span class="badge bg-danger">Positive</span>
                    <?php else: ?>
                    <span class="badge bg-success">Negative</span>
                    <?php endif; ?>
                    <br>
                    <strong>Self Sufficiency Status: </strong>
                    <?php if($row['self_sufficiency_check'] == 'allowed'): ?>
                    <span class="badge bg-info">Allowed to continue</span>
                    <?php else: ?>
                    <span class="badge bg-danger">Cannot manage to continue</span>
                    <?php endif; ?>
                    <br>
                  </td>
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
  $(document).ready(function() {
    var quill = new Quill('#skills', {
      theme: 'snow'
    });

    $('#create-progress-form').submit(function(e) {
      e.preventDefault();

      const form = this;

      if (form.checkValidity() === false) {
        e.stopPropagation();
        form.classList.add('was-validated');
      } else {
        // Update the hidden textarea with the Quill editor content
        $('#skills-textarea').val(quill.root.innerHTML);

        const formData = $(this).serialize();
        $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: formData,
          success: function(response) {
            Toastify({
              text: response.message || 'Progress added successfully!',
              duration: 4000,
              gravity: 'bottom',
              position: 'left',
              backgroundColor: '#052828',
            }).showToast();

            setTimeout(function() {
              // location.reload();
            }, 2000)
          },
          error: function(xhr, status, error) {
            Toastify({
              text: xhr.responseText,
              duration: 4000,
              gravity: 'bottom',
              position: 'left',
              backgroundColor: 'red',
            }).showToast();
          }
        });
      }
    });
  });
</script>