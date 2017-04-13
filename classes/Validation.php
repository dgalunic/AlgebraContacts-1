<?php

class Validation
{
	private $_passed = false;
	private $_errors = array();
	private $_db = null;
	
	public function __construct()
	{
		$this->_db = DB::getInstance();
	}
	
		public function check($items = array())
    	{
    		foreach ($items as $item => $rules) {
    			foreach($rules as $rule => $rule_value) {

    				$item = escape($item);
    				$value = trim($_POST[$item]);

    				if($rule === 'required' && empty($value)) {
    					$this->addError($item, "Field ".$this->format($item)." is required.");
    				} else if (!empty($value)) {
    					switch($rule) {
    						case 'min':
    							if(strlen($value) < $rule_value) {
    								$this->addError($item, "Field ".$this->format($item)." must have a minimum of {$rule_value} characters.");
    							}
    						break;
    						case 'max':
    							if(strlen($value) > $rule_value) {
    								$this->addError($item, "Field ".$this->format($item)." must have a maximum of {$rule_value} characters.");
    							}
    						break;
    						case 'matches':
    							if($value != $_POST[$rule_value]) {
    								$this->addError($item, "Field ".$this->format($item)." must match field {$rule_value}.");
    							}
    						break;
							/*
                            			case 'pattern':
    							if(!preg_match($rule_value ,$value)) {
                                    				if ($item === 'password') {
									$this->addError($item, "Field ".$this->format($item)." must include <b>at least</b> one <i>uppercase letter</i>, one <i>lowercase letter</i>, one <i>number</i>, and one <i>special character</i>.");
								    }
    							}
    						break;*/
    						case 'unique':
    							$check = $this->_db->get('id', $rule_value, array($item,'=',$value));
    							if($check->count()) {
    								$this->addError($item, $this->format($item)." <i>".$value."</i> already exists.");
    							}
    						break;
    					}
    				}
    			}
    		}

    		if(empty($this->_errors)) {
    			$this->_passed = true;
    		}

    		return $this;
    	}

        private function format($item){
            $item = str_replace("_", " ", $item);
            $item = ucwords($item);

            return "<b>".$item."</b>";
        }
	
	private function addError($item, $error)
	{
		$this->_errors[$item] = $error;
	}
	
	public function hasError($field)
	{
		if(isset($this->_errors[$field])) {
			return $this->_errors[$field];
		}
		
		return false;
	}
	
	public function errors()
	{
		return $this->_errors;
	}
	
	public function passed()
	{
		return $this->_passed;
	}
}
