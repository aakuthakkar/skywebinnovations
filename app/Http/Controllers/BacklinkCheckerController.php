<?php

namespace App\Http\Controllers;

use App\Services\Backlinks\BacklinkReportService;
use Illuminate\Http\Request;

/**
 * Public "Backlink Checker" — a free tool that shows the backlinks pointing
 * to any domain. Doubles as a link-magnet: useful free tools earn backlinks.
 *
 * For the site's own domain it shows real, first-party tracked links; for any
 * other domain it shows data from the configured backlink API (sample data on
 * free plans). If no API key is configured it explains that honestly rather
 * than showing fake numbers.
 */
class BacklinkCheckerController extends Controller
{
    public function __construct(
        private readonly BacklinkReportService $reports,
    ) {}

    /**
     * Landing page: the enter-a-domain form (the tool's entry point).
     */
    public function index()
    {
        return view('backlink-checker');
    }

    /**
     * Show the report for a domain. GET so reports are linkable/shareable
     * (good for SEO), e.g. /backlink-checker?domain=example.com&page=2
     */
    public function show(Request $request)
    {
        $validated = $request->validate([
            'domain' => ['required', 'string', 'max:253'],
            'page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ], [
            'domain.required' => 'Please enter a domain to check.',
        ]);

        $page = (int) ($validated['page'] ?? 1);

        $result = $this->reports->lookup(
            domain: $validated['domain'],
            page: $page,
            perPage: 50,
            clientKey: $request->ip(),
        );

        if (! $result['ok']) {
            return redirect()
                ->route('backlink-checker.index')
                ->withInput()
                ->withErrors(['domain' => $result['error']]);
        }

        return view('backlink-report', [
            'report' => $result['report'],
        ]);
    }
}
