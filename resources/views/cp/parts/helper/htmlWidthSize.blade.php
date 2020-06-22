<div class="form-group select-wlbl select-size">
    <span class="lblselect lblselecttop">Size</span>
    <select name="{{ $selectName }}" class="bs-select form-control">
        <option @if(isset($width) && $width==12) selected="selected" @endif value="12">100%</option>
        <option @if(isset($width) && $width==6) selected="selected" @endif value="6">50%</option>
        <option @if(isset($width) && $width==4) selected="selected" @endif value="4">33%</option>
        <option @if(isset($width) && $width==3) selected="selected" @endif value="3">25%</option>
        <option @if(isset($width) && $width==2) selected="selected" @endif value="2">20%</option>
    </select>
</div>