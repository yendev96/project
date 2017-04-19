<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {

        // for($i = 1; $i < 50; ++$i){
        //     DB::table('product')->insert([
        //         'name'        => 'Sản phẩm ',
        //         'title'       => 'Sản phẩm ',
        //         'slug'        => changeTitle('Sản phẩm '),
        //         'content'     => 'Sản phẩm ',
        //         'price'       => 12000000,
        //         'discount'    => 5,
        //         'quantily'    => 1000,
        //         'weight'      => 500 ,
        //         'memory'      => '64GB', 
        //         'img'         => 'MAIan_papers.co-ao28-hugoli-art-batman-minimal-logo-illust-dark-1920x1080.jpg', 
        //         'font_camera' => '12px', 
        //         'rear_camera' => '12px',
        //         'ram'         => 4 ,
        //         'os'          => 'Android' ,
        //         'battery'     => 120, 
        //         'bluetooth'   => '2.0', 
        //         'warranty'    => '12 tháng', 
        //         'cpu'         => '2.5 Ghz', 
        //         'sim'         => 2, 
        //         'color'       => 'Vàng', 
        //         'keywords'    => 'Đây là sản phẩm ', 
        //         'description' => 'Đây là sản phẩm ', 
        //         'view'        => 0,
        //         'status'      => 1, 
        //         'id_category' => 5, 
        //         'id_user'     => 1, 
        //     ]);
        // }
        
            DB::table('users')->insert(
                [
                [
                    'fullname' => 'Nguyễn Văn Yên',
                    'email' => 'supper@gmail.com',
                    'password' => 'vanyen96',
                    'address' => 'Hà Nội',
                    'phone' => '1',
                    'level' => 1,
                    'remember_token' => ''
                ],[
                    'fullname' => 'Hoàng Văn Tuấn',
                    'email' => 'supper1@gmail.com',
                    'password' => 'vanyen96',
                    'address' => 'Hà Nội',
                    'phone' => '1',
                    'level' => 1,
                    'remember_token' => ''
                ],[
                    'fullname' => 'Lê Thị Ánh',
                    'email' => 'supper2@gmail.com',
                    'password' => 'vanyen96',
                    'address' => 'Hà Nội',
                    'phone' => '1',
                    'level' => 1,
                    'remember_token' => ''
                ],[
                    'fullname' => 'Luowng Thị Ánh',
                    'email' => 'supper3@gmail.com',
                    'password' => 'vanyen96',
                    'address' => 'Hà Nội',
                    'phone' => '1',
                    'level' => 1,
                    'remember_token' => ''
                ],[
                    'fullname' => 'Đặng Thị Hồng',
                    'email' => 'supper4@gmail.com',
                    'password' => 'vanyen96',
                    'address' => 'Hà Nội',
                    'phone' => '1',
                    'level' => 1,
                    'remember_token' => ''
                ],[
                    'fullname' => 'Võ Thị Phương',
                    'email' => 'supper5@gmail.com',
                    'password' => 'vanyen96',
                    'address' => 'Hà Nội',
                    'phone' => '1',
                    'level' => 1,
                    'remember_token' => ''
                ],[
                    'fullname' => 'Đàm Thị Phượng',
                    'email' => 'supper6@gmail.com',
                    'password' => 'vanyen96',
                    'address' => 'Hà Nội',
                    'phone' => '1',
                    'level' => 1,
                    'remember_token' => ''
                ],[
                    'fullname' => 'Nguyễn Duy Dũng',
                    'email' => 'supper7@gmail.com',
                    'password' => 'vanyen96',
                    'address' => 'Hà Nội',
                    'phone' => '1',
                    'level' => 1,
                    'remember_token' => ''
                ],[
                    'fullname' => 'Nguyễn Thị Hoàn',
                    'email' => 'supper8@gmail.com',
                    'password' => 'vanyen96',
                    'address' => 'Hà Nội',
                    'phone' => '1',
                    'level' => 1,
                    'remember_token' => ''
                ]]
            );

        // for($i = 1; $i < 30; ++$i){

        //     DB::table('category')->insert([
        //         'name' => 'Điện thoại ',
        //         'slug' => changeTitle('Điện thoại').' ',
        //         'cat_order' =>$i,
        //         'parent_id' => $i,
        //         'keywords' => 'Điện thoại ',
        //         'description' => 'Điện thoại ',
        //     ]);
        // }

        

    }
}
