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
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->decimal('price', 10, 2);
            $table->decimal('last_price', 10, 2)->nullable();
            $table->longText('description')->nullable();
            $table->integer('qty')->default(0);
            $table->longText('images')->nullable();
            $table->smallInteger('featured')->default(0)->nullable();

            $table->unsignedInteger('category_id')->index()->nullable();
            $table->unsignedInteger('sub_category_id')->index()->nullable();
            $table->unsignedInteger('brand_id')->index()->nullable();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('set null');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
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
