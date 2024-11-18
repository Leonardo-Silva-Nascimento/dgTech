<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    public function up()
    {
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_usuario')->nullable();
            $table->integer('tipo')->nullable();
            $table->string('modulo', 255)->nullable();
            $table->string('acao', 255)->nullable();
            $table->integer('id_ref')->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });

        Schema::create('logs_errors', function (Blueprint $table) {
            $table->id();
            $table->integer('id_usuario')->nullable();
            $table->string('pagina', 500)->nullable();
            $table->string('modulo', 500)->nullable();
            $table->text('erro')->nullable();
            $table->text('erro_completo')->nullable();
            $table->timestamps();
        });

        Schema::create('logs_tipos', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo')->nullable();
            $table->string('name', 50)->nullable();
            $table->string('name_eng', 50)->nullable();
        });

        Schema::create('migrations', function (Blueprint $table) {
            $table->id();
            $table->string('migration', 255);
            $table->integer('batch');
        });

        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->string('model_type', 192);
            $table->unsignedBigInteger('model_id');
            $table->primary(['permission_id', 'model_id', 'model_type']);
        });

        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->string('model_type', 192);
            $table->unsignedBigInteger('model_id');
            $table->primary(['role_id', 'model_id', 'model_type']);
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 125);
            $table->string('guard_name', 125);
            $table->integer('ordem')->default(0);
            $table->timestamps();
        });

        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('tokenable_type', 190);
            $table->unsignedBigInteger('tokenable_id');
            $table->string('name', 190);
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
        });

        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');
            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 125);
            $table->string('guard_name', 125);
            $table->string('status', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id', 192)->primary();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity');
        });

        Schema::create('smtp', function (Blueprint $table) {
            $table->id();
            $table->string('email', 500)->nullable();
            $table->string('password', 500)->nullable();
            $table->string('smtp', 500)->nullable();
            $table->string('porta', 500)->nullable();
            $table->string('host', 500)->nullable();
            $table->string('token', 255)->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('empresa')->default(0);
            $table->string('name', 192);
            $table->string('email', 192)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 192);
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->string('profile_picture', 192)->nullable();
            $table->string('status', 50)->default('');
            $table->boolean('is_master')->default(false);
            $table->string('phone', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('smtp');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('migrations');
        Schema::dropIfExists('logs_tipos');
        Schema::dropIfExists('logs_errors');
        Schema::dropIfExists('logs');
        Schema::dropIfExists('failed_jobs');
    }
}
