<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Manage Registration</h3>
        <div class="card-toolbar">
            <?php if(isLoggedIn()): ?>
            <a href="<?php echo URLROOT;?>/registrations/create" class="btn btn-light-primary">Create Form</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body"> <!--Card for tidyness-->
    <div class="table-responsive">
            <table id="kt_datatable_posts" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Activity ID</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['registrations'] as $registration): ?>
                    <tr>
                        <td><?php echo $registration->activity_id; ?></td>
                        <td><?php echo $registration->link; ?></td>
                        <td>

                                <a href="<?php echo URLROOT . "/registrations/update/" .$registration->activity_id ?>" class="btn btn-light-warning">Update</a>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt<?php echo $registration->activity_id?>">
                                    Delete
                                </button>
                                <div class="modal fade" tabindex="-1" id="kt<?php echo $registration->activity_id?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Delete Registration</h3>
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure want to delete this registration?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="<?php echo URLROOT . "/registrations/delete/" .$registration->activity_id; ?>" method="POST">
                                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary font-weight-bold">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
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
    <div class="card-footer">
        Footer
    </div>
</div>