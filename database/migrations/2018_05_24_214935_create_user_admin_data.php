<?php

use BluesFlix\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAdminData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $model = User::create([
            'name' => env('ADMIN_DEFAULT_NAME', 'Administrator'),
            'email' => env('ADMIN_DEFAULT_EMAIL', 'admin@user.com'),
            'password' => bcrypt(env('ADMIN_DEFAULT_PASSWORD', 'admin@user.com')),
            'role' => User::ROLE_ADMIN
        ]);
        $model->verified = true;
        $model->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = (new User())->getTable();
        \DB::table($table)
            ->where('email', '=', env('ADMIN_DEFAULT_EMAIL', 'admin@user.com'))
            ->delete();

    }
}
