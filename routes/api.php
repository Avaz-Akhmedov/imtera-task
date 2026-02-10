<?php


use App\Http\Requests\ValidateYandexUrlRequest;
use App\Models\YandexOrganization;
use Illuminate\Support\Facades\DB;

\Illuminate\Support\Facades\Route::post('/test', function (ValidateYandexUrlRequest $request) {

    $service = new \App\Services\YandexScraperService();
    $data = $service->scrapeReviews($request->input('url'));
    DB::transaction(function () use ($data) {

        $organization = YandexOrganization::query()->firstOrCreate(['organization_id' => $data['organizationId']], [
            'count_of_ratings' => $data['countOfRatings'],
            'count_of_reviews' => $data['countOfReviews'],
            'rating' => $data['rating'],

        ]);

        foreach ($data['reviews'] as $review) {
            $organization->reviews()->updateOrCreate(
                [
                    'author' => $review['reviewerName'],
                    'review_date' => $review['reviewDate'],
                ],
                [
                    'content' => $review['reviewText'],
                    'rating' => $review['reviewRating'],
                ]);
        }

    });

    return [
        'success' => true
    ];
});
