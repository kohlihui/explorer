<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Create Registration</h3>
        <div class="card-toolbar">
            <?php if(isLoggedIn()): ?>
            <a href="<?php echo URLROOT;?>/registration" class="btn btn-light-primary">Manage Registration</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">


        <form action="<?php echo URLROOT; ?>/registration/create" method="POST">
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Link</label>
                <input type="text" name="link" class="form-control form-control-solid" placeholder="Title" required />
            </div>

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="form-label">Activity ID</label>
                <div class="position-relative">
                    <div class="required position-absolute top-0"></div>
                    <textarea name="activity_id" class="form-control" aria-label="With textarea" required></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>

        </form>

    </div>
    <div class="card-footer">
        Footer
    </div>
</div>