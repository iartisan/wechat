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
        $this->orders->price='10';
<<<<<<< HEAD
=======
        $this->orders->rebate='0.5';
>>>>>>> backup
        $this->orders->phone='123456';
        $this->orders->remark='good';
        $this->orders->pay='none';
        $this->orders->save();
        $id=$this->orders->id;
        $price=0;
<<<<<<< HEAD
=======
        //$str=array();
>>>>>>> backup
        foreach($data as $d)
        {
            $ordersmsgs = new Ordersmsgs;
            $ordersmsgs->of_foods=$d->id;
            $ordersmsgs->count=$d->count;
            $ordersmsgs->price=$d->price;
            $ordersmsgs->of_orders=$id;
<<<<<<< HEAD
            $ordersmsgs->rebate=$d->rebate;
            $ordersmsgs->save();
            $price=$price+(int)($d->price)*(int)($d->count);
        }
        $affectedRows = Orders::where('id', '=', $id)->update(array('price' => $price));
        if($affectedRows)
        {
            
        }
=======
            $ordersmsgs->save();
            $price=$price+(int)($d->price)*(int)($d->count);
            //$str[]=['of_foods'=>$this->ordersmsgs->of_foods,'count'=>$this->ordersmsgs->count,'price'=>$this->ordersmsgs->price,'of_orders'=>$id,'updated_at'=>'now()'];
        }
        //$this->ordersmsgs->Insert($str);
        //return $str;
        $affectedRows = Orders::where('id', '=', $id)->update(array('price' => $price));
>>>>>>> backup
    }
}
