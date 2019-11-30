<div id="edit-food" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">        
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title edit"></h4>
			</div>
			<div class="modal-body">
				<h1>Food Info</h1>
				<div id="fooddetail">
					<form id="food-info">
					<div  class="form-group">
							<input type="hidden" class="form-control" id="txt-foodID" name="txt-foodID">
						</div>
						<div  class="form-group">
							<label for="txt-foodname">Food Name: </label>
							<input type="text" class="form-control" id="txt-foodname" name="txt-foodname">
						</div>
                        <div  class="form-group">
							<label for="txt-price">Price: </label>
							<input type="text" class="form-control" id="txt-price" name="txt-price">
						</div>
						<div  class="form-group">
							<label for="txt-shortdescription">Short Description: </label>
							<input type="text" class="form-control" id="txt-shortdescription" name="txt-shortdescription">
						</div>
                        <div  class="form-group">
							<label for="txt-longdescription">Long Description: </label>
							<input type="text" class="form-control" id="txt-longdescription" name="txt-longdescription">
						</div>
						<div class="modal-footer">
						<input type="button" id="btnupdatefood" name="submit" value="Save" class="form-control btn btn-default" >
						<input type="button" value="Cancel" class="form-control btn btn-default" data-dismiss="modal">
						</div>
					</form>
				</div>
            </div>
		</div>
    </div>
</div>