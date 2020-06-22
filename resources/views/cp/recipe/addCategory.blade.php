<div class="row addcategory" style="padding: 20px;">

    <div class="col-md-12">
        <div class="form-group input-wlbl  @if ($errors->has('category')) has-error @endif">
            <span class="lblinput">Category Name - الإسم</span>

            {!! Form::text('recipe_id',isset($result->id)?$result->id:"0",['class'=>'hidden recipe_id']) !!}


            <select id="category_id" name="category" class="form-control select2 categorychoose" style="width: 100%; z-index: 5000">
                <option></option>
                <optgroup label="Category Name">
                    @foreach($category as $c)
                        <option value="{{$c->id}}">{{$c->name}} <span class="text text-danger">(Parent:{{\App\Models\CategoryModel::getCategoryName($c->parent_id)}})</span>
                        </option>
                    @endforeach
                </optgroup>


            </select>

            @if ($errors->has('category'))
                <span class="help-block error">{{ $errors->first('category') }}</span>
            @endif
        </div>
    </div>


    <div class="col-md-12 hidden">
        <div class="form-group input-wlbl  @if ($errors->has('about_category')) has-error @endif">
            <span>About Category -عن التصنيف</span>

            {!! Form::textarea('about_category',null,['class'=>'form-control textarea ']) !!}
            @if ($errors->has('about_category'))
                <span class="help-block error">{{ $errors->first('about_category') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6 hidden">
        <div class="form-group input-wlbl  @if ($errors->has('fee')) has-error @endif">
            <span>Fee</span>
            {!! Form::text('fee',null,['class'=>'form-control   ']) !!}
            @if ($errors->has('fee'))
                <span class="help-block error">{{ $errors->first('fee') }}</span>
            @endif
        </div>
    </div>


    <div class="col-md-6 hidden">
        <div class="form-group input-wlbl  @if ($errors->has('category_type')) has-error @endif">
            <span class="lblinput">Type</span>

            <input type="hidden" name="category_type" value="1">


            <p></p>
            @if ($errors->has('category_type'))
                <span class="help-block error">{{ $errors->first('category_type') }}</span>
            @endif
        </div>
    </div>


</div>

                                           
                                              
                                    
                                   