<?php
class GetclientController extends BaseController {


    /**
     * Post Model
     * @var Post
     */
    protected $clients;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Clients $clients)
    {
        parent::__construct();
        $this->clients = $clients;
    }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        $data = json_decode(file_get_contents("php://input"));
        $client=new Clients;
        foreach($data as $d)
        {
            
        }
    }
}
