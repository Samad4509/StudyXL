<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
   // List all transactions
    public function index()
    {
        $admin = Auth::guard('admin_token')->user();
        $transactions = Transaction::all();
        return response()->json([
            'success' => true,
            'message' => 'Transactions retrieved successfully',
            'data' => $transactions
        ]);
    }

    // Show single transaction
    public function show($id)
    {
        $admin = Auth::guard('admin_token')->user();
        $transaction = Transaction::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'Transaction retrieved successfully',
            'data' => $transaction
        ]);
    }

    // Create a new transaction
    public function store(Request $request)
    {
        $admin = Auth::guard('admin_token')->user();

        $data = $request->validate([
            'agent_name' => 'required|string',
            'agent_id' => 'required|string',
            'student_name' => 'required|string',
            'student_id' => 'required|string',
            'university' => 'required|string',
            'program' => 'required|string',
            'tuition_fee' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'balance_due' => 'required|numeric',
            'comm_percent' => 'required|numeric',
        ]);

        // Commission calculation
        $data['comm_earned'] = $data['paid_amount'] * ($data['comm_percent'] / 100);

        // Status auto-calculation
        if ($data['paid_amount'] == 0) {
            $data['status'] = 'Unpaid';
        } elseif ($data['paid_amount'] < $data['tuition_fee']) {
            $data['status'] = 'Partial';
        } else {
            $data['status'] = 'Fully Paid';
        }

        $transaction = Transaction::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully',
            'data' => $transaction
        ], 201);
    }

    // Update a transaction
    public function update(Request $request, $id)
    {
        $admin = Auth::guard('admin_token')->user();
        $transaction =Transaction::findOrFail($id);

        $data = $request->validate([
            'agent_name' => 'sometimes|required|string',
            'agent_id' => 'sometimes|required|string',
            'student_name' => 'sometimes|required|string',
            'student_id' => 'sometimes|required|string',
            'university' => 'sometimes|required|string',
            'program' => 'sometimes|required|string',
            'tuition_fee' => 'sometimes|required|numeric',
            'paid_amount' => 'sometimes|required|numeric',
            'balance_due' => 'sometimes|required|numeric',
            'comm_percent' => 'sometimes|required|numeric',
        ]);

        $transaction->fill($data);

        // Recalculate commission if paid_amount or comm_percent changed
        if (array_key_exists('paid_amount', $data) || array_key_exists('comm_percent', $data)) {
            $transaction->comm_earned = $transaction->paid_amount * ($transaction->comm_percent / 100);
        }

        // Recalculate status if paid_amount or tuition_fee changed
        if (array_key_exists('paid_amount', $data) || array_key_exists('tuition_fee', $data)) {
            if ($transaction->paid_amount == 0) {
                $transaction->status = 'Unpaid';
            } elseif ($transaction->paid_amount < $transaction->tuition_fee) {
                $transaction->status = 'Partial';
            } else {
                $transaction->status = 'Fully Paid';
            }
        }

        $transaction->save();

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated successfully',
            'data' => $transaction
        ]);
    }

    // Delete a transaction
    public function destroy($id)
    {
        $admin = Auth::guard('admin_token')->user();
        $transaction =Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully'
        ]);
    }

      public function myTransactions()
    {
        $agent = Auth::guard('agent_token')->user();

        $transactions = Transaction::where('agent_id', $agent->id)->get();

        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }

}
