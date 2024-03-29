<link rel="stylesheet" type="text/css" href="path/to/styles.css">
<?php if ($_SESSION['user_role'] == 'Administrator' || $_SESSION['user_role'] == 'Master Administrator') : ?>
<div class="card shadow-sm" style="border-color: #FCBD32;">
    <div class="card-header" style="background-color: #FCBD32; color: white;">
        <h3 class="card-title" style="color: white;font-family: 'Your Special Font', gagalin;font-size: 2em;"  >List of Rewards</h3>
        <!-- Check whether logged in or not -->
        <div class="card-toolbar">
            <?php if (isLoggedIn()): ?>
                <a href="<?php echo URLROOT; ?>/rewards/create" class="btn btn-light-primary" style="background-color: #183D64; color: white;">Create Rewards</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">

    <style>
/* Common table styles for both tables */
/* Common table styles for both tables */
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th, .table td {
    padding: 20px;
    border: 20px solid #dcdcdc; /* Border style for both tables */
    text-align: left;
}

.table th {
    background-color: #183D64; /* Blue */
    color: #ffffff;
}

/* Style for the first table (Administrator and Master Administrator) */
.card-header {
    background-color: #FCBD32; /* Yellow */
    color: white;
}

.btn-light-primary {
    background-color: #183D64 !important; /* Blue */
    color: white !important;
}

/* Style for the second table (Student) */
.card-header {
    background-color: #7C1C2B; /* Red */
    color: white;
}

.btn-light-warning {
    background-color: #7C1C2B !important; /* Red */
    color: white !important;
}

.btn-success[disabled] {
    background-color: #FCBD32 !important; /* Yellow */
    color: white !important;
}


    </style>



        <div class="table-responsive">
            <table id="kt_datatable_posts" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Badge Icon</th>
                        <th>Badge Name</th>
                        <th> Badge Description</th>
                        <th>Activities Joined</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['rewards'] as $reward): ?>
                        <tr>
                        <td>
                            <?php $badge_name_lowercase = strtolower($reward->badge_name); ?>
                            <?php if ($badge_name_lowercase === 'gold'): ?>
                                <img src="<?php echo URLROOT . "/public/images/rewards/2.png" ?>" alt="Gold Badge" style="width: 150px; height: 150px;">
                            <?php elseif ($badge_name_lowercase === 'silver'): ?>
                                <img src="<?php echo URLROOT . "/public/images/rewards/1.png" ?>" alt="Silver Badge" style="width: 150px; height: 150px;">
                            <?php elseif ($badge_name_lowercase === 'bronze'): ?>
                                <img src="<?php echo URLROOT . "/public/images/rewards/3.png" ?>" alt="Bronze Badge" style="width: 150px; height: 150px;">
                            <?php elseif ($badge_name_lowercase === 'diamond'): ?>
                                <img src="<?php echo URLROOT . "/public/images/rewards/4.png" ?>" alt="Diamond Badge" style="width: 150px; height: 150px;">
                            <?php else: ?>
                                <!-- Default image if badge_name doesn't match any of the above -->
                            <?php endif; ?>
                        </td>

                            <td><?php echo $reward->badge_name; ?></td>
                            <td><?php echo $reward->badge_description; ?></td>
                            <td><?php echo $reward->points_required; ?></td>
                            <td>
                            <a href="<?php echo URLROOT . '/rewards/update/' . $reward->reward_id; ?>" class="btn btn-light-warning">Update</a>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt<?php echo $reward->reward_id; ?>">Delete</button>
                                <div class="modal fade" tabindex="-1" id="kt<?php echo $reward->reward_id; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Delete Badge!</h3>
                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                </div>
                                                <!--end::Close-->
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this badge?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="<?php echo URLROOT . '/rewards/delete/' . $reward->reward_id; ?>" method="POST">
                                                    <input type="hidden" id="reward_id" name="reward_id" value="<?php echo $reward->reward_id; ?>">
                                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary font-weight-bold">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                var table = $('#kt_datatable_posts').DataTable({});
            });
        </script>
    </div>
</div>
<?php endif; ?>

<?php if ($_SESSION['user_role'] == 'Student') : ?>

    <div class="card shadow-sm" style="border-color: #FCBD32;">
    <div class="card-header" style="background-color: #FCBD32; color: white;">
        <h3 class="card-title" style="color: white;font-family: 'Your Special Font', gagalin;font-size: 2em;" >List of Rewards</h3>
        <!-- Check whether logged in or not -->

    </div>
    <div class="card-body">

    <style>
/* Common table styles for both tables */
/* Common table styles for both tables */
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th, .table td {
    padding: 20px;
    border: 20px solid #dcdcdc; /* Border style for both tables */
    text-align: left;
}

.table th {
    background-color: #183D64; /* Blue */
    color: #ffffff;
}

/* Style for the first table (Administrator and Master Administrator) */
.card-header {
    background-color: #FCBD32; /* Yellow */
    color: white;
}

.btn-light-primary {
    background-color: #183D64 !important; /* Blue */
    color: white !important;
}

/* Style for the second table (Student) */
.card-header {
    background-color: #7C1C2B; /* Red */
    color: white;
}

.btn-light-warning {
    background-color: #7C1C2B !important; /* Red */
    color: white !important;
}

.btn-success[disabled] {
    background-color: #FCBD32 !important; /* Yellow */
    color: white !important;
}


    </style>

        <div class="table-responsive">
            <table id="kt_datatable_posts" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Badge Icon</th>
                        <th>Badge Name</th>
                        <th> Badge Description</th>
                        <th>Activities Joined</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['rewards'] as $reward): ?>
                        <tr>
                        <td>
                            <?php $badge_name_lowercase = strtolower($reward->badge_name); ?>
                            <?php if ($badge_name_lowercase === 'gold'): ?>
                                <img src="<?php echo URLROOT . "/public/images/rewards/2.png" ?>" alt="Gold Badge" style="width: 150px; height: 150px;">
                            <?php elseif ($badge_name_lowercase === 'silver'): ?>
                                <img src="<?php echo URLROOT . "/public/images/rewards/1.png" ?>" alt="Silver Badge" style="width: 150px; height: 150px;">
                            <?php elseif ($badge_name_lowercase === 'bronze'): ?>
                                <img src="<?php echo URLROOT . "/public/images/rewards/3.png" ?>" alt="Bronze Badge" style="width: 150px; height: 150px;">
                            <?php elseif ($badge_name_lowercase === 'diamond'): ?>
                                <img src="<?php echo URLROOT . "/public/images/rewards/4.png" ?>" alt="Diamond Badge" style="width: 150px; height: 150px;">
                            <?php else: ?>
                                <!-- Default image if badge_name doesn't match any of the above -->
                            <?php endif; ?>
                        </td>

                            <td><?php echo $reward->badge_name; ?></td>
                            <td><?php echo $reward->badge_description; ?></td>
                            <td><?php echo $reward->points_required; ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                var table = $('#kt_datatable_posts').DataTable({});
            });
        </script>
    </div>
</div>
<?php endif; ?>


