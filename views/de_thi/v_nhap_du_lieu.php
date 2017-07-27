<input type="text" pattern="[0-9]{1,3}" name="tinh_thoi_gian" value="" id="phut"> Phút
<script>
	$("#phut").keyup(function()
	{
		var phut = $(this).val();
		if(phut > 180 || phut == "" || isNaN(phut))
		{
			alert("Không được nhập quá 180 phút và không được để trống");
			$("#bat_dau").attr("disabled","disabled");
		}
		else
		{
			$("#bat_dau").attr("disabled",false);
		}
	})
</script>