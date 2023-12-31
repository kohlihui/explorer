<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Edit Feedback Form Link</h3>
        <div class="card-toolbar">
            <?php if(isLoggedIn()): ?>
            <a href="<?php echo URLROOT;?>/feedbacks" class="btn btn-light-primary">Back</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">


        <form action="<?php echo URLROOT; ?>/feedbacks/edit/<?php echo $data['feedback']->feedback_id ?>" method="POST">
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Link:</label>
                <input type="text" name="link_form" class="form-control form-control-solid" value="<?php echo $data['feedback']->link_form ?>" required />
            </div>

            <!--<div class="mb-10">
                <label for="exampleFormControlInput1" class="form-label">Content</label>
                <div class="position-relative">
                    <div class="required position-absolute top-0"></div>
                    <textarea name="body" class="form-control" aria-label="With textarea" required></textarea>
                </div>
            </div> -->

            <button type="submit" class="btn btn-primary font-weight-bold">Submit</button> 

        </form>

    </div>
    <div class="card-footer">
        Footer
    </div>
</div>