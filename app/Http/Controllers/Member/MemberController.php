<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberFormRequest;
use App\Imports\MembersImport;
use App\Models\Member;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new member in list
     * @param MemberFormRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function storeMember(MemberFormRequest $request)
    {
        $input = $request->all();
        Member::store($input['name'], $input['email'], $input['phone']);
        return $this->index();
    }

    /**
     * Show all members from configurated list
     * @param false $clicked
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($clicked=false)
    {
        $members = Member::getMembers();
        $uploadButton = false;
        foreach ($members as $member) {
            if (!$member->uploaded)
                $uploadButton = true;
        }

        return view('members.list', ['members' => $members, 'uploadButton' => $uploadButton,'clicked'=>$clicked]);
    }

    /**
     * Show create member form
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Upload all not uploaded members
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function uploadMembers()
    {
        $members = Member::getMembers();
        $upload = false;
        foreach ($members as $member) {
            if (!$member->uploaded)
                $upload = true;
        }
        if ($upload) {
            Member::uploadAllMembers();
        }
        return $this->index();
    }

    /**
     * Import CSV with members
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(\Illuminate\Http\Request $request)
    {
        Excel::import(new MembersImport,($request['members']));
        return Redirect::to('/members');
    }

    /**
     * Show import csv form
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function importForm()
    {
        return view('members.import');
    }

}
