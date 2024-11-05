@extends('layouts.admin')
@section('title')
    Product Edit
@endsection
@section('style')
@endsection
@section('content')
    @include('admin.success-file')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <form id="product-form" action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
                @csrf
                @method("PUT")

                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!-- Begin Tabs -->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                        <!-- Add Tab Items Here if Needed -->
                    </ul>
                    <!-- End Tabs -->

                    <!-- Begin Tab Content -->
                    <div class="tab-content">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Umumiy malumotlar</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="form-group">
                                    <div class="d-flex flex-column gap-3">
                                        <div class="form-group d-flex flex-wrap gap-5">
                                            <div class="w-100 w-md-200px">
                                                <label class="form-label">Mahsulot nomi</label>
                                                <input name="product_name" value="{{ $product->product_name }}" class="form-control mb-2" placeholder="maxsulot nomi:">
                                            </div>
                                            <div class="w-100 w-md-200px">
                                                <label class="form-label">Category</label>
                                                <select class="form-select mb-2" name="category_id" required>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $category->id === $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="w-100 w-md-200px">
                                                <label class="form-label">Davlati:</label>
                                                <select class="form-select mb-2" name="country" required>
                                                    <option value="O'zbekiston" {{ $product->country === 'O\'zbekiston' ? 'selected' : '' }}>O'zbekiston</option>
                                                    <option value="Rossiya" {{ $product->country === 'Rossiya' ? 'selected' : '' }}>Rossiya</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="separator separator-dashed my-5"></div>
                                <div class="card-title">
                                    <h2>Parametrlar</h2>
                                </div>
                                <div class="mt-10">
                                    <div id="kt_ecommerce_add_category_conditions">
                                        <div class="form-group">
                                            <div class="d-flex flex-column gap-3">
                                                <div class="form-group d-flex flex-wrap gap-5">
                                                    <!-- Thickness -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">Qalinligi (Стенка)</label>
                                                        <input type="text" id="thickness" name="thickness" class="form-control mb-2" value="{{ $product->thickness }}" required>
                                                    </div>
                                                    <!-- Length -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">Uzunligi</label>
                                                        <input id="length" name="length" class="form-control mb-2" value="{{ $product->length }}" required>
                                                    </div>
                                                    <!-- Metal Type -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">Rangi:</label>
                                                        <select class="form-select mb-2" name="metal_type" required>
                                                            <option value="Qora">Qora</option>
                                                            <option value="Oq">Oq</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="separator separator-dashed my-5"></div>
                                </div>
                                <div class="card-title">
                                    <h2>Narxi</h2>
                                </div>
                                <div class="mt-10">
                                    <div id="kt_ecommerce_add_category_conditions">
                                        <div class="form-group">
                                            <div class="d-flex flex-column gap-3">
                                                <div class="form-group d-flex flex-wrap gap-5">
                                                    <!-- Price per Ton -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 tonna narxi</label>
                                                        <input id="price_per_ton" name="price_per_ton" class="form-control mb-2" value="{{ $product->price_per_ton }}" required>
                                                    </div>
                                                    <!-- Length per Ton -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 tonna uzunligi:</label>
                                                        <input id="length_per_ton" name="length_per_ton" class="form-control mb-2" value="{{ $product->length_per_ton }}" required>
                                                    </div>
                                                    <!-- Price per Meter -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 metr uchun narx:</label>
                                                        <input id="price_per_meter" name="price_per_meter" class="form-control mb-2" value="{{ $product->price_per_meter }}" required readonly style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;" >
                                                    </div>
                                                    <!-- Price per Item -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 dona uchun narx:</label>
                                                        <input id="price_per_item" name="price_per_item" class="form-control mb-2" value="{{ $product->price_per_item }}" required readonly style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;" >
                                                    </div>
                                                    <!-- Price per Package -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 pochka narxi:</label>
                                                        <input id="price_per_package" name="price_per_package" class="form-control mb-2" value="{{ $product->price_per_package }}" required readonly style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="separator separator-dashed my-5"></div>
                                </div>
                                <div class="card-title">
                                    <h2>Qiymatlari</h2>
                                </div>
                                <div class="mt-10">
                                    <div id="kt_ecommerce_add_category_conditions">
                                        <div class="form-group">
                                            <div class="d-flex flex-column gap-3">
                                                <div class="form-group d-flex flex-wrap gap-5">
                                                    <!-- Items per Package -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 pochkadagi soni:</label>
                                                        <input id="items_per_package" name="items_per_package" class="form-control mb-2" value="{{ $product->items_per_package }}" required>
                                                    </div>
                                                    <!-- Package Weight -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 pochkaning og’irligi</label>
                                                        <input id="package_weight" name="package_weight" class="form-control mb-2" value="{{ $product->package_weight }}" required  >
                                                    </div>
                                                    <!-- Package Length -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 pochka uzunligi:</label>
                                                        <input id="package_length" name="package_length" class="form-control mb-2" value="{{ $product->package_length }}" required readonly style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;" >
                                                    </div>
                                                    <!-- Weight per Meter -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 metr og‘irligi:</label>
                                                        <input id="weight_per_meter" name="weight_per_meter" class="form-control mb-2" value="{{ $product->weight_per_meter }}" required readonly style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                            </button>
                        </div>
                    </div>

                    <!-- Begin Toolbar -->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <div class="toolbar" id="kt_toolbar">
                            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3">
                                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Product Update</h1>
                                    <span class="h-20px border-gray-300 border-start mx-2"></span>
                                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Product Details</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Toolbar -->
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Function to calculate and display values
        function calculateValues() {
            const pricePerTon = parseFloat(document.getElementById('price_per_ton').value) || 0; // 1 tonna narxi
            const lengthPerTon = parseFloat(document.getElementById('length_per_ton').value) || 0; // 1 tonna uzunligi
            const length = parseFloat(document.getElementById('length').value) || 0; // Uzunligi
            const itemsPerPackage = parseFloat(document.getElementById('items_per_package').value) || 0; // 1 pochkadagi soni
            const packageWeight = parseFloat(document.getElementById('package_weight').value) || 0; // 1 pochkaning og‘irligi

            // Calculate price per meter
            const pricePerMeter = (pricePerTon / lengthPerTon).toFixed(3); // 1 metr uchun narx
            document.getElementById('price_per_meter').value = pricePerMeter;

            // Calculate price per item
            const pricePerItem = (pricePerTon / lengthPerTon * length).toFixed(2); // 1 Dona uchun narx
            document.getElementById('price_per_item').value = pricePerItem;

            // Calculate price per package
            const pricePerPackage = (packageWeight * pricePerTon).toFixed(2); // 1 pochka narxi
            document.getElementById('price_per_package').value = pricePerPackage;

            // Calculate package length
            const packageLength = (itemsPerPackage * length).toFixed(2); // 1 pochka uzunligi
            document.getElementById('package_length').value = packageLength;

            // Calculate weight per meter
            const weightPerMeter = (packageWeight / itemsPerPackage / length).toFixed(6); // 1 metr og‘irligi
            document.getElementById('weight_per_meter').value = weightPerMeter;

            // Display calculated values in full sentences


            // Display the full formatted result
            document.getElementById('calculated_values').innerText = resultText;
        }

        // Add event listeners for real-time calculation
        document.getElementById('price_per_ton').addEventListener('input', calculateValues);
        document.getElementById('length_per_ton').addEventListener('input', calculateValues);
        document.getElementById('length').addEventListener('input', calculateValues);
        document.getElementById('items_per_package').addEventListener('input', calculateValues);
        document.getElementById('package_weight').addEventListener('input', calculateValues);
    </script>

    <!-- HTML Section to display the result -->
    <div id="calculated_values" class="mt-5">
        <!-- This will dynamically display the full calculated values in the format you want -->
    </div>
@endsection
