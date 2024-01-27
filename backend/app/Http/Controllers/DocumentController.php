<?php

namespace App\Http\Controllers;

use App\Mail\GenericMail;
use App\Models\ApprovalConfig;
use App\Models\Document;
use App\Models\DocumentApproval;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DocumentController
{
    function save(Request $r)
    {
        // dd('abcc');
        $bod = json_decode($r->getContent());

        $doc = Document::query()->updateOrCreate(['id' => isset($bod->id) ? $bod->id : null], (array) $bod);

        // If id null/ zero, send email to first user

        if (!isset($bod->id) || (isset($bod->id) && $bod->id === 0)) {
            $firstUser = current($bod->document_approvals);
            $userNeededId = $firstUser->approval_needed_user_id;
            $foundUser = User::query()->find($userNeededId);

            // dd($foundUser);

            Mail::to($foundUser->email)->send(new GenericMail(env('MAIL_USERNAME'), 'You have new email.'));
        }

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
