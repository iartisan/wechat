<?php
class AdminStoresController extends AdminController {


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
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/blogs/title.blog_management');

        // Grab all the blog posts
        $posts = $this->post;

        // Show the page
        return View::make('admin/stores/index', compact('posts', 'title'));
    }
}