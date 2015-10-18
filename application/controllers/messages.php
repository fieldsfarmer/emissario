<?php

class Messages extends Controller
{
    public function index()
    {
    	$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
    	$messages = $this->beans->messageService->getMessages($userID);

        require APP . 'views/_templates/header.php';
        require APP . 'views/messages/index.php';
        require APP . 'views/_templates/footer.php';
    }

    public function view($travelID)
	{
		$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
		$travel = $this->beans->travelService->getTravel($travelID, $userID);

		require APP . 'views/_templates/header.php';
		require APP . 'views/messages/view.php';
		require APP . 'views/_templates/footer.php';
	}

	public function edit($travelID = "")
	{
		$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
		

		require APP . 'views/_templates/header.php';
		require APP . 'views/messages/edit.php';
		
		require APP . 'views/_templates/footer.php';
	}

	public function save()
	{
		$travelID = $this->beans->messageService->saveMessage();

		//header('location: ' . URL_WITH_INDEX_FILE . 'messages/view/' . $travelID);
	}

	public function delete($travelID)
	{
		$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
		$this->beans->travelService->deleteTravel($travelID, $userID);

		header('location: ' . URL_WITH_INDEX_FILE . 'messages');
	}
}