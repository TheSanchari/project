<?php
class Validation
{
    
    public $valid = FALSE;
    public $error;
    public $userInput;
    public $fieldstatus;



    public function __construct(array $args)
    {
     
        $this->userInput = $args;
        $this->initInputStatus();
        $this->initErrors();


    }

    private function initInputStatus(){
        foreach($this->userInput as $input => $val ) {
            $this->fieldstatus[$input] = false;
        }
    }

    private function initErrors(){
        foreach($this->userInput as $input => $val) {
            $this->error[$input] = [];
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function checkFormValidity(){
        foreach($this->fieldstatus as $status) {
            if($status === FALSE) {
                return;
            }
        }

        $this->valid = TRUE;
    }

  /**
   * Undocumented function
   *
   * @param String $fieldname
   * @param String $rules
   * @return void
   */
    public function rules(String $fieldname,String $rules) 
    {
        
        
        
       
        $rulesArr = explode('|',$rules);
        foreach($rulesArr as $rule)
        {
            $this->{$rule}($fieldname);

           
            

        }

        
    
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function required(string $fieldname)
    {   
    //    print_r($this->userInput[$fieldname]);
        echo "<br>";
         if(empty($this->userInput[$fieldname]))
            {

                $this->error[$fieldname][] = "please enter the ".$fieldname;
                return;
            }

            $this->fieldstatus[$fieldname] = TRUE;
    }
    // public function selected(string $fieldname)
    // {
    //     if(empty())
    //     {
    //         $this->error[$fieldname][] = "Please select the privacy";
    //         return;
    //     }

    // }


    public function email($fieldname)
    {
        if (!filter_var($this->userInput[$fieldname], FILTER_VALIDATE_EMAIL) && !empty($this->userInput[$fieldname])) 
        {
            $this->error[$fieldname][] = "Please enter a valid email address";
            return;
        }
        if(!empty($this->userInput[$fieldname]))
        {
            $this->fieldstatus[$fieldname] = TRUE;
        }

       
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function valid() :bool
    {   
        $this->checkFormValidity();
        // echo "<pre>";
        // print_r( $this->fieldstatus);
        return $this->valid;
    }

    public function exclude(string ...$fields)
    {
        foreach($fields as $field)
        {
            unset($this->error[$field]);
            unset($this->fieldstatus[$field]);
            unset($this->userInput[$field]);
        }
        


    }
    public function geterror()
    {
        return $this->error;

    }


   


}
?>