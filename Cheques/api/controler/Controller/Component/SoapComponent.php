<?php  
    App::import('core', 'AppHelper'); 

    /** 
    * Soap component for handling soap requests in Cake 
    * 
    * @author      Marcel Raaijmakers (Marcelius) 
    * @copyright   Copyright 2009, Marcel Raaijmakers 
    * @license     http://www.opensource.org/licenses/mit-license.php The MIT License 
    */ 
    class SoapComponent extends Component{ 

        var $name = 'Soap'; 

        var $components = array('RequestHandler'); 

        var $controller; 

        var $__settings = array( 
            'wsdl' => false, 
            'wsdlAction' => 'soap_wsdl', 
            'prefix' => null, 
            'action' => array('soap_service'), 
        ); 
		
		public function __construct(ComponentCollection $collection, $settings = array()) {
            //pr($settings);
            parent::__construct($collection, $settings);
            $this->_controller = $collection->getController();
			if (isset($settings['wsdl']) && !empty($settings['wsdl'])){ 
                $this->__settings['wsdl'] = $settings['wsdl'];
            } 

            if (isset($settings['prefix'])){ 
                $this->__settings['prefix'] = $settings['prefix']; 
            } 

            if (isset($settings['action'])){ 
                $this->__settings['action'] = is_array($settings['action']) ? $settings['action'] : array($settings['action']); 
            } 
			parent::initialize($this->_controller); 
        }

        public function startup(Controller $controller){ 
            //pr($this->_controller->params);
            //if (isset($this->_controller->params['soap'])){
				
                if ($this->__settings['wsdl'] != false){ 
				                    //render the wsdl file 
                    if ($this->action() == $this->__settings['wsdlAction']){
                 //  	pr(DS . 'wsdl' . DS . $this->__settings['wsdl']);
					 // Configure::write('debug', 1); 
                      $this->RequestHandler->respondAs('xml'); 
                      $this->_controller->ext = '.wsdl'; 
                    //  $this->_controller->render('/wsdl' . DS . $this->__settings['wsdl']);
					  $this->_controller->render(DS . 'wsdl' . DS . $this->__settings['wsdl']); //only works with short open tags set to false! 
                    } elseif(in_array($this->action(), $this->__settings['action'])) { 
                        //handle request 
                        ini_set('soap.wsdl_cache_enabled', 0);
                       // $soapServer = new SoapServer('http://10.1.1.18/web/htdocs/solemti/soap/messages/wsdl');
                        $soapServer = new SoapServer($this->wsdlUrl()); 
						$soapServer->setObject($this->_controller);
                        $soapServer->handle(); 
                        //stop script execution 
                        $this->_stop(); 
                        return false; 
                    } 
                } 
            //} 
        } 
        /** 
         * Return the current action 
         * 
         * @return string 
         */ 
        public function action(){ 
            return (!empty($this->__settings['prefix'])) ? str_replace( $this->__settings['prefix'] . '_', '',  $this->_controller->action) : $this->_controller->action; 
        } 
		 public function wsdlUrl(){ 
            return AppHelper::url(array('controller'=>Inflector::underscore($this->controller->name), 'action'=>$this->__settings['wsdlAction'], $this->__settings['prefix'] => true), true); 
        } 

    } 
?>