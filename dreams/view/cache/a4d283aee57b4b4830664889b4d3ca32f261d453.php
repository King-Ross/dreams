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

        .item {
            border: 2px dotted #888;
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
        h3,
        h4,
        h5 {
            margin: 5px 0;
        }

        .document-header {
            text-decoration: underline;
            font-size: 20px;
            color: #075E54;
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
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td class="contact-info" style="width: 40%; vertical-align: top;">
                    <img src="/<?php echo e($appName); ?>/assets/img/logo2.png" width="200px" alt="logo" class="logo">
                    <h1>Blue Spring Dry Cleaners and Laundary Services</h1>
                    <span>P.O Box 143, Fortportal Tourism City</span>
                    <span>Tel: +256 7532 457 234</span>
                    <hr>
                    <h2>Employee Schedule Details</h2>
                    <h5>Schedule Created On: <?php echo e($schedule['created_at']); ?></h5><br>
                    <span><strong>Empoloyee Name:</strong> <?php echo e($schedule['name']); ?></span><br>
                    <span><strong>Employee Contact:</strong> <?php echo e($schedule['phone']); ?></span><br>
                    <span><strong>Schedule Start Time:</strong> <?php echo e($schedule['start_time']); ?></span><br>
                    <span><strong>Schedule End Time:</strong> <?php echo e($schedule['end_time']); ?></span>


                </td>

                <td class="ticket-details" style="width: 50%; vertical-align: top;">
                    <h2>Customer Details</h2><br>
                    <span><strong>Name:</strong> <?php echo e($userDetails['name']); ?></span><br>
                    <span><strong>Phone:</strong> <?php echo e($userDetails['phone']); ?></span><br>
                    <span><strong>Email:</strong> <?php echo e($userDetails['email']); ?></span><br>
                    <span><strong>District:</strong> <?php echo e($userDetails['district']); ?></span><br>
                    <span><strong>Village:</strong> <?php echo e($userDetails['village']); ?></span>
                   
                    <h2>Order Items</h2>
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <span><?php echo e($item['quantity']); ?>  <?php echo e($item['item_description']); ?></span><br>
                        <span>Notes: <?php echo e($item['notes']); ?></span>
                    </div>
                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <h4>Important Notes:</h4>
                    <ul>
                        <li>Please make sure to work on the order items in the specified in start time and end time.</li>
                    </ul>

                </td>

            </tr>
        </table>
    </div>
</body>

</html>