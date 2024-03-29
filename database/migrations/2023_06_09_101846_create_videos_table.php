<?php

use App\Enums\VideoStatus;
use App\Models\Video;
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
        Schema::create('videos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('description');
            $table->string('src');
            $table->enum('status' , [VideoStatus::Deleted->getStringValue(),VideoStatus::Approved->getStringValue(),
                VideoStatus::Rejected->getStringValue(),
                VideoStatus::Pending->getStringValue()])->default(VideoStatus::Pending->getStringValue());
            $table->string('reject_reason')->nullable();
            $table->unsignedBigInteger('view')->default(0);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
