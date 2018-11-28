<?php
require_once "config/config.php";
class DB
{
    protected static $connection = NULL;
    public $db;
    protected $_table;
    protected $_fields = [];
    protected $_defaultFields = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $clause;
    protected $values;
    protected $trimmedclause;
    protected $primaryKey = 'id';
    protected $_logindetails = [

        
    ];
    protected function connect()
    {
        try
        {
           
            if(is_null(self::$connection))
            {
                self::$connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
                return self::$connection;
            }
            
            return self::$connection;
            

        }
        catch(PDOExeption $e)
        {
            // echo "connection failed".$e ->getMessage();
            die();

        }
       
    }

    /**
     * set table fields
     *
     * @param string ...$fileds
     * @return void
     */
    public function setFields(string ...$fileds)
    {
        $this->_fields = $fileds;
    }

    /**
     * get table fields
     *
     * @return array
     */
    public function getFields() : array
    {
        return $this->_fields;
    }

    /**
     * set table name
     *
     * @param string $name
     * @return void
     */
    public function setTable(string $name) 
    {
        $this->_table = $name;
    }

    /**
     * get table name
     *
     * @return string
     */
    public function getTable() :string 
    {
        return $this->_table; 
    }

    /**
     * data insert 
     *
     * @param array $args
     * @return boolean
     */
     public function insert(array $args) :bool
     {
        $sql = "INSERT INTO {$this->getTable()} ({$this->arrayToFields()}) VALUES ({$this->arrayToNamedPlaceholders()})";
        $stmt = self::$connection->prepare($sql);
        return $stmt->execute($args);
     }

     /**
      * Undocumented function
      *
      * @return string
      */
     protected function arrayToFields() :string
     {
        return implode(',',$this->getFields());
     }
    
     /**
      * Undocumented function
      *
      * @return string
      */
     protected function arrayToNamedPlaceholders() :string
     {
         $fields = '';
         foreach($this->getFields() as $field) {
             $fields .= ":".$field.',';
         } 
        
         $fields = rtrim($fields,',');

         return $fields;
     }/**
      * Undocumented function
      *
      * @return void
      */
     public function getAllRecord()
     {
     $sql = "SELECT {$this->arrayToFields()} FROM {$this->getTable()}";
     $stmt = self::$connection->prepare($sql);
     $stmt->execute();
     while($row = $stmt->fetch())
     {
         print_r($row);
     }
        
    }
    /**
     * get record from database
     *
     * @param integer $id
     * @return void
     */
     public function getRecord(int $id):array 
    {
     $sql = "SELECT {$this->arrayToFields()} FROM {$this->getTable()} WHERE id=$id";
     $stmt = self::$connection->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetch();
     return $result;
        
    }

    /**
     * get record from database using where clause
     *
     * @param String $clause
     * @return array
     */
    public function whereClause(array $args) 
    {   $row = [];
        // print_r($args);
        
        $this->arrayToClause($args);

        
    // $sql ="SELECT {$this->arrayToFields()} FROM {$this->getTable()} ";
    $sql ="SELECT * FROM {$this->getTable()} ";
    $sql .='WHERE ';
    $sql .=$this->trimmedclause;
    
    $stmt = self::$connection->prepare($sql);
    foreach($args as $key => $value)
    {    
        
        
        $stmt->bindValue(":$key", $value);
    }
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $row;
   

    }
  
   public function arrayToClause(array $args)
   {
    foreach($args as $key => $value )
    {
      $this->clause .= "$key =:$key AND ";
      
    }
    $this->trimmedclause = rtrim($this->clause,"AND ");
    $this->trimmedclause;
   }
   public function duplicateEmail(String $email) 
   {   
        $args = [
       'email'=>$email,
        ];
        $result = $this->whereClause($args);
        return $result;
       
   }
//    public function deletefield($id)
//    {
//    $status = FALSE;
//    $sql = "DELETE FROM {$this->getTable()} WHERE id =:id";

//    $stmt = self::$connection->prepare($sql);
//    $stmt->bindvalue(':id',$id);
//    $stmt->execute();
//    $count = $stmt->row_count();
//    if($count>0)
//    {
//        $status = TRUE;
//    }
//    return $status;

//     }
    public function updatefield($id,$name,$description,$updated_at): bool
    {

    $status = FALSE;    
    $sql = "UPDATE {$this->getTable()} SET name =:name,description =:description,updated_at =:updated_at WHERE id= :id";
    $stmt = self::$connection->prepare($sql);
    $stmt->bindValue(':name',$name);
    $stmt->bindValue(':description',$description);
    $stmt->bindValue(':id',$id);
    $stmt->bindValue(':updated_at',$updated_at);
    if($stmt->execute())
    {
        $status = TRUE;

    }
    
    return $status;

    }
    public function getId():array
    {
    $row = [];
    $sql = "SELECT id from {$this->getTable()}";
    $stmt = self::$connection->prepare($sql);
     if($stmt->execute())
     {
         $row = $stmt->fetchAll();
     }

     return $row;
    }

  public function delete($id,$deleted_at)
  { $status = FALSE;
    $sql = "UPDATE {$this->getTable()} SET deleted_at = :deleted_at WHERE id= :id";
    $stmt = self::$connection->prepare($sql);
    $stmt->bindValue(':deleted_at',$deleted_at);
    $stmt->bindValue(':id',$id);
    if($stmt->execute())
    {
        $status = TRUE;
    }
    return $status;
  }
   


   


     
   
}



?>