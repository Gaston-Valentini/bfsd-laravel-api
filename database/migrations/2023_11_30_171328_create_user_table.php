<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string("name", 50);
            $table->string("surname", 50);
            $table->string("nickname", 50)->unique();
            $table->string("email", 50)->unique();
            $table->string("password");
            $table->enum('role', ["user", "admin"]);
            $table->string("image", 255)->default("https://cdn-icons-png.flaticon.com/512/456/456212.png");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->boolean("is_active")->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
