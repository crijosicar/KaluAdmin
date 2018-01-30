<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'deleted_at')) {
            Schema::table('users', function ($table) {
                $table->string('device_id')->nullable();
                $table->char('gender', 1)->nullable();
                $table->date('birth_day')->nullable();
                $table->string('range_income')->nullable();
                $table->string('img_profile')->nullable();
                $table->string('occupation')->nullable();
            });
        } else {
            Schema::table('users', function ($table) {
                $table->string('device_id')->nullable();
                $table->char('gender', 1)->nullable();
                $table->date('birth_day')->nullable();
                $table->string('range_income')->nullable();
                $table->string('img_profile')->nullable();
                $table->string('occupation')->nullable();
                $table->softDeletes();	
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
        if (Schema::hasColumn('users', 'deleted_at')) {
            Schema::table('users', function ($table) {
                $table->dropColumn([
                    'device_id',
                    'gender',
                    'birth_day',
                    'range_income',
                    'img_profile',
                    'deleted_at',
                    'occupation'
                ]);
            });
        } else {
            Schema::table('users', function ($table) {
                $table->dropColumn([
                    'device_id',
                    'gender',
                    'birth_day',
                    'range_income',
                    'img_profile',
                    'occupation'
                ]);
            });
        }
    }
}
