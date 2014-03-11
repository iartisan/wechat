<?php
class SendtypeController extends BaseController {


    /**
     * Post Model
     * @var Post
     */
    protected $styles;
    protected $clients;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Styles $styles,Clients $clients)
    {
        parent::__construct();
        $this->styles= $styles;
        $this->clients= $clients;
    }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        session_start();
        $count = Clients::where('only_mark', '=', $_SESSION['open_id'])->count();
        if($count==0)
        {
            $this->clients->only_mark=$_SESSION['open_id'];
            $isok=$this->clients->save();
            $id=$this->clients->id;
        }
        else
        {
            $this->clients->where('only_mark', '=',$_SESSION['open_id'])->update(array('updated_at' => date('Y-m-d H:i:s')));
            $sql=$this->clients->where('only_mark', '=',$_SESSION['open_id'])->get();
            foreach($sql as $s)
            {
                $id=$s['id'];
            } 
        }
        $styles = $this->styles->orderBy('status', 'asc')->get();
        return Response::json($styles)->setCallback(Input::get('callback'));
    }
}
