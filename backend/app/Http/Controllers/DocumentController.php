<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Mail\GenericMail;
use App\Models\ApprovalConfig;
use App\Models\Document;
use App\Models\DocumentApproval;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DocumentController
{
    function get(int $id)
    {
        $doc = Document::query()->find($id);

        $doc->documentApprovals;

        return response($doc);
    }
    function all(Request $r)
    {
        $userId = $r->get('user_id');
        $approved = $r->get('approved');

        // Helper::ddh($userId);

        $docs = Document::all();

        // If user id is not null

        if ($userId) {
            $docApprovals = DocumentApproval::query();
            $docApprovals = $docApprovals->with('document');
            $docApprovals = $docApprovals->where('approval_needed_user_id', '=', $userId);

            if ($approved == 'true') {
                $docApprovals = $docApprovals->whereNotNull('approval_timestamp');
            } else {
                $docApprovals = $docApprovals->whereNull('approval_timestamp');
            }

            $docApprovals = $docApprovals->get();


            $docs = $docApprovals
                ->map(function (DocumentApproval $a) {
                    return $a->document;
                })
                ->unique(function (Document $d) {
                    return $d->id;
                })
                ->collect();
        }

        foreach ($docs as $d) {
            $d->documentApprovals;
        }

        return $docs;
    }

    function save(Request $r)
    {
        $bod = json_decode($r->getContent());

        $doc = Document::query()->updateOrCreate(
            ['id' => isset($bod->id) ? $bod->id : null],
            (array) $bod
        );

        // find the first non approved user
        // if (!isset($bod->id) || (isset($bod->id) && $bod->id === 0)) {
        /** @var DocumentApproval|null $firstUser */
        $firstUser = collect($bod->document_approvals)
            ->first(function ($d) {
                return !isset($d->approval_timestamp) || $d->approval_timestamp == null;
            });

        if ($firstUser) {
            $userNeededId = $firstUser->approval_needed_user_id;
            $foundUser = User::query()->find($userNeededId);

            try {
                $gm =   new GenericMail(
                    $doc->name ?? 'No Name',
                    env('MAIL_USERNAME'),
                    'You have new email.'
                );
                // Helper::ddh($gm);


                Mail::to($foundUser->email)->send(
                    $gm
                );
            } catch (Exception $e) {
                Helper::ddh($e);
                return;
            }
        }

        // }

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
