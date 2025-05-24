<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pasien', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pasien', function (Blueprint $table) {
            //
        });
    }
    
};

class AddNoRmToPasienTable extends Migration
{
    public function up()
    {
        Schema::table('pasien', function (Blueprint $table) {
            $table->string('no_rm')->nullable(); // Menambahkan kolom no_rm
        });
    }

    public function down()
    {
        Schema::table('pasien', function (Blueprint $table) {
            $table->dropColumn('no_rm'); // Menghapus kolom no_rm
        });
    }
}
