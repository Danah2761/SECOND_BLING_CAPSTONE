<label for="category_name">Category Name</label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="category_name" class="form-control" name="category_name"
               value="{{ isset($category) ? $category->category_name : old('category_name') }}"
               placeholder="Enter category name" required>
    </div>
</div>


