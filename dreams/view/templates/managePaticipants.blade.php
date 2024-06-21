@include('partials/header')

@include('partials/topBar');

@include('partials/leftPane');

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Register Participants</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Home</a></li>
        <li class="breadcrumb-item active">Register participants.</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row g-1">
      @if($action != 'edit')
      <div class="col-lg-3">
        <div class="card p-2">
          <div class="card-title">Register Dreams Participant</div>
          <small class="text-success">Participants who meet the age group requirement and are HIV Negative are the ones saved and enrolled. </small>
          <div class="card-body">
            <form action="/{{$appName}}/participants/create" method="POST" class="form needs-validation" novalidate id="register-participant-form">
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
                @foreach($participants as $row)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$row['name']}}</td>
                  <td>{{$row['gender']}}</td>
                  <td>{{$row['dob']}}</td>
                  <td>{{$row['district']}}, {{$row['county']}}, {{$row['subcounty']}}, {{$row['village']}}</td>
                  <td>{{$row['age_group']}}</td>
                  <td>
                    @if($row['hiv_status'] == 'negative')
                     <span class="badge bg-success">Participant is HIV Negative</span>
                     @else
                     <span class="badge bg-danger">Participant is HIV Positive</span>
                     @endif
                     
                     @if($row['schooling_status'] == 'schooling')
                     <span class="badge bg-info">Participant is Studying</span>
                     @else
                     <span class="badge bg-danger">Participant is Not Studying</span>
                    @endif
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-outline btn-sm dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Action
                      </button>
                      <div class="dropdown-menu" aria-labelledby="actionDropdown">
                        @if($role == 'Administrator')
                        @if($row['hiv_status'] == 'negative')
                        <a class="dropdown-item" href="/{{$appName}}/dashboard/participant/progress/add?id={{$row['id']}}">Add Progress Record</a> <!-- Replace "1" with the actual book ID -->
                        @endif
                        <a class="dropdown-item" href="/{{$appName}}/dashboard/participant/register/?action=edit&id={{$row['id']}}">Edit Partcipant Details</a> <!-- Replace "1" with the actual book ID -->
                        <a class="dropdown-item" href="/{{$appName}}/dashboard/participant/progress/view-encounters?id={{$row['id']}}">View Encounters</a> <!-- Replace "1" with the actual book ID -->

                        @endif
                      </div>
                    </div>
                  </td>
                </tr>

                @endforeach


              </tbody>
            </table>
          </div>
        </div>
      </div>
      @endif

      @if($action == 'edit')
      <div class="col-lg-5">
        <div class="card p-2">
          <div class="card-title">Edit Participants Details</div>
          
          <div class="card-body">
            <form action="/{{$appName}}/participants/update?id={{$participantDetails['id']}}" method="POST" class="form needs-validation" novalidate id="update-participant-form">
              <div class="form-group my-2">
                <label for="name">Fullname</label>
                <input value="{{$participantDetails['name']}}" autocomplete="off" type="text" class="form-control" name="name" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="">Gender</label>
                <select name="gendar" id="" required class="form-control">
                  <option value=""></option>
                  <option value="Male" {{$participantDetails['gender'] == 'Male' ? 'selected' : '' }}>Male</option>
                  <option value="Female" {{$participantDetails['gender'] == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="district">Home District</label>
                <input value="{{$participantDetails['district']}}" autocomplete="off" type="text" class="form-control" name="district" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="county">County</label>
                <input value="{{$participantDetails['county']}}" autocomplete="off" type="text" class="form-control" name="county" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="sub-county">Sub County</label>
                <input value="{{$participantDetails['subcounty']}}" autocomplete="off" type="text" class="form-control" name="sub-county" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="village">Village</label>
                <input value="{{$participantDetails['village']}}" autocomplete="off" type="text" class="form-control" name="village" required>
                <div class="invalid-feedback">This value is required</div>
              </div>

              <div class="form-group my-2">
                <label for="dob">Date of Birth</label>
                <input value="{{$participantDetails['dob']}}" autocomplete="off" type="text" class="form-control" name="dob" id="dob" required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              <div class="form-group my-2">
                <label for="age-group">Age Group (10-14 yrs.),(15-19 yrs)</label>
                <input value="{{$participantDetails['age_group']}}" type="text" class="form-control" name="age-group" id="age-group" readonly required>
                <div class="invalid-feedback">This value is required</div>
              </div>
              @if($participantDetails['hiv_status'] == 'positive')
              <div class="alert alert-danger">This partcipant turned positive while tracking his progress, editing particpant's status is not available</div>
              <input type="hidden" name="hiv-status" value="positive">
              @else
              <div class="form-group my-2">
                <label for="hiv-status">HIV Status</label>
                <select name="hiv-status" id="hiv-status" class="form-control" required>
                  <option value="">Select Status</option>
                  <option value="negative" {{$participantDetails['hiv_status'] == 'negative' ? 'selected' : '' }} >Negative</option>
                  <option value="positive" {{$participantDetails['hiv_status'] == 'positive' ? 'selected' : '' }}>Positive</option>
                </select>
                <div class="invalid-feedback">This value is required</div>
              </div>
              @endif
              <div class="form-group my-2">
                <label for="schooling-status">Schooling Status</label>
                <select name="schooling-status" id="schooling-status" class="form-control" required>
                  <option value="">Select Status</option>
                  <option value="schooling" {{$participantDetails['schooling_status'] == 'schooling' ? 'selected' : '' }}>Schooling</option>
                  <option value="not-schooling" {{$participantDetails['schooling_status'] == 'not-schooling' ? 'selected' : '' }}>Not Schooling</option>
                </select>
                <div class="invalid-feedback">This value is required</div>
              </div>

              <div class="text-start mt-2">
                <button type="submit" class="btn btn-primary btn-sm">Update Partcipant Details</button>
                <a href="/{{$appName}}/dashboard/participant/register/" class="btn btn-danger btn-sm">Cancel Update</a>
              </div>
            </form>

          </div>
        </div>
      </div>
      @endif
    </div>
  </section>

</main><!-- End #main -->

@include('partials/footer')

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
              location.replace("/{{$appName}}/dashboard/participant/register/");
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