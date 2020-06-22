

                                         <div class="row" style="padding: 20px;">

                                          
                                      
                                        
                                  
                                            
                                          <div class="col-md-6">
                                            <div class="form-group input-wlbl  <?php if($errors->has('title')): ?> has-error <?php endif; ?>">
                                                <span class="lblinput"> العنوان</span>
                                                 <?php echo Form::text('job_id',isset($result->id)?$result->id:"0",['class'=>'hidden job_id txtinput-required']); ?>


                                                 <?php echo Form::text('title',null,['class'=>'form-control  txtinput-required  ']); ?>

                                                <?php if($errors->has('title')): ?>
                                                    <span class="help-block error"><?php echo e($errors->first('title')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                             <div class="col-md-6">
                                                 <div class="form-group input-wlbl  <?php if($errors->has('type')): ?> has-error <?php endif; ?>">
                                                     <span class="lblinput">النوع</span>

                                                     <?php echo Form::select('type',$att_type,null,['class'=>'form-control txtinput-required txtinput']); ?>

                                                     <?php if($errors->has('type')): ?>
                                                         <span class="help-block error"><?php echo e($errors->first('type')); ?></span>
                                                     <?php endif; ?>
                                                 </div>
                                             </div>
                                        
                                           <div class="col-md-12">
                                            <div class="form-group input-wlbl  <?php if($errors->has('information')): ?> has-error <?php endif; ?>">
                                                <span class="lblinput"> المعلومات</span>
                                                 <?php echo Form::textarea('information',null,['class'=>'form-control  txtinput-required  ']); ?>

                                                <?php if($errors->has('information')): ?>
                                                    <span class="help-block error"><?php echo e($errors->first('information')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                                         <div class="col-md-12">
                                            <div class="form-group input-wlbl  <?php if($errors->has('icon')): ?> has-error <?php endif; ?>">
                                                 <span class=" "> المرفق</span>
                                                 <div class=" uploading alert alert-default hidden text-center"> <span class="glyphicon glyphicon-cloud-upload">Uploading....</span> </div>

                                     <div class="profile-userpic">
                                     
                                     
            <div class="upload-job-att">
               
                 <?php echo Form::text('name','1.jpg',['class'=>'hidden from-control  icon ']); ?>

               
                <input type="file" name="image" class="  upload-job-att" id="0" accept="*/*" />

            </div>
              
        </div>
    </div></div>

                                          

                                
                                      
                                        
                                        
                                         
                                           


                                            </div>

                                           
                                              
                                    
                                   