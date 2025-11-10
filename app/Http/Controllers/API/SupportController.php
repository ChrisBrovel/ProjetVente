<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportClient;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        return response()->json($request->user()->supportTickets);
    }

    public function show($id)
    {
        return response()->json(SupportClient::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $ticket = SupportClient::create([
            'user_id' => $request->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'status'  => 'open',
        ]);

        return response()->json($ticket, 201);
    }

    public function reply(Request $request, $id)
    {
        if (!Gate::allows('admin')) {
            return response()->json(['message'=>'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $ticket = SupportClient::findOrFail($id);
        $ticket->admin_reply = $request->message;
        $ticket->status = 'answered';
        $ticket->save();

        return response()->json($ticket);
    }

    public function update(Request $request, $id)
    {
        if (!Gate::allows('admin')) {
            return response()->json(['message'=>'Unauthorized'], 403);
        }

        $ticket = SupportClient::findOrFail($id);
        $ticket->update($request->only(['subject','message','status']));
        return response()->json($ticket);
    }

    public function destroy($id)
    {
        if (!Gate::allows('admin')) {
            return response()->json(['message'=>'Unauthorized'], 403);
        }

        $ticket = SupportClient::findOrFail($id);
        $ticket->delete();

        return response()->json(['message'=>'Ticket deleted']);
    }
}
