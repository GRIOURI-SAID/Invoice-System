@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة
                    فاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
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
                                        <table class="table table-striped mg-b-0 text-md-nowrap" style="width: 100%">
                                            <tbody>
                                                <tr scope="row">
                                                    <th>رقم الفاتور</th>
                                                    <td> {{ $invoice->invoice_number }}</td>

                                                    <th>تاريخ الاصدار</th>
                                                    <td>{{ $invoice->invoice_Date }} </td>

                                                    <th>تاريخ الاستحقاق</th>
                                                    <td>{{ $invoice->Due_date }}</td>

                                                    <th>القسم</th>
                                                    <td>{{ $invoice->section->section_name }}</td>
                                                </tr>

                                                <tr scope="row">
                                                    <th>المتج</th>
                                                    <td> {{ $invoice->product }}</td>

                                                    <th>مبلغ التحميل</th>
                                                    <td>{{ $invoice->Amount_collection }} </td>

                                                    <th>مبلغ العمولة</th>
                                                    <td>{{ $invoice->Amount_Commission }}</td>

                                                    <th>الخصم</th>
                                                    <td>{{ $invoice->Discount }}</td>
                                                </tr>


                                                <tr scope="row">
                                                    <th>نسبة الضريبة</th>
                                                    <td> {{ $invoice->Rate_VAT }}</td>

                                                    <th>قمية الضريبة</th>
                                                    <td>{{ $invoice->Value_VAT }} </td>

                                                    <th>الاجمالي مع الضريبة</th>
                                                    <td>{{ $invoice->Total }}</td>

                                                    <th>الحالة</th>
                                                    <td>
                                                        @if ($invoice->Value_Status == 2)
                                                            <span class="text-danger">
                                                                {{ $invoice->Status }}
                                                            </span>
                                                        @elseif ($invoice->Value_Status == 1)
                                                            <span class="text-success">
                                                                {{ $invoice->Status }}
                                                            </span>
                                                        @else
                                                            <span class="text-warning">
                                                                {{ $invoice->Status }}
                                                            </span>
                                                        @endif

                                                    </td>

                                                </tr>



                                            </tbody>
                                        </table>
                                    </div><!-- bd -->
                                </div><!-- bd -->
                            </div>
                            <div class="tab-pane" id="tab5">
                                <div class="table-responsive">
                                    <table class="table table-striped mg-b-0 text-md-nowrap" style="width: 100%">

                                        <thead>
                                            <tr>
                                                <th>رقم الفاتور</th>
                                                <th>نوع المنتج</th>
                                                <th>القسم</th>
                                                <th>حالة الدفع</th>
                                                <th>تاريخ الدفع</th>
                                                <th>ملاحظات</th>
                                                <th>تاريخ الاضافة</th>
                                                <th>المستخدم</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoices_details as $invoices_detail)
                                                <tr scope="row">
                                                    <td> {{ $invoices_detail->invoice_number }}</td>
                                                    <td>{{ $invoices_detail->product }} </td>
                                                    <td>{{ $invoice->section->section_name }}</td>
                                                    <td>
                                                        @if ($invoices_detail->Value_Status == 2)
                                                            <span class="text-danger">
                                                                {{ $invoices_detail->Status }}
                                                            </span>
                                                        @elseif ($invoices_detail->Value_Status == 1)
                                                            <span class="text-success">
                                                                {{ $invoices_detail->Status }}
                                                            </span>
                                                        @else
                                                            <span class="text-warning">
                                                                {{ $invoices_detail->Status }}
                                                            </span>
                                                        @endif

                                                    </td>
                                                    <td>{{ $invoice->Payment_Date }}</td>
                                                    <td>{{ $invoices_detail->note }}</td>
                                                    <td>{{ $invoices_detail->created_at }}</td>
                                                    <td>{{ $invoices_detail->user }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- bd -->
                            </div>
                            <div class="tab-pane" id="tab6">
                                <div class="table-responsive">
                                    <table class="table table-striped mg-b-0 text-md-nowrap" style="width: 100%">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم الملف</th>
                                                <th>قام بالاضافة</th>
                                                <th>تاريخ الاضافة</th>
                                                <th>العمليات</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($invoices_attachments as $invoices_attachment)
                                                @php
                                                    $i++;
                                                @endphp
                                                <tr scope="row">
                                                    <td> {{ $i }}</td>
                                                    <td>{{ $invoices_attachment->file_name }} </td>
                                                    <td>{{ $invoices_attachment->Created_by }}</td>
                                                    <td>{{ $invoices_attachment->created_at }}</td>
                                                    <td>
                                                        <a class="btn btn-outline-success btn-sm"
                                                            href="{{ url('View_file') }}/{{ $invoice->invoice_number }}/{{ $invoices_attachment->file_name }}"
                                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                                            تحميل </a>




                                                        <button class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                            data-file_name="{{ $invoices_attachment->file_name }}"
                                                            data-invoice_number="{{ $invoices_attachment->invoice_number }}"
                                                            data-id_file="{{ $invoices_attachment->id }}"
                                                            data-target="#delete_file">حذف</button>


                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- bd -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection



<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<!-- Internal Input tags js-->
<script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
<!--- Tabs JS-->
<script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
<script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
<!--Internal  Clipboard js-->
<script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
<!-- Internal Prism js-->
<script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
