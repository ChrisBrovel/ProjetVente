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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();  
            $table->enum('status', ['en_attente', 'en_cours', 'livré','annulé'])->default('en_attente');
             $table->enum('moyen_de_payement', ['carte_bancaire', 'mobile_money', ])->default('carte_bancaire');
            $table->decimal('Montant_total', 12, 2)->default(0);
            $table->string('adresse_livraison')->default('');
             $table->date('date_commande')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
