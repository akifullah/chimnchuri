<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addon_groups', function (Blueprint $table) {
            $table->id();

            $table->uuid("uuid")->nullable()->unique();

            $table->foreignId("item_id")->constrained()->onDelete("cascade");
            $table->foreignId("addon_category_id")->constrained()->onDelete("cascade");

            $table->enum("selection_type", ["single", "multiple"])->default("multiple");

            $table->unsignedBigInteger("min_qty")->nullable();
            $table->unsignedBigInteger("max_qty")->nullable();

            $table->boolean("is_required")->default(false);
            $table->boolean("is_active")->default(true);

            $table->integer("sort_order")->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->unique(["item_id", "addon_category_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addon_groups');
    }
};
