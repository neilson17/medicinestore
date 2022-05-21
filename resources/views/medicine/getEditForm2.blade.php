<form role="form" method="POST" action="{{url('medicines/'.$data->id)}}">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <button type="button" class="close" 
        data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Medicine</h4>
    </div>
    <div class="modal-body">
    <div class="form-body">
         <div class="form-group">
          <label for="inpgenericname">Nama Generik</label>
          <input type="text" class="form-control" id="eGenericName" name="generic_name" placeholder="Nama Generik" value="{{$data->generic_name}}">
         </div>
         <div class="form-group">
          <label for="inpform">Bentuk</label>
          <input type="text" class="form-control" id="eForm" name="form" placeholder="Bentuk" value="{{$data->form}}">
          <span class="help-block">
          Bentuk atau ukuran dari obat </span>
         </div>
         <div class="form-group">
          <label for="inprestrictionformula">Batas Pemakaian</label>
          <input type="text" class="form-control" id="eRestriction" name="restriction_formula" placeholder="Batas Pemakaian" value="{{$data->restriction_formula}}">
          <span class="help-block">
          Batas aman konsumsi obat </span>
         </div>
         <div class="form-group">
          <label>Harga</label>
          <div class="input-group">
           <span class="input-group-addon">
           <i class="fa fa-money"></i>
           </span>
           <input type="number" class="form-control" name="price" id="ePrice" placeholder="Harga Obat" value="{{$data->price}}">
          </div>
         </div>
         <div class="form-group">
          <label>Deskripsi</label>
          <textarea name="description" id="eDescription" class="form-control" rows="3">{{$data->description}}</textarea>
         </div>
         <div class="form-group">
          <label>Category</label>
          <select id="eCategory" name="category" class="form-control">
           <option value="">-- pilih kategori --</option>
           @foreach($categories as $c)
            <option value="{{$c->id}}" @if($c->id == $data->category_id) selected @endif>{{$c->name}}</option>
           @endforeach
          </select>
         </div>
         <div class="form-group">
          <label>Ketersediaan di Faskes</label>
          <div class="checkbox-list">
           <label><input id="eFaskes1" type="checkbox" name="faskes1" @if($data->faskes1 == 1) checked @endif> Faskes 1 </label>
           <label><input id="eFaskes2" type="checkbox" name="faskes2" @if($data->faskes2 == 1) checked @endif> Faskes 2 </label>
           <label><input id="eFaskes3" type="checkbox" name="faskes3" @if($data->faskes3 == 1) checked @endif> Faskes 3 </label>
          </div>
         </div>
         <div class="form-group" style="display:flex; flex-direction:column;">
          <label for="inpimage">Foto</label>
          <img src="{{asset('images/'.$data->image)}}" height="150px" width="150px" alt="">
         </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" data-dismiss="modal" onclick="saveDataUpdateTD({{$data->id}})" class="btn btn-info">Submit</button>
        <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
    </div>
</form>