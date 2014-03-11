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
        $posts=Orders::leftjoin('contacts','orders.of_contact','=','contacts.id')->select(array('orders.id','orders.created_at', 'contacts.name as contactsname','contacts.address as address','contacts.phone as phone','orders.pay','orders.remark'));
        //$posts = Post::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));
        //$posts = Orders::select(array('orders.id','orders.created_at', 'contacts.name','contacts.address','contacts.phone','orders.rebate','orders.pay','orders.remark'));
        return Datatables::of($posts)
       // ->edit_column('contactsname', '{{ DB::table(\'contacts\')->where(\'id\', \'=\', $of_contact)->count() }}')
        ->edit_column('orders', '{{ DB::table(\'orders\')->where(\'id\', \'=\', $id)->count() }}')
        ->edit_column('id','VG{{{$id}}}')
        ->make();
    }
}