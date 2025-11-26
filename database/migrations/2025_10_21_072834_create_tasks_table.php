<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/*カリキュラムにはこれは行ってる*///use Illuminate\Support\Carbon; // 日時を入れるためによく使います

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);//nullableになっているがvalidationでエラーするようにしたため一旦このままになってる
            $table->text('content')->nullable(false);//nullableになっているがvalidationでエラーするようにしたため一旦このままになってる
            $table->dateTime('deadline_at')->nullable(false);//nullableになっているがvalidationでエラーするようにしたため一旦このままになってる
            $table->dateTime('support_at');//->nullable(false)になっていないままマイグレーションを実行。sql側クエリでALTER TABLE tasks MODIFY support_at DATETIME NULL;を実行済
            $table->integer('priority')->nullable(false);//nullableになっているがセレクトボックスで空欄にならないようにしたため一旦このままになってる
            $table->integer('status')->nullable(false);//nullableになっているがセレクトボックスで空欄にならないようにしたため一旦このままになってる
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
