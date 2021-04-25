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