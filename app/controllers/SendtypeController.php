<?php
class SendtypeController extends BaseController {


    /**
     * Post Model
     * @var Post
     */
    protected $styles;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Styles $styles)
    {
        parent::__construct();
        $this->styles= $styles;
    }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        session_start();
            $fuck = $_SESSION['open_id'];
            return var_dump($fuck);
            return "fuck";
        $styles = $this->styles->orderBy('status', 'asc')->get();
        return Response::json($styles)->setCallback(Input::get('callback'));
    }
}
