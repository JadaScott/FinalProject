<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group_name');
            $table->integer('permissions_id');
            $table->timestamps();
        });
        DB::table('groups')->insert(
            array(
                'group_name' => 'admin', 'permissions_id' => '1'
            )
        );
        DB::table('groups')->insert(
            array(
                'group_name' => 'customer', 'permissions_id' => '2'
            )
        );
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}