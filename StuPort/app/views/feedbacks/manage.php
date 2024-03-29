<link rel="stylesheet" type="text/css" href="path/to/styles.css">
    <div class="card shadow-sm" style="border-color: #FCBD32;">
    <div class="card-header" style="background-color: #FCBD32; color: white;">
        <h3 class="card-title" style="color: white;font-family: 'Your Special Font', gagalin;font-size: 2em;">Manage Feedback</h3>
        <div class="card-toolbar">
            <?php if(isLoggedIn()): ?>
            <a href="<?php echo URLROOT;?>/activities" class="btn btn-light-primary" style="background-color: #183D64; color: white;">Select Activity</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body"> <!--Card for tidyness-->

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
                        <th>Activity Code No</th>
                        <th>Feedback Form Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!--loop through each feedback-->
                    <?php foreach($data['feedbacks'] as $feedback): ?> 
                    <tr>
                        <td><?php echo $feedback->activity_id; ?></td>
                        <td><?php echo '<a href="' . $feedback->link_form . '">' . $feedback->link_form . '</a>'; ?></td>
                        <td>
                            
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#kt<?php echo $feedback->feedback_id?>">
                                Delete
                                </button>

                                <div class="modal fade" tabindex="-1" id="kt<?php echo $feedback->feedback_id?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Delete Feedback</h3>

                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                            class="path2"></span></i>
                                                </div>
                                                <!--end::Close-->
                                            </div>

                                            <div class="modal-body">
                                                Are you sure want to delete this feedback form link for this activity?
                                            </div>

                                            <div class="modal-footer"style="background-color: #FCBD32; color: white;">
                                                <form action="<?php echo URLROOT . "/feedbacks/delete/" . $feedback->feedback_id; ?>"
                                                    method="POST">
                                                    <input type="hidden" id="activity_id" name="activity_id" value="<?php echo $feedback->activity_id; ?>">
                                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                                        data-dismiss="modal">Back</button>
                                                    <button type="submit"
                                                        class="btn btn-primary font-weight-bold">Delete</button>
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
            var table = $('#kt_datatable_posts').DataTable({

            });
        });
        </script>


    </div>
    <div class="card-footer">
        Footer
    </div>
</div>