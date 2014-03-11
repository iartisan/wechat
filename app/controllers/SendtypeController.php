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
        $this->clients->only_mark=$_SESSION['open_id'];
        $this->clients->save();
        $styles = $this->styles->orderBy('status', 'asc')->get();
        return Response::json($styles)->setCallback(Input::get('callback'));
    }
}