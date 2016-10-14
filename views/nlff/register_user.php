<div>
    <h1>Register</h1>
    <?php
        echo validation_errors();
        //open form
        $attributes = array('id'=>'', 'class'=>'', 'name'=>'register_user');
        echo form_open('nlff/register_user', $attributes);
        //user name
        $data = array('id'=> '', 'class'=> '', 'name'=>'user_name', 'value'=>'');
        echo 'User Name: ' . form_input($data) . "<br>";
        $data = array('id'=> '', 'class'=> '', 'name'=>'email', 'value'=>'');
        echo 'Email: ' . form_input($data) . "<br>";
        //Password
        $data = array('id'=>'', 'class'=> '', 'name'=>'user_password');
        echo 'Password: ' . form_password($data);
        echo '<br>';
        //Verify Password
        $data = array('id'=>'', 'class'=> '', 'name'=>'verify_user_password');
        echo 'Verify Password: ' . form_password($data);
        echo '<br>';
        //Submit button
        echo form_submit('register', 'Register');
        echo "</form>";
        ?>
    </div>
        
  