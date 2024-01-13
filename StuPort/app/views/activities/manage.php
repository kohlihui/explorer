<link rel="stylesheet" type="text/css" href="path/to/styles.css">
<?php if ($_SESSION['user_role'] == 'Administrator' || $_SESSION['user_role'] == 'Master Administrator') : ?>
<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Manage Activities</h3>
        <div class="card-toolbar">
            <?php if (isLoggedIn()): ?>
                <a href="<?php echo URLROOT; ?>/activities/create" class="btn btn-light-primary">Create</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="kt_datatable_posts" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Title</th>
                        <th>Category</th>
                        <th>Content</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Organizer Name</th>
                        <th>Skill Acquired</th>
                        <th>Attachment</th>
                        <th>Action</th>
                        <th>Feedback given</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['activities'] as $activity): ?>
                        <tr>
                            <td><?php echo $activity->title; ?></td>
                            <td><?php echo $activity->category; ?></td>
                            <td><?php echo $activity->activity_desc; ?></td>
                            <td><?php echo date('F j h:m', strtotime($activity->act_datetime)); ?></td>
                            <td><?php echo $activity->location; ?></td>
                            <td><?php echo $activity->organizer_name; ?></td>
                            <td><?php echo $activity->skill_acquired; ?></td>
                            <td>
                                <img src="<?php echo $activity->attachment; ?>" alt="Attachment">
                            </td>
                            <td>
                                    <a href="<?php echo URLROOT . "/activities/update/" . $activity->activity_id ?>" class="btn btn-light-warning">Update</a>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt<?php echo $activity->activity_id ?>">
                                        Delete
                                    </button>
                                    <div class="modal fade" tabindex="-1" id="kt<?php echo $activity->activity_id?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Delete Activity</h3>
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure want to delete this activity?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="<?php echo URLROOT . "/activities/delete/" . $activity->activity_id; ?>" method="POST">
                                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary font-weight-bold">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </td>
                            <td>
                                <?php
                                if (!empty($activity->link_form)) {
                                    echo '<a href="' . $activity->link_form . '">' . $activity->link_form . '</a>';
                                } else {
                                    echo '<a href="' . URLROOT . '/feedbacks/create/?activity_id=' . $activity->activity_id . '" class="btn btn-light-primary">Add Feedback</a>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                var table = $('#kt_datatable_posts').DataTable({});
            });
        </script>
</div>
<?php endif; ?>

<?php if ($_SESSION['user_role'] == 'Student') : ?>
<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Activities</h3>
        <div class="card-toolbar">
            <?php if (isLoggedIn()): ?>
                <!-- Need to change later -->
                <a href="<?php echo URLROOT; ?>/activities/create" class="btn btn-light-primary">Create</a> 
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="kt_datatable_posts" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Title</th>
                        <th>Category</th>
                        <th>Content</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Organizer Name</th>
                        <th>Skill Acquired</th>
                        <th>Attachment</th>
                        <th>Action</th>
                        <th>Feedback need to filled after event</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['activities'] as $activity): ?>
                        <tr>
                            <td><?php echo $activity->title; ?></td>
                            <td><?php echo $activity->category; ?></td>
                            <td><?php echo $activity->activity_desc; ?></td>
                            <td><?php echo date('F j h:m', strtotime($activity->act_datetime)); ?></td>
                            <td><?php echo $activity->location; ?></td>
                            <td><?php echo $activity->organizer_name; ?></td>
                            <td><?php echo $activity->skill_acquired; ?></td>
                            <td>
                                <img src="<?php echo $activity->attachment; ?>" alt="Attachment">
                            </td>
                            <td>
                                    <?php if ($this->activityModel->isStudentJoined($_SESSION['user_id'], $activity->activity_id)) : ?>
                                        <button class="btn btn-success" disabled>Join</button>
                                    <?php else : ?>
                                        <a href="<?php echo URLROOT . "/activities/join/" . $activity->activity_id ?>" class="btn btn-light-warning">Join</a>
                                    <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($activity->link_form)) {
                                    echo '<a href="' . $activity->link_form . '">' . $activity->link_form . '</a>';
                                } else {
                                    echo 'Feedback is not given yet.';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                var table = $('#kt_datatable_posts').DataTable({});
            });
        </script>
</div>
<?php endif; ?>

<!-- <?php if ($_SESSION['user_role'] == 'Lecturer') : ?>
<?php endif; ?> -->
