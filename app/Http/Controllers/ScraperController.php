<?php

namespace App\Http\Controllers;

use App\Keyword;
use App\Result;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ScraperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $keywords = Keyword::all();

        return view('pages.index', compact('keywords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
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

        return redirect('/history/' . $keyword->id);
    }

    public function redirectKeyword(Request $request)
    {
        return redirect('/history/' . $request->keyword_id);
    }

    /**
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getResults($keyword)
    {
        $finalResults = [];

        for ($i = 1; $i < 100; $i += 10) {
            $results = $this->curlData($keyword, $i);

            if ($results->searchInformation->totalResults <= 100) {
                $totalResults = $results->searchInformation->totalResults;
            } else {
                $totalResults = 100;
            }

            foreach ($results->items as $item) {
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

    public function curlData($keyword, $start = 1)
    {
        $apiKey = 'AIzaSyBsuANKyHDVKOlOwEoEeHyCasSbjj0saag';
        $cxKey = '015615786150392790734%3Adsww8gy6ify';
        $fields = urlencode('items(link,snippet,title),searchInformation/totalResults');

        $keyword = urlencode(str_replace(' ', '+', $keyword));

        $url = 'https://www.googleapis.com/customsearch/v1?q='. $keyword .'&cx='. $cxKey .'&fields='. $fields .'&start='. $start .'&key='. $apiKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);

        return json_decode($data);
    }
}
