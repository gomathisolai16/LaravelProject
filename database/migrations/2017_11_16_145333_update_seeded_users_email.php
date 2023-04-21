<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSeededUsersEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = User::where('username','testadmin')->first();
        if ($user) {
            $user->email = 'test099@mailinator.com';
            $user->save();
        }

        $user = User::where('username','testadvanced')->first();
        if ($user) {
            $user->email = 'testadvanced099@mailinator.com';
            $user->save();
        }
        
        $user = User::where('username','testuser')->first();
        if ($user) {
            $user->email = 'testuser099@mailinator.com';
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
