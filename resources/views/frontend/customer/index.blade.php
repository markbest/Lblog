@extends('_layouts.1colums')
@section('content')
<div class="col-lg-12 register_customer">
    <div class="col-lg-12">
       <div class="user-detail-box">
           <div class="mod-head">
              <img id="return_customer_icon" src="{{ getCustomerIcon() }}" style="width:100px;height:100px;">     
              <span class="pull-right operate">
                  <a href="{{ asset('customer/setting') }}" class="btn btn-mini btn-success">编辑</a>
              </span>
              <h1 class="user_name">{{ getCustomer()->name }}</h1>
           </div>   
       </div>
    </div>
</div>
@endsection