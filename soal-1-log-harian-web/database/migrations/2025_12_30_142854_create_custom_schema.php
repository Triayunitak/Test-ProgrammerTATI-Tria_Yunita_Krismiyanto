<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user'); // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('user_name', 100);
            $table->string('email_user', 150)->unique();
            $table->string('user_password', 255);
            $table->enum('role', ['staff', 'kepala_bidang', 'kepala_dinas']);
            $table->unsignedBigInteger('supervisor_id')->nullable();
            
            // Constraint FK Supervisor
            $table->foreign('supervisor_id')->references('id_user')->on('users')->onDelete('set null');
            
            $table->timestamps(); // created_at, updated_at
        });

        Schema::create('daily_logs', function (Blueprint $table) {
            $table->id('id_logs'); 
            $table->unsignedBigInteger('user_id');
            $table->date('log_date');
            $table->text('activity_summary');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->text('verification_note')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            // Foreign Keys & Unique Constraint
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('verified_by')->references('id_user')->on('users')->onDelete('set null');
            $table->unique(['user_id', 'log_date']); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_logs');
        Schema::dropIfExists('users');
    }
};