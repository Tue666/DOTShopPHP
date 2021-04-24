<?php 
class Feedback extends ViewModel{
    public function __construct(){
		if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
	}
    public function Index(){
        $contact = $this->getModel('ContactDAL');
        $listFeedbackJSON = json_decode($contact->getListFeedback(),true);
        $this->loadView('Shared','Layout',[
            'title'=>'Feedback',
            'page'=>'Feedback/Index',
            'listFeedback'=>$listFeedbackJSON
        ],1);
    }
}
?>