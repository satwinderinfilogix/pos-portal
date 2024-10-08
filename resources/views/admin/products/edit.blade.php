@extends('admin.layouts.app')

@section('content')
<style>
    .card .card-size {
        padding: 0.25rem;
    }
    .btn.btn-sm {
        padding: 0px 0px 0px 0px;
        font-size: 9px;
    }
    div#imagePreview
    {
        width: 144px;
    }
</style>
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4>Edit Product</h4>
                <h6>Edit product details</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <div class="page-btn">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary"><i data-feather="arrow-left"
                            class="me-2"></i>Back to Products</a>
                </div>
            </li>
        </ul>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data" id='product-form'>
        @csrf
        <div class="card">
            <div class="card-body add-product pb-0">
                <div class="accordion-card-one accordion" id="accordionExample">
                    <div class="accordion-item">
                        <div class="row mb-3">
                            <div class="col-md-6 add-product">
                                <label class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 add-product">
                                <label class="form-label">Product Code</label>
                                <input type="text" name="product_code" class="form-control" value="{{ old('product_code', $product->product_code) }}">
                                <small id="pcode-err" style="color:red; display:none;">Product code already exist</small>
                            </div>    
                        </div>
                        <div class="row mb-3">
                            <div class="add-product">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->name) }}">
                            </div>
                        </div>

                        <?php
                            // $productUnits = isset($product->units) ? json_decode($product->units, true) : [];
                            
                            // if (!is_array($productUnits)) {
                            //     $productUnits = [];
                            // }
                        ?>
                        <div class="row mb-3">
                            <div class="col-md-6 add-product">
                                <label class="form-label">Unit</label>
                                {{-- <select class="select2-multiple form-control" name="units[]" multiple="multiple"id="select2Multiple"> --}}
                                <select class="select2-multiple form-control" name="units" id="select2Multiple">
                                    <option value="" selected disabled>Select Unit</option>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}" {{ $unit->id == $product->units ? 'selected' : '' }}>
                                            {{ $unit->name }}
                                        </option>
                                        {{-- <option value="{{ $unit->id }}" {{ in_array($unit->id, $productUnits) ? 'selected' : '' }}>{{ $unit->name }}</option> --}}

                                    @endforeach
                                </select>

                                {{-- <div class="input-blocks add-product list">
                                    <label class="form-label">Units</label>
                                    <input type="text" id="unit" class="form-control">
                                    <button type="button" id="add-units" class="btn btn-primaryadd">Add Units</button>
                                </div>
                                <div id="unit-list" class="mt-3 d-flex flex-wrap">
                                    <!-- Display saved units from database -->
                                    @if($product->units && is_array($units = json_decode($product->units, true)))
                                        @foreach(json_decode($product->units) as $index => $unit)
                                        <div class="card added-units me-2 mb-2">
                                            <div class="card-body card-size d-flex justify-content-between align-items-center">
                                                <span>{{ $unit }}</span>
                                                <input type="hidden" name="units[]" value="{{ $unit }}">
                                                <button type="button" class="btn btn-sm btn-danger remove-units" data-index="{{ $index }}"><span class="badge rounded-pill">x</span></button>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div> --}}
                            </div>
                            <div class="col-md-6 add-product">
                                <label class="form-label">Manufacture Date</label>
                                <input type="text" name="manufacture_date" id="manufacture_date" class="form-control" value="{{ old('manufacture_date', $product->manufacture_date) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 add-product">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" id="product-image" class="form-control" value="{{ old('image')}}">
                            </div>
                        <div id="imagePreview">
                            @if ($product->image)
                                <img src="{{ asset($product->image) }}" id="preview-Img" class="img-preview" width="50" height="50">
                            @else
                                <img src="" id="preview-Img" height="50" width="50" name="image" hidden>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="btn-add mb-4">
                        <button type="submit" class="btn btn-submit">Update Product</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Select2 Multiple
        $('.select2-multiple').select2({
            placeholder: "Select Unit",
            allowClear: true
        });
    });

    $(document).ready(function () {
        // product image preview
        $('#product-image').change(function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').html(
                        '<img class="preview-img" width="50px" height="50px" src="' + e.target
                        .result + '" alt="Selected Image">');
                }
                reader.readAsDataURL(file);
            }
        });

        // Array to store entered units
        var units = [];

        // Add saved units to array
        @if($product->units && is_array($units = json_decode($product->units, true)))
        @foreach(json_decode($product->units) as $unit)
        units.push('{{ $unit }}');
        @endforeach
        @endif

        // Function to initialize displayed units
        function initializeUnitList() {
            $('#unit-list').empty(); // Clear previous entries
            units.forEach(function (unit, index) {
                var listItem = $('<div class="card added-units me-2 mb-2">' +
                                    '<div class="card-body card-size d-flex justify-content-between align-items-center">' +
                                        '<span>' + unit + '</span>' +
                                        '<input type="hidden" name="units[]" value="' + unit + '">' +
                                        '<button type="button" class="btn btn-sm btn-danger remove-units" data-index="' + index + '"><span class="badge rounded-pill">x</span></button>' +
                                    '</div>' +
                                '</div>');
                $('#unit-list').append(listItem);
            });
        }

        // Initialize displayed units on page load
        initializeUnitList();

        // Add Unit button click event
        $('#add-units').click(function () {
            var unitValue = $('#unit').val().trim();
            if (unitValue !== '') {
                // Add Unit to array
                units.push(unitValue);
                // Update displayed Units
                updateUnitList();
                // Clear input
                $('#unit').val('');
            }
        });

        // Remove Unit button click event (for dynamically added elements)
        $('#unit-list').on('click', '.remove-units', function () {
            var index = $(this).data('index');
            units.splice(index, 1); // Remove from array
            updateUnitList(); // Update displayed units
        });

        // Function to update displayed units
        function updateUnitList() {
            $('#unit-list').empty(); // Clear previous entries
            units.forEach(function (unit, index) {
                var listItem = $('<div class="card added-units me-2 mb-2">' +
                                    '<div class="card-body card-size d-flex justify-content-between align-items-center">' +
                                        '<span>' + unit + '</span>' +
                                        '<input type="hidden" name="units[]" value="' + unit + '">' +
                                        '<button type="button" class="btn btn-sm btn-danger remove-units" data-index="' + index + '"><span class="badge rounded-pill">x</span></button>' +
                                    '</div>' +
                                '</div>');
                $('#unit-list').append(listItem);
            });
        }

        // Datepicker initialization
        $('#manufacture_date').datepicker({
            format: 'yyyy-mm-dd', // specify the format you want
            todayHighlight: true,
            autoclose: true,
            endDate: new Date(), // Set the end date to today
            orientation: 'bottom'
        });

        // Form validation
        $("#product-form").validate({
            rules: {
                category_id: "required",
                product_name: "required",
                product_code: "required",
                manufacture_date: "required",
                units: "required"
            },
            messages: {
                category_id: "Please enter category",
                product_name: "Please enter the product name",
                product_code: "Please enter the product code",
                manufacture_date: "Please enter the manufacture date",
                units: "Please enter the unit"
            },
            errorClass: "invalid-feedback",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-invalid");
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    //check product code
    $(document).on('keyup','[name="product_code"]',function(){
        var product_code = $(this).val(); 
        var product_id = "{{ $product->id }}"; 
        var token = "{{ csrf_token() }}";
        var url = "{{ route('products.check_code') }}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                "_token": token,
                "type" : "edit",
                product_id,
                product_code
            },
            success: function(response) {
                console.log(response);
                if(response.success){
                    $('#pcode-err').show();
                    $('.btn-submit').prop('disabled', true);
                }else{
                    $('#pcode-err').hide();
                    $('.btn-submit').prop('disabled', false);
                }
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    });
</script>
@endsection
