<?php 
namespace App\Http\Controllers;

use App\Services\Web;

use App\Content;
use App\Slug;
use App\SlugAttribute;

use Request;
use Validator;
use View;
use Response;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		// $this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index() {
		// $client = new \SoapClient("http://192.168.0.100/eLoanSMSLoan/Service.svc?wsdl");

		
		// $result = $client->CreateLoanApplication(array("mobile" => "598506214", "text" => "Test", "app" => "SMSService"));
		// dd($result);
		
		return view('welcome');
	}

	public function web(Web $web) {
		$feed = Content::news_feed();

		return view('main.web', compact('web', 'feed'));
	}

	public function slug(Web $web, $slug) {
		$slug = Slug::where('name', $slug)->firstOrFail();

		if ($slug->slug_attribute_id == SlugAttribute::FOR_MENU) {
			$menu = $slug->menu;
			$contents = $menu->contents->sortByDesc(function($content) 
			{
				return $content->publish_date;
			});

			if (!$contents) {
				dd('no content'); // show 404
			}

			$first_content = $contents->first();
			if ($first_content->url) {
				return redirect($first_content->url);
			}

			if (count($contents) == 1) {
				$content = $contents->first();

				// dd($content->slug);
				return redirect(action('WelcomeController@slug', ['slug' => $content->slug->name]));
			} else {
				// dd($contents);
				// $contents = $contents->take(2); // add skip for pagination
				$contents = $menu->contentsPagination();

				if ($contents->count() == 0) {
					abort(404);
				}

				$contents->setPath($menu->slug->name);
				return view('main.multi_dynamic_contents', compact('web', 'contents'));
			}
		} else if ($slug->slug_attribute_id == SlugAttribute::FOR_CONTENT) {
			$content = $slug->content;

			if ($content->url) {
				return redirect($content->url);
			} else if ($content->static_file_name) {
				return view('main.statics.'.$content['static_file_name'], compact('web', 'content'));
			}

			return view('main.dynamic_content', compact('web', 'content'));
		}

		// show 404
		return '404';
	}

	public function mdl(Web $web) {
		return view('main.mdl', compact('web'));
	}

	public function calculate() {
		$data = [];
		return view('om', compact('data'));
	}

	public function postCalculate() {
		$request = Request::all();
		$success = false;
		$validation_rule = 'required|integer|min:0|max:100';
		$v = Validator::make($request, [
			'Monday' => $validation_rule,
			'Tuesday' => $validation_rule,
			'Wednesday' => $validation_rule,
			'Thursday' => $validation_rule,
			'Friday' => $validation_rule,
			'Saturday' => $validation_rule,
			'Sunday' => $validation_rule,
		]);

		if ($v->fails()) {
			$errors = $v->errors();
			$schedule = null;
			$debug = Request::has('xdebug') ? $request['xdebug'] : false;
			return Response::view('table', compact('schedule', 'errors'));
		}

		$schedule = new Schedule($request);
		$success = true;

		if (Request::has('debug') && $request['debug']) {
			dd($schedule);
		}

		$debug = Request::has('xdebug') ? $request['xdebug'] : false;
		return Response::view('table', compact('schedule', 'debug'));
	}
}


/**
* 
*/
class Schedule {

	private $raw_data = [];
	private $start_data = [];
	private $sum;
	public $workers = [];

	function __construct($request) {
		array_push($this->raw_data, $request['Monday']);
		array_push($this->raw_data, $request['Tuesday']);
		array_push($this->raw_data, $request['Wednesday']);
		array_push($this->raw_data, $request['Thursday']);
		array_push($this->raw_data, $request['Friday']);
		array_push($this->raw_data, $request['Saturday']);
		array_push($this->raw_data, $request['Sunday']);

		$this->start_data = $this->raw_data;
		$this->sum = $this->sumJobs($this->raw_data);

		while($this->sum != 0) {
			$worker = new Worker($this->raw_data);
			$this->lets_work($worker);
			array_push($this->workers, $worker);
		}
	}

	private function sumJobs() {
		$result = 0;
		foreach ($this->raw_data as $value)
			if ($value > 0) $result += $value;
		return $result;
	}

	private function lets_work($worker) {
		$schedule = $worker->schedule;
		for ($i = 0; $i < count($this->raw_data); $i++)
			$this->raw_data[$i] -= $schedule[$i];
		$this->sum = $this->sumJobs();
	}
}


/**
* 
*/
class Worker {

	private $raw_data = [];
	private $couples = [];

	public $schedule;
	public $html;
	public $html_debug;
	
	function __construct($data) {
		$this->raw_data = $data;
		$this->makeCouples(0);

		$best_couple = $this->findCouple();

		for ($i = 0; $i < count($this->raw_data); $i++) {
			if ($best_couple->check($i)) {
				$this->schedule[$i] = 0;
			} else {
				$this->schedule[$i] = 1;
			}
		}

		$this->buildHtml();
	}

	private function makeCouples($index) {
		// if ($index == count($this->raw_data)) 
		// 	return;

		// for ($i = $index + 1; $i < count($this->raw_data); $i++) {
		// 	array_push($this->couples, new Couple($this->raw_data, $index, $i));
		// }

		// $this->makeCouples($index + 1);

		for ($i = 0; $i < count($this->raw_data); $i++) {
			$next = $i == count($this->raw_data) - 1 ? 0 : $i + 1;
			array_push($this->couples, new Couple($this->raw_data, $i, $next));
		}
	}

	private function findCouple() {
		$couples = $this->couples;

		$min = $couples[0]->sum;

		for ($i = 0; $i < count($couples); $i++) {
			if ($couples[$i]->sum <= $min)
				$min = $couples[$i]->sum;
		}

		$min_couples = [];
		foreach ($couples as $key => $couple) {
			if ($couple->sum == $min) {
				array_push($min_couples, $couple);
			}
		}

		$best_choice;
		$max_score = -1;
		foreach ($min_couples as $key => $couple) {
			if ($couple->score > $max_score) {
				$max_score = $couple->score;
				$best_choice = $couple;
			}
		}

		return $best_choice;
	}

	public function schedule() {
		return $this->schedule;
	}

	private function buildHtml() {
		$html = '';
		foreach ($this->schedule as $key => $day) {
			$icon = $day == 1 ? 'check' : 'home';
			$html .= '<td><i class="fa fa-'.$icon.'"></i></td>';
		}
		$this->html = $html;

		$html_debug = '';
		foreach ($this->raw_data as $key => $day) {
			$d = $day < 0 ? '0 ('.$day.')' : $day;
			$html_debug .= '<td><span>'.$d.'</span></td>';
		}
		$this->html_debug = $html_debug;
	}
}


class Couple {

	private $data;
	private $first;
	private $second;

	public $sum;
	public $score;

	public function __construct($data, $first, $second) {
		$this->data = $data;
		$this->first = new Day($first, $this->data);
		$this->second = new Day($second, $this->data);

		$this->sum = $this->sum();
		$this->score = $this->score();
	}

	public function sum() {
		return $this->first->workers_needed + $this->second->workers_needed;
	}

	public function score() {
		return 0 + $this->first->score + $this->second->score;
	}

	public function check($i) {
		return $i == $this->first->index || $i == $this->second->index;
	}
}

/**
* 
*/
class Day {

	public $index;
	public $weekday;
	public $score;
	public $workers_needed;
	
	function __construct($index, $data) {
		$this->index = $index;
		$this->weekday = $this->getWeekDay();
		$this->score = $this->getScore();

		if ($data[$index] >= 0) {
			$this->workers_needed = $data[$index];
		} else {
			$this->workers_needed = 0;
		}
	}

	public function getWeekDay() {
		switch ($this->index) {
			case 0:
				return 'Monday';
			case 1:
				return 'Tuesday';
			case 2:
				return 'Wednesday';
			case 3:
				return 'Thursday';
			case 4:
				return 'Friday';
			case 5:
				return 'Saturday';
			case 6:
				return 'Sunday';
		}
	}

	public function getScore() {
		switch ($this->weekday) {
			case 'Saturday':
				return 1;

			case 'Sunday':
				return 1;
			
			default:
				return 0;
		}
	}
}