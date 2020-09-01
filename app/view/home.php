<div class="album py-5 bg-light">
  <div class="container">
      <div class="row">
          <div class="container">
  
            <div class="stepwizard col-md-offset-3">
                <div class="stepwizard-row setup-panel">
                  <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>Step 1</p>
                  </div>
                  <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>Step 2</p>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6 col-sm-12 div-setup-content">
                <div class="row setup-content" id="step-1">
                  <div class="col-md-12 col-md-offset-3">
                    <div class="col-md-12">
                      <h3> Step 1</h3>
                      <div class="col-md-12">
                        <div class="form-group files">
                            <label>Upload Your File </label>
                            <input type="file" name="excel_doc" class="form-control" >
                         </div>
                      </div>
                      <button class="btn btn-primary nextBtn btn-lg pull-right uploadNextBtn" type="button">Next</button>
                    </div>
                  </div>
                </div>
                <div class="row setup-content" id="step-2">
                  <div class="col-md-12 col-md-offset-3">
                    <div class="col-md-12">
                      <h3> Step 2</h3>
                      <div class="form-group">
                        <label class="control-label">Select worksheet to import</label>
                        <select name="worksheet_list" id="worksheet_list"> 
                        </select>
                      </div>
                      <div class="form-group" id="column_list">            
                      </div>
                      <div class="form-group">
                        <label class="control-label">Select destination table</label>
                        <select name="table_list" id="table_list"> 
                            <option>Select Db table</option>
                        </select>
                      </div>
                      <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                      <button class="btn btn-success btn-lg pull-right btn-export" type="button">Import</button>
                    </div>
                  </div>
                </div>
                <!--div class="row setup-content" id="step-3">
                  <div class="col-md-12 col-md-offset-3">
                    <div class="col-md-12">
                      <h3> Step 3</h3>
                      <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                      <button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>
                    </div>
                  </div>
                </div-->
              </div>
              
            </div>
          </div>
        </div>
      </div>


