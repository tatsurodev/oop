            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Subheading</small>
                        </h1>
                        <?php
                        // $find_user = User::find_user_by_id(1);
                        // echo '<pre>';
                        // var_dump($find_user);
                        // echo '</pre>';
                        // $user = User::instantation($find_user);
                        // echo '<pre>';
                        // var_export($user);
                        // echo '</pre>';
                        // echo $user->username;
                        // $users = User::find_all_users();
                        // foreach ($users as $user) {
                        //     echo $user->username.'<br>';
                        // }
                        $user = new User();
                        $user->username = 'john';
                        $user->passwoord = '123';
                        $user->first_name = 'John';
                        $user->last_name = 'Smith';
                        $user->create();

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
