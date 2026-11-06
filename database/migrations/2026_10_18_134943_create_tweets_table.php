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
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            $table->string('name');                   // Tên người đăng
            $table->string('image');                  // Link ảnh đại diện
            $table->string('handle');                 // Username dạng @handle
            $table->text('tweet');                     // Nội dung bài viết
            $table->string('file')->nullable();       // Đường dẫn file ảnh/video (có thể để trống)
            $table->boolean('is_video')->nullable();   // Đánh dấu: true nếu là video, false nếu là ảnh
            $table->string('comments');               // Số lượng bình luận
            $table->string('retweets');               // Số lượng retweet
            $table->string('likes');                  // Số lượng tim/thích
            $table->string('analytics');              // Số lượng lượt xem (analytics)
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweets');
    }
};
