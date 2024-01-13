<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Approved Personal Activity</h3>
        <div class="card-toolbar">
            
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="kt_datatable_posts" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Personal Activity's Name</th>
                        <th>Date</th>
                        <th>Venue</th>
                        <th>Description</th>
                        <th>Evidence</th>
                        <th>Action</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['perActivity'] as $peractivity): ?>
                        <?php if ($peractivity->status == 'Approved'): ?>
                            <tr>
                                <td><?php echo $peractivity->name; ?></td>
                                <td><?php echo date('F j h:m', strtotime($peractivity->date)); ?></td>
                                <td><?php echo $peractivity->venue; ?></td>
                                <td><?php echo $peractivity->description; ?></td>
                                <td><?php echo $peractivity->evidence; ?></td>
                                <td> <button class="btn btn-success" disabled>Approved</button></td>
                                <td>
                                <form id="commentForm_<?php echo $activity->activity_id; ?>">
                                    <div class="comment-container">
                                        <textarea id="commentInput_<?php echo $activity->activity_id; ?>" placeholder="Type your comment here"></textarea>
                                        <button type="button" onclick="addComment(<?php echo $activity->activity_id; ?>)">Enter</button>
                                    </div>
                                    <div id="reviewText_<?php echo $activity->activity_id; ?>" class="review-text">
                                        <?php if (!empty($activity->review)) echo $activity->review; ?>
                                    </div>
                                </form>
                                </td>
                            </tr>
                        <?php endif; ?>
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

        <script>
            function addComment(activityId) {
                var commentInput = document.getElementById('commentInput_' + activityId);
                var commentText = commentInput.value;

                var reviewText = document.getElementById('reviewText_' + activityId);
                reviewText.innerHTML = commentText;
                commentInput.value = '';
            }
        </script>
    </div>
</div>
