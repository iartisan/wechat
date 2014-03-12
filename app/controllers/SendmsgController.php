<?php
class SendmsgController extends BaseController {


    /**
     * Post Model
     * @var Post
     */
    protected $post;
    protected $foods;
    protected $contacts;
    public $value;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Post $post,Foods $foods,Clients $clients,Contacts $contacts,Loves $loves)
    {
        session_start();
        $this->value=$_SESSION['client_id'];
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
            $foods = $this->foods->select(DB::raw("*,(select count(*) from ordersmsgs where of_food=foods.id) as count,(select status from loves where of_food=foods.id and of_client='$this->value') as loves,(select count(*) from loves where of_food=foods.id and status=1) as love_count"))->where('show','=',1)->get();
        }
        else
        {
            $foods = $this->foods->select(DB::raw("*,(select count(*) from ordersmsgs where of_food=foods.id) as count,(select status from loves where of_food=foods.id and of_client='$this->value') as loves,(select count(*) from loves where of_food=foods.id and status=1) as love_count"))->where('show','=',1)->where('type','=',$typename)->get();
        }
        return Response::json($foods)->setCallback(Input::get('callback'));
    }
    public function getOne($id)
    {
        $foods = $this->foods->select(DB::raw("*,(select count(*) from loves where of_food=foods.id and status=1) as love_count,(select status from loves where of_food=foods.id and of_client='$this->value') as loves,(select count(*) from ordersmsgs where of_food=foods.id) as orderscount"))->where('id','=',$id)->get();
        return Response::json($foods)->setCallback(Input::get('callback'));
    }
    public function getUsermsg()
    {
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
   public function  getUserlove($id,$status)
   {
        $count = $this->loves->where('of_client','=',$_SESSION['client_id'])->where('of_food','=',$id)->count();
        if($status=='false')
        {
            $status=0;
        }
        else
        {
            $status=1;
        }
        if($count==0)
        {
            $this->loves->of_food=$id;
            $this->loves->status=$status;
            $this->loves->of_client=$_SESSION['client_id'];
            $this->loves->save();
        }
        else
        {
            $count = $this->loves->where('of_client','=',$_SESSION['client_id'])->where('of_food','=',$id)->update(array('status' => $status));;
        }
   }
   public function  getMylove()
   {
        $count = $this->loves->where('of_client','=',$_SESSION['client_id'])->where('status','=',1)->count();
        if($count==0)
        {
            return "null";
        }
        else
        {
            //$msg=DB::table('loves')->leftJoin('foods', 'foods.id', '=', 'loves.of_food')->join('ordersmsgs', 'ordersmsgs.of_food', '=', 'foods.id')->get();
            //$msg=DB::table('loves')->leftJoin('foods', 'foods.id', '=', 'loves.of_food')->get();
           //$msg = $this->foods->select(DB::raw("foods.name,(select count(*) from ordersmsgs where of_food=foods.id) as count from loves inner join foods inner join ordersmsgs where loves.of_food=foods.id and loves.status=1 and loves.of_client=4"))->groupBy('loves.id')->get();
        }
        return Response::json($msg)->setCallback(Input::get('callback'));
   }
}
