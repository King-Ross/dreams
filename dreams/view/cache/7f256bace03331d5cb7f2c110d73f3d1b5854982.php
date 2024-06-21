<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($appNameFull); ?></title>
    <style>
        body {
            background-color: #fcfdfe;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            background-color: #075E54;
            color: #ffffff;
            page-break-inside: avoid;
            padding: 10px;
        }

        .logo {
            max-width: 80px;
            display: block;
            margin: 0 auto 10px auto;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            margin: 5px 0;
            color: #060a1d;
        }

        .document-header {
            text-decoration: underline;
            font-size: 20px;
            color: #075E54;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            page-break-inside: avoid;
            /* Prevent table from breaking across pages */
        }

        tr th {
            background-color: #060a1d;
            color: #ffffff;
            height: 30px;
            vertical-align: middle;
            padding-top: 5px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .contact-info {
            text-align: center;
        }


        @media  print {
            .container {
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="contact-info" style="width: 50%; vertical-align: top;">
            <img src="/<?php echo e($appName); ?>/assets/img/logo2.png" width="200px" alt="logo" class="logo">
            <h1>Blue Spring Dry Cleaners and Laundary Services</h1>
            <h3>P.O Box 143, Fortportal Tourism City</h3>
            <h3>Tel: +256 7532 457 234</h3>
           

            <br><br><br><br><br>
            <h4>Orders In Process Report</h4>
            <span>Eported On <?php echo e($currentDate); ?></span>
            <br><br><br><br><br><br>

        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped" id="orders-in-process-table">
                    <thead>
                        <tr>
                            <th>SNo.</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Order Date</th>
                            <th>Pickup Date</th>
                            <th>Delivery Date</th>
                            <th>Service Type</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $orders2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($order2['name']); ?></td>
                            <td><?php echo e($order2['phone']); ?></td>
                            <td><?php echo e($order2['order_date']); ?></td>
                            <td><?php echo e($order2['pickup_date']); ?></td>
                            <td><?php echo e($order2['delivery_date']); ?></td>
                            <td><?php echo e($order2['service_type']); ?></td>
                            <td>
                                <?php if($order2['order_status'] == 'placed'): ?>
                                <span class="badge bg-warning">Placed</span>
                                <?php elseif($order2['order_status'] == 'processing'): ?>
                                <span class="badge bg-info">Processing</span>
                                <?php elseif($order2['order_status'] == 'complete'): ?>
                                <span class="badge bg-success">Complete</span>
                                <?php else: ?>
                                <span class="badge bg-danger">Cancelled</span>
                                <?php endif; ?>
                                <?php if($order2['payment_status'] == 'paid'): ?>
                                <span class="badge bg-success">Paid</span>
                                <?php else: ?>
                                <span class="badge bg-warning">Not Paid</span>
                                <?php endif; ?>
                            </td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>