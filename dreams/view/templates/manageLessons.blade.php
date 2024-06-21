@include('partials/header')

@include('partials/topBar');

@include('partials/leftPane');

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manage Lessons</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Manage Lessons</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row g-1">
            @if($action != 'edit')
            <div class="col-lg-5">
                <div class="card p-2">
                    <div class="card-title">Create New Lesson</div>
                    <form action="/{{$appName}}/lessons/create" class="form needs-validation" novalidate id="create-lesson-form">
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
                            @foreach($lessons as $row)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$row['id']}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$row['id']}}" aria-expanded="false" aria-controls="collapse{{$row['id']}}">
                                        {{$loop->iteration}}. {{$row['lesson_name']}}
                                    </button>
                                </h2>
                                <div id="collapse{{$row['id']}}" class="accordion-collapse collapse" aria-labelledby="heading{{$row['id']}}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {!! $row['description'] !!}
                                        <div class="dropdown mt-3">
                                            <button class="btn btn-outline btn-sm dropdown-toggle" type="button" id="actionDropdown{{$row['id']}}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Select Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="actionDropdown{{$row['id']}}">
                                                @if($role == 'Administrator')
                                                <a class="dropdown-item" href="/{{$appName}}/dashboard/lessons/?action=edit&id={{$row['id']}}" >Edit Lesson Details.</a> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($action == 'edit')
            <div class="col-lg-5">
                <div class="card p-2">
                    <div class="card-title">Edit Lesson Details</div>
                    <form action="/{{$appName}}/lessons/update?id={{$lessonDetails['id']}}" class="form needs-validation" novalidate id="update-lesson-form">
                        <div class="form-group my-2">
                            <label for="">Lesson Name</label>
                            <input value="{{$lessonDetails['lesson_name']}}" autocomplete="off" type="text" class="form-control" name="lesson-name" required>
                            <div class="invalid-feedback">This value is required</div>
                        </div>

                        <div class="form-group my-2">
                            <label for="">Lesson Description</label>
                            <div style="height: 350px;" id="lesson-description-editor">{!! $lessonDetails['description'] !!}</div>
                            <textarea name="lesson-description" id="lesson-description" class="form-control d-none"></textarea>
                            <div class="invalid-feedback">This value is required</div>
                        </div>

                        <div class="text-start mt-3">
                            <button type="submit" class="btn btn-primary btn-sm">Update Lesson Details</button>
                            <a href="/{{$appName}}/dashboard/lessons/" class="btn btn-danger btn-sm">Cancel Update</a>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </section>

</main><!-- End #main -->

@include('partials/footer')

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
                            location.replace("/{{$appName}}/dashboard/lessons/");
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
