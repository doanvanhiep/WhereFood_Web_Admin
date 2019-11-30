<div id="viewpicture" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">        
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title edit"></h4>
			</div>
			<div class="modal-body">
				<h1>List Picture</h1>
				<!-- The grid: four columns -->
				<div class="row">
				
				</div>

				<!-- The expanding image container -->
				<div class="container">
				<!-- Close the image -->
				<span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>

				<!-- Expanded image -->
				<img id="expandedImg" style="width:100%">

				<!-- Image text -->
				<div id="imgtext"></div>
				</div>
            </div>
		</div>
    </div>
</div>



<script>
function myFunction(imgs) {
  // Get the expanded image
  var expandImg = document.getElementById("expandedImg");
  // Get the image text
  var imgText = document.getElementById("imgtext");
  // Use the same src in the expanded image as the image being clicked on from the grid
  expandImg.src = imgs.src;
  // Use the value of the alt attribute of the clickable image as text inside the expanded image
  imgText.innerHTML = imgs.alt;
  // Show the container element (hidden with CSS)
  expandImg.parentElement.style.display = "block";
}
</script>