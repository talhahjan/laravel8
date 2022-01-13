<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        $table->id();
            $table->string('title');
            $table->mediumText('description');
            $table->double('price');
            $table->integer('discount')->default(0);
            $table->string('discount_price')->nullable();
            $table->string('color');
            $table->text('stock');   // stock within size i.e {6-2,7-1} it means we have 2 pairs of size 6 and 1 of size 7
            $table->text('size_range'); // result passed by a predefined array of sizes to populate size range 
            $table->string('slug')->unique();
            $table->integer('status')->default(1);
            $table->integer('featured')->default(0);
            $table->text('options')->nullable();
            $table->foreignId('brand_id')->nullable()
            ->constrained('brands')
            ->onUpdate('cascade')
            ->onDelete('SET NULL');
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
        Schema::dropIfExists('products');    }
}
