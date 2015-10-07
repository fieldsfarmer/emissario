<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Beans
     */
    public $beans = array();

    /**
     * Whenever a controller is created, open a database connection too. The idea behind is to have ONE connection
     * that can be used by multiple models (there are frameworks that open one connection per model).
     */
    function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadModels();
        $this->loadServices();
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
    }

    public function loadModels()
    {
    	require APP . '/core/model.php';
    	require APP . '/models/friendModel.php';
    	require APP . '/models/helpModel.php';
    	require APP . '/models/messageModel.php';
    	require APP . '/models/travelModel.php';
    	require APP . '/models/wishModel.php';

    	// create new "model" (and pass the database connection)
    	$this->beans["friendModel"] = new FriendModel($this->db);
    	$this->beans["helpModel"] = new HelpModel($this->db);
    	$this->beans["messageModel"] = new MessageModel($this->db);
    	$this->beans["travelModel"] = new TravelModel($this->db);
    	$this->beans["wishModel"] = new WishModel($this->db);
    }

    public function loadServices()
    {
    	require APP . '/core/service.php';
    	require APP . '/services/friendService.php';
    	require APP . '/services/helpService.php';
    	require APP . '/services/messageService.php';
    	require APP . '/services/travelService.php';
    	require APP . '/services/wishService.php';

    	$this->beans["friendService"] = new FriendService($this->beans);
    	$this->beans["helpService"] = new HelpService($this->beans);
    	$this->beans["messageService"] = new MessageService($this->beans);
    	$this->beans["travelService"] = new TravelService($this->beans);
    	$this->beans["wishService"] = new WishService($this->beans);
    }
}
