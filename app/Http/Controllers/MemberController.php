<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('member_id', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $members = $query->latest()->paginate(15)->withQueryString();
        $totalMembers = Member::count();
        $activeMembers = Member::where('status', 'Aktif')->count();

        return view('members.index', compact('members', 'totalMembers', 'activeMembers'));
    }

    public function create()
    {
        // Generate next member ID like ANG006
        $latest = Member::orderBy('id', 'desc')->first();
        $nextNum = $latest ? ((int) filter_var($latest->member_id, FILTER_SANITIZE_NUMBER_INT) + 1) : 1;
        $suggestedId = 'ANG' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);

        return view('members.create', compact('suggestedId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => ['required', 'string', 'unique:members,member_id'],
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:50', 'unique:members,nim'],
            'class_name' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', 'unique:members,email'],
            'status' => ['required', Rule::in(['Aktif', 'Nonaktif'])],
        ]);

        $member = Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', 'Anggota "' . $member->name . '" berhasil didaftarkan.');
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'member_id' => ['required', 'string', Rule::unique('members', 'member_id')->ignore($member->id)],
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:50', Rule::unique('members', 'nim')->ignore($member->id)],
            'class_name' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', Rule::unique('members', 'email')->ignore($member->id)],
            'status' => ['required', Rule::in(['Aktif', 'Nonaktif'])],
        ]);

        $member->update($validated);

        return redirect()->route('members.index')
            ->with('success', 'Data anggota "' . $member->name . '" berhasil diperbarui.');
    }

    public function destroy(Member $member)
    {
        if ($member->loans()->where('status', 'Dipinjam')->exists()) {
            return back()->with('error', 'Anggota tidak dapat dihapus karena masih memiliki pinjaman buku yang belum dikembalikan.');
        }

        $name = $member->name;
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota "' . $name . '" berhasil dihapus.');
    }
}