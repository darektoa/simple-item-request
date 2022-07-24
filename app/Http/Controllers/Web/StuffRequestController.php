<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\{Stuff, StuffRequest, User};
use Exception;
use Illuminate\Http\Request;

class StuffRequestController extends Controller
{
    public function index() {
        $stuffRequests = StuffRequest::with(['user', 'stuffs'])
            ->latest()
            ->paginate(10);

        return view('pages.stuff-request.index', compact('stuffRequests'));
    }


    public function create() {
        $stuffs = Stuff::with(['location'])->get();
        $users  = User::with(['departement'])->get();

        return view('pages.stuff-request.create', compact('stuffs', 'users'));
    }


    public function store(Request $request) {
        try{
            $this->validate($request, [
                'receiver_id'       => 'required|exists:users,id',
                'stuffs'            => 'required|array',
                'stuffs.*.id'       => 'required|exists:stuffs,id',
                'stuffs.*.quantity' => 'required|numeric|min:1',
            ]);

            $stuffs = collect($request->stuffs)
                ->groupBy('id')
                ->map(function($item) {
                    $quantity = $item['quantity'] ?? $item->sum('quantity');
                    return ['quantity' => $quantity];
                });

            $stuffRequest = StuffRequest::create(['user_id' => 1]); // Example User
            $stuffRequest->stuffs()->attach($stuffs->toArray());

            return redirect()->route('stuffs.requests.index');
        }catch(Exception $err){
            dd($err->getMessage());
            return back()->withInput();
        }
    }
}
