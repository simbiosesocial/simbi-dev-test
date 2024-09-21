<?php

namespace App\Http\Controllers;

use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use App\Http\Resources\Library\ListAllLoansResource;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::all();
        return response()->json($loans);
    }    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required',
            'author_id' => 'required',
            'user_email' => 'required',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:loan_date',
        ]);

        $loan = Loan::create($validatedData);
        return response()->json($loan, 201);
    }

    public function show($id)
    {
        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
        return response()->json($loan);
    }

    public function destroy($id)
    {
        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
        $loan->delete();
        return response()->json(['message' => 'Loan deleted successfully']);
    }
}

