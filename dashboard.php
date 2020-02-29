<?php
include "header.php";
include "left-navbar.php";
//include "session.php";

?>
    
      <section>
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>
               <div class="pull-right text-center">
                  <div class="text-sm mb-sm">500 ratings</div>
                  <div data-bar-color="#cfdbe2" data-height="18" data-bar-width="3" data-bar-spacing="2" data-values="[2,3,4,7,5,7,8,9,5,7,8,4,7]" class="inlinesparkline"></div>
               </div>Dashboard
               <small>Hi, <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}else{header("Location: login-form.php");}?>. Welcome back!</small>
            </h3>
            <div data-toggle="notify" data-onload data-message="&lt;b&gt;Login successful! &lt;/b&gt;&nbsp;&nbsp;Hi <?php echo $_SESSION['username'];?>, Welcome to School Managment." data-options="{&quot;status&quot;:&quot;success&quot;, &quot;pos&quot;:&quot;top-right&quot;}" class="hidden-xs"></div>
            <div class="row">
               <!-- START dashboard main content-->
               <section class="col-md-12">

                  <div class="row">
                     <div class="col-md-4">
                        <!-- START widget-->
                        <div data-toggle="play-animation" data-play="fadeInLeft" data-offset="0" data-delay="100" class="panel widget">
                           <div class="panel-body bg-primary">
                              <div class="row row-table row-flush">
                                 <div class="col-xs-8">
                                    <p class="mb0">Present days</p>
                                    <h3 class="m0">150</h3>
                                 </div>
                                 <div class="col-xs-4 text-right">
                                    <em class="fa fa-share-alt fa-2x"></em>
                                 </div>
                              </div>
                           </div>
                           <div class="panel-body">
                              <!-- Bar chart-->
                              <div class="text-center">
                                 <div data-width="100%" data-resize="true" data-bar-color="primary" data-height="30" data-bar-width="6" data-bar-spacing="6" data-values="[5,3,4,6,5,9,4,4,10,5,9,6,4]" class="inlinesparkline"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <!-- START widget-->
                        <div data-toggle="play-animation" data-play="fadeInDown" data-offset="0" data-delay="100" class="panel widget">
                           <div class="panel-body bg-success">
                              <div class="row row-table row-flush">
                                 <div class="col-xs-8">
                                    <p class="mb0">Absent days</p>
                                    <h3 class="m0">15</h3>
                                 </div>
                                 <div class="col-xs-4 text-right">
                                    <em class="fa fa-cloud-upload fa-2x"></em>
                                 </div>
                              </div>
                           </div>
                           <div class="panel-body">
                              <!-- Bar chart-->
                              <div class="text-center">
                                 <div data-width="100%" data-resize="true" data-bar-color="success" data-height="30" data-bar-width="6" data-bar-spacing="6" data-values="[10,30,40,70,50,90,70,50,90,40,40,60,40]" class="inlinesparkline"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <!-- START widget-->
                        <div data-toggle="play-animation" data-play="fadeInRight" data-offset="0" data-delay="100" class="panel widget">
                           <div class="panel-body bg-danger">
                              <div class="row row-table row-flush">
                                 <div class="col-xs-8">
                                    <p class="mb0">Holidays</p>
                                    <h3 class="m0">30</h3>
                                 </div>
                                 <div class="col-xs-4 text-right">
                                    <em class="fa fa-star fa-2x"></em>
                                 </div>
                              </div>
                           </div>
                           <div class="panel-body">
                              <!-- Bar chart-->
                              <div class="text-center">
                                 <div data-width="100%" data-resize="true" data-bar-color="danger" data-height="30" data-bar-width="6" data-bar-spacing="6" data-values="[2,7,5,9,4,2,7,5,7,5,9,6,4]" class="inlinesparkline"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- START chart-->
                  <div class="row">
                     <div class="col-lg-12">
                        <!-- START widget-->
                        <div class="panel widget bg-inverse">
                           <div class="row">
                              <div class="col-lg-2 col-sm-3 text-right">
                                 <div class="row">
                                    <div class="col-sm-12 col-xs-4">
                                       <div class="ph">
                                          <p class="h3 mb0">11200</p>
                                          <p class="m0 text-muted">Visits</p>
                                       </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-4">
                                       <div class="ph">
                                          <p class="h3 mb0">2000</p>
                                          <p class="m0 text-muted">Likes</p>
                                       </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-4">
                                       <div class="ph">
                                          <p class="h3 mb0">3500</p>
                                          <p class="text-muted">Subscriptions</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-10 col-sm-9 bg-primary">
                                 <div class="p-lg">
                                    <div class="h5 mt0">Latest stadistics</div>
                                    <!-- Line chart-->
                                    <div data-type="line" data-height="100" data-width="100%" data-line-width="2" data-line-color="#dddddd" data-spot-color="#bbbbbb" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="3" data-resize="true"
                                    data-values="[1,5,3,6,5,11,2,4,5,7,9,6,4]" class="inlinesparkline sparkline"></div>
                                    <!-- Bar chart-->
                                    <div class="text-center">
                                       <div data-bar-color="#fff" data-height="60" data-bar-width="8" data-bar-spacing="6" data-values="[1,5,3,6,5,8,2,4,5,7,9,6,4,3,6,5,9,2]" class="inlinesparkline inline"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- END widget-->
                     </div>
                  </div>
                  <!-- END chart-->
                  
                  
               </section>
               
               </aside>
               <!-- END dashboard sidebar-->
            </div>
         </div>
         <!-- END Page content-->
      </section>
      <!-- END Main section-->
   </div>
   <!-- END Main wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
   <?php include "footer.php";?>