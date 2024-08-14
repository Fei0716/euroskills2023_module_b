<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    use HasFactory;

    public function service_usages(){
        return $this->hasMany(ServiceUsage::class);
    }

    public function services() {
        $service_usages = $this->service_usages;
        $services = [];
        foreach ($service_usages as $su) {
            $serviceName = $su->service->name;
            // Initialize the service entry if it doesn't exist, a 3d array
            if (!isset($services[$serviceName][Carbon::parse($su->created_at)->format('m')])) {
                $services[$serviceName][Carbon::parse($su->created_at)->format('m')] = (object)[
                    'total_time' => 0,
                    'total_cost' => 0,
                    'cost_per_second' => $su->service->cost_per_second,
                ];
            }
            // Calculate total time and cost
            $services[$serviceName][Carbon::parse($su->created_at)->format('m')]->total_time += $su->usage_duration / 1000;
            $services[$serviceName][Carbon::parse($su->created_at)->format('m')]->total_cost += $su->usage_duration   * $su->service->cost_per_second;
        }
        return $services;
    }
}
