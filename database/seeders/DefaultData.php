<?php

namespace Database\Seeders;

use App\Models\ApiToken;
use App\Models\Service;
use App\Models\Workspace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //insert into services
        $service1 = new Service();
        $service1->name = "Service #1";
        $service1->cost_per_second = 0.0015;
        $service1->save();

        $service2 = new Service();
        $service2->name = "Service #2";
        $service2->cost_per_second = 0.005;
        $service2->save();

        //insert workspace
        $workspace = new Workspace();
        $workspace->title = 'My App';
        $workspace->description = 'This is the workspace named My App';
        $workspace->user_id = 1;
        $workspace->save();

        //the api tokens
        $token1 = new ApiToken();
        $token1->name = "production";
        $token1->token = Hash::make("production");
        $token1->workspace_id = 1;
        $token1->save();

        $token2 = new ApiToken();
        $token2->name = "development";
        $token2->token = Hash::make("development");
        $token2->workspace_id = 1;
        $token2->save();

    }
}
