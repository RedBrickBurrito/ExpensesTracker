<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AttachmentMail;

class EmailsController extends Controller
{
    /**
     *  Sends an email with the info from the request.
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $file = null;
        $mailTo = $request->input('to');
        if ($request->hasFile('blobPdf') && $request->file('blobPdf')->isValid()) {
            \error_log('File blobPdf was received and it is valid');
            $file = $request->file('blobPdf');
        }
        Mail::to($mailTo)->send(new AttachmentMail($file));
    }
}
