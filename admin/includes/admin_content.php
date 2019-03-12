            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Subheading</small>
                        </h1>
                        <?php
                        $result_set = User::find_all_users();
                        while ($row = mysqli_fetch_array($result_set)) {
                            echo $row['username'].'<br>';
                        }
                        $find_user = User::find_user_by_id(1);
                        $user = new User();
                        $user->id = $find_user['id'];
                        $user->username = $find_user['username'];
                        $user->password = $find_user['password'];
                        $user->first_name = $find_user['first_name'];
                        $user->last_name = $find_user['last_name'];
                        echo $user->firstid_name;
                         ?>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
