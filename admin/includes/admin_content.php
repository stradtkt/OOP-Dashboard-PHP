<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Admin
            <small>PHP Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Blank Page
            </li>
        </ol>

        <?php 
        
        
        // $sql = "SELECT * FROM users WHERE id=1";
        // $result = $db->query($sql);
        // $user_found = mysqli_fetch_array($result);
        // echo $user_found['username'];

        // $result_set = User::find_all_users();
        // while($row = mysqli_fetch_array($result_set)) {
        //     echo $row['username'] . "<br>";
        // }
        // $found_user = User::find_user_by_id(2);
        // echo $found_user['first_name'];

        // $found_user = User::find_user_by_id(2);
        // $user = User::instantiation($found_user);
        // echo $user->first_name;

        // $users = User::find_all_users();
        // foreach($users as $user) {
        //     echo $user->username . "<br>";
        // }

        $found_user = User::find_user_by_id(1);
        echo $found_user->username;
        ?>
    </div>
</div>
<!-- /.row -->