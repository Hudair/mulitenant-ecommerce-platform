<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\Analytics\Period;
use Auth;
use App\Order;
use App\Term;
use App\Domain;
use Analytics;
class DashboardController extends Controller
{
	public function dashboard()
	{
		
		return view('seller.dashboard');
	}

	public function order_statics($month)
	{
		$month=Carbon::parse($month)->month;
		$year=Carbon::parse(date('Y'))->year;
		$user_id=Auth::id();

		$total_orders=Order::where('user_id',$user_id)->whereMonth('created_at', '=',$month)->whereYear('created_at', '=',$year)->count();
		$total_pending=Order::where('user_id',$user_id)->whereMonth('created_at', '=',$month)->whereYear('created_at', '=',$year)->where('status','pending')->count();
		$total_completed=Order::where('user_id',$user_id)->whereMonth('created_at', '=',$month)->whereYear('created_at', '=',$year)->where('status','completed')->count();
		$total_processing1=Order::where('user_id',$user_id)->whereMonth('created_at', '=',$month)->whereYear('created_at', '=',$year)->where('status','processing')->count();
		$total_processing2=Order::where('user_id',$user_id)->whereMonth('created_at', '=',$month)->whereYear('created_at', '=',$year)->where('status','ready-for-pickup')->count();
		$total_processing=$total_processing1+$total_processing2;
		
		$data['total_orders']=number_format($total_orders);
		$data['total_pending']=number_format($total_pending);
		$data['total_completed']=number_format($total_completed);
		$data['total_processing']=number_format($total_processing);

		return response()->json($data);
	}

	public function staticData()
	{
		$user_id=Auth::id();
		$year=Carbon::parse(date('Y'))->year;
		$today=Carbon::today();


		$totalEarnings=Order::where('user_id',$user_id)->where('payment_status',1)->where('status','completed')->whereYear('created_at', '=',$year)->sum('total');
		$totalEarnings=amount_format($totalEarnings);

		$totalSales=Order::where('user_id',$user_id)->where('status','completed')->whereYear('created_at', '=',$year)->count();
		$totalSales=number_format($totalSales);
		$storage_size=folderSize('uploads/'.$user_id);

		$today_sale_amount = Order::where('user_id',$user_id)->where('status','!=','canceled')->whereDate('created_at', $today)->sum('total');
		$today_sale_amount=amount_format($today_sale_amount,'sign');

		$today_orders = Order::where('user_id',$user_id)->whereDate('created_at', $today)->count();
		$today_orders=number_format($today_orders);


		$yesterday_sale_amount = Order::where('user_id',$user_id)->where('status','!=','canceled')->whereDate('created_at', Carbon::yesterday())->sum('total');
		$yesterday_sale_amount=amount_format($yesterday_sale_amount,'sign');


		$previous_week = strtotime("-1 week +1 day");
		$start_week = strtotime("last sunday midnight",$previous_week);
		$end_week = strtotime("next saturday",$start_week);
		$start_week = date("Y-m-d",$start_week);
		$end_week = date("Y-m-d",$end_week);


		$lastweek_sale_amount = Order::where('user_id',$user_id)->where('status','=','completed')->whereDate('created_at', '>', Carbon::now()->subDays(7))->sum('total');
		$lastweek_sale_amount=amount_format($lastweek_sale_amount,'sign');

		$lastmonth_sale_amount = Order::where('user_id',$user_id)->where('status','=','completed')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->sum('total');
		$lastmonth_sale_amount=amount_format($lastmonth_sale_amount,'sign');

		$thismonth_sale_amount = Order::where('user_id',$user_id)->where('status','=','completed')->whereMonth('created_at', date('m'))
		->whereYear('created_at', date('Y'))->sum('total');
		$thismonth_sale_amount=amount_format($thismonth_sale_amount,'sign');

		$orders=Order::where('user_id',$user_id)->whereYear('created_at', '=',$year)->orderBy('id', 'asc')->selectRaw('year(created_at) year, monthname(created_at) month, count(*) sales')
                ->groupBy('year', 'month')
                ->get();

        $earnings=Order::where('user_id',$user_id)->whereYear('created_at', '=',$year)->where('status','completed')->orderBy('id', 'asc')->selectRaw('year(created_at) year, monthname(created_at) month, sum(total) total')
                ->groupBy('year', 'month')
                ->get();
        $posts=Term::where('user_id',Auth::id())->where('type','!=','page')->count();
        $pages=Term::where('user_id',Auth::id())->where('type','page')->count();
        
		$data['totalEarnings']=$totalEarnings;
		$data['totalSales']=$totalSales;
		$data['storage_size']=$storage_size.'MB';
		$data['today_sale_amount']=$today_sale_amount;
		$data['today_orders']=$today_orders;
		$data['yesterday_sale_amount']=$yesterday_sale_amount;
		$data['lastweek_sale_amount']=$lastweek_sale_amount;
		$data['lastmonth_sale_amount']=$lastmonth_sale_amount;
		$data['thismonth_sale_amount']=$thismonth_sale_amount;
		$data['orders']=$orders;
		$data['earnings']=$earnings;
		$data['products']=$posts;
		$data['pages']=$pages;
		$data['storage_used']=(float)str_replace(',', '', $storage_size);

		$plan_info=Domain::where('user_id',Auth::id())->first();
		
		$plan_data=json_decode($plan_info->data);
		$plan=Auth::user()->user_plan->plan_info->name ?? '';
		$product_limit=$plan_data->product_limit;
		$storage=$plan_data->storage;
		$will_expired=$plan_info->will_expire;

		$data['plan_name']=$plan;
		$data['product_limit']=$product_limit;
		$data['storage']=$storage;
		
		if ($will_expired == null) {
			$expire = "Expired";
		}
		else{
			$expire = Carbon::parse($will_expired)->format('F d, Y');
		}
		$data['will_expired']=$expire;
	
		return response()->json($data);
	}

	public function perfomance($period)
	{
		$user_id=Auth::id();

		if ($period != 365) {
			$earnings=Order::where('user_id',$user_id)->whereDate('created_at', '>', Carbon::now()->subDays($period))->where('status','!=','canceled')->orderBy('id', 'asc')->selectRaw('year(created_at) year, date(created_at) date, sum(total) total')->groupBy('year','date')->get();
		}
		else{
			$earnings=Order::where('user_id',$user_id)->whereDate('created_at', '>', Carbon::now()->subDays($period))->where('status','!=','canceled')->orderBy('id', 'asc')->selectRaw('year(created_at) year, monthname(created_at) month, sum(total) total')->groupBy('year','month')->get();
		}
	   
		
		return response()->json($earnings);		
	}


	public function google_analytics($days)
	{
		
		if (file_exists('uploads/'.Auth::id().'/service-account-credentials.json')) {
			$info=google_analytics_for_user();
			
			\Config::set('analytics.view_id', $info['view_id']);
			\Config::set('analytics.service_account_credentials_json', $info['service_account_credentials_json']);

			$data['TotalVisitorsAndPageViews']=$this->fetchTotalVisitorsAndPageViews($days);
			$data['MostVisitedPages']=$this->fetchMostVisitedPages($days);
			$data['Referrers']=$this->fetchTopReferrers($days);
			$data['fetchUserTypes']=$this->fetchUserTypes($days);
			$data['TopBrowsers']=$this->fetchTopBrowsers($days);
		}
		else{
			$data['TotalVisitorsAndPageViews']=[];
			$data['MostVisitedPages']=[];
			$data['Referrers']=[];
			$data['fetchUserTypes']=[];
			$data['TopBrowsers']=[];
		}
		
		
		return response()->json($data);
	}

	public function getCountries($period)
	{
		return $country = \Analytics::performQuery(Period::days($period),'ga:sessions',['dimensions'=>'ga:country','dimension'=>'ga:latitude','dimension'=>'ga:longitude','sort'=>'-ga:sessions']);
		
		$result= collect($country['rows'] ?? [])->map(function (array $dateRow) {
			return [
				'country' =>  $dateRow[0],
				'sessions' => (int) $dateRow[1],
			];
		});
		
		return $result;
	}

	

	public function fetchTotalVisitorsAndPageViews($period)
	{
		
		return Analytics::fetchTotalVisitorsAndPageViews(Period::days($period))->map(function($data)
        {
            $row['date']=$data['date']->format('Y-m-d');
            $row['visitors']=$data['visitors'];
            $row['pageViews']=$data['pageViews'];
            return $row;
        });
				
	}
	public function fetchMostVisitedPages($period)
	{
		return \Analytics::fetchMostVisitedPages(Period::days($period));
		
	}

	public function fetchTopReferrers($period)
	{
		return \Analytics::fetchTopReferrers(Period::days($period));
		
	}

	public function fetchUserTypes($period)
	{
		return \Analytics::fetchUserTypes(Period::days($period));
		
	}

	public function fetchTopBrowsers($period)
	{
		return \Analytics::fetchTopBrowsers(Period::days($period));
		
	}

}
