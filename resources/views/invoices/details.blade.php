

@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتورة</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">
					@if (session()->has('delete'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>{{session()->get('delete')}}</strong>
							<button class="colse" type="button" data-dismiss="alert" aria-label="close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif
					@if (session()->has('add'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>{{session()->get('add')}}</strong>
							<button class="colse" type="button" data-dismiss="alert" aria-label="close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif
					@if ($errors->any())
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						@foreach ($errors->all() as $error)
						<strong>{{$error}}</strong>
						<button class="colse" type="button" data-dismiss="alert" aria-label="close">
							<span aria-hidden="true">&times;</span>
						</button>
						@endforeach
					</div>
					@endif
					<div class="col-xl-12">
						<!-- div -->
						<div class="card mg-b-20" id="tabs-style2">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									Basic Style2 Tabs
								</div>
								<p class="mg-b-20">It is Very Easy to Customize and it uses in your website apllication.</p>
								<div class="text-wrap">
									<div class="example">
										<div class="panel panel-primary tabs-style-2">
											<div class=" tab-menu-heading">
												<div class="tabs-menu1">
													<!-- Tabs -->
													<ul class="nav panel-tabs main-nav-line">
														<li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات الفاتورة</a></li>
														<li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
														<li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
													</ul>
												</div>
											</div>
											<div class="panel-body tabs-menu-body main-content-body-right border">
												<div class="tab-content">
													<div class="tab-pane active" id="tab4">
														<div class="card-body">
															<div class="table-responsive">
																<table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
																	<thead>
																		<tr>
																			<th class="border-bottom-0">رقم الفاتورة</th>
																			<th class="border-bottom-0">تاريخ الاصدار</th>
																			<th class="border-bottom-0">تاريخ الاستحقاق</th>
																			<th class="border-bottom-0">القسم</th>
																			<th class="border-bottom-0">المنتج</th>
																			<th class="border-bottom-0">مبلغ التحصيل</th>
																			<th class="border-bottom-0">مبلغ العمولة</th>
																			<th class="border-bottom-0">الخصم</th>
																			<th class="border-bottom-0">نسبة الضريبة</th>
																			<th class="border-bottom-0">قيمة الضريبة</th>
																			<th class="border-bottom-0">الاجمالي</th>
																			<th class="border-bottom-0">الحالة</th>
																			<th class="border-bottom-0">ملاحظات</th>
																			<th class="border-bottom-0">العمليات</th>
																		</tr>
																	</thead>
																	<tbody>
																		
																		<tr>
																			<td>{{$invoice['invoice-number']}}</td>
																			<td>{{$invoice['invoice-date']}}</td>
																			<td>{{$invoice->due_date}}</td>
																			<td>{{$invoice->section->section_name}}</td>
																			<td>{{$invoice->product}}</td>
																			<td>{{$invoice->amount_collection}}</td>
																			<td>{{$invoice->amount_commission}}</td>
																			<td>{{$invoice->discount}}</td>
																			<td>{{$invoice['rate-vat']}}</td>
																			<td>{{$invoice['value-vat']}}</td>
																			<td>{{$invoice->total}}</td>
																			<td>{{$invoice->status}}</td>
																			<td>{{$invoice->note}}</td>
																			<td>
																				<div class="dropdown">
																					<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
																					data-toggle="dropdown" id="dropdownMenuButton" type="button">العمليات <i class="fas fa-caret-down ml-1"></i></button>
																					<div  class="dropdown-menu tx-13">
																						<a class="dropdown-item" href="{{url('editinvoice',['id'=>$invoice->id])}}">تعديل</a>
																						<a class="dropdown-item" data-toggle="modal" data-target="#delete_invoice" data-id="{{$invoice->id}}" href="{{url('editinvoice',['id'=>$invoice->id])}}"><i class="text-danger fas fa-trash-alt">&nbsp;حذف</i></a>
																					</div>
																				</div>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="tab5">
														<div class="card-body">
															<div class="table-responsive">
																<table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
																	<thead>
																		<tr>
																			<th class="border-bottom-0">#</th>
																			<th class="border-bottom-0">رقم الفاتورة</th>
																			<th class="border-bottom-0">القسم</th>
																			<th class="border-bottom-0">نوع المنتج</th>
																			<th class="border-bottom-0">تاريخ الاضافة</th>
																			<th class="border-bottom-0">ملاحظات</th>
																			<th class="border-bottom-0">حالة الدفع</th>
																			<th class="border-bottom-0">تاريخ الدفع</th>
																			<th class="border-bottom-0">المستخدم</th>
																		</tr>
																	</thead>
																	<tbody>
																		@php
																			$i = 0;
																		@endphp
																		@foreach ($details as $detail)
																			{{$i++}}
																			<tr>
																				<td>{{$i}}</td>
																				<td>{{$detail->invoice_number}}</td>
																				<td>{{$invoice->section->section_name}}</td>
																				<td>{{$detail->product}}</td>
																				<td>{{$detail->created_at}}</td>
																				<td>{{$detail->note}}</td>
																				<td>
																					@if ($detail->value_Status === 2)
																						<span class="badge badge-pill text-danger">{{$detail->Status}}</span>
																					@elseif($detail->value_Status === 1)
																						<span class="badge badge-pill text-success">{{$detail->Status}}</span>
																					@else
																						<span class="badge badge-pill text-warning">{{$detail->Status}}</span>
																					@endif
																				</td>
																				<td>{{$detail->payment_date}}</td>
																				<td>{{$detail->user}}</td>
																			</tr>
																		@endforeach
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="tab6">
														<div class="card-body">
															<div class="card card-statistics">
																<div class="card-body">
																	<p class="text-danger">صيغة المرفق: pdf , png , jpeg , jpg</p>
																	<h5 class="card-title">اضافة مرفقات</h5>
																	<form action="{{route('add_attachement')}}" method="post" enctype="multipart/form-data">
																		{{ csrf_field() }}
																		<div class="custom-file">
																			<input type="file" name="file_name" class="from-control" id="customFile" required><br><br>
																			<input type="text" name="invoice_id" value="{{$invoice->id}}" hidden>
																			<input type="text" name="invoice_number" value="{{$invoice['invoice-number']}}" hidden>
																			<button class="btn btn-primary btn-sm" name="uploadfile">تاكيد</button>
																		</div>
																	</form>
																</div>
															</div>
															<div class="table-responsive mt-15">
																<table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
																	<thead>
																		<tr>
																			<th class="border-bottom-0">#</th>
																			<th class="border-bottom-0">اسم الملف</th>
																			<th class="border-bottom-0">الاضافة</th>
																			<th class="border-bottom-0">تاريخ الاضافة</th>
																			<th class="border-bottom-0">العمليات</th>
																		</tr>
																	</thead>
																	<tbody>
																		@php
																			$i = 0;
																		@endphp
																		@foreach ($attachements as $attachement)
																		{{$i++}}
																		<tr>
																			<td>{{$i}}</td>
																			<td>{{$attachement->file_name}}</td>
																			<td>{{$attachement->created_by}}</td>
																			<td>{{$attachement->created_at}}</td>
																			<td colspan="2">
																				<a href="{{url('view_file')}}/{{$attachement->invoice_number}}/{{$attachement->file_name}}"
																				class="btn btn-outline-success btn-sm" role="button"><i class="fas fa-eye"></i>&nbsp;عرض
																				</a>
																				<a href="{{url('download')}}/{{$attachement->invoice_number}}/{{$attachement->file_name}}"
																				class="btn btn-outline-info btn-sm" role="button"><i class="fas fa-download"></i>&nbsp;تحميل
																				</a>
																				<button
																				class="btn btn-outline-danger btn-sm"
																				data-toggle="modal"
																				data-file_name="{{$attachement->file_name}}"
																				data-invoice_number="{{$attachement->invoice_number}}"
																				data-id_file="{{$attachement->id}}"
																				data-target="#delete_file"
																				>حدف</button>
																			</td>
																		</tr>
																		@endforeach
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /div -->
				</div>
				<!-- /row -->

				<!-- delete attachement -->
				<div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="{{route('delete_file')}}" method="post">
		
							{{ csrf_field() }}
							<div class="modal-body">
								<p class="text-center">
								<h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
								</p>
		
								<input type="hidden" name="id_file" id="id_file" value="">
								<input type="hidden" name="file_name" id="file_name" value="">
								<input type="hidden" name="invoice_number" id="invoice_number" value="">
		
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
								<button type="submit" class="btn btn-danger">تاكيد</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			{{-- delete invoice --}}
			<div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="{{route('delete_invoice')}}" method="post">
							{{method_field('delete')}}
							{{ csrf_field() }}
							<div class="modal-body">
								<p class="text-center">
								<h6 style="color:red"> هل انت متاكد من عملية حذف الفاتورة ؟</h6>
								</p>
								<input type="hidden" name="invoice_id" id="invoice_id" value="">
		
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
								<button type="submit" class="btn btn-danger">تاكيد</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			{{-- fin --}}
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>

<script>
	$('#delete_file').on('show.bs.modal',function(event){
		var button = $(event.relatedTarget)
		var id = button.data('id_file')
		var file = button.data('file_name')
		var number = button.data('invoice_number')
		var modal = $(this)

		modal.find('.modal-body #id_file').val(id);
		modal.find('.modal-body #file_name').val(file);
		modal.find('.modal-body #invoice_number').val(number);
	});
</script>

<script>
	$('#delete_invoice').on('show.bs.modal',function(event){
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var modal = $(this)
		modal.find('.modal-body #invoice_id').val(id);
	})
</script>
@endsection