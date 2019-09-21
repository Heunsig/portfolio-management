<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Portfolio;
use App\Http\Controllers\API\helpers\Converter;


class PortfolioController extends Controller
{
    public function getPortfolios (Request $request) {
        $portfolios = Portfolio::with('links', 'files')->get();
        $result = [];

        foreach ($portfolios as $portfolio) {
            $result[] = Converter::makeResult($portfolio, $request->query('only'));
        }

        return response()->json($result);
    }

    public function getPortfolio (Request $request, $id) {
        $portfolio = Portfolio::where('id', $id)->with('links', 'files')->first();
        return response()->json(Converter::makeResult($portfolio, $request->query('only')));
    }
}
