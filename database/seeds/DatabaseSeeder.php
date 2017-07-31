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
        // $this->call(UsersTableSeeder::class);
        $this->call(CategoriTableSeeder::class);
    }
}

/**
 * summary
 */
class CategoriTableSeeder extends Seeder
{
    /**
     * summary
     */
    public function run()
    {

        DB::table('users')->insert([
            ['name'=>'admin', 'email'=>'quangducchung@gmail.com', 'password'=>bcrypt(123456), 'quyen'=>1]
        ]);
        // DB::table('categories')->insert([
        // 	['ten' => 'Xã Hội','tenkhongdau' => 'Xa-Hoi'],
        //     ['ten' => 'Thế Giới','tenkhongdau' => 'The-Gioi'],
        //     ['ten' => 'Kinh Doanh','tenkhongdau' => 'Kinh-Doanh'],
        //     ['ten' => 'Văn Hoá','tenkhongdau' => 'Van-Hoa'],
        //     ['ten' => 'Thể Thao','tenkhongdau' => 'The-Thao'],
        //     ['ten' => 'Pháp Luật','tenkhongdau' => 'Phap-Luat'],
        //     ['ten' => 'Đời Sống','tenkhongdau' => 'Doi-Song'],
        //     ['ten' => 'Khoa Học','tenkhongdau' => 'Khoa-Hoc'],
        //     ['ten' => 'Vi Tính','tenkhongdau' => 'Vi-Tinh']
        // ]);
        // for($i=1; $i<=10; $i++){
        //     DB::table('users')->insert([
        //         ['name'=>str_random(5), 'email'=>'chungqd'.$i.'@gmail.com', 'password'=>bcrypt(12345), 'quyen'=>0]
        //     ]);
        // }
    }
}
