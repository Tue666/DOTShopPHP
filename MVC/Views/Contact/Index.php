    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-danger mt-2">Contact</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="account-notify" style="display:none;">
					<div class="alert-success alert">
					</div>
				</div>
                <form class="contact-form">
                    <?php if(isset($_SESSION['USER_SESSION'])): ?>
                        <input type="hidden" value="<?php echo $_SESSION['USER_SESSION']; ?>" id="id-contact"/>
                    <?php else: ?>
                        <input type="hidden" id="id-contact"/>
                    <?php endif; ?>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="contact-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="contact-email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="contact-phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="contact-title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" id="contact-area" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <a id="submitContact" type="button" class="btn btn-primary disabled">Send</a>
                        <a onclick="routeToHistory('<?php echo BASE_URL; ?>Contact/History')" type="button" class="btn btn-danger">History</a>
                    </div>
                </form>
                <div class="notify-contact">
                    
                </div>
            </div>
            <div class="col-md-6">
                <div id="map" style="width:100%;height:462px;"></div>
            </div>
        </div>
    </div>

    <!-- login permission modal -->
    <div class="modal fade" id="loginPermissionModal">
        <div class="modal-dialog">
        	<div class="modal-content">
            	<div class="modal-header">
            		<h5 style="color:black;" class="modal-title">Oops!</h5>
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                		<span style="color:black;" aria-hidden="true">&times;</span>
            		</button>
            	</div>
            	<div class="modal-body">
            		<label style="color:black;">Login to use. Thanks! :D</label>
            	</div>
            	<div class="modal-footer">
            		<button onclick="window.location.href='<?php echo BASE_URL; ?>Login/Index'" type="button" class="btn btn-danger" data-dismiss="modal">Login</button>
            		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            	</div>
        	</div>
        </div>
    </div>
    <!-- end login permission modal -->

    <!-- success modal -->
        <div class="modal fade" id="successModal">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:black;" class="modal-title">Success! <i style="color:green;" class="fas fa-check-circle"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span style="color:black;" aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="display:flex;justify-content:space-between;align-items:center;">
                <img style="width:20%;" src="<?php echo IMAGE_URL.'/success.png' ?>" alt="">
                <label style="color:black;width:77%;">Submitted your contact. Check history to see the response!.</label>
              </div>
              <div class="modal-footer">
            	<button onclick="routeToHistory('<?php echo BASE_URL; ?>Contact/History')" type="button" class="btn btn-danger">History</button>
            	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
          </div>
        </div>
    <!-- end success modal -->

    <!-- failed modal -->
    <div class="modal fade" id="failedModal">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:black;" class="modal-title">Failed! <i style="color:red;" class="fas fa-times-circle"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span style="color:black;" aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="display:flex;justify-content:space-between;align-items:center;">
                <img style="width:20%;" src="<?php echo IMAGE_URL.'/failed.png' ?>" alt="">
                <label style="color:black;width:77%;">Submitted your contact. Check history to see the response!.</label>
              </div>
              <div class="modal-footer">
            	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
          </div>
        </div>
    <!-- end failed modal -->