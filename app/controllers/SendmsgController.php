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
    public function __construct(Post $post,Foods $foods,Clients $clients,Contacts $contacts,Loves $loves)
    {
        parent::__construct();
        $this->post = $post;
        $this->foods = $foods;
        $this->clients = $clients;
        $this->contacts = $contacts;
        $this->loves = $loves;
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
            $foods = $this->foods->select(DB::raw('*,(select count(*) from ordersmsgs where of_foods=foods.id) as count'))->where('show','=',0)->get();
        }
        else
        {
            $foods = $this->foods->select(DB::raw('*,(select count(*) from ordersmsgs where of_foods=foods.id) as count'))->where('show','=',0)->where('type','=',$typename)->get();
        }
        return Response::json($foods)->setCallback(Input::get('callback'));
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
            $id=$this->clients->where('id','=',$_SESSION['client_id'])->lists('of_contact');
            if($id[0]!='null')
            {
                $msg=DB::table('contacts')->where('id','=',$id[0])->get();
                return Response::json($msg)->setCallback(Input::get('callback'));
            }
            else
            {
                return "null";
            }
        }
        else
        {
            return "null";
        }
        
    }
   public function  getUserlove($id)
   {
        session_start();
        $this->loves->of_foods=$id;
        $this->loves->of_client=$_SESSION['client_id'];
        $this->loves->save();
   }
}
