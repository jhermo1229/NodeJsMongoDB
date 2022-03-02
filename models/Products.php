<?php
    class Products {

        private $conn;
        private $table = 'products';


        //properties

        public $id;
        public $product_name;
        public $description;
        public $image_url;
        public $cost;

        //constructor with db
        public function __construct($db) {
            $this->conn = $db;
        }


        public function read(){
            //create query

            $query = 'SELECT 
                        c.id,
                        c.product_name,
                        c.description,
                        c.image_url,
                        c.cost
                        FROM
                        ' .$this->table . ' c
                        ORDER BY
                            c.id';


            //Prepared statement

            $stmt = $this->conn->prepare($query);

            //Execute Query
            $stmt->execute();

            return $stmt;
        }

        public function read_single(){
            //create query

            $query = 'SELECT 
                        c.id,
                        c.product_name,
                        c.description,
                        c.image_url,
                        c.cost
                        FROM
                        ' .$this->table . ' c
                        WHERE 
                            c.id = ?
                        LIMIT 0,1';


            //Prepared statement

            $stmt = $this->conn->prepare($query);

            $stmt->bindparam(1, $this->id);

            

            //Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->product_name = $row['product_name'];
            $this->description = $row['description'];
            $this->image_url = $row['image_url'];
            $this->cost = $row['cost'];

            
        }

        public function create() {

            $query = 'INSERT INTO ' . $this->table . '
            SET
                description = :description,
                product_name = :productName,
                image_url = :url,
                cost = :cost';

            $stmt = $this->conn->prepare($query);

            //Clean data
            // $this->id = htmlspecialchars(strip_tags($this->id));
            $this->productName = htmlspecialchars(strip_tags($this->productName));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->url = htmlspecialchars(strip_tags($this->url));
            $this->cost = htmlspecialchars(strip_tags($this->cost));

            // $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':productName', $this->productName);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':url', $this->url);
            $stmt->bindParam(':cost', $this->cost);


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
                description = :description,
                product_name = :productName,
                image_url = :url,
                cost = :cost
                WHERE
                id = :id';

            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->productName = htmlspecialchars(strip_tags($this->productName));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->url = htmlspecialchars(strip_tags($this->url));
            $this->cost = htmlspecialchars(strip_tags($this->cost));
            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':productName', $this->productName);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':url', $this->url);
            $stmt->bindParam(':cost', $this->cost);


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