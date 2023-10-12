<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studying_languages;
use App\Models\Studying_contents;
use App\Models\Records;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class topController extends Controller
{
    //
    public function index()
    {

        $languages = Studying_languages::all();
        $contents = Studying_contents::all();


        $now = Carbon::now();
        $now_format = $now->format('Y-m-d');

        $startOfDay = $now->startOfDay();
        $endOfDay = $now->endOfDay();

        $todays = DB::table('records')
            ->whereDate('record_at', '=', $now->format('Y-m-d'))
            ->sum('time');


        $month_format = $now->format('Y-m H:i');
        $weeks = $now->weekOfMonth;

        $months = DB::table('records')
            ->whereRaw('MONTH(record_at) = MONTH(?) AND YEAR(record_at) = YEAR(?)', [$now, $now])
            ->sum('time');

        $totals = DB::table('records')
            ->sum('time');


        $from = date('Y-m-01'); // 今月の初日
$to = date('Y-m-t'); // 今月の末日
        $dailyData = DB::table('records')
            ->select(DB::raw('DATE(record_at) as date'), DB::raw('SUM(time) as total_time'))
            ->whereBetween('record_at', [$from, $to])
            ->groupBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => Carbon::parse($item->date)->format('d'),
                    'total_time' => $item->total_time
                ];
            });
            // dd($endOfMonth);


        $learningData = DB::table('records')
            ->join('studying_languages', 'records.language_id', '=', 'studying_languages.id')
            ->select('studying_languages.language', 'studying_languages.chart_bgcolor', DB::raw('SUM(records.time) as total_time'))
            ->groupBy('studying_languages.language', 'studying_languages.chart_bgcolor')
            ->get();



        $chartData = [];
        foreach ($learningData as $item) {
            $chartData[] = [
                'label' => $item->language,
                'data' => $item->total_time,
                'backgroundColor' => '#' . $item->chart_bgcolor,
            ];
        }

        $contentData = DB::table('records')
            ->join('studying_contents', 'records.content_id', '=', 'studying_contents.id')
            ->select('studying_contents.content', 'studying_contents.chart_bgcolor', DB::raw('SUM(records.time) as total_time'))
            ->groupBy('studying_contents.content', 'studying_contents.chart_bgcolor')
            ->get();

        $contentsData = [];
        foreach ($contentData as $item) {
            $contentsData[] = [
                'label' => $item->content,
                'data' => $item->total_time,
                'backgroundColor' => '#' . $item->chart_bgcolor,
            ];
        }



        return view('index', compact('languages', 'contents', 'todays', 'months', 'totals', 'weeks', 'now_format', 'dailyData', 'chartData', 'contentsData'));
    }

    public function store(Request $request)
    {



        $records = new Records;

        $records->create([
            'time' => $request->time,
            'record_at' => $request->date,
            'content_id' => $request->content,
            'language_id' => $request->language,
        ]);

        return redirect()->route('top');
    }

    public function __construct()
    {
       $this->middleware('auth');
    }
}
