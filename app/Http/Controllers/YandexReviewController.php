<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateYandexUrlRequest;
use App\Services\YandexScraperService;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;


class  YandexReviewController extends Controller
{
    public function __construct(public YandexScraperService $service)
    {
    }


    public function __invoke(ValidateYandexUrlRequest $request)
    {
        try {
            $validated = $request->validated();

            $data = $this->service->scrapeReviews($validated['url']);

            return Inertia::render('ScrapedReviews', [
                'scraped' => $data
            ]);
        } catch (\Exception $e) {
            Log::error('Yandex scraping error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to scrape reviews. Please try again.');
        }
    }

}
