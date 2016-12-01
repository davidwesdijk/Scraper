<?php

namespace App\Http\Controllers;

use App\Keyword;
use App\Result;
use App\Http\Utilities\ApiRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ScraperController extends Controller
{
    /**
     * Display the page with the select for all keywords
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $keywords = Keyword::all();

        return view('pages.index', compact('keywords'));
    }

    /**
     * Show the page with the form for a new scrape
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created Keyword and fetch the Google results
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'keyword' => 'required|max:255'
        ]);

        $results = $this->getResults($request->keyword);

        $keyword = Keyword::create($request->all());

        foreach ($results as $result)
        {
            $keyword->results()->create($result);
        }

        flash()->success('Success!', 'The results has successfully been retrieved from Google');

        return redirect('/history/' . $keyword->id);
    }

    /**
     * Redirect the user to the result page (show) after the creation of the instance\
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function redirectKeyword(Request $request)
    {
        return redirect('/history/' . $request->keyword_id);
    }

    /**
     * Display the keyword instance with results by keyword id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keyword = Keyword::where(
            'id', $id
        )->firstOrFail();

        $results = Result::where('keyword_id', $id)->paginate(10);

        return view('pages.show', compact('keyword', 'results'));
    }

    /**
     * Get a max. of 100 results by the keyword and return them in an array
     * 
     * @param  string $keyword 
     * @return array          
     */
    public function getResults($keyword)
    {
        $finalResults = [];

        // Google CSE limits the max. results by 10, so run 10 times
        for ($i = 1; $i < 100; $i += 10) {
            // Curl the results by 10 and store them in an array
            $results = ApiRequest::fetchGoogle($keyword, $i);

            // If Google has more than 100 results, limit them at 100
            if ($results->searchInformation->totalResults <= 100) {
                $totalResults = $results->searchInformation->totalResults;
            } else {
                $totalResults = 100;
            }

            // loop through the array and fill the final array with wanted values
            foreach ($results->items as $item) {
                // Skip the last entries if it exceeds the totalResults, just in case :-)
                if (count($finalResults) >= $totalResults) 
                    continue;

                $finalResults[] = [
                    'title' => $item->title,
                    'url' => $item->link,
                    'description' => $item->snippet
                ];
            }
        }

        return $finalResults;
    }
}
