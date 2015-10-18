<?php
if (session_status() == PHP_SESSION_NONE)
{
	session_start();
}

class Application
{
	/** @var null The controller */
	private $url_controller = null;

	/** @var null The method (of the above controller), often also named "action" */
	private $url_action = null;

	/** @var array URL parameters */
	private $url_params = array();

	/** @var null Database Connection */
	private $db = null;

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        // create array with URL parts in $url
        $this->getUrlWithoutModRewrite();

		$GLOBALS["beans"] = new stdClass();
		$this->openDatabaseConnection();
		$this->loadServices();
		$this->loadHelpers();

        // check for controller: no controller given ? then load start-page
        if (!$this->url_controller) {

            require APP . 'controllers/home.php';
            $page = new Home();
            $page->index();

        } elseif (file_exists(APP . 'controllers/' . $this->url_controller . '.php')) {
            // here we did check for controller: does such a controller exist ?

        	// If user is not logged in, restrict to the login page only
			$this->checkLoggedIn();

            // if so, then load this file and create this controller
            // example: if controller would be "car", then this line would translate into: $this->car = new car();
            require APP . 'controllers/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();

            // check for method: does such a method exist in the controller ?
            if (method_exists($this->url_controller, $this->url_action)) {

                if(!empty($this->url_params)) {
                    // Call the method and pass arguments to it
                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                } else {
                    // If no parameters are given, just call the method without parameters, like $this->home->method();
                    $this->url_controller->{$this->url_action}();
                }

            } else {
                if(strlen($this->url_action) == 0) {
                    // no action defined: call the default index() method of a selected controller
                    $this->url_controller->index();
                }
                else {
                    // defined action not existent: show the error page
                    require APP . 'controllers/error.php';
                    $page = new Error();
                    $page->index();
                }
            }
        } else {
            require APP . 'controllers/error.php';
            $page = new Error();
            $page->index();
        }
    }

    /**
     * Get and split the URL
     */
    private function getUrlWithoutModRewrite()
    {
        // TODO the "" is weird
        // get URL ($_SERVER['REQUEST_URI'] gets everything after domain and domain ending), something like
        // array(6) { [0]=> string(0) "" [1]=> string(9) "index.php" [2]=> string(10) "controller" [3]=> string(6) "action" [4]=> string(6) "param1" [5]=> string(6) "param2" }
        // split on "/"
        $url = explode('/', $_SERVER['REQUEST_URI']);
        // also remove everything that's empty or "index.php", so the result is a cleaned array of URL parts, like
        // array(4) { [2]=> string(10) "controller" [3]=> string(6) "action" [4]=> string(6) "param1" [5]=> string(6) "param2" }
        $url = array_diff($url, array('', 'index.php'));
        // to keep things clean we reset the array keys, so we get something like
        // array(4) { [0]=> string(10) "controller" [1]=> string(6) "action" [2]=> string(6) "param1" [3]=> string(6) "param2" }
        $url = array_values($url);

        // if first element of our URL is the sub-folder (defined in config/config.php), then remove it from URL
        if (defined('URL_SUB_FOLDER') && !empty($url[0]) && $url[0] === URL_SUB_FOLDER) {
            // remove first element (that's obviously the sub-folder)
            unset($url[0]);
            // reset keys again
            $url = array_values($url);
        }

        // Put URL parts into according properties
        // By the way, the syntax here is just a short form of if/else, called "Ternary Operators"
        // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
        $this->url_controller = isset($url[0]) ? $url[0] : null;
        $this->url_action = isset($url[1]) ? $url[1] : null;

        // Remove controller and action from the split URL
        unset($url[0], $url[1]);

        // Rebase array keys and store the URL params
        $this->url_params = array_values($url);

        // for debugging. uncomment this if you have problems with the URL
        //echo 'Controller: ' . $this->url_controller . '<br>';
        //echo 'Action: ' . $this->url_action . '<br>';
        //echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
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

	private function loadHelpers()
	{
		require APP . '/helpers/queryHelper.php';
		require APP . '/helpers/siteHelper.php';
		require APP . '/helpers/stringHelper.php';

		$GLOBALS["beans"]->queryHelper = new QueryHelper();
		$GLOBALS["beans"]->siteHelper = new SiteHelper();
		$GLOBALS["beans"]->stringHelper = new StringHelper();
	}

	private function loadServices()
	{
		require APP . '/core/model.php';
		require APP . '/models/friendModel.php';
		require APP . '/models/helpModel.php';
		require APP . '/models/messageModel.php';
		require APP . '/models/resourceModel.php';
		require APP . '/models/travelModel.php';
		require APP . '/models/userModel.php';
		require APP . '/models/wishModel.php';

		require APP . '/core/service.php';
		require APP . '/services/friendService.php';
		require APP . '/services/helpService.php';
		require APP . '/services/messageService.php';
		require APP . '/services/resourceService.php';
		require APP . '/services/travelService.php';
		require APP . '/services/userService.php';
		require APP . '/services/wishService.php';

		$GLOBALS["beans"]->friendService = new FriendService(new FriendModel($this->db));
		$GLOBALS["beans"]->helpService = new HelpService(new HelpModel($this->db));
		$GLOBALS["beans"]->messageService = new MessageService(new MessageModel($this->db));
		$GLOBALS["beans"]->resourceService = new ResourceService(new ResourceModel($this->db));
		$GLOBALS["beans"]->travelService = new TravelService(new TravelModel($this->db));
		$GLOBALS["beans"]->userService = new UserService(new UserModel($this->db));
		$GLOBALS["beans"]->wishService = new WishService(new WishModel($this->db));
	}

	private function checkLoggedIn()
	{
		if (!is_numeric($GLOBALS["beans"]->siteHelper->getSession("userID")))
		{
			$validDestination = false;

			// The following destinations do not require user to log in
			$validDestination = $validDestination || (strcasecmp("home", $this->url_controller) == 0 && strlen($this->url_action) == 0);
			$validDestination = $validDestination || (strcasecmp("home", $this->url_controller) == 0 && strcasecmp("index", $this->url_action) == 0);
			$validDestination = $validDestination || (strcasecmp("user", $this->url_controller) == 0 && strcasecmp("login", $this->url_action) == 0);
			$validDestination = $validDestination || (strcasecmp("user", $this->url_controller) == 0 && strcasecmp("signUp", $this->url_action) == 0);
			$validDestination = $validDestination || (strcasecmp("user", $this->url_controller) == 0 && strcasecmp("createAccount", $this->url_action) == 0);
			$validDestination = $validDestination || (strcasecmp("user", $this->url_controller) == 0 && strcasecmp("checkUniqueEmail", $this->url_action) == 0);
			$validDestination = $validDestination || (strcasecmp("resources", $this->url_controller) == 0 && strcasecmp("getStates", $this->url_action) == 0);

			if (!$validDestination)
			{
				header('location: ' . URL_WITH_INDEX_FILE);
			}
		}
	}
}
