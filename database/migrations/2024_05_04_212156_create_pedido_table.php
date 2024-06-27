<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->id();
            $table->string('fecha');
            $table->string('nombre_cli');
            $table->string('apellido_cli');
            $table->string('dni_cli');
            $table->integer('telefono_cli');
            $table->string('correo_cli');
            $table->string('departamento_cli');
            $table->string('distrito_cli');
            $table->string('direccion_cli');
            $table->string('referencia_cli');
            $table->string('mensaje_cli');
            $table->string('producto');
            $table->string('metodo_pago');
            $table->string('banca_billetera');
            $table->string('estado_pedido');
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
        Schema::dropIfExists('pedido');
    }
}
