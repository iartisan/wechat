<?php
class GetclientController extends BaseController {


    /**
     * Post Model
     * @var Post
     */
    protected $contacts;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Contacts $contacts)
    {
        parent::__construct();
        $this->contacts = $contacts;
    }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        session_start();
        $data = json_decode(file_get_contents("php://input"));
        $this->contacts->name=$data->name;
        $this->contacts->phone=$data->phone;
        $this->contacts->address=$data->address; 
        $this->contacts->of_client=$_SESSION['client_id'];
        $this->contacts->save();
        $_SESSION['contact_id']=$this->contacts->id;
    }
}
