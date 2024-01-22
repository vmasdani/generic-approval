<?php

namespace App\Http\Controllers;

use App\Models\ApprovalConfig;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovalConfigController
{
    function saveBulk(Request $r)
    {
        $bod = json_decode($r->getContent());

        DB::transaction(function () use ($bod) {
            foreach ($bod as $c) {
                ApprovalConfig::query()->updateOrCreate(
                    ['id' => isset($c->id) ? $c->id : null],
                     (array) $c
                );
            }
        });


        return response("OK");
    }
}
