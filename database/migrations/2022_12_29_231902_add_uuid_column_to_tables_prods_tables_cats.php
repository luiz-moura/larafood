<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->uuid();
        });
        Schema::table('tables', function (Blueprint $table) {
            $table->uuid();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->uuid();
        });

        DB::statement('ALTER TABLE products ALTER COLUMN uuid SET DEFAULT uuid_generate_v4();');
        DB::statement('ALTER TABLE tables ALTER COLUMN uuid SET DEFAULT uuid_generate_v4();');
        DB::statement('ALTER TABLE categories ALTER COLUMN uuid SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
        Schema::table('tables', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
