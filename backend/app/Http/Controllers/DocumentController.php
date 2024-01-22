<?php

namespace App\Http\Controllers;

use App\Models\ApprovalConfig;
use App\Models\Document;
use App\Models\DocumentApproval;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController
{
    function save(Request $r)
    {
        $bod = json_decode($r->getContent());

        $doc = Document::query()->updateOrCreate(['id' => isset($bod->id) ? $bod->id : null], (array) $bod);

        // Save doc items
        if (isset($bod->document_approvals)) {
            foreach ($bod->document_approvals as $a) {

                DB::transaction(function () use ($a, $doc) {
                    $a->document_id = $doc->id;
                    DocumentApproval::query()->updateOrCreate(['id' => isset($a->id) ? $a->id : null], (array) $a);
                });
            }
        }



        return response($doc);
    }
}
