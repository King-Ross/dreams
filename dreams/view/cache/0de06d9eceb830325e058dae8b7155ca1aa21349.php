<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Register Participants</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
        <li class="breadcrumb-item active">Register participants.</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row g-1">
      <?php if($action != 'edit'): ?>
      <div class="col-lg-3">
        <div class="card p-2">
          <div class="card-title">Register Dreams Participant</div>
          <small class="text-success">Participants who meet the age group requirement and are HIV Negative are the ones saved and enrolled. </small>
          <div class="card-body">
            <form action="/<?php echo e($appName); ?>/participants/create" method="POST" class="form needs-validation" novalidate id="register-participant-form">
              <div class="form-group my-2">
                <label for="name">Fullname</label>
                <input autocomplete="off" type="text" class="form-control" name="name" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="">Gender</label>
                <select name="gendar" id="" required class="form-control">
                  <option value=""></option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="district">Home District</label>
                <input autocomplete="off" type="text" class="form-control" name="district" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="county">County</label>
                <input autocomplete="off" type="text" class="form-control" name="county" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="sub-county">Sub County</label>
                <input autocomplete="off" type="text" class="form-control" name="sub-county" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="village">Village</label>
                <input autocomplete="off" type="text" class="form-control" name="village" required>
                <div class="invalid-feedback">This value is required</div>
              </div>

              <div class="form-group my-2">
                <label for="dob">Date of Birth</label>
                <input autocomplete="off" type="text" class="form-control" name="dob" id="dob" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="age-group">Age Group (10-14 yrs.),(15-19 yrs)</label>
                <input type="text" class="form-control" name="age-group" id="age-group" readonly required>
                <div class="invalid-feedback">This value is required</div>
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
                <label for="schooling-status">Schooling Status</label>
                <select name="schooling-status" id="schooling-status" class="form-control" required>
                  <option value="">Select Status</option>
                  <option value="schooling">Schooling</option>
                  <option value="not-schooling">Not Schooling</option>
                </select>
                <div class="invalid-feedback">This value is required</div>
              </div>

              <div class="text-start mt-2">
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
              </div>
            </form>

          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="alert alert-info">Progress cannot be added to a participant with a status of <strong>HIV Positive</strong> this participant can only be given other services in the encounters section.</div>
        <div class="card p-2">
          <div class="card-title">Enrolled Participants</div>
          <div class="card-body">
            <table class="table table-stripped datatable" id="participants-table">
              <thead>
                <tr>
                  <th>SNo.</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Dob</th>
                  <th>Address</th>
                  <th>Group</th>
                  <th>Status</th>
                  <th>Action</th>

                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($loop->iteration); ?></td>
                  <td><?php echo e($row['name']); ?></td>
                  <td><?php echo e($row['gender']); ?></td>
                  <td><?php echo e($row['dob']); ?></td>
                  <td><?php echo e($row['district']); ?>, <?php echo e($row['county']); ?>, <?php echo e($row['subcounty']); ?>, <?php echo e($row['village']); ?></td>
                  <td><?php echo e($row['age_group']); ?></td>
                  <td>
                    <?php if($row['hiv_status'] == 'negative'): ?>
                     <span class="badge bg-success">Participant is HIV Negative</span>
                     <?php else: ?>
                     <span class="badge bg-danger">Participant is HIV Positive</span>
                     <?php endif; ?>
                     
                     <?php if($row['schooling_status'] == 'schooling'): ?>
                     <span class="badge bg-info">Participant is Studying</span>
                     <?php else: ?>
                     <span class="badge bg-danger">Participant is Not Studying</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-outline btn-sm dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Action
                      </button>
                      <div class="dropdown-menu" aria-labelledby="actionDropdown">
                        <?php if($role == 'Administrator'): ?>
                        <?php if($row['hiv_status'] == 'negative'): ?>
                        <a class="dropdown-item" href="/<?php echo e($appName); ?>/dashboard/participant/progress/add?id=<?php echo e($row['id']); ?>">Add Progress Record</a> <!-- Replace "1" with the actual book ID -->
                        <?php endif; ?>
                        <a class="dropdown-item" href="/<?php echo e($appName); ?>/dashboard/participant/register/?action=edit&id=<?php echo e($row['id']); ?>">Edit Partcipant Details</a> <!-- Replace "1" with the actual book ID -->
                        <a class="dropdown-item" href="/<?php echo e($appName); ?>/dashboard/participant/progress/view-encounters?id=<?php echo e($row['id']); ?>">View Encounters</a> <!-- Replace "1" with the actual book ID -->

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
      <?php endif; ?>

      <?php if($action == 'edit'): ?>
      <div class="col-lg-5">
        <div class="card p-2">
          <div class="card-title">Edit Participants Details</div>
          
          <div class="card-body">
            <form action="/<?php echo e($appName); ?>/participants/update?id=<?php echo e($participantDetails['id']); ?>" method="POST" class="form needs-validation" novalidate id="update-participant-form">
              <div class="form-group my-2">
                <label for="name">Fullname</label>
                <input value="<?php echo e($participantDetails['name']); ?>" autocomplete="off" type="text" class="form-control" name="name" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="">Gender</label>
                <select name="gendar" id="" required class="form-control">
                  <option value=""></option>
                  <option value="Male" <?php echo e($participantDetails['gender'] == 'Male' ? 'selected' : ''); ?>>Male</option>
                  <option value="Female" <?php echo e($participantDetails['gender'] == 'Female' ? 'selected' : ''); ?>>Female</option>
                </select>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="district">Home District</label>
                <input value="<?php echo e($participantDetails['district']); ?>" autocomplete="off" type="text" class="form-control" name="district" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="county">County</label>
                <input value="<?php echo e($participantDetails['county']); ?>" autocomplete="off" type="text" class="form-control" name="county" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="sub-county">Sub County</label>
                <input value="<?php echo e($participantDetails['subcounty']); ?>" autocomplete="off" type="text" class="form-control" name="sub-county" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="village">Village</label>
                <input value="<?php echo e($participantDetails['village']); ?>" autocomplete="off" type="text" class="form-control" name="village" required>
                <div class="invalid-feedback">This value is required</div>
              </div>

              <div class="form-group my-2">
                <label for="dob">Date of Birth</label>
                <input value="<?php echo e($participantDetails['dob']); ?>" autocomplete="off" type="text" class="form-control" name="dob" id="dob" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="age-group">Age Group (10-14 yrs.),(15-19 yrs)</label>
                <input value="<?php echo e($participantDetails['age_group']); ?>" type="text" class="form-control" name="age-group" id="age-group" readonly required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <?php if($participantDetails['hiv_status'] == 'positive'): ?>
              <div class="alert alert-danger">This partcipant turned positive while tracking his progress, editing particpant's status is not available</div>
              <input type="hidden" name="hiv-status" value="positive">
              <?php else: ?>
              <div class="form-group my-2">
                <label for="hiv-status">HIV Status</label>
                <select name="hiv-status" id="hiv-status" class="form-control" required>
                  <option value="">Select Status</option>
                  <option value="negative" <?php echo e($participantDetails['hiv_status'] == 'negative' ? 'selected' : ''); ?> >Negative</option>
                  <option value="positive" <?php echo e($participantDetails['hiv_status'] == 'positive' ? 'selected' : ''); ?>>Positive</option>
                </select>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <?php endif; ?>
              <div class="form-group my-2">
                <label for="schooling-status">Schooling Status</label>
                <select name="schooling-status" id="schooling-status" class="form-control" required>
                  <option value="">Select Status</option>
                  <option value="schooling" <?php echo e($participantDetails['schooling_status'] == 'schooling' ? 'selected' : ''); ?>>Schooling</option>
                  <option value="not-schooling" <?php echo e($participantDetails['schooling_status'] == 'not-schooling' ? 'selected' : ''); ?>>Not Schooling</option>
                </select>
                <div class="invalid-feedback">This value is required</div>
              </div>

              <div class="text-start mt-2">
                <button type="submit" class="btn btn-primary btn-sm">Update Partcipant Details</button>
                <a href="/<?php echo e($appName); ?>/dashboard/participant/register/" class="btn btn-danger btn-sm">Cancel Update</a>
              </div>
            </form>

          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </section>

</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
  $(document).ready(function() {
    $('#dob').datepicker({
      dateFormat: 'yy/mm/dd',
      changeMonth: true,
      changeYear: true,
      yearRange: 'c-20:c', // Adjust this range as necessary
      onSelect: function(dateText) {
        const dob = new Date(dateText);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const monthDiff = today.getMonth() - dob.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
          age--;
        }

        let ageGroup = '';
        if (age >= 10 && age <= 14) {
          ageGroup = '10-14 yrs';
        } else if (age >= 15 && age <= 19) {
          ageGroup = '15-19 yrs';
        } else {
          ageGroup = 'Dob Not In Required Age Groups';
        }

        $('#age-group').val(ageGroup);
      }
    });

    $('#register-participant-form').submit(function(e) {
      e.preventDefault();

      const form = this;
      const hivStatus = $('#hiv-status').val();
      if (hivStatus !== 'negative') {
        Toastify({
          text: 'Only participants with HIV negative status can be enrolled.',
          duration: 4000,
          gravity: 'bottom',
          position: 'left',
          backgroundColor: 'red',
        }).showToast();

        return;
      }

      if (form.checkValidity() === false) {
        e.stopPropagation();
        form.classList.add('was-validated');
      } else {
        const formData = $(this).serialize();
        $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: formData,
          success: function(response) {
            Toastify({
              text: response.message || 'Participant registered successfully!',
              duration: 4000,
              gravity: 'bottom',
              position: 'left',
              backgroundColor: '#052828',
            }).showToast();

            setTimeout(function() {
              location.reload();
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

    $('#update-participant-form').submit(function(e) {
      e.preventDefault();

      const form = this;

      if (form.checkValidity() === false) {
        e.stopPropagation();
        form.classList.add('was-validated');
      } else {
        const formData = $(this).serialize();
        $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: formData,
          success: function(response) {
            Toastify({
              text: response.message || 'Participant updated successfully!',
              duration: 4000,
              gravity: 'bottom',
              position: 'left',
              backgroundColor: '#052828',
            }).showToast();

            setTimeout(function() {
              location.replace("/<?php echo e($appName); ?>/dashboard/participant/register/");
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