@include('partials/header')

@include('partials/topBar');

@include('partials/leftPane');

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manage Materials</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Manage Materials</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row g-1">
            <div class="col-sm-4">
                <div class="card p-2">
                    <div class="card-title">Create Material Out Record</div>
                    <div class="card-body">
                        <form id="distribute-item-client" action="/{{$appName}}/materials/create" class="form needs-validation" novalidate>
                            <div class="form-group my-2">
                                <label for="item">Item Name</label>
                                <input type="text" class="form-control" id="item" name="item" required>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="age-group">Target Age Group</label>
                                <select name="age-group" id="age-group" required class="form-control">
                                    <option value="">Select Age Group</option>
                                    <option value="10-14yrs">10-14yrs</option>
                                    <option value="15-19yrs">15-19yrs</option>
                                </select>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="distribution-date">Distribution Date</label>
                                <input type="date" class="form-control" id="distribution-date" name="distribution-date" required>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="">Distribution Status</label>
                                <fieldset class="row mb-3">
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="distribution-status" id="requires-return" value="requires-return" required>
                                            <label class="form-check-label" for="requires-return">
                                                Item Requires Return
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="distribution-status" id="given-out" value="given-out" required>
                                            <label class="form-check-label" for="given-out">
                                                Given Out For Good
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2" id="return-date-group" style="display:none;">
                                <label for="return-date">Return Date</label>
                                <input type="date" class="form-control" id="return-date" name="return-date">
                                <div class="invalid-feedback">This value is required</div>
                            </div>
                            <div class="form-group my-2">
                                <label for="notes">Notes</label>
                                <textarea id="notes" name="notes" class="form-control"></textarea>
                                <div class="invalid-feedback">This value is required</div>
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
                    <div class="card-title">All Materials Distributed</div>
                    <div class="card-body">
                        <table class="table table-stripped datatable" id="participants-table">
                            <thead>
                                <tr>
                                    <th>SNo.</th>
                                    <th>Material</th>
                                    <th>Details</th>
                                    <th>Notes</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materials as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$row['material_name']}}</td>

                                    <td> <strong>Target Group: </strong> {{$row['target_age_group']}},
                                        <br> <strong>Distribution date: </strong> {{$row['distribution_date']}},
                                        <br> <strong>Material status: </strong>{{$row['status']}},
                                        @if($row['return_date'])
                                         <br><strong>Return Date: </strong> {{$row['return_date']}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$row['notes']}}
                                    </td>

                                </tr>

                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@include('partials/footer')

<script>
    $(document).ready(function() {
        $('input[type=radio][name=distribution-status]').change(function() {
            if (this.value == 'requires-return') {
                $('#return-date-group').show();
                $('#return-date').attr('required', true);
            } else {
                $('#return-date-group').hide();
                $('#return-date').removeAttr('required').val('');
            }
        });

        // Initialize the form to hide the return date if needed
        if ($('input[type=radio][name=distribution-status]:checked').val() !== 'requires-return') {
            $('#return-date-group').hide();
            $('#return-date').removeAttr('required');
        }
    });

    $('#distribute-item-client').submit(function(e) {
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
                        text: response.message || 'Record saved successfully!',
                        duration: 4000,
                        gravity: 'bottom',
                        position: 'left',
                        backgroundColor: '#052828',
                    }).showToast();

                    setTimeout(function() {
                        location.reload();
                    }, 2000);
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
</script>