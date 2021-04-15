<?php
class Pages extends Controller{
    public function __construct(){

    }

    public function index(){
        $data =  ['title' => 'ShareLinks',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni porro rem voluptates, ?'
    ];
        $this->view('pages/index', $data);
        
    }


    public function about(){

        $data =  ['title' => 'About us',
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni porro rem voluptates, sit amet consectetur adipisicing elit. Magni porro rem voluptates, sit amet consectetur adipisicing elit. Magni porro rem voluptates, '
    ];
        $this->view('pages/about',  $data);
       
    }
}
