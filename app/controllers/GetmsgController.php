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
    public function __construct(Post $post,Foods $foods)
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
        $data = Input::json();
        return View::make('site/blog/index', compact('data'));
    }
}