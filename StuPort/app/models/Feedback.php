<?php

class Feedback {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function manageAllFeedbacks(){
        $this->db->query('SELECT * FROM feedbacks');

        $results=$this->db->resultSet();

        return $results;
    }

    public function addFeedback($data)
    {
        $this->db->query('INSERT INTO feedbacks (link_form, activity_id) VALUES (:link_form, :activity_id)');
        
        $this->db->bind(':link_form', $data['link_form']);
        $this->db->bind(':activity_id', $data['activity_id']);

        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function findFeedbackById($id)
    {
        $this->db->query('SELECT * FROM feedbacks WHERE feedback_id = :feedback_idd');
        $this->db->bind(':feedback_id', $feedback_id);

        $row = $this->db->single();

        return $row;
    }
}
?>