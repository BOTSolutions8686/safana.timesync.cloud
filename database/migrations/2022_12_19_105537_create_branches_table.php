<?php

use App\Models\Branch;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('user_id');
            $table->bigInteger('company_id');
            $table->bigInteger('status_id')->default(1)->comment('1=active,4=inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        $branch=new Branch();
        $branch->name='Head Office';
        $branch->address='Head Office';
        $branch->phone='55887744';
        $branch->email='headoffice@hrm.com';
        $branch->user_id=2;
        $branch->company_id=2;
        $branch->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
