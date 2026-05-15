<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArchivesController extends Controller
{
    public function index(): View
    {
        $concepts = Concept::onlyTrashed()
            ->whereHas('domain', fn ($q) => $q->where('user_id', auth()->id()))
            ->with('domain')
            ->orderBy('deleted_at', 'desc')
            ->get();

        return view('archives', compact('concepts'));
    }

    public function restore(int $concept): RedirectResponse
    {
        $concept = Concept::onlyTrashed()
            ->whereHas('domain', fn ($q) => $q->where('user_id', auth()->id()))
            ->findOrFail($concept);

        $domainId = $concept->domain_id;
        $concept->restore();

        return redirect()->back()->with('success', 'Concept restaure.');
    }

    public function destroy(int $concept): RedirectResponse
    {
        $concept = Concept::onlyTrashed()
            ->whereHas('domain', fn ($q) => $q->where('user_id', auth()->id()))
            ->findOrFail($concept);

        $concept->forceDelete();

        return redirect()->back()->with('success', 'Concept supprime definitivement.');
    }
}
