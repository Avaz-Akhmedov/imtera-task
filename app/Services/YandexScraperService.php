<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class YandexScraperService
{
    public function scrapeReviews(string $url): array
    {
        $response = Http::withHeaders(
            [
                'Accept-Language' => 'ru-RU,ru;q=0.9',
            ]
        )->get($url);


        $crawler = new Crawler($response->body());

        $countOfRatings = $crawler->filter('[class*="business-rating-amount-view _summary"]')->first()->text();
        $countOfRatings = (int)preg_replace('/\D/', '', $countOfRatings);

        $countOfReviews = $crawler->filter('[class*="card-section-header__title _wide"]')->first()->text();
        $countOfReviews = (int)preg_replace('/\D/', '', $countOfReviews);
        $ratingParts = $crawler->filter('.business-summary-rating-badge-view__rating .business-summary-rating-badge-view__rating-text')
            ->each(function (Crawler $node) {
                return $node->text();
            });

        $rating = str_replace(',', '.', implode('', $ratingParts));

        $reviews = [];


        $reviewNodes = $crawler->filter('[class*="business-reviews-card-view__reviews-container"] .business-review-view')->slice(0, 5);

        $reviewNodes->each(function (Crawler $node) use (&$reviews) {
            $reviewText = $node->filter('.business-review-view__body')->text();

            $reviewerName = $node->filter('a.business-review-view__link span[itemprop="name"]')->text();

            $reviewDate = $node->filter('.business-review-view__date meta[itemprop="datePublished"]')
                ->attr('content');

            $ratingValueNode = $node->filter('span[itemprop="reviewRating"] meta[itemprop="ratingValue"]');
            $reviewRating = $ratingValueNode->count() ? (float)$ratingValueNode->attr('content') : null;

            $reviewDate = Carbon::parse($reviewDate)->toDateTimeString();

            $reviews[] = compact('reviewText', 'reviewerName', 'reviewDate', 'reviewRating');
        });

        preg_match('#/(\d+)/reviews/#', $url, $matches);
        $organizationId = $matches[1];


        return [
            'organizationId' => $organizationId,
            'countOfRatings' => $countOfRatings,
            'rating' => $rating,
            'countOfReviews' => $countOfReviews,
            'reviews' => $reviews,
        ];
    }
}
