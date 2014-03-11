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
        $data = json_decode(file_get_contents("php://input"));
        
    }
}
