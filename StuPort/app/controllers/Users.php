<?php
class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() {
        $data = [
            'username' => '',
            'email' => '',
            'full_name' => '',
            'telephone' => '',
            'age' => '',
            'race' => '',
            'gender' => '',
            'password' => '',
            'confirmPassword' => '',
            'user_role' => '',  
            'address' => '',
            'institution' => '',
            'course' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => '',
            'fullNameError' => '',  // Add these lines to initialize the new keys
            'genderError' => '',
            'ageError' => '',
            'addressError' => '',
            'courseError' => '',
            'institutionError' => '',
        ];
        

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'full_name' => trim($_POST['full_name']),
                'telephone' => trim($_POST['telephone']),
                'age' => trim($_POST['age']),
                'race' => trim($_POST['race']),
                'gender' => trim($_POST['gender']),
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'user_role' => isset($_POST['user_role'])? $_POST['user_role'] : '',  // Add user role to the data array
                'address' => trim($_POST['address']),
                'institution' => trim($_POST['institution']),
                'course' => trim($_POST['course']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
                'fullNameError' => '',  // Add these lines to initialize the new keys
                'genderError' => '',
                'ageError' => '',
                'addressError' => '',
                'courseError' => '',
                'institutionError' => ''
                //'userRoleError' => ''  // Add user role error to the data array
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
     

            //Validate username on letters/numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username.';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters and numbers.';
            }

            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email address.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct format.';
            } else {
                //Check if email exists.
                if ($this->userModel->findUserByEmail($data['email'])) {
                $data['emailError'] = 'Email is already taken.';
                }
            }

           // Validate password on length, numeric values,
            if(empty($data['password'])){
              $data['passwordError'] = 'Please enter password.';
            } elseif(strlen($data['password']) < 6){
              $data['passwordError'] = 'Password must be at least 8 characters';
            } 

            //Validate confirm password
             if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
                }
            }
            // Validate user role



            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Assign the user role to the $data array
                //$data['user_role'] = $_POST['user_role'];


                if ($data['user_role'] == "Student") {
                    $this->userModel->registerStudent($data);
                    header('location:'. URLROOT . '/user/login');
                }
            }

        }
        $this->view('users/register', $data);
      }  // This brace was moved to the correct position

     

      public function login() {
        $data = [
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => '',
            'user_role' => '',  // Add a default user role or fetch it from the database during login
        ];
    
        // Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
                'user_role' => '',  // Add a default user role or fetch it from the database during login
            ];
            // Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username.';
            }
    
            // Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password.';
            }
    
            // Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                // Fetch user details from the database including the user role
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);
    
                if ($loggedInUser) {
                    // Assign the user role to the $data array
                    $data['user_role'] = $loggedInUser->user_role;
    
                    // Create user session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Password or username is incorrect. Please try again.';
                }
            }
        } else  {
            $data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => '',
                'user_role' => '',  // Add a default user role or fetch it from the database during login
            ];
        }
    
        $this->view('users/login', $data);
    }
    





    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
        $_SESSION['user_role'] = $user->user_role;

    
        // Redirect based on user_role
        if ($user->user_role == 'Administrator') {
            header('location:' . URLROOT . '/pages/dashboard_administrator');
        } elseif ($user->user_role == 'Master Administrator') {
            header('location:' . URLROOT . '/pages/dashboard_masteradministrator');
        } elseif ($user->user_role == 'Student') {
            // Default redirect for other user roles
            header('location:' . URLROOT . '/pages/dashboard_student');
        } else {
            echo "User_role undefined.";
            header('location:' . URLROOT . '/users/login');
        }
    }
    
    
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['user_role']);
        header('location:' . URLROOT . '/users/login');
    }
}