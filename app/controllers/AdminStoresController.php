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
    public function __construct(Stores $stores)
    {
        parent::__construct();
        $this->stores = $stores;
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
               $imgDir = '../img/';
               $filetype = substr(Input::file('photo')->getMimeType(),6);
               Image::make(Input::file('photo')->getRealPath())->resize(300,200)->save($imgDir.$id."."."jpg");
            }
            // Redirect to the new blog post page
            return Redirect::to('admin/stores/' . $this->stores->id . '/edit')->with('success', Lang::get('admin/blogs/messages.create.success'));
        }

            // Redirect to the blog post create page
        //return Redirect::to('admin/blogs/create')->with('error', Lang::get('admin/blogs/messages.create.error'));

        // Form validation failed
        return Redirect::to('admin/stores/create')->withInput()->withErrors($validator);
    }
}