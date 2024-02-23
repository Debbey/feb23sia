<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Post;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->longText('post_name'); 
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->timestamps();
        });

        for ($i=0; $i < 100; $i++) { 
            $user = new User();
            $user->user_name = 'arieldave';
            $user->password = 'bombeos';
            $user->save();

            for ($i2=0; $i2 < 5; $i2++) { 
                $post = new Post();
                $post->post_name = 'Post Name ni sya' . $i2;
                $post->user_id = $user->id;
                $post->save();
            }
        }
    }


    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};