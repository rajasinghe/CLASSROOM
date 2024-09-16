<?php

    trait UserModel{

        public function getLoginCredentials($userName){
            $query="SELECT * from user WHERE username = '$userName'";

            $results = DB::select($query);

            if(count($results) < 1) return [];

            return $results[0];
        }

        public function saveLoginRecord($user){
            $query = "INSERT INTO login_records(user_id,session_id,session_condition) VALUES(?,?,'ACTIVE')";

            $conn = DB::getConnection();

            $stmnt = $conn->prepare($query);

            $id = $user['id'];
            $session_id = $user['session_token'];

            $stmnt->bind_param("is",$id,$session_id);

            return $stmnt->execute();
        }

        public function endLoginSession($user){
            $query = "UPDATE SET session_condition = 'DEACTIVE' WHERE user_id = ? AND session_id = ?";

            $conn = DB::getConnection();

            $stmnt = $conn->prepare($query);

            $id = $user['user_id'];
            $session_id = $user['session_token'];

            $stmnt->bind_param("is",$id,$session_id);

            return $stmnt->execute();
        }

        public function handleSessionTimeOut(){
            if((isset($_SERVER['HTTP_CONTENT_TYPE']) && $_SERVER['HTTP_CONTENT_TYPE'] === 'application/json')){
                echo json_encode([
                    'condition' => 'failed',
                    'errorType' => 'SESSION_TIMEOUT',
                    'redirectTo' => '/login'
                ]);
                return;
            }

            header("Location: /login");
        }
    }