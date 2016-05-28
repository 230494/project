 <?php
 class EWebUser extends CWebUser{ 
	protected $_model;
	protected function loadUser() { 
		if ( $this->_model === null ) { 
			$this->_model = Admin::model()->findByPk($this->id); 
		} 
		return $this->_model; 
	} 
	
	function getLevel() {
		$user=$this->loadUser(); 
		if($user)  return $user->id_level; 
		return 100;	
	} 
	
	function getUsername() {
		$user=$this->loadUser(); 
		if($user)  return $user->username; 
		return 100;	
	} 
	
	
	
}
 
 
 
 
 
 ?>