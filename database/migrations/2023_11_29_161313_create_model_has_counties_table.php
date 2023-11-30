<?php

declare(strict_types=1);

use App\Models\County;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('model_has_counties', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->foreignIdFor(County::class)->constrained()->cascadeOnDelete();
        });
    }
};
