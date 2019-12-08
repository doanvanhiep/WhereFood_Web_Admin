<div id="edit-modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">        
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h1>User Detail</h1>
				<div id="userdetail">
					<form id="user-info">
						<div  class="form-group">
							<input type="hidden" class="form-control" id="txt-useraccount" name="txt-useraccount">
						</div>
						<div  class="form-group">
							<label for="txt-fullname">Full Name: </label>
							<input type="text" class="form-control" id="txt-fullname" name="txt-fullname">
						</div>
						<div  class="form-group">
							<label for="txt-dateofbirth">Date of Birth: </label>
							<input type="date" class="form-control" id="txt-dateofbirth" name="txt-dateofbirth">
						</div>
						<div  class="form-group">
							<label for="txt-phonenumber">Phone Number: </label>
							<input type="text" class="form-control" id="txt-phonenumber" name="txt-phonenumber">
						</div>
						<div class="modal-footer">
						<input type="button" value="Cancel" class="btn btn-secondary" data-dismiss="modal">
						<input type="button" id="btnupdate" name="submit" value="Save" class="btn btn-primary">
						</div>
					</form>
				</div>
            </div>
		</div>
    </div>
</div>