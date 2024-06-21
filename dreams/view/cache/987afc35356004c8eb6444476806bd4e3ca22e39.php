<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manage Lessons</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Manage Lessons</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row g-1">
            <?php if($action != 'edit'): ?>
            <div class="col-lg-5">
                <div class="card p-2">
                    <div class="card-title">Create New Lesson</div>
                    <form action="/<?php echo e($appName); ?>/lessons/create" class="form needs-validation" novalidate id="create-lesson-form">
                        <div class="form-group my-2">
                            <label for="">Lesson Name</label>
                            <input type="text" class="form-control" name="lesson-name" required>
                            <div class="invalid-feedback">This value is required</div>
                        </div>

                        <div class="form-group my-2">
                            <label for="">Lesson Description</label>
                            <div style="height: 350px;" id="lesson-description-editor"></div>
                            <textarea name="lesson-description" id="lesson-description" class="form-control d-none"></textarea>
                            <div class="invalid-feedback">This value is required</div>
                        </div>

                        <div class="text-start mt-3">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card p-2">
                    <div class="card-title">Current Available Lessons.</div>
                    <div class="card-body">
                        <div class="alert alert-info">Click on the arrow to expand and collapse the lesson.</div>
                        <div class="accordion" id="accordionExample">
                            <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?php echo e($row['id']); ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($row['id']); ?>" aria-expanded="false" aria-controls="collapse<?php echo e($row['id']); ?>">
                                        <?php echo e($loop->iteration); ?>. <?php echo e($row['lesson_name']); ?>

                                    </button>
                                </h2>
                                <div id="collapse<?php echo e($row['id']); ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo e($row['id']); ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $row['description']; ?>

                                        <div class="dropdown mt-3">
                                            <button class="btn btn-outline btn-sm dropdown-toggle" type="button" id="actionDropdown<?php echo e($row['id']); ?>" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Select Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="actionDropdown<?php echo e($row['id']); ?>">
                                                <?php if($role == 'Administrator'): ?>
                                                <a class="dropdown-item" href="/<?php echo e($appName); ?>/dashboard/lessons/?action=edit&id=<?php echo e($row['id']); ?>" >Edit Lesson Details.</a> 
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if($action == 'edit'): ?>
            <div class="col-lg-5">
                <div class="card p-2">
                    <div class="card-title">Edit Lesson Details</div>
                    <form action="/<?php echo e($appName); ?>/lessons/update?id=<?php echo e($lessonDetails['id']); ?>" class="form needs-validation" novalidate id="update-lesson-form">
                        <div class="form-group my-2">
                            <label for="">Lesson Name</label>
                            <input value="<?php echo e($lessonDetails['lesson_name']); ?>" autocomplete="off" type="text" class="form-control" name="lesson-name" required>
                            <div class="invalid-feedback">This value is required</div>
                        </div>

                        <div class="form-group my-2">
                            <label for="">Lesson Description</label>
                            <div style="height: 350px;" id="lesson-description-editor"><?php echo $lessonDetails['description']; ?></div>
                            <textarea name="lesson-description" id="lesson-description" class="form-control d-none"></textarea>
                            <div class="invalid-feedback">This value is required</div>
                        </div>

                        <div class="text-start mt-3">
                            <button type="submit" class="btn btn-primary btn-sm">Update Lesson Details</button>
                            <a href="/<?php echo e($appName); ?>/dashboard/lessons/" class="btn btn-danger btn-sm">Cancel Update</a>
                        </div>
                    </form>
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
        var quill = new Quill('#lesson-description-editor', {
            theme: 'snow'
        });

        $('#create-lesson-form').submit(function(e) {
            e.preventDefault();

            const form = this;

            if (form.checkValidity() === false) {
                e.stopPropagation();
                form.classList.add('was-validated');
            } else {
                // Update the hidden textarea with the Quill editor content
                $('#lesson-description').val(quill.root.innerHTML);

                const formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        Toastify({
                            text: response.message || 'Lesson added successfully!',
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

        $('#update-lesson-form').submit(function(e) {
            e.preventDefault();

            const form = this;

            if (form.checkValidity() === false) {
                e.stopPropagation();
                form.classList.add('was-validated');
            } else {
                // Update the hidden textarea with the Quill editor content
                $('#lesson-description').val(quill.root.innerHTML);

                const formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        Toastify({
                            text: response.message || 'Lesson updated successfully!',
                            duration: 4000,
                            gravity: 'bottom',
                            position: 'left',
                            backgroundColor: '#052828',
                        }).showToast();

                        setTimeout(function() {
                            location.replace("/<?php echo e($appName); ?>/dashboard/lessons/");
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
