<?php
/**
 * Bootstrap for Lightweight application and modules. Invokes services and modules.
 */
namespace Lightweight;

use Monolog;
use Zend\ServiceManager\ServiceManager;

class Application
{
    /**
     * MVC event token
     * @var
     */
    protected $event;
    
    /**
     * EventManagerInterface 
     * @var
     */
    protected $events;
    
    /**
     * @var ServiceManager
     */
    protected $serviceManager;
    
    /**
     * Constructor
     *
     * @param ServiceManager $serviceManager
     */
    public function __construct(
        ServiceManager $serviceManager
    ) {
            $this->serviceManager = $serviceManager;
   }
   
   /**
    * Retrieve the service manager
    *
    * @return ServiceManager
    */
   public function getServiceManager()
   {
       return $this->serviceManager;
   }
   
   /**
    * Retrieve the application configuration
    *
    * @return array|object
    */
   public function getConfig()
   {
       return $this->serviceManager->get('config');
   }
   
   /**
    * Bootstrap the application
    *
    * Defines and binds the MvcEvent, and passes it the request, response, and
    * router. Attaches the ViewManager as a listener. Triggers the bootstrap
    * event.
    *
    * @param array $listeners List of listeners to attach.
    * @return Application
    */
   public function bootstrap(array $listeners = [])
   {
       $serviceManager = $this->serviceManager;
       $events         = $this->events;
       
       // Setup default listeners
       $listeners = array_unique(array_merge($this->defaultListeners, $listeners));
       
       foreach ($listeners as $listener) {
           $serviceManager->get($listener)->attach($events);
       }
       
       // Setup MVC Event
       /*
       $this->event = $event  = new MvcEvent();
       $event->setName(MvcEvent::EVENT_BOOTSTRAP);
       $event->setTarget($this);
       $event->setApplication($this);
       $event->setRequest($this->request);
       $event->setResponse($this->response);
       $event->setRouter($serviceManager->get('Router'));
       */
       // Trigger bootstrap events
       // $events->triggerEvent($event);
       
       return $this;
   }
   
    
    public static function init($configuration = [])
    {
        echo "Configs loaded from Lightweight\Application \n";
        
        // Prepare the service manager
        // $smConfig = isset($configuration['service_manager']) ? $configuration['service_manager'] : [];
        // $smConfig = new Service\ServiceManagerConfig($smConfig);
        
        $serviceManager = new ServiceManager();
        // $smConfig->configureServiceManager($serviceManager);
        $serviceManager->setService('ApplicationConfig', $configuration);
        
        // Load modules from instance of ModuleManager
        // $serviceManager->get('ModuleManager')->loadModules();
        
        // debugging ServiceManager array structure
        echo "ServiceManager set App Configs array ";
        echo "<pre>";
        print_r($serviceManager->get('ApplicationConfig'));
        echo "</pre>";
        
        $listeners = [];
        
        return $serviceManager->get('ApplicationConfig')->bootstrap($listeners);
        
    }
    
    
    public function run()
    {
        $events = $this->events;
        $event = $this->event;
        
        return true;
        
    }
}



?>