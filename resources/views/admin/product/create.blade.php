@extends('layouts.admin')
@section('title')
    Product Add
@endsection
@section('style')
    <style>
        /* Style for read-only input fields */
        input[readonly] {
            background-color: #F5F5F7; /* Set the background color */
            border: 1px solid #ccc;    /* Optional: adjust the border color */
            color: #333;                /* Optional: adjust the text color */
        }
        /* Additional styles can go here */
    </style>
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
            <form id="product-form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
                @csrf
                <!-- Main column -->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!-- Tabs -->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2"></ul>

                    <!-- Tab content -->
                    <div class="tab-content">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Umumiy ma'lumotlar</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div id="kt_ecommerce_add_category_conditions">
                                    <div class="form-group">
                                        <div class="d-flex flex-column gap-3">
                                            <div class="form-group d-flex flex-wrap gap-5">
                                                <!-- Product Name -->
                                                <div class="w-100 w-md-200px">
                                                    <label class="form-label">Mahsulot nomi</label>
                                                    <input id="product_name" name="product_name" class="form-control mb-2" placeholder="Mahsulot nomi:" required>
                                                </div>
                                                <!-- Category -->
                                                <div class="w-100 w-md-200px">
                                                    <label class="form-label">Kategoriya</label>
                                                    <select class="form-select mb-2" name="category_id" required>
                                                        <option value="">Asosiy kategoriya</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- Country -->
                                                <div class="w-100 w-md-200px">
                                                    <label class="form-label">Davlati:</label>
                                                    <select class="form-select mb-2" name="country" required>
                                                        <option value="O'zbekiston">O'zbekiston</option>
                                                        <option value="Rossiya">Rossiya</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="separator separator-dashed my-5"></div>
                                </div>

                                <!-- Parameters Section -->
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
                                                        <input type="text" id="thickness" name="thickness" class="form-control mb-2" placeholder="Qalinligi" required>
                                                    </div>
                                                    <!-- Length -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">Uzunligi</label>
                                                        <input id="length" name="length" class="form-control mb-2" placeholder="Uzunligi" required>
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
                                                        <input id="price_per_ton" name="price_per_ton" class="form-control mb-2" placeholder="1 tonna narxi" required>
                                                    </div>
                                                    <!-- Length per Ton -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 tonna uzunligi:</label>
                                                        <input id="length_per_ton" name="length_per_ton" class="form-control mb-2" placeholder="1 tonna uzunligi:" required>
                                                    </div>
                                                    <!-- Price per Meter -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 metr uchun narx:</label>
                                                        <input id="price_per_meter" name="price_per_meter" class="form-control mb-2" placeholder="1 metr uchun narx:" required readonly style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;" >
                                                    </div>
                                                    <!-- Price per Item -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 dona uchun narx:</label>
                                                        <input id="price_per_item" name="price_per_item" class="form-control mb-2" placeholder="1 dona uchun narx:" required readonly style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;" >
                                                    </div>
                                                    <!-- Price per Package -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 pochka narxi:</label>
                                                        <input id="price_per_package" name="price_per_package" class="form-control mb-2" placeholder="1 pochka narxi:" required readonly style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;" >
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
                                                        <input id="items_per_package" name="items_per_package" class="form-control mb-2" placeholder="1 pochkadagi soni:" required>
                                                    </div>
                                                    <!-- Package Weight -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 pochkaning og’irligi</label>
                                                        <input id="package_weight" name="package_weight" class="form-control mb-2" placeholder="1 pochkaning og’irligi" required  >
                                                    </div>
                                                    <!-- Package Length -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 pochka uzunligi:</label>
                                                        <input id="package_length" name="package_length" class="form-control mb-2" placeholder="1 pochka uzunligi:" required readonly style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;" >
                                                    </div>
                                                    <!-- Weight per Meter -->
                                                    <div class="w-100 w-md-200px">
                                                        <label class="form-label">1 metr og‘irligi:</label>
                                                        <input id="weight_per_meter" name="weight_per_meter" class="form-control mb-2" placeholder="1 metr og‘irligi:" required readonly style="background-color: #F5F5F7; border: 1px solid #ccc; color: #333;" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">O'zgarishlarni saqlash</span>
                                <span class="indicator-progress">Iltimos kuting...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
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
