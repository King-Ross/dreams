<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manage Events</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Manage Events</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row g-1">
            <?php if($action != 'edit'): ?>
            <div class="col-sm-4">
                <div class="card p-2">
                    <div class="card-title">Create New Event</div>
                    <div class="card-body">
                        <form action="/<?php echo e($appName); ?>/events/create" class="form needs-validation" novalidate id="create-event-form">

                            <div class="form-group my-2">
                                <label for="">Event Type</label>
                                <input autocomplete="off" type="text" name="event-type" class="form-control" required>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="">Event Title</label>
                                <input autocomplete="off" type="text" name="event-title" class="form-control" required>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="">Event Description</label>
                                <div style="height: 200px;" id="event-description-editor"></div>
                                <textarea name="event-description" class="form-control d-none" id="event-description"></textarea>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="">Learning Outcomes</label>
                                <div style="height: 200px;" id="event-learning-outcomes-editor"></div>
                                <textarea name="event-learning-outcomes" class="form-control d-none" id="event-learning-outcomes"></textarea>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="">Event Start Date</label>
                                <input type="date" name="start-date" class="form-control" required>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="">Event End Date</label>
                                <input type="date" name="end-date" class="form-control" required>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="text-start mt-3">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="alert alert-info">Only events with valid end dates are shown here.</div>
                <div class="card p-2">
                    <div class="card-title">All Events.</div>
                    <div class="card-body">
                        <table class="table table-striped datatable" id="participants-table">
                            <thead>
                                <tr>
                                    <th>Event Details including Type, Title, Description etc.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
            
                                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="accordion" id="accordionRow<?php echo e($loop->iteration); ?>">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingRow<?php echo e($loop->iteration); ?>">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRow<?php echo e($loop->iteration); ?>" aria-expanded="false" aria-controls="collapseRow<?php echo e($loop->iteration); ?>">
                                                        View Details for <?php echo e($row['title']); ?> event.
                                                    </button>
                                                </h2>
                                                <div id="collapseRow<?php echo e($loop->iteration); ?>" class="accordion-collapse collapse" aria-labelledby="headingRow<?php echo e($loop->iteration); ?>" data-bs-parent="#accordionRow<?php echo e($loop->iteration); ?>">
                                                    <div class="accordion-body">
                                                        <strong>Type:</strong> <?php echo e($row['type']); ?><br>
                                                        <strong>Title:</strong> <?php echo e($row['title']); ?><br>
                                                        <strong>Description:</strong> <?php echo $row['description']; ?><br>
                                                        <strong>Learning Outcomes:</strong> <?php echo $row['learning_outcomes']; ?><br>
                                                        <strong>Schedule:</strong> Runs from <?php echo e($row['start_date']); ?> to <?php echo e($row['end_date']); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline btn-sm dropdown-toggle" type="button" id="actionDropdown<?php echo e($loop->iteration); ?>" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Select Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="actionDropdown<?php echo e($loop->iteration); ?>">
                                                <?php if($role == 'Administrator'): ?>
                                                <a class="dropdown-item" href="/<?php echo e($appName); ?>/dashboard/events/?action=edit&id=<?php echo e($row['id']); ?>" >Edit Event Details.</a> 
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
            <div class="col-sm-6">
                <div class="card p-2">
                    <div class="card-title">Edit Event Details</div>
                    <div class="card-body">
                        <form action="/<?php echo e($appName); ?>/events/update?id=<?php echo e($eventDetails['id']); ?>" class="form needs-validation" novalidate id="update-event-form">

                            <div class="form-group my-2">
                                <label for="">Event Type</label>
                                <input value="<?php echo e($eventDetails['type']); ?>" autocomplete="off" type="text" name="event-type" class="form-control" required>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="">Event Title</label>
                                <input value="<?php echo e($eventDetails['title']); ?>" autocomplete="off" type="text" name="event-title" class="form-control" required>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="">Event Description</label>
                                <div style="height: 200px;" id="event-description-editor"><?php echo $eventDetails['description']; ?></div>
                                <textarea name="event-description" class="form-control d-none" id="event-description"></textarea>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="">Learning Outcomes</label>
                                <div style="height: 200px;" id="event-learning-outcomes-editor"><?php echo $eventDetails['learning_outcomes']; ?></div>
                                <textarea name="event-learning-outcomes" class="form-control d-none" id="event-learning-outcomes"></textarea>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="">Event Start Date</label>
                                <input value="<?php echo e($eventDetails['start_date']); ?>" type="date" name="start-date" class="form-control" required>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="">Event End Date</label>
                                <input value="<?php echo e($eventDetails['end_date']); ?>" type="date" name="end-date" class="form-control" required>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="text-start mt-3">
                                <button type="submit" class="btn btn-sm btn-primary">Update Event Details</button>
                                <a href="/<?php echo e($appName); ?>/dashboard/events/" class="btn btn-sm btn-danger">Cancel Update</a>
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
        // Initialize Quill editor
        var quill = new Quill('#event-description-editor', {
            theme: 'snow'
        });
        var quill2 = new Quill('#event-learning-outcomes-editor', {
            theme: 'snow'
        });

        $('#create-event-form').submit(function(e) {
            e.preventDefault();

            const form = this;

            if (form.checkValidity() === false) {
                e.stopPropagation();
                form.classList.add('was-validated');
            } else {
                // Update the hidden textarea with the Quill editor content
                $('#event-description').val(quill.root.innerHTML);
                $('#event-learning-outcomes').val(quill2.root.innerHTML);

                const formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        Toastify({
                            text: response.message || 'Event added successfully!',
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

        $('#update-event-form').submit(function(e) {
            e.preventDefault();

            const form = this;

            if (form.checkValidity() === false) {
                e.stopPropagation();
                form.classList.add('was-validated');
            } else {
                // Update the hidden textarea with the Quill editor content
                $('#event-description').val(quill.root.innerHTML);
                $('#event-learning-outcomes').val(quill2.root.innerHTML);

                const formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        Toastify({
                            text: response.message || 'Event Updated successfully!',
                            duration: 4000,
                            gravity: 'bottom',
                            position: 'left',
                            backgroundColor: '#052828',
                        }).showToast();

                        setTimeout(function() {
                            location.replace("/<?php echo e($appName); ?>/dashboard/events/");
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