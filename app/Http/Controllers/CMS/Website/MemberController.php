<?php

namespace App\Http\Controllers\CMS\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use App\Models\Member;
use DB;

class MemberController extends Controller
{
    private $baseView;
    
    public function __construct()
    {
        $this->baseView = 'cms/website/members';
    }

    public function index()
    {
        $members = Member::oldest('sort')->get();
        return view($this->baseView . '/index', compact('members'));
    }

    public function create()
    {
        return view($this->baseView . '/create');
    }

    public function store(MemberRequest $request)
    {
        $finalThumbnail = '';
        if ($request->hasFile('thumbnail')) {
            $finalThumbnail = $this->fileUploadHandler($request->thumbnail, 'uploads/members/');
        }

        $member = new Member;
        $member->name = $request->name;
        $member->thumbnail = $finalThumbnail;
        $member->position = $request->position;
        $member->excerpt = $request->excerpt;
        $member->sort = $request->sort;
        $member->save();

        return back()->with('success', 'New member has been added.');
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view($this->baseView . '/edit', compact('member'));
    }

    public function update(MemberRequest $request, $id)
    {
        $member = Member::findOrFail($id);

        $finalThumbnail = $member->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if (!empty($member->thumbnail) && file_exists(public_path('uploads/members/' . $member->thumbnail))) {
                unlink(public_path('uploads/members/' . $member->thumbnail));
            }
            $finalThumbnail = $this->fileUploadHandler($request->thumbnail, 'uploads/members/');
        }

        $member->name = $request->name;
        $member->thumbnail = $finalThumbnail;
        $member->position = $request->position;
        $member->excerpt = $request->excerpt;
        $member->sort = $request->sort;
        $member->save();

        return back()->with('success', 'Member updated successfully.');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        if (!empty($member->thumbnail) && file_exists(public_path('uploads/members/' . $member->thumbnail))) {
            unlink(public_path('uploads/members/' . $member->thumbnail));
        }

        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}
