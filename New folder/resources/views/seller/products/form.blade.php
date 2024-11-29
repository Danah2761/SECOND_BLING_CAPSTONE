<div class="row">
    <div class="col-md-12 mb-3">
        <label for="product_name">Product Name</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">shopping_basket</i>
            </span>
            <div class="form-line">
                <input type="text" id="product_name" class="form-control" name="product_name"
                       value="{{ isset($product) ? $product->product_name : old('product_name') }}"
                       placeholder="Enter product name" required>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <label for="description">Description</label>
        <div class="form-group">
            <textarea id="description" name="description" required>{{ isset($product) ? $product->description : old('description') }}</textarea>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <label for="category_id">Category</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">category</i>
            </span>
            <div class="form-line">
                <select id="category_id" name="category_id" class="selectpicker" required>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->category_id }}" {{ isset($product) && $product->category_id == $category->category_id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <label for="price">Price</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">attach_money</i>
            </span>
            <div class="form-line">
                <input type="number" id="price" class="form-control" name="price"
                       value="{{ isset($product) ? $product->price : old('price') }}" placeholder="Enter price" required>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <label for="stock_quantity">Stock Quantity</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">storage</i>
            </span>
            <div class="form-line">
                <input type="number" id="stock_quantity" class="form-control" name="stock_quantity"
                       value="{{ isset($product) ? $product->stock_quantity : old('stock_quantity') }}"
                       placeholder="Enter stock quantity" required>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <label for="image">Product Image</label>
        <p>Image Upload Requirements:</p>
        <ul style="list-style-type: none; padding: 0;">
            <li style="margin-bottom: 8px;">
                <span style="color: green; font-weight: bold;">✔</span> The uploaded image must be <strong>high resolution</strong>.
            </li>
            <li style="margin-bottom: 8px;">
                <span style="color: green; font-weight: bold;">✔</span> Accepted file formats: <strong>PDF, PNG, JPG</strong>.
            </li>
            <li style="margin-bottom: 8px;">
                <span style="color: green; font-weight: bold;">✔</span> The uploaded image must be an <strong>original photo</strong>.
            </li>
            <li style="margin-bottom: 8px;">
                <span style="color: green; font-weight: bold;">✔</span> The picture background must be <strong>white</strong>.
            </li>
            <li style="margin-bottom: 8px;">
                <span style="color: green; font-weight: bold;">✔</span> The image must be in <strong>color</strong>.
            </li>
        </ul>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">image</i>
            </span>
            <div class="form-line">
                <input type="file" id="image" class="form-control" name="image">
            </div>
        </div>
        @if(isset($product) && $product->image)
            <img src="{{ asset($product->image) }}" alt="{{ $product->product_name }}" width="100">
        @endif
    </div>
</div>

@push('js')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endpush
