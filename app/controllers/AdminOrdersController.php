<?php
class AdminOrdersController extends AdminController {


    /**
     * Post Model
     * @var Post
     */
    protected $orders;
    protected $ordersmsgs;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Orders $orders,ordersmsgs $ordersmsgs)
    {
        parent::__construct();
        $this->orders = $orders;
        $this->ordersmsgs = $ordersmsgs;
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
        $posts=Orders::leftjoin('contacts','orders.of_contact','=','contacts.id')->select(array('orders.id','orders.created_at', 'contacts.name as contactsname','contacts.address as address','orders.updated_at','contacts.updated_at as updatedat','contacts.phone as phone','orders.pay','orders.remark','orders.step as step'));
        return Datatables::of($posts)
        ->edit_column('updated_at','{{ implode(\',\',DB::table(\'foods\')->join(\'ordersmsgs\',\'foods.id\',\'=\',\'ordersmsgs.of_food\')->where(\'of_order\', \'=\', $id)->lists(\'name\')) }}')
        ->edit_column('step','<button value={{$step}} onclick="change_step({{$id}},{{$step}})" class="btn btn-default btn-xs">@if($step==1)新订单@elseif($step==2) 已处理 @else 已完成 @endif</button>')
        ->edit_column('updatedat', '{{ DB::table(\'ordersmsgs\')->where(\'of_order\', \'=\', $id)->sum(\'ordersmsgs.price`*`ordersmsgs.count\') }}')
        ->add_column('infomation','<a href="{{{URL::to(\'admin/orders/info/\'.$id)}}}" class="btn btn-default btn-xs iframe">详情</a>')
        ->edit_column('id','VG{{{$id}}}')
        ->make();
    }

    public function getInfos($id)
    {
         $posts=Orders::leftjoin('ordersmsgs','orders.id','=','ordersmsgs.of_order')->select(array('ordersmsgs.of_food','ordersmsgs.count','ordersmsgs.price','ordersmsgs.rebate'));
        return Datatables::of($posts)
        ->edit_column('of_food','{{ implode(\',\',DB::table(\'foods\')->where(\'id\', \'=\', $of_food)->lists(\'name\')) }}')
        ->make();
    }

    public function getInfo($id){
         return View::make('admin.orders.show',compact('id'));
    }
    public function postUpdate()
    {
        $orders = Orders::find($_POST['id']);
        if($_POST['step']==3)
        {
            $orders->step=1;
        }
        else
        {
            $orders->step=$_POST['step']+1;
        }
        $orders->save();
        echo $orders->step;
    }
}
