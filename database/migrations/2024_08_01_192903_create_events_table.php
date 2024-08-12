<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->enum('event_type', ['webinar', 'bemawa', 'komunitas']);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('status', ['active', 'inactive']);
            $table->enum('jenis_event', ['Online', 'Offline']); // Menambahkan kolom jenis_event
            $table->string('image')->nullable(); // Menambahkan kolom gambar
            $table->string('organizer'); // Menambahkan kolom penyelenggara
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
        Schema::dropIfExists('events');
    }
}
