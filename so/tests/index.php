<!DOCTYPE html>

<html>
<head>
  <script src="jquery-1.11.3.min.js"></script>
  <script src="jsrender.min.js"></script>
</head>
<body>

<div id="result"></div>

<script id="theTmpl" type="text/x-jsrender">
<div>
   <em>Name:</em> {{:name}}
   {{if showNickname && nickname}}
      (Goes by <em>{{:nickname}}</em>)
   {{/if}}
</div>
</script>

<script>

$.ajax(
	{
		url: "ws.php", 
		dataType : 'json',
		type     : 'post',
		success: function(result){
			var template = $.templates("#theTmpl");
			var htmlOutput = template.render(result);
			$("#result").html(htmlOutput);
    		}
	}
);

</script>

</body>
</html>
