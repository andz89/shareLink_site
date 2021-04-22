<?php 
session_start();

  // Flash message helper
  // EXAMPLE in controller Users - flash('register_success', 'You are now registered');
  // DISPLAY IN VIEW - echo flash('register_success');
  function flash($name = '', $message = '', $class = 'alert alert-success'){
    if(!empty($name)){
           // If  you are creating a new flash
      if(!empty($message) && empty($_SESSION[$name])){

            // Unset previous values stored in $_SESSION
        if(!empty($_SESSION[$name])){
          unset($_SESSION[$name]);
        }
            // Unset previous values stored in $_SESSION
        if(!empty($_SESSION[$name. '_class'])){
          unset($_SESSION[$name. '_class']);
        }

           // Set new $_SESSION values
        $_SESSION[$name] = $message;
        $_SESSION[$name. '_class'] = $class;

      } 

      // If  you are displayng flash and if $name is true (there is a message in $SESSION[$name)

      elseif(empty($message) && !empty($_SESSION[$name])){
        $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
        echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
        unset($_SESSION[$name]);
        unset($_SESSION[$name. '_class']);
      }
    }
  }

    function isLoggedIn(){
    if(isset($_SESSION['user_id'])){
      return true;
    } else {
      return false;
    }
  }