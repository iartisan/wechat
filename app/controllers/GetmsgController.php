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
        $data = json_decode(file_get_contents("php://input"));
        return $data;
        /*
        $this->orders->name='a';
        $this->orders->phone='123456';
        $this->orders->remark='good';
        $this->orders->pay='none';
        $this->orders->save();
        $id=$this->orders->id;
        $i=0;
        $price=0;
        $str=array();
        foreach($data as $d)
        {
            $this->ordersmsgs->name=$d->name;
            $this->ordersmsgs->count=$d->count;
            $this->ordersmsgs->price=$d->price;
            //$this->ordersmsgs->save();
            $price=$price+(int)($d->price);
            //echo $this->ordersmsgs->name."\n";
            $str[]=['name'=>$this->ordersmsgs->name,'count'=>$this->ordersmsgs->count,'price'=>$this->ordersmsgs->price,'ofid'=>$id];
            $i++;
        }
        $this->ordersmsgs->Insert($str);
        $affectedRows = Orders::where('id', '=', $id)->update(array('price' => $price));
        echo $price;
        */
    }
}
