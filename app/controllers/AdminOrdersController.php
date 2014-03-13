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
        $posts=Orders::leftjoin('contacts','orders.of_contact','=','contacts.id')->select(array('orders.id','orders.updated_at','orders.created_at', 'contacts.name as contactsname','contacts.address as address','contacts.phone as phone','orders.pay','orders.remark'));
        return Datatables::of($posts)
       // ->edit_column('orders','{{ DB::table(\'orders\')->where(\'id\', \'=\', $id)->get() }}')
        ->edit_column('updated_at','{{ implode(\',\',DB::table(\'foods\')->join(\'ordersmsgs\',\'foods.id\',\'=\',\'ordersmsgs.of_food\')->where(\'of_order\', \'=\', $id)->lists(\'name\')) }}')
        ->add_column('infomation','<a href="{{{URL::to(\'admin/orders/info/\'.$id)}}}" class="btn btn-default btn-xs iframe">详情</a>')
        ->edit_column('id','VG{{{$id}}}')
        ->make();
    }

    public function getInfos($id)
    {
         $posts=Orders::leftjoin('contacts','orders.of_contact','=','contacts.id')->select(array('orders.id','orders.updated_at','orders.created_at', 'contacts.name as contactsname','contacts.address as address','contacts.phone as phone','orders.pay','orders.remark'));
        return Datatables::of($posts)
       // ->edit_column('orders','{{ DB::table(\'orders\')->where(\'id\', \'=\', $id)->get() }}')
        ->edit_column('updated_at','{{ implode(\',\',DB::table(\'foods\')->join(\'ordersmsgs\',\'foods.id\',\'=\',\'ordersmsgs.of_food\')->where(\'of_order\', \'=\', $id)->lists(\'name\')) }}')
        ->add_column('infomation','<a href="{{{URL::to(\'admin/orders/info/\'.$id)}}}" class="btn btn-default btn-xs iframe">详情</a>')
        ->edit_column('id','VG{{{$id}}}')
        ->make();
    }

    public function getInfo($id){
         return View::make('admin.orders.show',compact('id'));
    }
}
