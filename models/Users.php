<?php
    class Users {

        private $conn;
        private $table = 'users';


        //properties

        public $id;
        public $username;
        public $password;
        public $first_name;
        public $last_name;
        public $address;
        public $shipping_address;
        public $email;
        public $mobile_number;

        //constructor with db
        public function __construct($db) {
            $this->conn = $db;
        }


        public function read(){
            //create query

            $query = 'SELECT 
                        id,
                        username,
                        password,
                        first_name,
                        last_name,
                        address,
                        shipping_address,
                        email,
                        mobile_number
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
                        username,
                        password,
                        first_name,
                        last_name,
                        address,
                        shipping_address,
                        email,
                        mobile_number
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
            $this->username = $row['username'];
            $this->password = $row['password'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->address = $row['address'];
            $this->shipping_address = $row['shipping_address'];
            $this->email = $row['email'];
            $this->mobile_number = $row['mobile_number'];

            
        }

        public function create() {

            $query = 'INSERT INTO ' . $this->table . '
            SET
                username = :username,
                password = :password,
                first_name = :first_name,
                last_name = :last_name,
                address = :address,
                shipping_address = :shipping_address,
                email = :email,
                mobile_number = :mobile_number';

            $stmt = $this->conn->prepare($query);

            //Clean data
            // $this->id = htmlspecialchars(strip_tags($this->id));
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->first_name = htmlspecialchars(strip_tags($this->first_name));
            $this->last_name = htmlspecialchars(strip_tags($this->last_name));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->shipping_address = htmlspecialchars(strip_tags($this->shipping_address));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->mobile_number = htmlspecialchars(strip_tags($this->mobile_number));

            // $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':first_name', $this->first_name);
            $stmt->bindParam(':last_name', $this->last_name);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':shipping_address', $this->shipping_address);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':mobile_number', $this->mobile_number);


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
            username = :username,
            password = :password,
            first_name = :first_name,
            last_name = :last_name,
            address = :address,
            shipping_address = :shipping_address,
            email = :email,
            mobile_number = :mobile_number
            WHERE
                id = :id';
            

            $stmt = $this->conn->prepare($query);


            //Clean data
            // $this->id = htmlspecialchars(strip_tags($this->id));
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->first_name = htmlspecialchars(strip_tags($this->first_name));
            $this->last_name = htmlspecialchars(strip_tags($this->last_name));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->shipping_address = htmlspecialchars(strip_tags($this->shipping_address));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->mobile_number = htmlspecialchars(strip_tags($this->mobile_number));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':first_name', $this->first_name);
            $stmt->bindParam(':last_name', $this->last_name);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':shipping_address', $this->shipping_address);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':mobile_number', $this->mobile_number);


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