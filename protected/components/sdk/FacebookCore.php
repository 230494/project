<?php

	class FacebookCore extends CApplicationComponent {

	        protected $_appId;

	        protected $_appSecret;

	        protected $_facebook;
	        public function init(){
	                parent::init();
	        }
	        public function getFacebook(){
	                if($this->_facebook!==null)
	                        return $this->_facebook;
	                Yii::import('application.components.sdk.Facebook');
	                $this->_facebook=new Facebook(array(
	                        'appId'=>$this->getAppId(),
	                        'secret'=>$this->getAppSecret(),
	            'cookie'=>true,
	                ));

	                return $this->_facebook;
	        }
	        public function setAppId($str){
	                $this->_appId=$str;
	        }
	        public function getAppId(){
	                return $this->_appId;
	        }
	        public function setAppSecret($str){

	                $this->_appSecret=$str;

	        }
	        public function getAppSecret(){

	                return $this->_appSecret;
	        }
	        public function __call($method, $args) {
	                $facebook=$this->getFacebook();

	                if(method_exists($facebook, $method)){
	                        return call_user_func_array(array($facebook, $method), $args);
	                }
	        }
	}