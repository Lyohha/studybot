<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Roles;

class UserRolesLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_role_link', function(Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Roles::class);
            $table->timestamps();
        });

        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('role_id');
        });

        Schema::table('roles', function(Blueprint $table) {
            $table->dropColumn('rules');
            $table->boolean('edit_roles')->after('name')->default(false);
        });
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
