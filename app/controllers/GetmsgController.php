<?php
class GetmsgController extends BaseController {


    /**
     * Post Model
     * @var Post
     */
    protected $orders;
    protected $ordersmsg;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Orders $orders,Ordersmsgs $ordersmsgs)
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
        session_start();
        $data = json_decode(file_get_contents("php://input"));
        $this->orders->of_client=$_SESSION['client_id'];
        $this->orders->of_contact=$_SESSION['contact_id'];
        $this->orders->remark='good';
        $this->orders->pay='none';
        $this->orders->save();
        $id=$this->orders->id;
        $price=0;
        foreach($data as $d)
        {
            $ordersmsgs = new Ordersmsgs;
            $ordersmsgs->of_food=$d->id;
            $ordersmsgs->count=$d->count;
            $ordersmsgs->price=$d->price;
            $ordersmsgs->of_order=$id;
            $ordersmsgs->rebate=$d->rebate;
            $ordersmsgs->save();
        }
    }
}
