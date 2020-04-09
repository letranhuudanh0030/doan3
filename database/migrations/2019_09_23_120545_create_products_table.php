<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->decimal('price')->default(0);
            $table->decimal('discount')->default(0);
            $table->integer('product_category_id')->default(0);
            $table->integer('provider_id')->default(0);
            $table->string('short_desc')->nullable();
            $table->text('desc')->nullable();
            $table->string('image')->nullable();
            $table->text('images')->nullable();
            $table->boolean('publish')->default(0);
            $table->boolean('highlight')->default(0);
            $table->integer('sort_order')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('meta_keyword')->nullable();
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
        Schema::dropIfExists('products');
    }
}
