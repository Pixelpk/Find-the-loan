
<div class="form-group">
    <label for="" class="control-label mb-10">Type Name</label>
    <select  class="form-control" name="loan_type_id" id="loan_main_type">
        <option value="" hidden>Select</option>
       @foreach($loanTypes as $item)
            <option @if($loanReason && $loanReason->loan_type_id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->sub_type }}</option>
       @endforeach
    </select>
</div>