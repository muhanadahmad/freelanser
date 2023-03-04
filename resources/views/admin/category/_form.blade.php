        @if ($errors->any())
            <div class="alert alert-danger">
                <h5>{{ __('Error Occured') }}</h5>
                <ul>
                    @foreach ($errors->all() as $err)
                        <li class="text-danger">{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!--name input-->
        <div class="row">
            <x-form.input lable="Name" type="text" name="name" :value="$category->name" required />
        </div>

        <!--name select-->
        <div >
            <label for="inputName" class="control-label">Sub Category </label>
            <select name="parent_id" @class([
               'form-control ','SlectBox','is-invalid'=>$errors->has('parent_id')
            ])
             onclick="console.log($(this).val())"
                onchange="console.log('change is firing')">
                <!--placeholder-->
                <option value="" selected disabled>Primary Category</option>
                @foreach ($parent as $parent)
                    <option value="{{ $parent->id }}" @selected(old('parent_id',$category->parent_id) == $parent->id)>
                        {{ $parent->name }}</option>
                @endforeach
                @error('parent_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </select>
        </div>

        <!--notes input-->
        <div class="row">
            <x-form.textarea lable="Notes" name="notes" :value="$category->notes" />
        </div>

        <!--status select-->
        <div class="row">
            <x-form.status lable="Status" name="status" :value="$category->status" :option="['active' => 'Active', 'inactive' => 'Inactive']" />
        </div><br>

        <!--image input-->
        <h5 class="">Image</h5>
        <x-form.input  type="file" name="image" class="dropify"
        accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />

        </div><br>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">ٍSave Data</button>

        </div>
        <br><br>
