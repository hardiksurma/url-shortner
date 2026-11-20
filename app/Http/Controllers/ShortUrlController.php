<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function create()
    {
        abort_unless(auth()->user()->hasAnyRole(['admin', 'member']), 403);
        return view('short_urls.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        abort_unless($user->hasAnyRole(['admin', 'member']), 403);

        $validated = $request->validate([
            'original_url' => ['required', 'url:http,https', 'max:2048'],
        ]);

        do {
            $shortCode = Str::lower(Str::random(7));
        } while (ShortUrl::where('short_code', $shortCode)->exists());

        ShortUrl::create([
            'company_id' => $user->company_id,
            'user_id' => $user->id,
            'original_url' => $validated['original_url'],
            'short_code' => $shortCode,
            'clicks' => 0,
        ]);

        return redirect()->route('dashboard')->with('success', 'Short URL created successfully.');
    }

    public function redirect(string $shortCode)
    {
        $shortUrl = ShortUrl::where('short_code', $shortCode)->firstOrFail();
        $shortUrl->increment('clicks');
        return redirect()->away($shortUrl->original_url);
    }
}
