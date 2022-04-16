<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Department;

class UniversityStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // if (!Schema::hasTable('faculty')) {
        //     Schema::create('faculty', function(Blueprint $table) {
        //         $table->id();
        //         $table->string('name');
        //         $table->timestamp();
        //     });
        // }

        if (!Schema::hasTable('department')) {
            Schema::create('department', function(Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->foreignIdFor(Department::class);
                $table->timestamps();
            });
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
