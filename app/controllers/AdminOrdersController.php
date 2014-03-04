<?php
class AdminOrdersController extends AdminController {


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
        // Title
        $title = Lang::get('admin/blogs/title.blog_management');

        // Grab all the blog posts
        $orders = $this->orders;

        // Show the page
        return View::make('admin/orders/index', compact('orders', 'title'));
    }
    public function getData()
    {
        //$posts = Post::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));
        $posts = Orders::select(array('orders.id','orders.created_at', 'orders.name','orders.foods','orders.price','orders.rebate','orders.pay','orders.phone','orders.remark'));
        return Datatables::of($posts)

        //->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')
        ->edit_column('orders', '{{ DB::table(\'orders\')->where(\'id\', \'=\', $id)->count() }}')
        ->edit_column('id','VG{{{$id}}}')
        ->make();
    }
}