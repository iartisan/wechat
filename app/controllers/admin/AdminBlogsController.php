<?php
class AdminBlogsController extends AdminController {


    /**
     * Post Model
     * @var Post
     */
    protected $post;
    protected $foods;
    protected $styles;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Post $post,Foods $foods,Styles $styles)
    {
        parent::__construct();
        $this->post = $post;
        $this->foods = $foods;
        $this->styles=$styles;
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
        return View::make('admin/blogs/index', compact('posts', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('admin/blogs/title.create_a_new_blog');
        $styles= $this->styles->get();
        // Show the page
        return View::make('admin/blogs/create_edit', compact('styles','title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
        // Declare the rules for the form validation

        // Validate the inputs
            // Create a new blog post
        $user = Auth::user();

        // Update the blog post data
        $this->foods->name   = Input::get('food_name');
        $this->foods->type   = Input::get('type');
        $this->foods->price  = Input::get('price');
        $this->foods->status = Input::get('status');
        $this->foods->tag    = Input::get('tag');
        $this->foods->times  = Input::get('times');
        $this->foods->pic="abc";
            // Was the blog post created?
        if($this->foods->save())
        {
            $id=$this->foods->id;
            if (Input::hasFile('photo'))
            {
               $imgDir = 'img/';
               $filetype = substr(Input::file('photo')->getMimeType(),6);
               Image::make(Input::file('photo')->getRealPath())->resize(300,200)->save($imgDir.$id."."."jpg");
            }
            // Redirect to the new blog post page
            return Redirect::to('admin/blogs/' . $this->foods->id . '/edit')->with('success', Lang::get('admin/blogs/messages.create.success'));
        }

            // Redirect to the blog post create page
        //return Redirect::to('admin/blogs/create')->with('error', Lang::get('admin/blogs/messages.create.error'));

        // Form validation failed
        return Redirect::to('admin/blogs/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getShow($post)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getEdit($id)
	{
        $foods = $this->foods->find($id);
        // Title
        
        $title = Lang::get('admin/blogs/title.blog_update');
        $styles= $this->styles->get();
        // Show the page
        return View::make('admin/blogs/create_edit', compact('foods', 'title','styles'));
	}
    /*
    public function getEdit($post)
    {
        // Title
        $title = Lang::get('admin/blogs/title.blog_update');

        // Show the page
        return View::make('admin/blogs/create_edit', compact('post', 'title'));
    }
    */
    /**
     * Update the specified resource in storage.
     *
     * @param $post
     * @return Response
     */
	public function postEdit($id)
	{

        // Declare the rules for the form validation
        // Check if the form validates with success
            // Update the blog post data
        $foods=Foods::find($id);
        $foods->name   = Input::get('food_name');
        $foods->type   = Input::get('type');
        $foods->price  = Input::get('price');
        $foods->status = Input::get('status');
        $foods->tag    = Input::get('tag');
        $foods->times  = Input::get('times');
        $foods->pic="abc";
        // Was the blog post updated?
        if($foods->save())
        {
            if (Input::hasFile('photo'))
            {
               $imgDir = 'img/';
               $filetype = substr(Input::file('photo')->getMimeType(),6);
               Image::make(Input::file('photo')->getRealPath())->resize(300,200)->save($imgDir.$id."."."jpg");
            }
            // Redirect to the new blog post page
            return Redirect::to('admin/blogs/' .$id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
        }

            // Redirect to the blogs post management page
            //return Redirect::to('admin/blogs/' . $post->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));

        // Form validation failed
        return Redirect::to('admin/blogs/' . $post->id . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function getDelete($id)
    {
        // Title
        $title = Lang::get('admin/blogs/title.blog_delete');

        // Show the page
        return View::make('admin/blogs/delete', compact('id', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($id)
    {
        // Declare the rules for the form validation
        // Check if the form validates with success
       DB::table('foods')->where('id', '=', $id)->delete();
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

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        //$posts = Post::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));
        $posts = Foods::select(array('foods.id', 'foods.name','foods.type', 'foods.price', 'foods.status','foods.tag','foods.times','foods.created_at'));
        return Datatables::of($posts)

        //->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')
        ->edit_column('foods', '{{ DB::table(\'foods\')->where(\'id\', \'=\', $id)->count() }}')
        ->add_column('图片','<img class="iframe" src="../img/{{{$id  }}}.jpg" width=50 height=50 />')
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/blogs/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >编辑</a>
                <a href="{{{ URL::to(\'admin/blogs/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">删除</a>
            ')


        ->remove_column('id')
        ->make();
    }

}