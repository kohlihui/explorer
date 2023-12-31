<?php
class Feedbacks extends Controller {
    public function __construct() {
        $this->feedbackModel = $this->model('feedback');
    }

    public function index() {
        $feedback = $this->feedbackModel->manageAllFeedbacks();

        $data= [

            'feedbacks' => $feedback

        ];

        $this->view('feedbacks/index', $data);
    }

    public function create()
    {

        $data = 
        [
            'link_form' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = 
            [
            'activity_id' => $_POST['activity_id'],
            'link_form' => trim($_POST['link_form'])
            ];


            if ($data['link_form']){
                if ($this->feedbackModel->addFeedback($data)){
                    header("Location: " . URLROOT. "/feedbacks" );
                }
                else
                {
                    die("Something went wrong :(");
                }
            }
            else
            {
                $this->view('feedbacks/index', $data);
            }
        }

        $activity_id = $_GET['activity_id'];


        $activity = $this->feedbackModel->findActivityById($activity_id);

        $data = 
        [
            'activity' => $activity
        ];

        $this->view('feedbacks/index', $data);
    }

    public function edit($id)
    {
        $feedback = $this->feedbackModel->findFeedbackById($id);

        $data = 
        [
            'feedback' => $feedback,
            'link_form' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = 
            [
            'feedback_id' => $feedback_id,
            'feedback' => $feedback,
            'activity_id' => $_SESSION['id'],
            'link_form' => trim($_POST['link_form'])
            ];


            if (empty($data['link_form'])){
                if ($this->feedbackModel->editFeedback($data)){
                    header("Location: " . URLROOT. "/feedbacks" );
                }
                else
                {
                    die("Something went wrong :(");
                }
            }
            else
            {
                $this->view('feedbacks/index', $data);
            }
        }

        $this->view('feedbacks/index', $data);
    }

    public function delete($feedback_id)
    {
        $feedback = $this->feedbackModel->findFeedbackById($feedback_id);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($this->feedbackModel->deleteFeedback($feedback_id)){
            header("Location: " . URLROOT . "/feedbacks");
            }
            else
            {
                die('Something went wrong..');
            }
         }
    }

    public function findFeedbackById($feedback_id)
    {
        $this->db->query('SELECT * FROM feedbacks WHERE feedback_id = :feedback_id');
        $this->db->bind(':feedback_id', $feedback_id);

        $row = $this->db->single();

        return $row;
    }

}
?>