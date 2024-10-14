<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        DB::table('statuses')->insert([
            'name' => 'Ariza holatida',
        ]);
        DB::table('statuses')->insert([
            'name' => 'Yangi',
        ]);
        DB::table('statuses')->insert([
            'name' => 'Avto keldi',
        ]);
        DB::table('statuses')->insert([
            'name' => 'Avto kirdi',
        ]);
        DB::table('statuses')->insert([
            'name' => 'Yakunlandi',
        ]);
        DB::table('statuses')->insert([
            'name' => 'Qarz',
        ]);
        DB::table('statuses')->insert([
            'name' => 'Bekor qilindi',
        ]);
         DB::table('statuses')->insert([
             'name' => 'Chiqib ketti',
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
