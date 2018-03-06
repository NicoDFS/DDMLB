 <form role="form" action="{{route('doctor.showAssistantList')}}" method="get">
                              <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                      <label>Search :</label>
                                        <input value="{{$params->s}}" class="form-control" type="text" name="s" placeholder="User name, Email ..." >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                        <div class="form-group">
                                          <label>Verified :</label>               
                                            <select  name="verified" class="form-control" >
                                            <option value="" >Select verified</option>
                                            <option value="1" @if ($params->verified==1) selected="selected" @endif>Yes</option>
                                            <option value="2" @if ($params->verified==2) selected="selected" @endif>No</option>          
                                            </select>                          
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