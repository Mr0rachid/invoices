@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ طباعة</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-12">
						<div class=" main-content-body-invoice" id="printcontent">
							<div class="card card-invoice">
								<div class="card-body">
									<div class="invoice-header">
										<h1 class="invoice-title">طباعة</h1>
										<div class="billed-from">
											<h6>BootstrapDash, Inc.</h6>
											<p>201 Something St., Something Town, YT 242, Country 6546<br>
											Tel No: 324 445-4544<br>
											Email: youremail@companyname.com</p>
										</div><!-- billed-from -->
									</div><!-- invoice-header -->
									<div class="row mg-t-20">
										<div class="col-md">
											<label class="tx-gray-600">Billed To</label>
											<div class="billed-to">
												<h6>Juan Dela Cruz</h6>
												<p>4033 Patterson Road, Staten Island, NY 10301<br>
												Tel No: 324 445-4544<br>
												Email: youremail@companyname.com</p>
											</div>
										</div>
										<div class="col-md">
											<label class="tx-gray-600">معلومات الفاتورة</label>
											<p class="invoice-info-row"><span>رقم الفاتورة</span> <span>{{$invoice['invoice-number']}}</span></p>
											<p class="invoice-info-row"><span>تاريخ الاصدار</span> <span>{{$invoice['invoice-date']}}</span></p>
											<p class="invoice-info-row"><span>تاريخ الاستحقاق</span> <span>{{$invoice['due_date']}}</span></p>
											<p class="invoice-info-row"><span>القسم</span> <span>{{$invoice->section['section_name']}}</span></p>
										</div>
									</div>
									<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
											<thead>
												<tr>
													<th class="wd-20p">#</th>
													<th class="wd-40p">القسم</th>
													<th class="tx-center">مبلغ التحصيل</th>
													<th class="tx-right">مبلغ العمولة</th>
													<th class="tx-right">الاجمالي</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th class="wd-20p">1</th>
													<th class="wd-40p">{{$invoice->section['section_name']}}</th>
													<th class="tx-center">{{number_format($invoice['amount_collection'],2)}}</th>
													<th class="tx-right">{{number_format($invoice['amount_commission'],2)}}</th>
													@php
														$collection = $invoice['amount_collection'];
														$commission = $invoice['amount_commission'];
														$total = $collection + $commission;
													@endphp
													<th class="tx-right">{{number_format($total,2)}}</th>
												</tr>
												<tr>
													<td class="tx-right">الاجمالي</td>
													<td class="tx-right" colspan="2">{{number_format($total,2)}}</td>
												</tr>
												<tr>
													<td class="tx-right">نسبة الضريبة({{$invoice['rate-vat']}})</td>
													<td class="tx-right" colspan="2">{{$invoice['value-vat']}}</td>
												</tr>
												<tr>
													<td class="tx-right">قيمة الخصم</td>
													<td class="tx-right" colspan="2">{{$invoice['discount']}}</td>
												</tr>
												<tr>
													<td class="tx-right tx-uppercase tx-bold tx-inverse">الاجمالي شامل الضريبة</td>
													<td class="tx-right" colspan="2">
														<h4 class="tx-primary tx-bold">{{$invoice['total']}}</h4>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<hr class="mg-b-40">
									<a class="btn btn-danger float-left mt-3 mr-2" id="print_button" onclick="printdiv()">
										<i class="mdi mdi-printer ml-1"></i>طباعة
									</a>
								</div>
							</div>
						</div>
					</div><!-- COL-END -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<script type="text/javascript">
	function printdiv(){
		var printcontent = document.getElementById('printcontent').innerHTML;
		var originalcontent = document.body.innerHTML;
		document.body.innerHTML = printcontent;
		window.print();
		document.body.innerHTML = originalcontent;
		location.reload();
	}
</script>
@endsection