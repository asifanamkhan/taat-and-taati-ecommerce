<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="{{$seo->meta_keys}}">
        <meta name="author" content="GeniusOcean">

        <title>{{$gs->title}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('assets/print/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/print/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('assets/print/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/print/css/style.css')}}">
  <link href="{{asset('assets/print/css/print.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="icon" type="image/png" href="{{asset('assets/images/'.$gs->favicon)}}"> 
  <style type="text/css">
@page { size: auto;  margin: 0mm; }
@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    width: 210mm;
    height: 287mm;
  }

html {

}
::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
    background: transparent;  /* optional: just make scrollbar invisible */
}
  </style>
</head>
<body onload="window.print();">
    <div class="invoice-wrap">
            <div class="invoice__title">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="invoice__logo text-left">
                           <img src="{{ asset('assets/images/'.$gs->invoice_logo) }}" alt="woo commerce logo">
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="invoice__metaInfo">
                <div class="col-lg-6">
                    <div class="invoice__orderDetails">
                        
                        <p><strong>{{ __('Order Details') }} </strong></p>
                        <span><strong>{{ __('Invoice Number') }} :</strong> {{ sprintf("%'.08d", $order->id) }}</span><br>
                        <span><strong>{{ __('Order Date') }} :</strong> {{ date('d-M-Y',strtotime($order->created_at)) }}</span><br>
                        <span><strong>{{  __('Order ID')}} :</strong> {{ $order->order_number }}</span><br>
                        @if($order->dp == 0)
                        <span> <strong>{{ __('Shipping Method') }} :</strong>
                            @if($order->shipping == "pickup")
                            {{ __('Pick Up') }}
                            @else
                            {{ __('Ship To Address') }}
                            @endif
                        </span><br>
                        @endif
                        <span> <strong>{{ __('Payment Method') }} :</strong> {{$order->method}}</span>
                    </div>
                </div>
            </div>

            <div class="invoice__metaInfo" style="margin-top:0px;">
                @if($order->dp == 0)
                <div class="col-lg-6">
                        <div class="invoice__orderDetails" style="margin-top:5px;">
                            <p><strong>{{ __('Shipping Details') }}</strong></p>
                           <span><strong>{{ __('Customer Name') }}</strong>: {{ $order->shipping_name == null ? $order->customer_name : $order->shipping_name}}</span><br>
                           <span><strong>{{ __('Customer Phone') }}</strong>: {{ $order->shipping_phone == null ? $order->customer_phone : $order->shipping_phone}}</span><br>
                           <span><strong>{{ __('Address') }}</strong>: {{ $order->shipping_address == null ? $order->customer_address : $order->shipping_address }}</span><br>
                           <span><strong>{{ __('City') }}</strong>: {{ $order->shipping_city == null ? $order->customer_city : $order->shipping_city }}</span><br>
                           <span><strong>{{ __('Country') }}</strong>: {{ $order->shipping_country == null ? $order->customer_country : $order->shipping_country }}</span>
                        </div>
                </div>
                @endif
                <div class="col-lg-6" style="width:50%;">
                        <div class="invoice__orderDetails" style="margin-top:5px;">
                            <p><strong>{{ __('Billing Details') }}</strong></p>
                            <span><strong>{{ __('Customer Name') }}</strong>: {{ $order->customer_name}}</span><br>
                            <span><strong>{{ __('Customer Phone') }}</strong>: {{ $order->customer_phone}}</span><br>
                            <span><strong>{{ __('Address') }}</strong>: {{ $order->customer_address }}</span><br>
                            <span><strong>{{ __('City') }}</strong>: {{ $order->customer_city }}</span><br>
                            <span><strong>{{ __('Country') }}</strong>: {{ $order->customer_country }}</span>
                        </div>
                </div>
            </div>

                <div class="col-lg-12">
                    <div class="invoice_table">
                        <div class="mr-table">
                            <div class="table-responsive">
                                <table id="example2" class="table table-hover dt-responsive" cellspacing="0"
                                    width="100%">
                                    <thead style="border-top:1px solid rgba(0, 0, 0, 0.1) !important;">
                                        <tr>
                                            <th>{{ __('Product') }}</th>
                                            <th>{{ __('Details') }}</th>
                                            <th>{{ __('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
                                        $subtotal = 0;
                                        $tax = 0;
                                    @endphp
                                    @foreach($cart as $product)
                                        <tr>
                                            <td width="50%">

                                                {{$product['product_name']}}
                                            </td>
                                            <td>
                                                @if($product['product_size'])
                                                    <p>
                                                        <strong>Size :</strong> {{$product['product_size']}}
                                                    </p>
                                                @endif
                                                @if($product['product_color'])
                                                    <p>
                                                        <strong>color :</strong> <span
                                                                style="width: 40px; height: 20px; display: block; background: {{$product['product_color']}};"></span>
                                                    </p>
                                                @endif
                                                <p>
                                                    <strong>Price :</strong> {{$order->currency_sign}}{{ round($product['total_price'] * $order->currency_value , 2) }}
                                                </p>
                                                    <p>
                                                        <strong>Qty :</strong> {{$product['product_quantity']}}
                                                    </p>
                                            </td>


                                            <td>{{$order->currency_sign}}{{ round($product['total_price'] * $order->currency_value , 2) }}
                                            </td>
                                            @php
                                                $subtotal += round($product['total_price'] * $order->currency_value, 2);
                                            @endphp

                                        </tr>

                                    @endforeach

                                        <tr class="semi-border">
                                            <td colspan="1"></td>
                                            <td><strong>{{ __('Subtotal') }}</strong></td>
                                            <td>{{$order->currency_sign}}{{ round($subtotal, 2) }}</td>

                                        </tr>
                                        @if($order->shipping_cost != 0)
                                        <tr class="no-border">
                                            <td colspan="1"></td>
                                            <td><strong>{{ __('Shipping Cost') }}({{$order->currency_sign}})</strong></td>
                                            <td>{{ round($order->shipping_cost , 2) }}</td>
                                        </tr>
                                        @endif

                                        @if($order->packing_cost != 0)
                                        <tr class="no-border">
                                            <td colspan="1"></td>
                                            <td><strong>{{ __('Packaging Cost') }}({{$order->currency_sign}})</strong></td>
                                            <td>{{ round($order->packing_cost , 2) }}</td>
                                        </tr>
                                        @endif

                                        @if($order->tax != 0)
                                        <tr class="no-border">
                                            <td colspan="1"></td>
                                            <td><strong>{{ __('TAX') }}({{$order->currency_sign}})</strong></td>

                                            @php
                                            $tax = ($subtotal / 100) * $order->tax;
                                            @endphp

                                            <td>{{round($tax, 2)}}</td>
                                        </tr>

                                        @endif
                                        @if($order->coupon_discount != null)
                                        <tr class="no-border">
                                            <td colspan="1"></td>
                                            <td><strong>{{ __('Coupon Discount') }}({{$order->currency_sign}})</strong></td>
                                            <td>{{$order->currency_sign}}{{round($order->coupon_discount, 2)}}</td>
                                        </tr>
                                        @endif
                                        <tr class="final-border">
                                            <td colspan="1"></td>
                                            <td><strong>{{ __('Total') }} @if($order->adjust_remark != '') (Adjusted) @endif</strong></td>
                                            <td>{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                                @if($order->adjust_remark != '')
                                <div>
                                    <p style="text-align: left">
                                        <b>**Adjust remark: </b>
                                        <span>{{$order->adjust_remark}}</span>
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
<!-- ./wrapper -->

<script type="text/javascript">
setTimeout(function () {
        window.close();
      }, 500);
</script>

</body>
</html>
