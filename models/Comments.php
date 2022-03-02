<?php
    class Comments {

        private $conn;
        private $table = 'comments';


        //properties

        public $id;
        public $product_id;
        public $user_id;
        public $comment;
        public $rating;

        //constructor with db
        public function __construct($db) {
            $this->conn = $db;
        }


        public function read(){
            //create query

            $query = 'SELECT 
                        id,
                        product_id,
                        user_id,
                        comment,
                        rating
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
                        product_id,
                        user_id,
                        comment,
                        rating
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
            $this->product_id = $row['product_id'];
            $this->user_id = $row['user_id'];
            $this->comment = $row['comment'];
            $this->rating = $row['rating'];            
        }

        public function create() {

            $query = 'INSERT INTO ' . $this->table . '
            SET
                product_id = :product_id,
                user_id = :user_id,
                comment = :comment,
                rating = :rating';

            $stmt = $this->conn->prepare($query);

            //Clean data
            // $this->id = htmlspecialchars(strip_tags($this->id));
            $this->product_id = htmlspecialchars(strip_tags($this->product_id));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
            $this->comment = htmlspecialchars(strip_tags($this->comment));
            $this->rating = htmlspecialchars(strip_tags($this->rating));

            // $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':product_id', $this->product_id);
            $stmt->bindParam(':user_id', $this->user_id);
            $stmt->bindParam(':comment', $this->comment);
            $stmt->bindParam(':rating', $this->rating);


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
            product_id = :product_id,
            user_id = :user_id,
            comment = :comment,
            rating = :rating
            WHERE
                id = :id';
            

            $stmt = $this->conn->prepare($query);


            //Clean data
            // $this->id = htmlspecialchars(strip_tags($this->id));
            $this->product_id = htmlspecialchars(strip_tags($this->product_id));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
            $this->comment = htmlspecialchars(strip_tags($this->comment));
            $this->rating = htmlspecialchars(strip_tags($this->rating));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':product_id', $this->product_id);
            $stmt->bindParam(':user_id', $this->user_id);
            $stmt->bindParam(':comment', $this->comment);
            $stmt->bindParam(':rating', $this->rating);


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