<script>
    function showDrop(){
        $('#select').attr('size',3);
		$("#select").toggle();
    }
    function populateTextBox(){
            var val = $("#select option:selected").text();
        $("#contentTitle").val(val);
		 $("#select").hide();
    }
   </script>
													<input onclick="showDrop();" type="text"  class="form-control" required id="contentTitle" name="contentTitle" placeholder="Content Title" >

<select id="select" name="" style="display:none;width: 100px;" onclick="populateTextBox();">
<option value="Value for Item 1" title="Title for Item 1">Item 1</option>
<option value="Value for Item 2" title="Title for Item 2">Item 2</option>
<option value="Value for Item 3" title="Title for Item 3">Item 3</option>
</select>												
