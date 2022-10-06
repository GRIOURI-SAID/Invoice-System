@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادت</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    المنتجات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('Add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Add') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        @if (session()->has('edit'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('edit') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        @if (session()->has('delete'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('delete') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <a class="modal-effect btn btn-success btn-block" data-effect="effect-scale" data-toggle="modal"
                                href="#modaldemo8">اضافة القسم</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">اسم المنتج</th>
                                    <th class="wd-15p border-bottom-0">القسم</th>
                                    <th class="wd-20p border-bottom-0">الوصف</th>
                                    <th class="wd-15p border-bottom-0">العمليات</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($products as $product)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->section->section_name }}</td>
                                        <td>{{ $product->description }}</td>

                                        <td>
                                            <div class="btn-icon-list">


                                                <a href="#delete_product" class="ml-2" data-effect="effect-scale"
                                                    data-toggle="modal" data-id={{ $product->id }}
                                                    data-product_name={{ $product->name }}>
                                                    <button class="btn btn-danger btn-icon"><i
                                                            class="typcn typcn-trash"></i></button>

                                                </a>



                                                <a href="#edit_product" data-toggle="modal" data-effect="effect-scale"
                                                    data-id={{ $product->id }} data-product_name={{ $product->name }}
                                                    data-description={{ $product->description }}
                                                    data-section_id={{ $product->section_id }}>

                                                    <button class="btn btn-warning btn-icon"><i
                                                            class="typcn typcn-edit"></i></button>
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach




                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('products.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="section_name">اسم المنتج</label>
                                <input type="text" name="name" placeholder="" class="form-control" />
                            </div>


                            <div class="form-group">
                                <label for="section_name">القسم</label>
                                <select name="section_id" class="form-control">
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="section_name">ملاحظات</label>
                                <textarea class="form-control" name="description" id="" cols="3" rows="4"></textarea>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit">اضافة</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>




        <div class="modal" id="edit_product">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">تعديل القسم</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="products/update" method="post">
                            {{ method_field('patch') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" id="id" name="id" />
                                <label for="section_name">اسم المنتج</label>
                                <input type="text" name="name" id="name" placeholder=""
                                    class="form-control" />
                            </div>


                            <div class="form-group">
                                <label for="section_name">القسم</label>
                                <select name="section_id" id="section_id" class="form-control">
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="section_name">ملاحظات</label>
                                <textarea class="form-control" name="description" id="description" cols="3" rows="4"></textarea>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-warning" type="submit">تعديل</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal" id="delete_product">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حدف القسم</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="products/destroy" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" id="id" name="id" />
                                <label>هل تريد حدف المنتج</label>
                                <input type="text" name="name" disabled id="name" placeholder=""
                                    class="form-control" />
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-danger" type="submit">حدف</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                    </div>
                    </form>
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
@section('js')
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

    <script>
        $('#edit_product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('product_name')
            var description = button.data('description')
            var section_id = button.data('section_id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(product_name);
            modal.find('.modal-body #section_id').val(section_id);
            modal.find('.modal-body #description').val(description);
        })
    </script>


    <script>
        $('#delete_product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('product_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(product_name);

        })
    </script>
@endsection
