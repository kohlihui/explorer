<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">List of Rewards</h3>
        <!-- Check whether logged in or not -->
        <div class="card-toolbar">
            <?php if (isLoggedIn()): ?>
                <a href="<?php echo URLROOT; ?>/rewards/create" class="btn btn-light-primary">Create Rewards</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
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
                            <td><img src="<?php echo $reward->badge_icon_path ?>" alt="Badge Icon" style="width: 90px; height: 90px;"></td>
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
