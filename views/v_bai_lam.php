<?php if($ds_thoi_gian == null){ ?>
	<div class="col-md-12 alert alert-danger">Bạn chưa làm bài nào !</div>
<?php } ?>
<?php if($ds_thoi_gian != null){ ?>
<div class="col-md-12">
<form action="hien_thi_bai.php" method="post">
	<div class="form-group col-md-12">
		<div class="col-md-offset-4 col-md-3">
			<select class="form-control" name="thoi_gian_lam_bai">
				<?php foreach($ds_thoi_gian as $thoi_gian){ ?>
					<option value="<?php echo $thoi_gian["time"] ?>"><?php echo date("d/m/Y H:i:s",strtotime($thoi_gian["time"])); ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group col-md-12">
		<div class="col-md-offset-5 col-md-3">
			<button type="submit" class="btn btn-success" name="xem">Xem Bài</button>
		</div>
	</div>
</form>
</div>
<?php } ?>