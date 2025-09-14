<?php

use App\Traits\BaseModelSoftDeleteDefault;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use BaseModelSoftDeleteDefault;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 128);
            $table->string('image', 128)->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('stok')->default(0);
            $table->date('expired_at')->nullable();
            $table->double('harga_reseller')->default(0);
            $table->double('harga_eceran')->default(0);
            $this->base($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
