@extends('layouts.app')
@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>{{ __('Subscribers') }}</h4>
          </div>
          <div class="card-body" id="total_subscribers">
            <img src="{{ asset('uploads/loader.gif') }}">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="far fa-newspaper"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>{{ __('Domain Request') }}</h4>
          </div>
          <div class="card-body" id="total_domain_requests">
            <img src="{{ asset('uploads/loader.gif') }}">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="far fa-file"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>{{ __('Total Earnings') }}</h4>
          </div>
          <div class="card-body" id="total_earnings">
            <img src="{{ asset('uploads/loader.gif') }}">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-circle"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>{{ __('Expired Subscriptions') }}</h4>
          </div>
          <div class="card-body" id="total_expired_subscriptions">
            <img src="{{ asset('uploads/loader.gif') }}">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-stats">
          <div class="card-stats-title">{{ __('Order Statistics') }} -
            <div class="dropdown d-inline">
              <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month" id="orders-month">{{ Date('F') }}</a>
              <ul class="dropdown-menu dropdown-menu-sm">
                <li class="dropdown-title">{{ __('Select Month') }}</li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='January') active @endif" data-month="January" >{{ __('January') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='February') active @endif" data-month="February" >{{ __('February') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='March') active @endif" data-month="March" >{{ __('March') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='April') active @endif" data-month="April" >{{ __('April') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='May') active @endif" data-month="May" >{{ __('May') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='June') active @endif" data-month="June" >{{ __('June') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='July') active @endif" data-month="July" >{{ __('July') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='August') active @endif" data-month="August" >{{ __('August') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='September') active @endif" data-month="September" >{{ __('September') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='October') active @endif" data-month="October" >{{ __('October') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='November') active @endif" data-month="November" >{{ __('November') }}</a></li>
                <li><a href="#" class="dropdown-item month @if(Date('F')=='December') active @endif" data-month="December" >{{ __('December') }}</a></li>
              </ul>
            </div>
          </div>
          <div class="card-stats-items">
            <div class="card-stats-item">
              <div class="card-stats-item-count" id="pending_order"></div>
              <div class="card-stats-item-label">{{ __('Pending') }}</div>
            </div>

            <div class="card-stats-item">
              <div class="card-stats-item-count" id="completed_order"></div>
              <div class="card-stats-item-label">{{ __('Completed') }}</div>
            </div>

            <div class="card-stats-item">
              <div class="card-stats-item-count" id="shipping_order"></div>
              <div class="card-stats-item-label">{{ __('Expired') }}</div>
            </div>
          </div>
        </div>
        <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-archive"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>{{ __('Total Orders') }}</h4>
          </div>
          <div class="card-body" id="total_order">

          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-chart">
          <canvas id="sales_of_earnings_chart" height="80"></canvas>
        </div>
        <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Sales Of Earnings - {{ date('Y') }}</h4>
          </div>
          <div class="card-body" id="sales_of_earnings">
            <img src="{{ asset('uploads/loader.gif') }}">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-chart">
          <canvas id="total_sales_chart" height="80"></canvas>
        </div>
        <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-shopping-bag"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Sales - {{ date('Y') }}</h4>
          </div>
          <div class="card-body" id="total_sales">
            <img src="{{ asset('uploads/loader.gif') }}" class="loads">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
     <div class="card">
      <div class="card-header">

        <h4 class="card-header-title">{{ __('Earnings performance') }} <img src="{{ asset('uploads/loader.gif') }}" height="20" id="earning_performance"></h4>
        <div class="card-header-action">
          <select class="form-control" id="perfomace">
            <option value="7">{{ __('Last 7 Days') }}</option>
            <option value="15">{{ __('Last 15 Days') }}</option>
            <option value="30">{{ __('Last 30 Days') }}</option>
            <option value="365">{{ __('Last 365 Days') }}</option>
          </select>
        </div>
      </div>
      <div class="card-body">
        <canvas id="myChart" height="150"></canvas> 
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-12 col-12 col-sm-12">
    @if(Route::has('admin.customer.index'))
    <div class="card">
      <div class="card-header">
        <h4>{{ __('Recent Request') }}</h4>
      </div>
      <div class="card-body">
        <ul class="list-unstyled list-unstyled-border">
          @foreach($request_users as $row)
          <li class="media">
            <a href="{{ route('admin.customer.show',$row->id) }}"><img class="mr-3 rounded-circle" width="50" src="https://ui-avatars.com/api/?name={{ $row->name }}&background=random" alt="avatar"></a>
            <div class="media-body">
              <div class="float-right text-primary mt-3"><a href="{{ route('admin.customer.show',$row->id) }}">{{ $row->created_at->diffForHumans() }}</a></div>
              <div class="media-title  mt-3"><a href="{{ route('admin.customer.show',$row->id) }}">{{ $row->name }}</a></div>
            </div>
          </li>
          @endforeach
        </ul>
        <div class="text-center pt-1 pb-1">
          @if(count($request_users) == 4)
          <a href="{{ route('admin.customer.index','type=3') }}" class="btn btn-primary btn-lg btn-round">
            View All
          </a>
          @endif
        </div>
      </div>
    </div>
    @endif
  </div>
  @if(Route::has('admin.customer.index'))
  <div class="col-md-12 col-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4><a href="{{ route('admin.order.index','status=2') }}">{{ __('Recent Orders') }}</a></h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-nowrap card-table text-center">
            <thead>
              <tr>
                <th class="text-left" >{{ __('Order') }}</th>
                <th >{{ __('Date') }}</th>
                <th>{{ __('Customer') }}</th>
                <th class="text-right">{{ __('Amount') }}</th>
                <th>{{ __('Method') }}</th>
                <th>{{ __('Payment Status') }}</th>
                <th>{{ __('Fulfillment') }}</th>
                <th class="text-right">{{ __('Action') }}</th>
              </tr>
            </thead>
            <tbody class="list font-size-base rowlink" data-link="row">
              @foreach($orders ?? [] as $key => $row)
              <tr>

                <td class="text-left"><a href="{{ route('admin.order.invoice',$row->id) }}">{{ $row->order_no }}</a></td>
                <td>{{ $row->created_at->format('d-F-Y') }}</td>
                <td><a href="{{ route('admin.customer.show',$row->user->id) }}">{{ $row->user->name }}</a></td>
                <td>{{ amount_format($row->amount) }}</td>
                <td>{{ $row->category->name ?? '' }}</td>
                <td>
                  @if($row->payment_status==1)
                  <span class="badge badge-success">{{ __('Paid') }}</span>
                  @elseif($row->payment_status == 2)
                   <span class="badge badge-warning">{{ __('Pending') }}</span>
                  @else
                  <span class="badge badge-danger">{{ __('Fail') }}</span>
                  @endif
                  
                </td>

                <td>
                  @if($row->status == 1) 
                  <span class="badge badge-success">Approved</span>
                  @elseif($row->status == 2)
                  <span class="badge badge-warning">{{ __('Pending') }}</span>
                  @elseif($row->status == 3)
                  <span class="badge badge-danger">{{ __('Expired') }}</span>
                  @else
                  <span class="badge badge-danger">{{ __('Cancelled') }}</span>
                  @endif

                </td>
                <td> <div class="dropdown d-inline">
                  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('Action') }}
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item has-icon" href="{{ route('admin.order.edit',$row->id) }}"><i class="far fa-edit"></i> {{ __('Edit') }}</a>
                    <a class="dropdown-item has-icon" href="{{ route('admin.order.show',$row->id) }}"><i class="far fa-eye"></i> {{ __('View') }}</a>
                    <a class="dropdown-item has-icon" href="{{ route('admin.order.invoice',$row->id) }}"><i class="fa fa-file-invoice"></i> {{ __('Download Invoice') }}</a>

                  </div>
                </div></td>
              </tr> 
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>
</section>

<div class="row">
  <div class="col-lg-12 col-md-12 col-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4>Site Analytics</h4>
        <div class="card-header-action">
          <select class="form-control" id="days"> 
            <option value="7">Last 7 Days</option>
            <option value="15">Last 15 Days</option>
            <option value="30">Last 30 Days</option>
            <option value="180">Last 180 Days</option>
            <option value="365">Last 365 Days</option>
          </select>
        </div>
      </div>
      <div class="card-body">
        <canvas id="google_analytics" height="120"></canvas>
        <div class="statistic-details mt-sm-4">
          <div class="statistic-details-item">

            <div class="detail-value" id="total_visitors"></div>
            <div class="detail-name">Total Vistors</div>
          </div>
          <div class="statistic-details-item">

            <div class="detail-value" id="total_page_views"></div>
            <div class="detail-name">Total Page Views</div>
          </div>

          <div class="statistic-details-item">

            <div class="detail-value" id="new_vistors"></div>
            <div class="detail-name">New Visitor</div>
          </div>

          <div class="statistic-details-item">

            <div class="detail-value" id="returning_visitor"></div>
            <div class="detail-name">Returning Visitor</div>
          </div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 col-md-6 col-12">
        <div class="card">
          <div class="card-header">
            <h4>Referral URL</h4>
          </div>
          <div class="card-body refs" id="refs" >



          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4>Top Browser</h4>
          </div>
          <div class="card-body">
            <div class="row" id="browsers"></div>
          </div>
        </div>

      </div>

      <div class="col-lg-6 col-md-6 col-12">
        <div class="card">
          <div class="card-header">
            <h4>{{ __('Top Most Visit Pages') }}</h4>
          </div>
          <div class="card-body tmvp" id="table-body">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="base_url" value="{{ url('/') }}">
<input type="hidden" id="site_url" value="{{ url('/') }}">
<input type="hidden" id="dashboard_static" value="{{ route('admin.dashboard.static') }}">
<input type="hidden" id="dashboard_perfomance" value="{{ url('/admin/dashboard/perfomance') }}">
<input type="hidden" id="dashboard_order_statics" value="{{ url('/admin/dashboard/order_statics') }}">
<input type="hidden" id="gif_url" value="{{ asset('uploads/loader.gif') }}">
<input type="hidden" id="month" value="{{ date('F') }}">
@endsection
@push('js')
<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/js/index-0.js') }}"></script>

@endpush
