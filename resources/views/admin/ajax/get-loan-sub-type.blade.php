
<div class="form-group">
    <label for="" class="control-label mb-10">Select Sub type</label>
    <select  class="form-control" name="sub_type_id" id="loan_main_type">
        <option value="" hidden>Select</option>
       @foreach($mainType as $item)
            <option @if($loanType && $loanType->profile == $item->id) selected @endif  value="{{ $item->id }}">{{ $item->main_type }}</option>
       @endforeach
    </select>
</div>