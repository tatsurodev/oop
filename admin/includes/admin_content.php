            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Subheading</small>
                        </h1>
                        <?php
                        // $find_user = User::find_by_id(1);
                        // echo '<pre>';
                        // var_dump($find_user);
                        // echo '</pre>';
                        // $user = User::instantation($find_user);
                        // echo '<pre>';
                        // var_export($user);
                        // echo '</pre>';
                        // echo $user->username;

                        // $users = User::find_all();
                        // foreach ($users as $user) {
                        //     echo $user->username;
                        // }

                        // // createメソッド
                        // $user = new User();
                        // $user->username = 'john';
                        // $user->password = '123';
                        // $user->first_name = 'John';
                        // $user->last_name = 'Smith';
                        // $user->create();

                        //updateメソッド
                        // $user = User::find_by_id(5);
                        // $user->first_name = 'Hanakoo';
                        // $user->last_name = 'Sasakii';
                        // $user->update();

                        //deleteメソッド
                        // $user = User::find_by_id(4);
                        // $user->delete();

                        //saveメソッド
                        // $update_user = User::find_by_id(5);
                        // $update_user->last_name = 'Yamada';
                        // $update_user->save();

                        // $photos = Photo::find_all();
                        // foreach ($photos as $photo) {
                        //     echo $photo->filename;
                        // }

                        $photo = new Photo();
                        $photo->title = 'Test title';
                        $photo->size = 123;
                        $photo->create();

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
