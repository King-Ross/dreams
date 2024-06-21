@include('partials/header')

@include('partials/topBar')

@include('partials/leftPane')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>All Participants Progress.</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Home</a></li>
                <li class="breadcrumb-item active">All participants progress.</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card p-2">
            <div class="card-body">
                <!-- Export Button -->
                <div class="mb-3">
                    <button id="export-excel" class="btn btn-primary btn-sm">Export to Excel</button>
                </div>
                <table class="table table-stripped" id="participants-table">
                    <thead>
                        <tr>
                            <th>SNo.</th>
                            <th>Participant</th>
                            <th>Progress Data</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($progress as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row['name']}}</td>
                            <td>Attended {{$row['title']}} on {{$row['date_attended']}},
                                participant attended <strong>{{$row['lesson_name']}} lesson</strong> and got the following skills <br>
                                {!!$row['skills_attained']!!}
                            </td>
                            <td>
                                <strong>HIV Status: </strong>
                                @if($row['hiv_status_check'] == 'positive')
                                <span class="badge bg-danger">Positive</span>
                                @else
                                <span class="badge bg-success">Negative</span>
                                @endif
                                <br>
                                <strong>Self Sufficiency Status: </strong>
                                @if($row['self_sufficiency_check'] == 'allowed')
                                <span class="badge bg-info">Allowed to continue</span>
                                @else
                                <span class="badge bg-danger">Cannot manage to continue</span>
                                @endif
                                <br>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@include('partials/footer')

<script>
$(document).ready(function() {
    $('#export-excel').click(function() {
        $.ajax({
            url: '/{{$appName}}/reports/export/progress/all', // Update with the correct URL for exporting to Excel
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                a.href = url;
                a.download = 'progress_report.xlsx';
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error exporting data to Excel:', textStatus, errorThrown);
            }
        });
    });
});

</script>
