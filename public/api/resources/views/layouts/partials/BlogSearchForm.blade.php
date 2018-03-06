 <form role="form" action="{{route('doctor.showBlogList')}}" method="get">
          <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                        <label>Search :</label>
                          <input value="{{$params->s}}" class="form-control" type="text" name="s" placeholder="title, description ..." >
                      </div>
                  </div>
                  <div class="col-md-2">
                        <div class="form-group">
                          <label>Publish :</label>               
                            <select  name="publish" class="form-control" >
                            <option value="" >Select verified</option>
                            <option value="1" @if ($params->publish==1) selected="selected" @endif>Yes</option>
                            <option value="2" @if ($params->publish==2) selected="selected" @endif>No</option>          
                            </select>                          
                        </div>
                  </div> 
                  <div class="col-md-2">
                      <div class="form-group">
                              <label>From :</label>
                              <div class="form-group">
                                    <div class='input-group date' >
                                        <input value="{{$params->startdate}}" type='text' name="startdate" class="form-control" id='datepicker'/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                              </div>
                      </div>
                  </div>
                  <div class="col-md-2">
                      <div class="form-group">
                          <label>To :</label>
                          <div class='input-group date' >
                              <input value="{{$params->enddate}}" type='text' name="enddate" class="form-control" id='datepicker1'/>
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>&nbsp;</label>                      
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-info btn-flat">Go!</button>
                            </span>
                    </div>
                  </div>
          </div> 
  </form>
<script>
  $(function () {
     $('#datepicker').datepicker({
      autoclose: true
    });
  $('#datepicker1').datepicker({
      autoclose: true
    });
  });
</script>