@extends('layouts.master')
@section('title')
Invoices - قائمة المنتجات
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المنتجات</span>
		</div>
	</div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
		<!-- session has  -->
		 @if($errors->any())
		 <div class="alert alert-danger alert-dismissible fade show" role="alert">
			<ul>
			@foreach ($errors->all() as $error)
					<li>
					<strong>{{$error}}</strong>
					<button class="colse" type="button" data-dismiss="alert" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>
					</li>
					<br>
			@endforeach
			</ul>
				</div>	
		 @endif
		 @if(session()->has('add'))
		 <div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>{{session()->get('add')}}</strong>
					<button class="colse" type="button" data-dismiss="alert" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>	
		 @endif
		 @if(session()->has('edit'))
		 <div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>{{session()->get('edit')}}</strong>
					<button class="colse" type="button" data-dismiss="alert" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>	
		 @endif
		 @if(session()->has('delete'))
		 <div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>{{session()->get('delete')}}</strong>
					<button class="colse" type="button" data-dismiss="alert" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>	
		 @endif
		<!-- row -->
		<div class="row">
		<div class="col-xl-12">
					<div class="card mg-b-20">
						<div class="card-header pb-0">
							<!-- header de tableau -->
							<div class="col-sm-6 col-md-4 col-xl-3">
							<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة منتج</a>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="example1" class="table key-buttons text-md-nowrap">
									<thead>
										<tr>
											<th class="border-bottom-0">#</th>
											<th class="border-bottom-0">اسم المنتج</th>
											<th class="border-bottom-0">اسم القسم</th>
											<th class="border-bottom-0">الملاحضات</th>
											<th class="border-bottom-0">العمليات</th>
										</tr>
									</thead>
									<tbody>
										@php
										$i = 0
										@endphp
										@foreach($products as $product)
										@php
										$i++
										@endphp
											<tr>
											<td>{{$i}}</td>
												<td>{{$product->product_name}}</td>
												<td>{{$product->section->section_name}}</td>
												<td>{{$product->description}}</td>
												<td>
													<button class="btn btn-outline-success btn-sm" data-id="{{$product->id}}" data-product_name = "{{$product->product_name}}" data-section_name = "{{$product->section->section_name}}" data-description = "{{$product->description}}" data-toggle = "modal" data-target = "#edit">تعديل</button>
													<button class="btn btn-outline-danger btn-sm" data-product_id = "{{$product->id}}" data-product_name = "{{$product->product_name}}" data-toggle="modal" data-target="#modaldemo9">حذف</button>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- form to add product -->
				<div class="modal" id="modaldemo8">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title"> اضافة منتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form action="{{route('store')}}" method="post">
								{{ csrf_field() }}
							<div class="form-group">
								<label>اسم منتج</label>
								<input type="text" class="form-control" id="product_name" name="product_name">
							</div>
							<div class="form-group">
								<label for="">القسم</label>
								<select name="section_id" id="section_id" class="form-control">
									<option value="">--حدد القسم--</option>
								@foreach($section as $item)
								<option value="{{$item->id}}">{{$item->section_name}}</option>
								@endforeach
								</select>
							</div>
							<div class="form-group">
								<label> الوصف</label>
								<textarea class="form-control" id="description" name="description" rows="3"></textarea>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-success">تأكيد</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- edit product -->
		<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">تعديل المنتج</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<form action="{{route('updateproduct')}}" method="post" autocomplete="off">
							{{method_field('PATCH')}}
							{{csrf_field()}}
							<div class="form-group">
								<input type="hidden" name="id" id="id" value="">
								<label for="recipient-name" class="col-form-label">اسم القسم:</label>
								<input class="form-control" name="product_name" id="product_name" type="text">
							</div>
							<div class="form-group">
								<label for="">القسم</label>
								<select name="section_name" id="section_name" class="form-control">
								@foreach($section as $item)
								<option {{$item->id}} >{{$item->section_name}}</option>
								@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="message-text" class="col-form-label">ملاحظات:</label>
								<textarea class="form-control" id="description" name="description"></textarea>
							</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">تعديل البيانات</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		{{-- delete --}}
		<div class="modal" id="modaldemo9">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">حذف القسم</h6>
						<button aria-label="Close" class="close" data-dismiss="modal"type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<form action="{{route('deleted')}}" method="post">
						{{method_field('delete')}}
						{{csrf_field()}}
						<div class="modal-body">
							<p>هل انت متاكد من عملية الحذف ؟</p><br>
							<input type="hidden" name="id" id="id">
							<input class="form-control" name="section_name" id="section_name" type="text" readonly>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
							<button type="submit" class="btn btn-danger">تاكيد</button>
						</div>
				</div>
				</form>
			</div>
		</div>
		<!-- row closed -->
	</div>
	<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

<script>
	$('#edit').on('show.bs.modal',function(event){
		var button = $(event.relatedTarget)
		var product_name = button.data('product_name')
		var section_name = button.data('section_name')
		var description = button.data('description')
		var id = button.data('id')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #product_name').val(product_name);
		modal.find('.modal-body #section_name').val(section_name);
		modal.find('.modal-body #description').val(description);
		
	})
</script>

<script>
	$('#modaldemo9').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('product_id')
		var product_name = button.data('product_name')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #section_name').val(product_name);
	})
</script>

@endsection

