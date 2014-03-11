<?php
class SendmsgController extends BaseController {


    /**
     * Post Model
     * @var Post
     */
    protected $post;
    protected $foods;
    protected $contacts;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Post $post,Foods $foods,Clients $clients,Contacts $contacts)
    {
        parent::__construct();
        $this->post = $post;
        $this->foods = $foods;
        $this->clients = $clients;
        $this->contacts = $contacts;
    }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex($typename)
    {
        if($typename=='index')
        {
             $foods = $this->foods->where('show','=',0)->get();
        }
        else
        {
            $foods = $this->foods->where('type','=',$typename)->get();
        }
        return Response::json($foods)->setCallback(Input::get('callback'));
        // Show the page
        //return View::make('admin/stores/index', compact('posts', 'title'));
    }
    public function getOne($id)
    {
        $foods = $this->foods->where('id','=',$id)->get();
        return Response::json($foods)->setCallback(Input::get('callback'));
    }
    public function getUsermsg()
    {
        session_start();
        $count = $this->contacts->where('of_client','=',$_SESSION['client_id'])->count();
        if($count>0)
        {
            $msg=$this->contacts->where('of_client','=',$_SESSION['client_id'])->count();
        }
        else
        {
            return "null";
        }
        return Response::json($msg)->setCallback(Input::get('callback'));
    }
}
