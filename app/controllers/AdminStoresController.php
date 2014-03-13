<?php
class AdminStoresController extends AdminController {


    /**
     * Post Model
     * @var Post
     */
    protected $stores;
    protected $foods;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(POST $post,Stores $stores)
    {
        parent::__construct();
        $this->stores = $stores;
        $this->post = $post;
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
        $count = DB::table('stores')->count();
        // Show the page
        return View::make('admin/stores/index', compact('count','title'));
    }
    public function getCreate()
    {
        // Title
        $title = Lang::get('admin/blogs/title.create_a_new_blog');

        // Show the page
        return View::make('admin/stores/create_edit', compact('title'));
    }
    public function postCreate()
    {
        // Declare the rules for the form validation

        // Validate the inputs
            // Create a new blog post
        $user = Auth::user();

        // Update the blog post data
        $this->stores->name   = Input::get('stores_name');
        $this->stores->address   = Input::get('stores_address');
        $this->stores->phone  = Input::get('stores_phone');
        $this->stores->message = Input::get('stores_message');
        $this->stores->keyword    = Input::get('stores_keyword');
        $this->stores->pointer_x  = Input::get('pointer_x');
        $this->stores->pointer_y  = Input::get('pointer_y');
            // Was the blog post created?
        if($this->stores->save())
        {
            $id=$this->stores->id;
            if (Input::hasFile('photo'))
            {
               $imgDir = 'storesimg/';
               $filetype = substr(Input::file('photo')->getMimeType(),6);
               Image::make(Input::file('photo')->getRealPath())->resize(300,200)->save($imgDir.$id."."."jpg");
            }
            // Redirect to the new blog post page
            return Redirect::to('admin/stores/' . $this->stores->id . '/edit')->with('success', Lang::get('admin/blogs/messages.create.success'));
        }
        return Redirect::to('admin/stores/create')->withInput()->withErrors($validator);
    }

    public function postEdit($id)
    {

        // Declare the rules for the form validation
        // Check if the form validates with success
            // Update the blog post data
        $stores=Stores::find($id);
        $stores->name       = Input::get('stores_name');
        $stores->address    = Input::get('stores_address');
        $stores->phone      = Input::get('stores_phone');
        $stores->message    = Input::get('stores_message');
        $stores->keyword    = Input::get('stores_keyword');
        $stores->pointer_x  = Input::get('pointer_x');
        $stores->pointer_y  = Input::get('pointer_y');
        // Was the blog post updated?
        if($stores->save())
        {
            if (Input::hasFile('photo'))
            {
               $imgDir = 'storesimg/';
               $filetype = substr(Input::file('photo')->getMimeType(),6);
               Image::make(Input::file('photo')->getRealPath())->resize(300,200)->save($imgDir.$id."."."jpg");
            }
            // Redirect to the new blog post page
            return Redirect::to('admin/stores/' .$id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
        }

            // Redirect to the blogs post management page
            //return Redirect::to('admin/blogs/' . $post->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));

        // Form validation failed
        return Redirect::to('admin/stores/' . $stores->id . '/edit')->withInput()->withErrors($validator);
    }
    public function getEdit($id)
    {
        
        $stores= $this->stores->find($id);
        // Title
        $title = Lang::get('admin/blogs/title.blog_update');
        // Show the page
        return View::make('admin/stores/create_edit', compact('stores', 'title'));
    }
    public function getData()
    {
        //$posts = Post::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));
        $posts = Stores::select(array('stores.id', 'stores.name','stores.address', 'stores.phone', 'stores.message','stores.keyword','stores.pointer_x','stores.pointer_y'));
        return Datatables::of($posts)
        ->edit_column('stores', '{{ DB::table(\'stores\')->where(\'id\', \'=\', $id)->count() }}')
        ->add_column('图片','<img class="iframe" src="../storesimg/{{{$id  }}}.jpg" width=50 height=50 />')
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/stores/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >编辑</a>
                <a href="{{{ URL::to(\'admin/stores/delete/\' . $id) }}}" class="btn btn-default btn-xs iframe">删除</a>
            ')


        ->remove_column('id')
        ->make();
    }
     public function getDelete($id)
    {
        // Title
        $title = Lang::get('admin/stores/title.blog_delete');

        // Show the page
        return View::make('admin/stores/delete', compact('id', 'title'));
    }
    public function postDelete($id)
    {
        // Declare the rules for the form validation
        // Check if the form validates with success
       DB::table('stores')->where('id', '=', $id)->delete();
    /*
        // Was the blog post deleted?
        $food = Foods::find($id);
        
        if(empty($food))
        {
            // Redirect to the blog posts management page
            return Redirect::to('admin/blogs')->with('success', Lang::get('admin/blogs/messages.delete.success'));
        }       
        // There was a problem deleting the blog post
        return Redirect::to('admin/blogs')->with('error', Lang::get('admin/blogs/messages.delete.error'));
        */
    }
}