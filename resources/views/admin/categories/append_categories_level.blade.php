<div class="form-group">
    <label for="parent_id">Select Category Lavel</label>
    <select name="parent_id" id="parent_id"  class="form-control select2" style="width: 100%;">
        <option value="0" @if(isset($categorydata['parent_id']) && $categorydata['parent_id'] == 0 ) selected @endif > Main Category </option>
        @if(!empty($getCategories))
            @foreach($getCategories as $category)
                <option @if(isset($categorydata['parent_id']) && $categorydata['parent_id'] == $category['id'] ) selected @endif value="{{$category['id']}}">{{$category['category_name']}}</option>
                @if(!empty($category['subcategories']))
                    @foreach($category['subcategories'] as $subcategory)
                        <option value="{{$subcategory['id']}}">&nbsp;&raquo;&nbsp;{{$subcategory['category_name']}}</option>
                    @endforeach
                @endif
            @endforeach
        @endif
    </select>
</div>

