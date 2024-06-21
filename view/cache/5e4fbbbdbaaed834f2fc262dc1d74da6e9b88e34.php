<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>All Participants Progress.</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
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
    </section>

</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
$(document).ready(function() {
    $('#export-excel').click(function() {
        $.ajax({
            url: '/<?php echo e($appName); ?>/reports/export/progress/all', // Update with the correct URL for exporting to Excel
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
