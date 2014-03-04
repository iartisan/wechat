<?php
class AdminStylesController extends AdminController {


    /**
     * Post Model
     * @var Post
     */
    protected $post;
    protected $foods;
    //protected $styles;
    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Post $post,Foods $foods,Styles $styles)
    {
        parent::__construct();
        $this->post = $post;
        $this->foods = $foods;
        $this->styles = $styles;
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
        $posts = $this->styles;

        // Show the page
        return View::make('admin/styles/index', compact('posts', 'title'));
    }
    public function getData()
    {
        //$posts = Post::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));
        $posts = Styles::select(array('styles.id', 'styles.name','styles.status'));
        return Datatables::of($posts)
        //->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')
        ->edit_column('styles', '{{ DB::table(\'styles\')->where(\'id\', \'=\', $id)->count() }}')
        ->edit_column('status', '<input class="btn btn-default" onclick="up({{$id}},{{$status}})" type="button" value="上移"><input onclick="down({{$id}},{{$status}})" class="btn btn-default" type="button" value="下移">')
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/styles/edit/\' . $id  ) }}}" class="btn btn-default btn-xs iframe" >编辑</a>
                <a href="{{{ URL::to(\'admin/styles/delete/\' . $id) }}}" class="btn btn-xs btn-danger iframe">删除</a>
            ')
        ->remove_column('id')
        ->make();
    }
    public function getCreate()
    {
        // Title
        $title = Lang::get('admin/blogs/title.create_a_new_blog');

        // Show the page
        return View::make('admin/styles/create_edit', compact('title'));
    }
    public function getEdit($id)
    {
        $styles = $this->styles->find($id);
        
        $title = Lang::get('');
        // Show the page
        return View::make('admin/styles/create_edit', compact('styles', 'title'));
    }
    public function postEdit($id)
    {
        return $id;
    }
    public function getDelete($id)
    {
        // Title
        $title = Lang::get('admin/blogs/title.blog_delete');
        // Show the page
        return View::make('admin/styles/delete', compact('id', 'title'));
    }
     public function postDelete($id)
    {
        // Declare the rules for the form validation
        // Check if the form validates with success
       DB::table('styles')->where('id', '=', $id)->delete();
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
    public function postCreate()
    {
        // Declare the rules for the form validation

        // Validate the inputs
            // Create a new blog post
        $user = Auth::user();
        // Update the blog post data
        $this->styles->name   = Input::get('type_name');
        $this->styles->status  ='1';
            // Was the blog post created?
        if($this->styles->save())
       {
            $update = Styles::where('id', '=', $this->styles->id)->update(array('status' => $this->styles->id));
            // Redirect to the new blog post page
             return Redirect::to('admin/styles/edit/' . $this->styles->id )->with('success', Lang::get('更新成功'));
        }

            // Redirect to the blog post create page
        //return Redirect::to('admin/styles/create')->with('error', Lang::get('admin/blogs/messages.create.error'));

        // Form validation failed
        return Redirect::to('admin/blogs/create')->withInput()->withErrors($validator);
    }
}
