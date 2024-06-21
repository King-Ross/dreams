<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

    <div class="pagetitle">
        <h1>View Encounters</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
                <li class="breadcrumb-item active">View Encounters</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row g-1">
            <div class="col-sm-4">
                <div class="card p-2">
                    <div class="card-title">Add New Encounter</div>
                    <div class="card-body">
                        <form action="/<?php echo e($appName); ?>/encounters/create" class="needs-validation" novalidate id="create-encounters-form">
                            <div class="form-group my-2">
                                <label for="">Encounter Date</label>
                                <input type="date" name="encounter-date" class="form-control" required>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
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
                                <label for="lesson">Material Given Out</label>
                                <select name="material" id="material" required class="form-control">
                                    <option value="">Select Item</option>
                                    <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($material['id']); ?>"><?php echo e($material['material_name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="invalid-feedback">This value is required</div>
                            </div>

                            <div class="form-group">
                                <label for="">Service Details</label>
                                <textarea name="service-details" rows="5" id="" class="form-control"></textarea>
                            </div>

                            <div class="text-start mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card p-2">
                    <div class="card-title">Participant Encouters</div>
                    <div class="card-body">
                        <table class="table table-stripped datatable" id="participants-table">
                            <thead>
                                <tr>
                                    <th>SNo.</th>
                                    <th>Date</th>
                                    <th>Event</th>
                                    <th>Lesson</th>
                                    <th>Education Materials</th>
                                    <th>Service Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $encounters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($row['date']); ?></td>
                                    <td><?php echo e($row['title']); ?></td>
                                    <td><?php echo e($row['lesson_name']); ?></td>
                                    <td><?php echo e($row['material_name']); ?></td>
                                    <td><?php echo e($row['service']); ?></td>
                                    
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
        $('#create-encounters-form').submit(function(e) {
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
                            text: response.message || 'Encounter added successfully!',
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
    })
</script>