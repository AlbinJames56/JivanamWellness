<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        // only active members, featured first, then by sort_order
        $teamMembers = TeamMember::query()
            ->where('active', true)
            ->orderByDesc('featured')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // other page content could be loaded similarly (stats etc).
        return view('pages.about', compact('teamMembers'));
    }
}
