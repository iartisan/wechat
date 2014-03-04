<?php
class GetmsgController extends BaseController {


    /**
     * Post Model
     * @var Post
     */
    protected $orders;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Orders $orders)
    {
        parent::__construct();
        $this->orders = $orders;
    }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
$data = json_decode(file_get_contents("php://input"));
        //$data = Input::json();
        return $data;
        //return View::make('site/blog/index', compact('data'));
    }
}
