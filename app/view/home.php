<div class="container">
<div class="row">
  <!-- Start -  left panel  -->
  <div class="col-lg-4 col-md-4 col-sm-12" style="height:1000px;border:1px solid green;"> 
    <div class="col-md-12 " id="step-1">
      <h6>STEP-1</h6>
         <div class="col-md-12">
            <div class="upload-btn-wrapper">
              <button class="btn">Load Db Excel</button>
              <input type="file" name="excel_doc" />
            </div>
          </div>
    </div>
    <div class="col-md-12 setup-content" id="step-2">
        <h6>STEP-2</h6>
        <div class="form-group">
          <label class="control-label">Select worksheet to import</label>
          <select name="worksheet_list" id="worksheet_list"> 
          </select>
        </div>
    </div>    
     <div class="col-md-12 setup-content" id="step-3">
        <h6>STEP-3</h6>
        <div class="form-group" id="column_list">            
        </div>
     </div>
     <div class="col-md-12 setup-content" id="step-4">
        <h6>STEP-4</h6>
        <div class="form-group">
                        <label class="control-label">Select destination table</label>
                        <select name="table_list" id="table_list"> 
                            <option>Select Db table</option>
                        </select>
        </div>
        <button class="btn btn-success btn-lg pull-right btn-export" type="button">Import</button>
     </div>



  </div> <!-- End -  left panel  -->
  
  <!-- Start -  right panel  -->
  <div class="col-lg-8 col-md-8 col-sm-12" style="height:1000px;border:1px solid red;">
  
  
  
  </div>  <!-- End -  right panel  -->
</div>
</div>
