<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the Migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('domain')->unique();
            $table->timestamps();
        });

        Schema::create('domain_dns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('domain_id')->constrained('domains');
            $table->string('type');
            $table->string('ttl');
            $table->json('options')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the Migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domain_dns');
        Schema::dropIfExists('domains');
    }
}
