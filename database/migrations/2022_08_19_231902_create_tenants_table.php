<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('plan_id')
                ->nullable()
                ->constrained('plans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('cnpj')->unique();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('url')->unique();
            $table->string('logo')->nullable()->unique();
            $table->string('subscription_id', 255)->nullable();
            $table->enum('active', ['Y', 'N'])->default('Y');
            $table->boolean('subscription_active')->default(false);
            $table->boolean('subscription_suspended')->default(false);
            $table->date('subscribed_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
};
