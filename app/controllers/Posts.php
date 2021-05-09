<?php 

class Posts extends Controller {

    public function __construct(){
        if(!isLoggedIn()){
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }
    public function index(){
        //get posts
        $posts = $this->postModel->getPosts();
        $data = [
            'posts'=> $posts
        ];
        $this->view('post/index',$data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize the post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title'=> trim($_POST['title']),
                'body'=> trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            //validate data
            if(empty($data['title'])){
                $data['title_err'] = 'Plesae enter title';
            }
      
              if(empty($data['body'])){
                $data['body_err'] = 'Plesae enter body';
            }
            //make sure no errors

            if(empty($data['title_err']) && empty($data['body_err'])){
                // Validated
                if($this->postModel->addPost($data)){
                    flash('post_message', 'Post Added');
                    redirect('posts');
                }else{
                    die('something went wrong');
                }
            }else{
                //load view with errors
                $this->view('post/add',$data);
            }
        }else{
            $data = [
                'title'=> '',
                'body'=> ''
            ];
            $this->view('post/add',$data);
        }
  
    }
    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize the post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id'=> $id,
                'title'=> trim($_POST['title']),
                'body'=> trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            //validate data
            if(empty($data['title'])){
                $data['title_err'] = 'Plesae enter title';
            }
      
              if(empty($data['body'])){
                $data['body_err'] = 'Plesae enter body';
            }
            //make sure no errors

            if(empty($data['title_err']) && empty($data['body_err'])){
                // Validated
                if($this->postModel->updatePost($data)){
                    flash('post_message', 'Post Updated');
                    redirect('posts');
                }else{
                    die('something went wrong');
                }
            }else{
                //load view with errors
                $this->view('post/edit',$data);
            }
        }else{
            //get existing post from model
            $post = $this->postModel->getPostsById($id);
            
            //check for owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }
            $data = [
                'id'=> $id,
                'title'=> $post->title,
                'body'=> $post->body
            ];
            $this->view('post/edit',$data);
        }
  
    }


    public function show($id){
        $post = $this->postModel->getPostsById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $data = [
            'post'=> $post,
            'user'=> $user
        ];
        $this->view('post/show', $data);
    }
    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
               //get existing post from model
               $post = $this->postModel->getPostsById($id);
            
               //check for owner
               if($post->user_id != $_SESSION['user_id']){
                   redirect('posts');
               }
            if($this->postModel->deletePost($id)){
                flash('post_message', 'Post removed'); 
                redirect('posts');
            }else{
                die('something went wrong');
            }

        }else{
            redirect('posts');
        }
    }
}