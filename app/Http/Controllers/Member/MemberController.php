<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberFormRequest;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeMember(MemberFormRequest $request)
    {
        $input = $request->all();
        Member::store($input['name'], $input['email'], $input['phone']);
        return $this->index();
    }

    public function index()
    {
        return view('members.list', ['members' => DB::table('members')->paginate(15)]);
    }

}
