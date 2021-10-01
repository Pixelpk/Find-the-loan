
<div class="form-group">
    <label for="" class="control-label mb-10">Type Name</label>
    <select @if($profile == 2) required @endif  class="form-control" name="loan_type_id" id="loan_main_type">
        <option value="" hidden>Select</option>
       @foreach($loanTypes as $item)
            <option value="{{ $item->id }}">{{ $item->sub_type }}</option>
       @endforeach
    </select>
</div>
