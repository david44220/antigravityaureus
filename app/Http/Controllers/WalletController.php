<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\DepositFundsAction;
use App\Http\Requests\DepositFundsRequest;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WalletController extends Controller
{
    /**
     * Display the user's wallet balances and transaction history.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $wallet = $user->wallet()->firstOrCreate([]);

        $transactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->paginate(15);

        return view('wallet.index', compact('user', 'wallet', 'transactions'));
    }

    /**
     * Handle fund deposits into the user's purchase balance.
     */
    public function deposit(DepositFundsRequest $request, DepositFundsAction $depositFunds): RedirectResponse
    {
        $user = $request->user();
        $amount = (float) $request->validated('amount');

        $depositFunds->execute($user, $amount);

        return redirect()->route('wallet.index')
            ->with('status', "Successfully credited \${$amount} to your purchase balance.");
    }
}
