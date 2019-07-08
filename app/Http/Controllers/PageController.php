<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Template;
/*use App\Models\Icons;
use App\Modes\Types;*/

class PageController extends Controller
{
	public function getIndex(){
		return view('pages.index');
	}

	public function getPortfolio(){
		return view('pages.portfolio');
	}

	public function getTemplate(){
		return view('pages.template');
	}

	public function getContact(){
		return view('pages.contact');
	}

	public function getPortfolioPop($id){
		$portfolio = Portfolio::find($id);

		return view('pages.portfolioPop')->with([
			'portfolio' => $portfolio
		]);
	}

	public function getTemplatePop($id){
		$template = Template::find($id);

		return view('pages.templatePop')->with([
			'template' => $template
		]);
	}

}
