<?php

namespace App\Http\Controllers\API\Agent;

use App\Http\Controllers\Controller;
use App\Models\Client\Container;
use Illuminate\Http\Request;

class ApiContainerController extends Controller
{
    public function statusControll(Container $container)
    {
        if ($container->on_truck) {
            $container->update([
                'on_truck' => 0,
            ]);
            return response(['message' => 'ur offline'], 201);
        } else {
            $container->update([
                'on_truck' => 1,
            ]);
            return response(['message' => 'ur Online'], 201);
        }
    }
}
