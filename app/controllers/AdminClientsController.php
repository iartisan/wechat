<?php
class AdminClientsController extends AdminController {


    /**
     * Post Model
     * @var Post
     */
    protected $clients;
    protected $loves;
    protected $orders;
    //protected $styles;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Clients $clients,Loves $loves,Orders $orders)
    {
        parent::__construct();
        $this->clients = $clients;
        $this->loves = $loves;
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
      $ClientsCount = $this->clients->count(); 
      $LovesCount = $this->loves->count(); 
      $OrdersCount = $this->orders->count();
      return View::make('admin/clients/index', compact('ClientsCount', 'LovesCount', 'OrdersCount','title'));
    }
     public function getData()
    {
        $posts=Clients::leftjoin('contacts','clients.of_contact','=','contacts.id')->select(array('clients.only_mark','contacts.name','contacts.phone', 'contacts.address'));
        return Datatables::of($posts)
        ->make();
    }
}
