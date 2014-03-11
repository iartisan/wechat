<?php
class SendmsgController extends BaseController {


    /**
     * Post Model
     * @var Post
     */
    protected $post;
    protected $foods;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Post $post,Foods $foods)
    {
        parent::__construct();
        $this->post = $post;
        $this->foods = $foods;
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
             $foods = $this->foods->get();
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
}
