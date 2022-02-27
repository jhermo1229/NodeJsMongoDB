<?php
    class PurchaseHistory {

        private $conn;
        private $table = 'purchase_history';


        //properties

        public $id;
        public $user_id;
        public $cart_id;
        public $purchase_success;

        //constructor with db
        public function __construct($db) {
            $this->conn = $db;
        }


        public function read(){
            //create query

            $query = 'SELECT 
                        id,
                        user_id,
                        cart_id,
                        purchase_success
                        FROM
                        ' .$this->table .'
                        ORDER BY
                            id';


            //Prepared statement

            $stmt = $this->conn->prepare($query);

            //Execute Query
            $stmt->execute();

            return $stmt;
        }

        public function read_single(){
            //create query

            $query = 'SELECT 
                        id,
                        user_id,
                        cart_id,
                        purchase_success
                        FROM
                        ' .$this->table .'
                        WHERE 
                            id = ?
                        LIMIT 0,1';


            //Prepared statement

            $stmt = $this->conn->prepare($query);

            $stmt->bindparam(1, $this->id);

            

            //Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];            
            $this->user_id = $row['user_id'];
            $this->cart_id = $row['cart_id'];
            $this->purchase_success = $row['purchase_success'];        
        }

        public function create() {

            $query = 'INSERT INTO ' . $this->table . '
            SET
                user_id = :user_id,
                cart_id = :cart_id,
                purchase_success = :purchase_success';

            $stmt = $this->conn->prepare($query);

            //Clean data
            // $this->id = htmlspecialchars(strip_tags($this->id));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
            $this->cart_id = htmlspecialchars(strip_tags($this->cart_id));
            $this->purchase_success = htmlspecialchars(strip_tags($this->purchase_success));

            // $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':user_id', $this->user_id);
            $stmt->bindParam(':cart_id', $this->cart_id);
            $stmt->bindParam(':purchase_success', $this->purchase_success);


            if($stmt->execute()){
                return true;
            }
            //Print error
            printf("ERROR: %s.\n", $stmt->error);

            return false;
        }

        

        public function update() {

            $query = 'UPDATE ' . $this->table . '
            SET
            user_id = :user_id,
            cart_id = :cart_id,
            purchase_success = :purchase_success
            WHERE
                id = :id';
            

            $stmt = $this->conn->prepare($query);


            //Clean data
            // $this->id = htmlspecialchars(strip_tags($this->id));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
            $this->cart_id = htmlspecialchars(strip_tags($this->cart_id));
            $this->purchase_success = htmlspecialchars(strip_tags($this->purchase_success));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':user_id', $this->user_id);
            $stmt->bindParam(':cart_id', $this->cart_id);
            $stmt->bindParam(':purchase_success', $this->purchase_success);


            if($stmt->execute()){
                return true;
            }
            //Print error
            printf("ERROR: %s.\n", $stmt->error);

            return false;
        }

        //Delete by ID
        public function delete(){
            // Delete query

            $query ='DELETE FROM ' .$this->table . ' WHERE id = :id';

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()){
                return true;
            }
            //Print error
            printf("ERROR: %s.\n", $stmt->error);

            return false;
             
            }
    }